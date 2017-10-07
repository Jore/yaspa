<?php

namespace Yaspa\AdminApi\ApplicationCharge\Transformers;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use Yaspa\AdminApi\ApplicationCharge\Models\ApplicationCharge as ApplicationChargeModel;
use Yaspa\Exceptions\MissingExpectedAttributeException;
use Yaspa\Interfaces\ArrayResponseTransformerInterface;
use stdClass;

class ApplicationCharge implements ArrayResponseTransformerInterface
{
    /**
     * @param ResponseInterface $response
     * @return ApplicationChargeModel
     * @throws MissingExpectedAttributeException
     */
    public function fromResponse(ResponseInterface $response): ApplicationChargeModel
    {
        $stdClass = json_decode($response->getBody()->getContents());

        if (!property_exists($stdClass, 'ApplicationCharge')) {
            throw new MissingExpectedAttributeException('ApplicationCharge');
        }

        return $this->fromShopifyJsonApplicationCharge($stdClass->ApplicationCharge);
    }

    /**
     * @param ResponseInterface $response
     * @return array|ApplicationChargeModel[]
     * @throws MissingExpectedAttributeException
     */
    public function fromArrayResponse(ResponseInterface $response): array
    {
        $stdClass = json_decode($response->getBody()->getContents());

        if (!property_exists($stdClass, 'ApplicationCharges')) {
            throw new MissingExpectedAttributeException('ApplicationCharges');
        }

        return array_map([$this, 'fromShopifyJsonApplicationCharge'], $stdClass->applicationCharges);
    }


    /**
     * @param stdClass $shopifyJsonApplicationCharge
     * @return ApplicationChargeModel
     */
    public function fromShopifyJsonApplicationCharge(stdClass $shopifyJsonApplicationCharge): ApplicationChargeModel
    {
        $applicationCharge = new ApplicationChargeModel();

        if (property_exists($shopifyJsonApplicationCharge, 'id')) {
            $applicationCharge->setId($shopifyJsonApplicationCharge->id);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'confirmation_url')) {
            $applicationCharge->setConfirmationUrl($shopifyJsonApplicationCharge->confirmation_url);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'name')) {
            $applicationCharge->setName($shopifyJsonApplicationCharge->name);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'price')) {
            $applicationCharge->setPrice($shopifyJsonApplicationCharge->price);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'return_url')) {
            $applicationCharge->setReturnUrl($shopifyJsonApplicationCharge->return_url);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'status')) {
            $applicationCharge->setStatus($shopifyJsonApplicationCharge->status);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'test')) {
            $applicationCharge->setTest($shopifyJsonApplicationCharge->test);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'created_at')
            && !empty($shopifyJsonApplicationCharge->created_at)
        ) {
            $createdAt = new DateTime($shopifyJsonApplicationCharge->created_at);
            $applicationCharge->setCreatedAt($createdAt);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'updated_at')
            && !empty($shopifyJsonApplicationCharge->updated_at)
        ) {
            $updatedAt = new DateTime($shopifyJsonApplicationCharge->updated_at);
            $applicationCharge->setUpdatedAt($updatedAt);
        }

        return $applicationCharge;
    }

    /**
     * @param ApplicationChargeModel $applicationCharge
     * @return array
     */
    public function toArray(ApplicationChargeModel $applicationCharge): array
    {
        $array = [];

        $array['id'] = $applicationCharge->getId();
        $array['confirmation_url'] = $applicationCharge->getConfirmationUrl();
        $array['name'] = $applicationCharge->getName();
        $array['price'] = $applicationCharge->getPrice();
        $array['return_url'] = $applicationCharge->getReturnUrl();
        $array['status'] = $applicationCharge->getStatus();
        $array['test'] = $applicationCharge->getTest();
        $array['created_at'] = ($applicationCharge->getCreatedAt()) ? $applicationCharge->getCreatedAt()->format(DateTime::ISO8601) : null;
        $array['updated_at'] = ($applicationCharge->getUpdatedAt()) ? $applicationCharge->getUpdatedAt()->format(DateTime::ISO8601) : null;

        return $array;
    }
}
