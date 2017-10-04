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
 * @package Yaspa\AdminApi\Customer\Builders
 * @see https://help.shopify.com/api/reference/applicationcharge#show
 */
class GetApplicationChargeRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait,
        ResourceRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/application_charges/%s.json';

    /**
     * Builder properties
     */
    /** @var ApplicationChargeModel $ApplicationChargeModel */
    protected $ApplicationChargeModel;
    /** @var ApplicationChargeFields $ApplicationChargeFields */
    protected $ApplicationChargeFields;

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
        return $this->ApplicationChargeModel->getId();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        if (!is_null($this->ApplicationChargeFields)) {
            $array['fields'] = implode(',', $this->ApplicationChargeFields->getFields());
        }

        return $array;
    }

    /**
     * @param ApplicationChargeModel $ApplicationChargeModel
     * @return GetApplicationChargeRequest
     */
    public function withApplicationCharge(ApplicationChargeModel $ApplicationChargeModel): GetApplicationChargeRequest
    {
        $new = clone $this;
        $new->ApplicationChargeModel = $ApplicationChargeModel;

        return $new;
    }

    /**
     * @param ApplicationChargeFields $ApplicationChargeFields
     * @return GetApplicationChargeRequest
     */
    public function withApplicationChargeFields(ApplicationChargeFields $ApplicationChargeFields): GetApplicationChargeRequest
    {
        $new = clone $this;
        $new->ApplicationChargeFields = $ApplicationChargeFields;

        return $new;
    }
}
