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

        return array_map([$this, 'fromShopifyJsonApplicationCharge'], $stdClass->ApplicationCharges);
    }


    /**
     * @param stdClass $shopifyJsonApplicationCharge
     * @return ApplicationChargeModel
     */
    public function fromShopifyJsonApplicationCharge(stdClass $shopifyJsonApplicationCharge): ApplicationChargeModel
    {
        $ApplicationCharge = new ApplicationChargeModel();

        if (property_exists($shopifyJsonApplicationCharge, 'id')) {
            $ApplicationCharge->setId($shopifyJsonApplicationCharge->id);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'namespace')) {
            $ApplicationCharge->setNamespace($shopifyJsonApplicationCharge->namespace);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'key')) {
            $ApplicationCharge->setKey($shopifyJsonApplicationCharge->key);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'value')) {
            $ApplicationCharge->setValue($shopifyJsonApplicationCharge->value);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'value_type')) {
            $ApplicationCharge->setValueType($shopifyJsonApplicationCharge->value_type);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'description')) {
            $ApplicationCharge->setDescription($shopifyJsonApplicationCharge->description);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'owner_id')) {
            $ApplicationCharge->setOwnerId($shopifyJsonApplicationCharge->owner_id);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'created_at')
            && !empty($shopifyJsonApplicationCharge->created_at)
        ) {
            $createdAt = new DateTime($shopifyJsonApplicationCharge->created_at);
            $ApplicationCharge->setCreatedAt($createdAt);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'updated_at')
            && !empty($shopifyJsonApplicationCharge->updated_at)
        ) {
            $updatedAt = new DateTime($shopifyJsonApplicationCharge->updated_at);
            $ApplicationCharge->setUpdatedAt($updatedAt);
        }

        if (property_exists($shopifyJsonApplicationCharge, 'owner_resource')) {
            $ApplicationCharge->setOwnerResource($shopifyJsonApplicationCharge->owner_resource);
        }

        return $ApplicationCharge;
    }

    /**
     * @param ApplicationChargeModel $ApplicationCharge
     * @return array
     */
    public function toArray(ApplicationChargeModel $ApplicationCharge): array
    {
        $array = [];

        $array['id'] = $ApplicationCharge->getId();
        $array['namespace'] = $ApplicationCharge->getNamespace();
        $array['key'] = $ApplicationCharge->getKey();
        $array['value'] = $ApplicationCharge->getValue();
        $array['value_type'] = $ApplicationCharge->getValueType();
        $array['description'] = $ApplicationCharge->getDescription();
        $array['owner_id'] = $ApplicationCharge->getOwnerId();
        $array['created_at'] = ($ApplicationCharge->getCreatedAt()) ? $ApplicationCharge->getCreatedAt()->format(DateTime::ISO8601) : null;
        $array['updated_at'] = ($ApplicationCharge->getUpdatedAt()) ? $ApplicationCharge->getUpdatedAt()->format(DateTime::ISO8601) : null;
        $array['owner_resource'] = $ApplicationCharge->getOwnerResource();

        return $array;
    }
}
