<?php

namespace Yaspa\AdminApi\ApplicationCharge\Builders;

/**
 * Class ApplicationChargeFields
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Builders
 * @see https://help.shopify.com/api/reference/applicationcharge#show
 *
 * Possible fields to be included with return data resulting from a application charges call.
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
     * ApplicationChargeFields constructor.
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
     * @return ApplicationChargeFields
     */
    public function withId(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::ID;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withConfirmationUrl(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::CONFIRMATION_URL;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withName(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::NAME;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withPrice(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::PRICE;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withStatus(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::STATUS;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withReturnUrl(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::RETURN_URL;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withTest(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::TEST;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withCreatedAt(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::CREATED_AT;

        return $new;
    }

    /**
     * @return ApplicationChargeFields
     */
    public function withUpdatedAt(): ApplicationChargeFields
    {
        $new = clone $this;
        $new->fields[] = self::UPDATED_AT;

        return $new;
    }
}
