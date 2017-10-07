<?php

namespace Yaspa\AdminApi\ApplicationCharge\Models;

use DateTime;

/**
 * Class ApplicationCharge
 *
 * @package Yaspa\AdminApi\ApplicationCharge\Models
 * @see https://help.shopify.com/api/reference/application_charges#show
 */
class ApplicationCharge
{
    /** @var int $id */
    protected $id;
    /** @var string $confirmationUrl */
    protected $confirmationUrl;
    /** @var string $name */
    protected $name;
    /** @var float $price */
    protected $price;
    /** @var string $returnUrl */
    protected $returnUrl;
    /** @var string $status */
    protected $status;
    /** @var string $test */
    protected $test;
    /** @var DateTime $createdAt */
    protected $createdAt;
    /** @var DateTime $updatedAt */
    protected $updatedAt;

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ApplicationCharge
     */
    public function setId(int $id): ApplicationCharge
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmationUrl():? string
    {
        return $this->confirmationUrl;
    }

    /**
     * @param string $confirmationUrl
     * @return ApplicationCharge
     */
    public function setConfirmationUrl(string $confirmationUrl): ApplicationCharge
    {
        $this->confirmationUrl = $confirmationUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getName():? string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ApplicationCharge
     */
    public function setName(string $name): ApplicationCharge
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param float $price
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ApplicationCharge
     */
    public function setPrice($price): ApplicationCharge
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnUrl():? string
    {
        return $this->returnUrl;
    }

    /**
     * @param string $status
     * @return ApplicationCharge
     */
    public function setStatus(string $status): ApplicationCharge
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getTest():? string
    {
        return $this->test;
    }

    /**
     * @param string $test
     * @return ApplicationCharge
     */
    public function setTest(string $test): ApplicationCharge
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt():? DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return ApplicationCharge
     */
    public function setCreatedAt(DateTime $createdAt): ApplicationCharge
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt():? DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return ApplicationCharge
     */
    public function setUpdatedAt(DateTime $updatedAt): ApplicationCharge
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
