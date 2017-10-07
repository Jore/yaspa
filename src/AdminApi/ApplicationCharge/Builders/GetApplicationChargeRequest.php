<?php

namespace Yaspa\AdminApi\ApplicationCharge\Builders;

use Yaspa\AdminApi\ApplicationCharge\Models\ApplicationCharge as ApplicationChargeModel;
use Yaspa\Constants\RequestBuilder;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestBuilderTrait;
use Yaspa\Traits\ResourceRequestBuilderTrait;

/**
 * Class GetApplicationChargeRequest
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Builders
 * @see https://help.shopify.com/api/reference/applicationcharge#index
 */
class GetApplicationChargeRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait,
        ResourceRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/application_charges/%s.json';

    /**
     * Builder properties
     */
    /** @var ApplicationChargeModel $applicationChargeModel */
    protected $applicationChargeModel;

    /**
     * GetApplicationChargeRequest constructor.
     */
    public function __construct()
    {
        $this->uriTemplate = self::URI_TEMPLATE;
        $this->httpMethod = RequestBuilder::GET_HTTP_METHOD;
        $this->headers = RequestBuilder::JSON_HEADERS;
        $this->bodyType = RequestBuilder::JSON_BODY_TYPE;
    }

    /**
     * @return int|null
     */
    public function toResourceId()
    {
        return $this->applicationChargeModel->getId();
    }

    /**
     * @param ApplicationChargeModel $applicationChargeModel
     * @return GetApplicationChargeRequest
     */
    public function withApplicationCharge(ApplicationChargeModel $applicationChargeModel): GetApplicationChargeRequest
    {
        $new = clone $this;
        $new->applicationChargeModel = $applicationChargeModel;

        return $new;
    }
}
