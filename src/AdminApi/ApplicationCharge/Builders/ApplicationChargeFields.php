<?php

namespace Yaspa\AdminApi\ApplicationCharge\Builders;

/**
 * Class ApplicationChargeFields
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Builders
 * @see https://help.shopify.com/api/reference/applicationcharge#show
 *
 * Field builder for use with requests such as get customers.
 */
class ApplicationChargeFields
{
    const ID = 'id';
    const CONFIRMATION_URL = 'confirmation_url';
    const CREATED_AT = 'created_at';
    const NAME = 'name';
    const PRICE = 'price';
    const RETURN_URL = 'return_url';
    const STATUS = 'status';
    const TEST = 'test';
    const UPDATED_AT = 'updated_at';

    /** @var string $fields */
    protected $fields;

    /**
     * CustomerFields constructor.
     */
    public function __construct()
    {
        $this->fields = [];
    }

    /**
     * @return string[]
     */
    public function getFields(): array
    {
        return array_unique($this->fields);
    }

    /**
     * @return CustomerFields
     */
    public function withId(): CustomerFields
    {
        $new = clone $this;
        $new->fields[] = self::ID;

        return $new;
    }

    /**
     * @return CustomerFields
     */
    public function withCreatedAt(): CustomerFields
    {
        $new = clone $this;
        $new->fields[] = self::CREATED_AT;

        return $new;
    }

    /**
     * @return CustomerFields
     */
    public function withUpdatedAt(): CustomerFields
    {
        $new = clone $this;
        $new->fields[] = self::UPDATED_AT;

        return $new;
    }
}
