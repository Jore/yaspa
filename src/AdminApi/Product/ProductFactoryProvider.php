<?php

namespace Yaspa\AdminApi\Product;

use GuzzleHttp;
use Yaspa\AdminApi\Metafield;
use Yaspa\Builders\PagedResultsIterator;
use Yaspa\Interfaces\FactoryInterface;
use Yaspa\Interfaces\FactoryProviderInterface;

/**
 * Class ProductFactoryProvider
 *
 * @package Yaspa\AdminApi\Product
 */
class ProductFactoryProvider implements FactoryProviderInterface
{
    /**
     * @param FactoryInterface $factory
     * @return array
     */
    public static function makeConstructors(FactoryInterface $factory): array
    {
        return [
            Builders\CreateNewProductRequest::class => function () use ($factory) {
                return new Builders\CreateNewProductRequest(
                    $factory::make(Transformers\Product::class)
                );
            },
            Builders\GetProductsRequest::class => function () {
                return new Builders\GetProductsRequest();
            },
            Builders\ProductFields::class => function () {
                return new Builders\ProductFields();
            },
            ProductService::class => function () use ($factory) {
                return new ProductService(
                    $factory::make(GuzzleHttp\Client::class),
                    $factory::make(Transformers\Product::class),
                    $factory::make(Builders\CreateNewProductRequest::class),
                    $factory::make(PagedResultsIterator::class)
                );
            },
            Transformers\Product::class => function () use ($factory) {
                return new Transformers\Product(
                    $factory::make(Transformers\Variant::class),
                    $factory::make(Transformers\Image::class),
                    $factory::make(Metafield\Transformers\Metafield::class)
                );
            },
            Transformers\Image::class => function () {
                return new Transformers\Image();
            },
            Transformers\Variant::class => function () {
                return new Transformers\Variant();
            },
        ];
    }
}