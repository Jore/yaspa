<?php

namespace Yaspa\AdminApi\ApplicationCharge;

use GuzzleHttp;
use Yaspa\Interfaces\FactoryInterface;
use Yaspa\Interfaces\FactoryProviderInterface;

/**
 * Class ApplicationChargeFactoryProvider
 *
 * @package Yaspa\AdminApi\ApplicationCharge
 */
class ApplicationChargeFactoryProvider implements FactoryProviderInterface
{
    /**
     * @param FactoryInterface $factory
     * @return array
     */
    public static function makeConstructors(FactoryInterface $factory): array
    {
        return [
            Builders\CreateNewApplicationChargeRequest::class => function () use ($factory) {
                return new Builders\CreateNewApplicationChargeRequest(
                    $factory::make(Transformers\ApplicationCharge::class)
                );
            },
            Builders\GetApplicationChargesRequest::class => function () {
                return new Builders\GetApplicationChargesRequest();
            },
            ApplicationChargeService::class => function () use ($factory) {
                return new ApplicationChargeService(
                    $factory::make(GuzzleHttp\Client::class),
                    $factory::make(Transformers\ApplicationCharge::class),
                    $factory::make(Builders\CreateNewApplicationChargeRequest::class)
                );
            },
            Transformers\ApplicationCharge::class => function () {
                return new Transformers\ApplicationCharge();
            },
        ];
    }
}
