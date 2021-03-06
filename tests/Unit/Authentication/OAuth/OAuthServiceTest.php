<?php

namespace Yaspa\Tests\Unit\Authentication\OAuth;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Yaspa\Authentication\OAuth\Builders\NewDelegateAccessTokenRequest;
use Yaspa\Authentication\OAuth\Builders\Scopes;
use Yaspa\Authentication\OAuth\Models\AccessToken;
use Yaspa\Authentication\OAuth\Models\AuthorizationCode;
use Yaspa\Authentication\OAuth\Models\Credentials;
use Yaspa\Authentication\OAuth\OAuthService as OAuthService;
use Yaspa\Factory;
use Yaspa\Tests\Utils\MockGuzzleClient;

class OAuthServiceTest extends TestCase
{
    public function testCanRequestPermanentAccessToken()
    {
        // Create mock client
        $container = [];
        $mockClientUtil = new MockGuzzleClient();
        $client = $mockClientUtil->makeWithJsonResponse(
            200,
            [
                'access_token' => 'foo',
            ],
            $container
        );
        Factory::inject(Client::class, $client);

        // Create parameters
        $authorizationCode = new AuthorizationCode();
        $authorizationCode
            ->setCode('0907a61c0c8d55e99db179b68161bc00')
            ->setShop('some-shop.myshopify.com')
            ->setTimestamp('1337178173')
            ->setHmac('4712bf92ffc2917d15a2f5a273e39f0116667419aa4b6ac0b3baaf26fa3c4d20');

        $credentials = new Credentials();
        $credentials
            ->setApiKey('foo')
            ->setApiSecretKey('hush');

        // Test results
        $oAuthService = Factory::make(OAuthService::class);
        $result = $oAuthService->requestPermanentAccessToken($authorizationCode, $credentials);
        $this->assertInstanceOf(AccessToken::class, $result);
        $this->assertEquals('foo', $result->getAccessToken());

        // Test request
        $this->assertCount(1, $container);
        /** @var RequestInterface $request */
        $request = $container[0]['request'];
        $requestBody = $request->getBody()->getContents();
        $this->assertContains('client_id', $requestBody);
        $this->assertContains('client_secret', $requestBody);
        $this->assertContains('code', $requestBody);
    }

    public function testCanDelegateAccessToken()
    {
        // Create mock client
        $container = [];
        $mockClientUtil = new MockGuzzleClient();
        $client = $mockClientUtil->makeWithJsonResponse(
            200,
            [
                'access_token' => 'foo',
                'scope' => 'bar,baz',
                'expires_in' => 10,
            ],
            $container
        );
        Factory::inject(Client::class, $client);

        // Prepare parameters
        $accessToken = new AccessToken();
        $accessToken->setAccessToken('foo');

        $scopes = (new Scopes())
            ->withWriteOrders()
            ->withWriteCustomers();

        $delegateAccessTokenRequest = Factory::make(NewDelegateAccessTokenRequest::class)
            ->withShop('bar')
            ->withAccessToken($accessToken)
            ->withScopes($scopes)
            ->withExpiresIn(10);

        // Test method
        $instance = Factory::make(OAuthService::class);
        $delegateToken = $instance->createNewDelegateAccessToken($delegateAccessTokenRequest);

        // Test results
        $this->assertInstanceOf(AccessToken::class, $delegateToken);
        $this->assertNotEmpty($delegateToken->getAccessToken());
        $this->assertNotEmpty($delegateToken->getScopes());
        $this->assertNotEmpty($delegateToken->getExpiresIn());

        // Test request
        $this->assertCount(1, $container);
        /** @var RequestInterface $request */
        $request = $container[0]['request'];
        $requestBody = $request->getBody()->getContents();
        $this->assertContains('delegate_access_scope', $requestBody);
        $this->assertContains('expires_in', $requestBody);
    }

    public function testCanDelegateAccessTokenWithoutExpires()
    {
        // Create mock client
        $container = [];
        $mockClientUtil = new MockGuzzleClient();
        $client = $mockClientUtil->makeWithJsonResponse(
            200,
            [
                'access_token' => 'foo',
                'scope' => 'bar,baz',
            ],
            $container
        );
        Factory::inject(Client::class, $client);

        // Prepare parameters
        $accessToken = new AccessToken();
        $accessToken->setAccessToken('foo');

        $scopes = (new Scopes())
            ->withWriteOrders()
            ->withWriteCustomers();

        $delegateAccessTokenRequest = Factory::make(NewDelegateAccessTokenRequest::class)
            ->withShop('bar')
            ->withAccessToken($accessToken)
            ->withScopes($scopes);

        // Test method
        $instance = Factory::make(OAuthService::class);
        $delegateToken = $instance->createNewDelegateAccessToken($delegateAccessTokenRequest);

        // Test results
        $this->assertInstanceOf(AccessToken::class, $delegateToken);
        $this->assertNotEmpty($delegateToken->getAccessToken());
        $this->assertNotEmpty($delegateToken->getScopes());
        $this->assertEmpty($delegateToken->getExpiresIn());

        // Test request
        $this->assertCount(1, $container);
        /** @var RequestInterface $request */
        $request = $container[0]['request'];
        $requestBody = $request->getBody()->getContents();
        $this->assertContains('delegate_access_scope', $requestBody);
        $this->assertNotContains('expires_in', $requestBody);
    }
}
