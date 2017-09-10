<?php

namespace Yaspa\AdminApi\ApplicationCharge;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Yaspa\AdminApi\ApplicationCharge\Builders\GetApplicationChargesRequest;
use Yaspa\AdminApi\ApplicationCharge\Builders\CreateNewApplicationChargeRequest;
use Yaspa\AdminApi\ApplicationCharge\Models\ApplicationCharge;
use Yaspa\AdminApi\ApplicationCharge\Transformers;
use Yaspa\Interfaces\RequestCredentialsInterface;

/**
 * Class ApplicationChargeService
 *
 * @package Yaspa\AdminApi\ApplicationCharge
 * @see https://help.shopify.com/api/reference/applicationcharge
 */
class ApplicationChargeService
{
    /** @var Client $httpClient */
    protected $httpClient;
    /** @var Transformers\ApplicationCharge $applicationChargeTransformer */
    protected $applicationChargeTransformer;
    /** @var CreateNewApplicationChargeRequest $createNewApplicationChargeRequestBuilder */
    protected $createNewApplicationChargeRequestBuilder;

    /**
     * ApplicationChargeService constructor.
     *
     * @param Client $httpClient
     * @param Transformers\ApplicationCharge $ApplicationChargeTransformer
     * @param CreateNewApplicationChargeRequest $createNewApplicationChargeRequestBuilder
     */
    public function __construct(
        Client $httpClient,
        Transformers\ApplicationCharge $applicationChargeTransformer,
        CreateNewApplicationChargeRequest $createNewApplicationChargeRequestBuilder
    ) {
        $this->httpClient = $httpClient;
        $this->applicationChargeTransformer = $applicationChargeTransformer;
        $this->createNewApplicationChargeRequestBuilder = $createNewApplicationChargeRequestBuilder;
    }

    /**
     * Get ApplicationCharges based on parameters set in the request.
     *
     * @see https://help.shopify.com/api/reference/ApplicationCharge#index
     * @param GetApplicationChargesRequest $request
     * @return ApplicationCharge[]
     */
    public function getApplicationCharges(GetApplicationChargesRequest $request): array
    {
        $response = $this->asyncGetApplicationCharges($request)->wait();

        return $this->applicationChargeTransformer->fromArrayResponse($response);
    }

    /**
     * Async version of self::getApplicationCharges
     *
     * Please note that results will have to be manually transformed.
     *
     * @see https://help.shopify.com/api/reference/ApplicationCharge#index
     * @param GetApplicationChargesRequest $request
     * @return PromiseInterface
     */
    public function asyncGetApplicationCharges(GetApplicationChargesRequest $request): PromiseInterface
    {
        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }

    /**
     * Create a new ApplicationCharge
     *
     * @see https://help.shopify.com/api/reference/ApplicationCharge#create
     * @param RequestCredentialsInterface $credentials
     * @param Models\ApplicationCharge $applicationCharge
     * @return Models\ApplicationCharge
     */
    public function createNewApplicationCharge(
        RequestCredentialsInterface $credentials,
        Models\ApplicationCharge $applicationCharge
    ): Models\ApplicationCharge {
        $response = $this->asyncCreateNewApplicationCharge($credentials, $applicationCharge)->wait();

        return $this->applicationChargeTransformer->fromResponse($response);
    }

    /**
     * Async version of self::createNewApplicationCharge
     *
     * @see https://help.shopify.com/api/reference/applicationcharge#create
     * @param RequestCredentialsInterface $credentials
     * @param Models\ApplicationCharge $applicationCharge
     * @return PromiseInterface
     */
    public function asyncCreateNewApplicationCharge(
        RequestCredentialsInterface $credentials,
        Models\ApplicationCharge $applicationCharge
    ): PromiseInterface {
        $request = $this->createNewApplicationChargeRequestBuilder
            ->withCredentials($credentials)
            ->withApplicationCharge($applicationCharge);

        return $this->httpClient->sendAsync(
            $request->toRequest(),
            $request->toRequestOptions()
        );
    }
}
