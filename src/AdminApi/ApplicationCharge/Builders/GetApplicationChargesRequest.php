<?php

namespace Yaspa\AdminApi\ApplicationCharge\Builders;

use Yaspa\Constants\RequestBuilder;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestBuilderTrait;
use Yaspa\Traits\ResourceRequestBuilderTrait;

/**
 * Class GetApplicationChargesRequest
 *
 * @package Yaspa\AdminApi\Customer\Builders
 * @see https://help.shopify.com/api/reference/applicationcharge#index
 */
class GetApplicationChargesRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait,
        ResourceRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/application_charges/%s.json';

    /** @var int $sinceId */
    protected $sinceId;
    /** @var ApplicationChargeFields $applicationChargeFields */
    protected $applicationChargeFields;

    /**
     * GetApplicationChargesRequest constructor.
     */
    public function __construct()
    {
        // Set properties with defaults
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
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        if (!is_null($this->sinceId)) {
            $array['since_id'] = $this->sinceId;
        }

        if (!is_null($this->applicationChargeFields)) {
            $array['applicationcharge_fields'] = implode(',', $this->applicationChargeFields->getFields());
        }

        return $array;
    }

    /**
     * @param int $sinceId
     * @return GetApplicationChargesRequest
     */
    public function withSinceId(int $sinceId): GetApplicationChargesRequest
    {
        $new = clone $this;
        $new->sinceId = $sinceId;

        return $new;
    }
    /**
     * @param ApplicationChargeFields $applicationChargeFields
     * @return GetApplicationChargesRequest
     */
    public function withApplicationChargeFields(ApplicationChargeFields $applicationChargeFields): GetApplicationChargesRequest
    {
        $new = clone $this;
        $new->applicationChargeFields = $applicationChargeFields;

        return $new;
    }
}
