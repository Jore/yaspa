<?php

namespace Yaspa\Tests\Integration\AdminApi\Customer;

use DateTime;
use PHPUnit\Framework\TestCase;
use Yaspa\AdminApi\Customer\Builders\CustomerFields;
use Yaspa\AdminApi\Customer\Builders\GetCustomersRequest;
use Yaspa\AdminApi\Customer\CustomerService;
use Yaspa\Authentication\Factory\ApiCredentials;
use Yaspa\Factory;
use Yaspa\Tests\Utils\Config as TestConfig;

class CustomerServiceTest extends TestCase
{
    /**
     * @group integration
     */
    public function testGetCustomers()
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
        $fields = Factory::make(CustomerFields::class)
            ->withId()
            ->withEmail()
            ->withFirstName()
            ->withLastName()
            ->withVerifiedEmail()
            ->withCreatedAt()
            ->withUpdatedAt();
        $request = Factory::make(GetCustomersRequest::class)
            ->withCredentials($credentials)
            ->withCustomerFields($fields)
            ->withLimit(2)
            ->withCreatedAtMin(new DateTime('-1 year'));

        $service = Factory::make(CustomerService::class);
        $customers = $service->getCustomers($request);
        dump($customers);
    }
}