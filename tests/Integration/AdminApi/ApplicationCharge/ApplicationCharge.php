<?php

namespace Yaspa\Tests\Integration\AdminApi\ApplicationCharge;

use DateTime;
use PHPUnit\Framework\TestCase;
use Yaspa\AdminApi\ApplicationCharge\Builders\CreateNewApplicationChargeRequest;
use Yaspa\AdminApi\ApplicationCharge\Models\ApplicationCharge;
use Yaspa\Authentication\Factory\ApiCredentials;
use Yaspa\Factory;
use Yaspa\Tests\Utils\Config as TestConfig;

class ApplicationChargeTest extends TestCase
{
    /**
     * @group integration
     * @return ApplicationCharge
     */
    public function testCanCreateNewApplicationCharge()
    {
        // Get config
        $config = new TestConfig();
        $shop = $config->get('shopifyShop');
        $privateApp = $config->get('shopifyShopApp');

        // Create parameters
        $credentials = Factory::make(ApiCredentials::class)
            ->makePrivate(
                $shop->myShopifySubdomainName,
                $privateApp->apiKey,
                $privateApp->password
            );

        // Test method
        $applicationCharge = (new ApplicationCharge())
            ->setName('Super Duper Expensive charge')
            ->setPrice('100.00')
            ->setReturnUrl('http://super-duper.shopifyapps.com')
            ->setTest(true);

        $request = Factory::make(CreateNewApplicationChargeRequest::class)
            ->withCredentials($credentials)
            ->withApplicationCharge($applicationCharge);

        $service = Factory::make(ApplicationChargeService::class);
        $newApplicationCharge = $service->createNewApplicationCharge($request);
        $this->assertInstanceOf(ApplicationCharge::class, $newApplicationCharge);
        $this->assertNotEmpty($newApplicationCharge->getId());
        $this->assertEquals('name', $newApplicationCharge->getName());
        $this->assertEquals('price', $newApplicationCharge->getPrice());
        $this->assertEquals('status', $newApplicationCharge->getStatus());
        $this->assertEquals('return_url', $newApplicationCharge->getReturnUrl());
        $this->assertEquals('test', $newApplicationCharge->getTest());
        $this->assertNotEmpty($newApplicationCharge->getConfirmationUrl());

        return $newApplicationCharge;
    }
}
