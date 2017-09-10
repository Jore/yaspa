<?php

namespace Yaspa\AdminApi\ApplicationCharge\Builders;

use Yaspa\AdminApi\ApplicationCharge\Models\ApplicationCharge as ApplicationChargeModel;
use Yaspa\Constants\RequestBuilder;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestBuilderTrait;
use Yaspa\Traits\ResourceRequestBuilderTrait;

/**
 * Class CreateAccountActivationUrlRequest
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Builders
 * @see https://help.shopify.com/api/reference/ApplicationCharge#account_activation_url
 */
class CreateAccountActivationUrlRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait,
        ResourceRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/application_charges.json';

    /**
     * Builder properties
     */
    /** @var ApplicationChargeModel $ApplicationChargeModel */
    protected $ApplicationChargeModel;

    /**
     * CreateAccountActivationUrlRequest constructor.
     */
    public function __construct()
    {
        $this->uriTemplate = self::URI_TEMPLATE;
        $this->httpMethod = RequestBuilder::POST_HTTP_METHOD;
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
     * @param ApplicationChargeModel $ApplicationChargeModel
     * @return CreateAccountActivationUrlRequest
     */
    public function withApplicationCharge(ApplicationChargeModel $ApplicationChargeModel): CreateAccountActivationUrlRequest
    {
        $new = clone $this;
        $new->ApplicationChargeModel = $ApplicationChargeModel;

        return $new;
    }
}
