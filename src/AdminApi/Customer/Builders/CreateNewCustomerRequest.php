<?php

namespace Yaspa\AdminApi\Customer\Builders;

use Yaspa\AdminApi\Customer\Models\Customer as CustomerModel;
use Yaspa\AdminApi\Customer\Transformers\Customer as CustomerTransformer;
use Yaspa\AdminApi\Metafield\Models\Metafield as MetafieldModel;
use Yaspa\AdminApi\Metafield\Transformers\Metafield as MetafieldTransformer;
use Yaspa\Constants\RequestBuilder;
use Yaspa\Filters\ArrayFilters;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestBuilderTrait;

/**
 * Class CreateNewCustomerRequest
 *
 * @package Yaspa\AdminApi\Customer\Builders
 * @see https://help.shopify.com/api/reference/customer#create
 */
class CreateNewCustomerRequest implements RequestBuilderInterface
{
    use AuthorizedRequestBuilderTrait;

    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/customers.json';

    /**
     * Dependencies
     */
    /** @var CustomerTransformer */
    protected $customerTransformer;
    /** @var MetafieldTransformer */
    protected $metafieldTransformer;
    /** @var ArrayFilters $arrayFilters */
    protected $arrayFilters;

    /**
     * Builder properties
     */
    /** @var CustomerModel $customerModel */
    protected $customerModel;
    /** @var bool $sendEmailInvite */
    protected $sendEmailInvite;
    /** @var array|MetafieldModel[] $metafields */
    protected $metafields;
    /** @var string $password */
    protected $password;
    /** @var string $passwordConfirmation */
    protected $passwordConfirmation;

    /**
     * CreateNewCustomerRequest constructor.
     *
     * @param CustomerTransformer $customerTransformer
     * @param MetafieldTransformer $metafieldTransformer
     * @param ArrayFilters $arrayFilters
     */
    public function __construct(
        CustomerTransformer $customerTransformer,
        MetafieldTransformer $metafieldTransformer,
        ArrayFilters $arrayFilters
    ) {
        // Set dependencies
        $this->customerTransformer = $customerTransformer;
        $this->metafieldTransformer = $metafieldTransformer;
        $this->arrayFilters = $arrayFilters;

        // Set properties with defaults
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
        $array = [];

        if (!is_null($this->customerModel)) {
            $array = $this->customerTransformer->toArray($this->customerModel);
        }

        if (!is_null($this->sendEmailInvite)) {
            $array['send_email_invite'] = $this->sendEmailInvite;
        }

        if (!empty($this->metafields)) {
            $array['metafields'] = array_map([$this->metafieldTransformer, 'toArray'], $this->metafields);
        }

        if (!is_null($this->password)) {
            $array['password'] = $this->password;
        }

        if (!is_null($this->passwordConfirmation)) {
            $array['password_confirmation'] = $this->passwordConfirmation;
        }

        $array = $this->arrayFilters->arrayFilterRecursive($array, [$this->arrayFilters, 'notNull']);

        return ['customer' => $array];
    }

    /**
     * @param CustomerModel $customerModel
     * @return CreateNewCustomerRequest
     */
    public function withCustomer(CustomerModel $customerModel): CreateNewCustomerRequest
    {
        $new = clone $this;
        $new->customerModel = $customerModel;

        return $new;
    }

    /**
     * @param bool $sendEmailInvite
     * @return CreateNewCustomerRequest
     */
    public function withSendEmailInvite(bool $sendEmailInvite): CreateNewCustomerRequest
    {
        $new = clone $this;
        $new->sendEmailInvite = $sendEmailInvite;

        return $new;
    }

    /**
     * @param array|MetafieldModel[] $metafields
     * @return CreateNewCustomerRequest
     */
    public function withMetafields(array $metafields): CreateNewCustomerRequest
    {
        $new = clone $this;
        $new->metafields = $metafields;

        return $new;
    }

    /**
     * @param string $password
     * @return CreateNewCustomerRequest
     */
    public function withPassword(string $password): CreateNewCustomerRequest
    {
        $new = clone $this;
        $new->password = $password;

        return $new;
    }

    /**
     * @param string $passwordConfirmation
     * @return CreateNewCustomerRequest
     */
    public function withPasswordConfirmation(string $passwordConfirmation): CreateNewCustomerRequest
    {
        $new = clone $this;
        $new->passwordConfirmation = $passwordConfirmation;

        return $new;
    }
}
