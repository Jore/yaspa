<?php

namespace Yaspa\AdminApi\Customer;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Yaspa\AdminApi\Customer\Builders\CreateNewCustomerRequest;
use Yaspa\AdminApi\Customer\Builders\GetCustomerRequest;
use Yaspa\AdminApi\Customer\Builders\GetCustomersRequest;
use Yaspa\AdminApi\Customer\Builders\ModifyExistingCustomerRequest;
use Yaspa\AdminApi\Customer\Builders\SearchCustomersRequest;
use Yaspa\AdminApi\Customer\Models;
use Yaspa\AdminApi\Customer\Transformers;
use Yaspa\Builders\PagedResultsIterator;
use Yaspa\Interfaces\RequestCredentialsInterface;

/**
 * Class CustomerService
 *
 * @package Yaspa\AdminApi\Customer
 */
class CustomerService
{
    /** @var Client $httpClient */
    protected $httpClient;
    /** @var Transformers\Customer $customerTransformer */
    protected $customerTransformer;
    /** @var PagedResultsIterator $pagedResultsIteratorBuilder */
    protected $pagedResultsIteratorBuilder;
    /** @var GetCustomerRequest $getCustomerRequestBuilder */
    protected $getCustomerRequestBuilder;

    /**
     * CustomerService constructor.
     *
     * @param Client $httpClient
     * @param Transformers\Customer $customerTransformer
     * @param PagedResultsIterator $pagedResultsIteratorBuilder
     * @param GetCustomerRequest $getCustomerRequestBuilder
     */
    public function __construct(
        Client $httpClient,
        Transformers\Customer $customerTransformer,
        PagedResultsIterator $pagedResultsIteratorBuilder,
        GetCustomerRequest $getCustomerRequestBuilder
    ) {
        $this->httpClient = $httpClient;
        $this->customerTransformer = $customerTransformer;
        $this->pagedResultsIteratorBuilder = $pagedResultsIteratorBuilder;
        $this->getCustomerRequestBuilder = $getCustomerRequestBuilder;
    }

    /**
     * Get customers based on parameters set in the request.
     *
     * @see https://help.shopify.com/api/reference/customer#index
     * @param GetCustomersRequest $request
     * @return Models\Customer[]|PagedResultsIterator
     */
    public function getCustomers(GetCustomersRequest $request): PagedResultsIterator
    {
        return $this->pagedResultsIteratorBuilder
            ->withRequestBuilder($request)
            ->withTransformer($this->customerTransformer);
    }

    /**
     * Async version of self::getCustomers
     *
     * Please note that results will have to be manually transformed.
     *
     * @see https://help.shopify.com/api/reference/customer#index
     * @param GetCustomersRequest $request
     * @return PromiseInterface
     */
    public function asyncGetCustomers(GetCustomersRequest $request): PromiseInterface {
        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * Search customers.
     *
     * @progress Just managed to get integration test working, there are issues with iterator
     * @see https://help.shopify.com/api/reference/customer#search
     * @param SearchCustomersRequest $request
     * @return Models\Customer[]|PagedResultsIterator
     */
    public function searchCustomers(SearchCustomersRequest $request): PagedResultsIterator
    {
        return $this->pagedResultsIteratorBuilder
            ->withRequestBuilder($request)
            ->withTransformer($this->customerTransformer);
    }

    /**
     * Async version of self::searchCustomers
     *
     * @see https://help.shopify.com/api/reference/customer#search
     * @param SearchCustomersRequest $request
     * @return PromiseInterface
     */
    public function asyncSearchCustomers(SearchCustomersRequest $request): PromiseInterface {
        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * Create a new customer.
     *
     * @see https://help.shopify.com/api/reference/customer#create
     * @param CreateNewCustomerRequest $request
     * @return Models\Customer
     */
    public function createNewCustomer(CreateNewCustomerRequest $request): Models\Customer
    {
        $response = $this->asyncCreateNewCustomer($request)->wait();

        return $this->customerTransformer->fromResponse($response);
    }

    /**
     * Async version of self::createNewCustomer
     *
     * @see https://help.shopify.com/api/reference/customer#create
     * @param CreateNewCustomerRequest $request
     * @return PromiseInterface
     */
    public function asyncCreateNewCustomer(CreateNewCustomerRequest $request): PromiseInterface
    {
        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * Modify an existing customer.
     *
     * @see https://help.shopify.com/api/reference/customer#update
     * @param ModifyExistingCustomerRequest $request
     * @return Models\Customer
     */
    public function modifyExistingCustomer(ModifyExistingCustomerRequest $request): Models\Customer
    {
        $response = $this->asyncModifyExistingCustomer($request)->wait();

        return $this->customerTransformer->fromResponse($response);
    }

    /**
     * Async version of self::updateExistingCustomer
     *
     * @see https://help.shopify.com/api/reference/customer#update
     * @param ModifyExistingCustomerRequest $request
     * @return PromiseInterface
     */
    public function asyncModifyExistingCustomer(ModifyExistingCustomerRequest $request): PromiseInterface
    {
        return $this->httpClient->sendAsync(
            $request->toResourceRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * @todo Refactor out reused constants such as POST, PUT, ContentType and Accepts
     */
    /**
     * @param RequestCredentialsInterface $credentials
     * @param int $customerId
     * @return Models\Customer
     */
    public function getCustomer(RequestCredentialsInterface $credentials, int $customerId): Models\Customer
    {
        $response = $this->asyncGetCustomer($credentials, $customerId)->wait();

        return $this->customerTransformer->fromResponse($response);
    }

    /**
     * Async version of self::getCustomer
     *
     * @param RequestCredentialsInterface $credentials
     * @param int $customerId
     * @return PromiseInterface
     */
    public function asyncGetCustomer(RequestCredentialsInterface $credentials, int $customerId): PromiseInterface
    {
        $customer = (new Models\Customer())->setId($customerId);
        $request = $this->getCustomerRequestBuilder
            ->withCredentials($credentials)
            ->withCustomer($customer);

        return $this->httpClient->sendAsync(
            $request->toResourceRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * @todo https://help.shopify.com/api/reference/customer#account_activation_url
     */
}
