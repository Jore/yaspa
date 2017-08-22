<?php

namespace Yaspa\Tests\Integration\AdminApi\Metafield;

use GuzzleHttp\Exception\ClientException;
use Yaspa\AdminApi\Metafield\Builders\MetafieldFields;
use Yaspa\AdminApi\Metafield\MetafieldService;
use Yaspa\AdminApi\Metafield\Builders\GetMetafieldsRequest;
use Yaspa\AdminApi\Metafield\Models\Metafield;
use Yaspa\Tests\Utils\Config as TestConfig;
use Yaspa\Authentication\Factory\ApiCredentials;
use Yaspa\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class MetafieldServiceTest
 *
 * @package Yaspa\Tests\Integration\AdminApi\Metafield
 *
 * Please note that resource related tests at in resource specific tests. Theyse are:
 *
 * - Get metafields that belong to a product
 * - Get metafields that belong to a product image
 */
class MetafieldServiceTest extends TestCase
{
    /**
     * @group integration
     */
    public function testCanCreateANewMetafieldForAStore()
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
        $metafield = (new Metafield())
            ->setNamespace('inventory')
            ->setKey('warehouse')
            ->setValue(25)
            ->setValueType('integer');

        // Get and test results
        $service = Factory::make(MetafieldService::class);
        $createdMetafield = $service->createNewMetafield($credentials, $metafield);
        $this->assertNotEmpty($createdMetafield->getId());

        return $createdMetafield;
    }

    /**
     * @group integration
     */
    public function testCannotCreateAMetafieldWithoutAKey()
    {
        // Expect Guzzle client exception due to response 422, unprocessable entity
        $this->expectException(ClientException::class);

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
        $metafield = new Metafield();

        // Get and test results
        $service = Factory::make(MetafieldService::class);
        $service->createNewMetafield($credentials, $metafield);
    }

    /**
     * @depends testCanCreateANewMetafieldForAStore
     * @group integration
     * @param Metafield $originalMetafield
     */
    public function testCanGetAllMetafieldsAfterTheSpecifiedId(Metafield $originalMetafield)
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
        $request = Factory::make(GetMetafieldsRequest::class)
            ->withCredentials($credentials)
            ->withSinceId($originalMetafield->getId() - 1);

        // Get and test results
        $service = Factory::make(MetafieldService::class);
        $metafields = $service->getMetafields($request);
        $this->assertNotEmpty($metafields);
    }

    /**
     * @depends testCanCreateANewMetafieldForAStore
     * @group integration
     */
    public function testCanGetAllMetafieldsThatBelongToAStore()
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
        $request = Factory::make(GetMetafieldsRequest::class)
            ->withCredentials($credentials)
            ->withLimit(1);

        // Get and test results
        $service = Factory::make(MetafieldService::class);
        $metafields = $service->getMetafields($request);
        $this->assertCount(1, $metafields);
    }
}
