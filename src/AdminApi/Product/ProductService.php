<?php

namespace Yaspa\AdminApi\Product;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Yaspa\AdminApi\Product\Builders\CreateNewProductRequest;
use Yaspa\AdminApi\Product\Builders\GetProductsRequest;
use Yaspa\AdminApi\Product\Models;
use Yaspa\AdminApi\Product\Transformers;
use Yaspa\Builders\PagedResultsIterator;
use Yaspa\Interfaces\RequestCredentialsInterface;

/**
 * Class ProductService
 *
 * @package Yaspa\AdminApi\Product
 * @see https://help.shopify.com/api/reference/product
 */
class ProductService
{
    /** @var Client $httpClient */
    protected $httpClient;
    /** @var Transformers\Product $productTransformer */
    protected $productTransformer;
    /** @var CreateNewProductRequest $createNewProductRequestBuilder */
    protected $createNewProductRequestBuilder;
    /** @var PagedResultsIterator $pagedResultsIteratorBuilder */
    protected $pagedResultsIteratorBuilder;

    /**
     * ProductService constructor.
     *
     * @param Client $httpClient
     * @param Transformers\Product $productTransformer
     * @param CreateNewProductRequest $createNewProductRequestBuilder
     * @param PagedResultsIterator $pagedResultsIteratorBuilder
     */
    public function __construct(
        Client $httpClient,
        Transformers\Product $productTransformer,
        CreateNewProductRequest $createNewProductRequestBuilder,
        PagedResultsIterator $pagedResultsIteratorBuilder
    ) {
        $this->httpClient = $httpClient;
        $this->productTransformer = $productTransformer;
        $this->createNewProductRequestBuilder = $createNewProductRequestBuilder;
        $this->pagedResultsIteratorBuilder = $pagedResultsIteratorBuilder;
    }

    /**
     * Get products based on parameters set in the request.
     *
     * @see https://help.shopify.com/api/reference/product#index
     * @param GetProductsRequest $request
     * @return PagedResultsIterator
     */
    public function getProducts(GetProductsRequest $request): PagedResultsIterator
    {
        return $this->pagedResultsIteratorBuilder
            ->withRequestBuilder($request)
            ->withTransformer($this->productTransformer);
    }

    /**
     * Async version of self::getProducts
     *
     * Please note that results will have to be manually transformed.
     *
     * @see https://help.shopify.com/api/reference/product#index
     * @param GetProductsRequest $request
     * @return PromiseInterface
     */
    public function asyncGetProducts(GetProductsRequest $request): PromiseInterface
    {
        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * @todo Implement count https://help.shopify.com/api/reference/product#count
     */

    /**
     * Create a new product
     *
     * @see https://help.shopify.com/api/reference/product#create
     * @param RequestCredentialsInterface $credentials
     * @param Models\Product $product
     * @return Models\Product
     */
    public function createNewProduct(
        RequestCredentialsInterface $credentials,
        Models\Product $product
    ): Models\Product {
        $response = $this->asyncCreateNewProduct($credentials, $product)->wait();

        return $this->productTransformer->fromResponse($response);
    }

    /**
     * Async version of self::createNewProduct
     *
     * @see https://help.shopify.com/api/reference/product#create
     * @param RequestCredentialsInterface $credentials
     * @param Models\Product $product
     * @return PromiseInterface
     */
    public function asyncCreateNewProduct(
        RequestCredentialsInterface $credentials,
        Models\Product $product
    ): PromiseInterface {
        $request = $this->createNewProductRequestBuilder
            ->withCredentials($credentials)
            ->withProduct($product);

        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }
}