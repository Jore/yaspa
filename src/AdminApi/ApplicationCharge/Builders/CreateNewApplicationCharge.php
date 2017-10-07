<?php

namespace Yaspa\AdminApi\ApplicationCharge\Builders;

use Yaspa\AdminApi\ApplicationCharge\Models\ApplicationCharge as ApplicationChargeModel;
use Yaspa\AdminApi\ApplicationCharge\Transformers\ApplicationCharge as ApplicationChargeTransformer;
use Yaspa\Constants\RequestBuilder;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestBuilderTrait;
use Yaspa\Traits\ResourceRequestBuilderTrait;

/**
 * Class CreateNewApplicationChargeRequest
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Builders
 * @see https://help.shopify.com/api/reference/applicationcharge#create
 */
class CreateNewApplicationChargeRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait,
        ResourceRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/application_charges.json';

    /**
     * Builder properties
     */
    /** @var ApplicationChargeModel $applicationChargeModel */
    protected $applicationChargeModel;
    /** @var ApplicationChargeTransformer $applicationChargeTransformer */
    protected $applicationChargeTransformer;

    /**
     * CreateNewApplicationChargeRequest constructor.
     *
     * @param ApplicationChargeTransformer $applicationChargeTransformer
     */
    public function __construct(ApplicationChargeTransformer $applicationChargeTransformer)
    {
        $this->applicationChargeTransformer = $applicationChargeTransformer;
        $this->uriTemplate = self::URI_TEMPLATE;
        $this->httpMethod = RequestBuilder::POST_HTTP_METHOD;
        $this->headers = RequestBuilder::JSON_HEADERS;
        $this->bodyType = RequestBuilder::JSON_BODY_TYPE;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return ['application_charge' => $this->applicationChargeTransformer->toArray($this->applicationChargeModel)];
    }

    /**
     * @param ApplicationChargeModel $applicationChargeModel
     * @return CreateNewApplicationChargeRequest
     */
    public function withApplicationCharge(ApplicationChargeModel $applicationChargeModel): CreateNewApplicationChargeRequest
    {
        $new = clone $this;
        $new->applicationChargeModel = $applicationChargeModel;

        return $new;
    }
}
