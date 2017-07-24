<?php

namespace Yaspa\AdminApi\Customer\Builders;

use DateTime;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use Yaspa\Interfaces\RequestBuilderInterface;
use Yaspa\Traits\AuthorizedRequestTrait;
use Yaspa\Traits\RequestBuilderTrait;

/**
 * Class GetCustomersRequest
 *
 * @package Yaspa\AdminApi\Customer\Builders
 */
class GetCustomersRequest implements RequestBuilderInterface
{
    use AuthorizedRequestTrait,
        RequestBuilderTrait;

    const HEADERS = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];
    const HTTP_METHOD = 'GET';
    const URI_TEMPLATE = 'https://%s.myshopify.com/admin/customers.json';

    /** @var array|int[] $ids */
    protected $ids;
    /** @var int $sinceId */
    protected $sinceId;
    /** @var DateTime $createdAtMin */
    protected $createdAtMin;
    /** @var DateTime $createdAtMax */
    protected $createdAtMax;
    /** @var DateTime $updatedAtMin */
    protected $updatedAtMin;
    /** @var DateTime $updatedAtMax */
    protected $updatedAtMax;
    /** @var int $limit */
    protected $limit;
    /** @var int $page */
    protected $page;
    /** @var CustomerFields $customerFields */
    protected $customerFields;

    /**
     * GetShopRequest constructor.
     */
    public function __construct()
    {
        // Set properties with defaults
        $this->httpMethod = self::HTTP_METHOD;
        $this->uriTemplate = self::URI_TEMPLATE;
        $this->headers = self::HEADERS;
    }

    /**
     * Generate a Guzzle/PSR-7 request.
     *
     * @return Request
     */
    public function toRequest(): Request
    {
        // Create URI
        $uri = new Uri(sprintf($this->uriTemplate, $this->credentials->getShop()));

        // Create request
        return new Request(
            $this->httpMethod,
            $uri,
            $this->headers
        );
    }

    /**
     * Generate Guzzle request options.
     *
     * @see http://docs.guzzlephp.org/en/stable/request-options.html#query
     * @return array
     */
    public function toRequestOptions(): array
    {
        $requestOptions = [RequestOptions::QUERY => $this->toArray()];

        return array_merge($this->credentials->toRequestOptions(), $requestOptions);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        if (!empty($this->ids)) {
            $array['ids'] = implode(',', $this->ids);
        }

        if (!is_null($this->sinceId)) {
            $array['since_id'] = $this->sinceId;
        }

        if (!is_null($this->createdAtMin)) {
            $array['created_at_min'] = $this->createdAtMin->format(DateTime::ISO8601);
        }

        if (!is_null($this->createdAtMax)) {
            $array['created_at_max'] = $this->createdAtMax->format(DateTime::ISO8601);
        }

        if (!is_null($this->updatedAtMin)) {
            $array['updated_at_min'] = $this->updatedAtMin->format(DateTime::ISO8601);
        }

        if (!is_null($this->updatedAtMax)) {
            $array['updated_at_max'] = $this->updatedAtMax->format(DateTime::ISO8601);
        }

        if (!is_null($this->limit)) {
            $array['limit'] = $this->limit;
        }

        if (!is_null($this->page)) {
            $array['page'] = $this->page;
        }

        if (!is_null($this->customerFields)) {
            $array['customer_fields'] = implode(',', $this->customerFields->getFields());
        }

        return $array;
    }

    /**
     * @param array|int[] $ids
     * @return GetCustomersRequest
     */
    public function withIds(array $ids): GetCustomersRequest
    {
        $new = clone $this;
        $new->ids = $ids;

        return $new;
    }

    /**
     * @param int $sinceId
     * @return GetCustomersRequest
     */
    public function withSinceId(int $sinceId): GetCustomersRequest
    {
        $new = clone $this;
        $new->sinceId = $sinceId;

        return $new;
    }

    /**
     * @param DateTime $createdAtMin
     * @return GetCustomersRequest
     */
    public function withCreatedAtMin(DateTime $createdAtMin): GetCustomersRequest
    {
        $new = clone $this;
        $new->createdAtMin = $createdAtMin;

        return $new;
    }

    /**
     * @param DateTime $createdAtMax
     * @return GetCustomersRequest
     */
    public function withCreatedAtMax(DateTime $createdAtMax): GetCustomersRequest
    {
        $new = clone $this;
        $new->createdAtMax = $createdAtMax;

        return $new;
    }

    /**
     * @param DateTime $updatedAtMin
     * @return GetCustomersRequest
     */
    public function withUpdatedAtMin(DateTime $updatedAtMin): GetCustomersRequest
    {
        $new = clone $this;
        $new->updatedAtMin = $updatedAtMin;

        return $new;
    }

    /**
     * @param DateTime $updatedAtMax
     * @return GetCustomersRequest
     */
    public function withUpdatedAtMax(DateTime $updatedAtMax): GetCustomersRequest
    {
        $new = clone $this;
        $new->updatedAtMax = $updatedAtMax;

        return $new;
    }

    /**
     * @param int $limit
     * @return GetCustomersRequest
     */
    public function withLimit(int $limit): GetCustomersRequest
    {
        $new = clone $this;
        $new->limit = $limit;

        return $new;
    }

    /**
     * @param int $page
     * @return GetCustomersRequest
     */
    public function withPage(int $page): GetCustomersRequest
    {
        $new = clone $this;
        $new->page = $page;

        return $new;
    }

    /**
     * @param CustomerFields $customerFields
     * @return GetCustomersRequest
     */
    public function withCustomerFields(CustomerFields $customerFields): GetCustomersRequest
    {
        $new = clone $this;
        $new->customerFields = $customerFields;

        return $new;
    }
}