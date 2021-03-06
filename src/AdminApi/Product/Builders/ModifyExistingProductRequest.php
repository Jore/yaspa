<?php

namespace Yaspa\AdminApi\Product\Builders;

use Yaspa\AdminApi\Metafield\Models\Metafield as MetafieldModel;
use Yaspa\AdminApi\Metafield\Transformers\Metafield as MetafieldTransformer;
use Yaspa\AdminApi\Product\Models\Product as ProductModel;
use Yaspa\AdminApi\Product\Models\Product;
use Yaspa\AdminApi\Product\Transformers\Product as ProductTransformer;
use Yaspa\Constants\RequestBuilder;
use Yaspa\Filters\ArrayFilters;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestBuilderTrait;
use Yaspa\Traits\ResourceRequestBuilderTrait;

/**
 * Class ModifyExistingProductRequest
 *
 * @package Yaspa\AdminApi\Customer\Builders
 * @see https://help.shopify.com/api/reference/product#update
 */
class ModifyExistingProductRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait,
        ResourceRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/products/%s.json';

    /**
     * Dependencies
     */
    /** @var ProductTransformer $productTransformer */
    protected $productTransformer;
    /** @var MetafieldTransformer */
    protected $metafieldTransformer;
    /** @var ArrayFilters $arrayFilters */
    protected $arrayFilters;

    /**
     * Builder properties
     */
    /** @var  ProductModel $productModel */
    protected $productModel;
    /** @var array|MetafieldModel[] $metafields */
    protected $metafields;

    /**
     * ModifyExistingProductRequest constructor.
     *
     * @param ProductTransformer $productTransformer
     * @param MetafieldTransformer $metafieldTransformer
     * @param ArrayFilters $arrayFilters
     */
    public function __construct(
        ProductTransformer $productTransformer,
        MetafieldTransformer $metafieldTransformer,
        ArrayFilters $arrayFilters
    ) {
        $this->productTransformer = $productTransformer;
        $this->metafieldTransformer = $metafieldTransformer;
        $this->arrayFilters = $arrayFilters;
        $this->uriTemplate = self::URI_TEMPLATE;
        $this->httpMethod = RequestBuilder::PUT_HTTP_METHOD;
        $this->headers = RequestBuilder::JSON_HEADERS;
        $this->bodyType = RequestBuilder::JSON_BODY_TYPE;
    }

    /**
     * @return int|null
     */
    public function toResourceId()
    {
        return $this->productModel->getId();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        // Transform model
        if (!is_null($this->productModel)) {
            $array = $this->productTransformer->toArray($this->productModel);
        }

        // Transform nested models
        if (!empty($this->metafields)) {
            $array['metafields'] = array_map([$this->metafieldTransformer, 'toArray'], $this->metafields);
        }

        // Retain only not null values
        $array = $this->arrayFilters->arrayFilterRecursive($array, [$this->arrayFilters, 'notNull']);

        return ['product' => $array];
    }

    /**
     * @param Product $product
     * @return ModifyExistingProductRequest
     */
    public function withProduct(ProductModel $product): ModifyExistingProductRequest
    {
        $new = clone $this;
        $new->productModel = $product;

        return $new;
    }

    /**
     * @param array|MetafieldModel[] $metafields
     * @return ModifyExistingProductRequest
     */
    public function withMetafields(array $metafields): ModifyExistingProductRequest
    {
        $new = clone $this;
        $new->metafields = $metafields;

        return $new;
    }
}
