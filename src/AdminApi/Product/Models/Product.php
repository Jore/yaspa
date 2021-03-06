<?php

namespace Yaspa\AdminApi\Product\Models;

use DateTime;
use stdClass;
use Yaspa\AdminApi\Metafield\Models\Metafield;

/**
 * Class Product
 *
 * @package Yaspa\AdminApi\Product\Models
 * @see https://help.shopify.com/api/reference/product#show
 */
class Product
{
    /** @var int $id */
    protected $id;
    /** @var string $title */
    protected $title;
    /** @var string $bodyHtml */
    protected $bodyHtml;
    /** @var string $vendor */
    protected $vendor;
    /** @var string $productType */
    protected $productType;
    /** @var DateTime $createdAt */
    protected $createdAt;
    /** @var string $handle */
    protected $handle;
    /** @var DateTime $updatedAt */
    protected $updatedAt;
    /** @var DateTime $publishedAt */
    protected $publishedAt;
    /** @var bool $published */
    protected $published;
    /** @var string $templateSuffix */
    protected $templateSuffix;
    /** @var string $publishedScope */
    protected $publishedScope;
    /** @var string $metafieldsGlobalTitleTag */
    protected $metafieldsGlobalTitleTag;
    /** @var string $metafieldsGlobalDescriptionTag */
    protected $metafieldsGlobalDescriptionTag;
    /** @var array|string[] $tags */
    protected $tags;
    /** @var array|Variant[] $variants */
    protected $variants;
    /** @var array|stdClass[] $options */
    protected $options;
    /** @var array|Image[] $images */
    protected $images;
    /** @var Image $image */
    protected $image;
    /** @var array|Metafield[] $metafields */
    protected $metafields;

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle():? string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getBodyHtml():? string
    {
        return $this->bodyHtml;
    }

    /**
     * @param string $bodyHtml
     * @return Product
     */
    public function setBodyHtml(string $bodyHtml): Product
    {
        $this->bodyHtml = $bodyHtml;
        return $this;
    }

    /**
     * @return string
     */
    public function getVendor():? string
    {
        return $this->vendor;
    }

    /**
     * @param string $vendor
     * @return Product
     */
    public function setVendor(string $vendor): Product
    {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductType():? string
    {
        return $this->productType;
    }

    /**
     * @param string $productType
     * @return Product
     */
    public function setProductType(string $productType): Product
    {
        $this->productType = $productType;
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
     * @return Product
     */
    public function setCreatedAt(DateTime $createdAt): Product
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getHandle():? string
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     * @return Product
     */
    public function setHandle(string $handle): Product
    {
        $this->handle = $handle;
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
     * @return Product
     */
    public function setUpdatedAt(DateTime $updatedAt): Product
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt():? DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTime $publishedAt
     * @return Product
     */
    public function setPublishedAt(DateTime $publishedAt): Product
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateSuffix():? string
    {
        return $this->templateSuffix;
    }

    /**
     * @param string $templateSuffix
     * @return Product
     */
    public function setTemplateSuffix(?string $templateSuffix): Product
    {
        $this->templateSuffix = $templateSuffix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublishedScope():? string
    {
        return $this->publishedScope;
    }

    /**
     * @param string $publishedScope
     * @return Product
     */
    public function setPublishedScope(string $publishedScope): Product
    {
        $this->publishedScope = $publishedScope;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetafieldsGlobalTitleTag():? string
    {
        return $this->metafieldsGlobalTitleTag;
    }

    /**
     * @param string $metafieldsGlobalTitleTag
     * @return Product
     */
    public function setMetafieldsGlobalTitleTag(string $metafieldsGlobalTitleTag): Product
    {
        $this->metafieldsGlobalTitleTag = $metafieldsGlobalTitleTag;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetafieldsGlobalDescriptionTag():? string
    {
        return $this->metafieldsGlobalDescriptionTag;
    }

    /**
     * @param string $metafieldsGlobalDescriptionTag
     * @return Product
     */
    public function setMetafieldsGlobalDescriptionTag(string $metafieldsGlobalDescriptionTag): Product
    {
        $this->metafieldsGlobalDescriptionTag = $metafieldsGlobalDescriptionTag;
        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getTags():? array
    {
        return $this->tags;
    }

    /**
     * @param array|string[] $tags
     * @return Product
     */
    public function setTags(array $tags): Product
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return array|Variant[]
     */
    public function getVariants():? array
    {
        return $this->variants;
    }

    /**
     * @param array|Variant[] $variants
     * @return Product
     */
    public function setVariants(array $variants): Product
    {
        $this->variants = $variants;
        return $this;
    }

    /**
     * @return array|stdClass
     */
    public function getOptions():? array
    {
        return $this->options;
    }

    /**
     * @param array|stdClass $options
     * @return Product
     */
    public function setOptions(array $options): Product
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array|Image[]
     */
    public function getImages():? array
    {
        return $this->images;
    }

    /**
     * @param array|Image[] $images
     * @return Product
     */
    public function setImages(array $images): Product
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return Image
     */
    public function getImage():? Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     * @return Product
     */
    public function setImage(Image $image): Product
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return array|Metafield[]
     */
    public function getMetafields():? array
    {
        return $this->metafields;
    }

    /**
     * @param array|Metafield[] $metafields
     * @return Product
     */
    public function setMetafields(array $metafields): Product
    {
        $this->metafields = $metafields;
        return $this;
    }

    /**
     * This is a getter to logically support self::setPublished
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        if (is_null($this->publishedAt)) {
            return false;
        }

        $now = new DateTime();
        return intval($now->diff($this->publishedAt)->format('yMDHIS')) >= 0;
    }

    /**
     * @return bool
     */
    public function getPublished():? bool
    {
        return $this->published;
    }

    /**
     * This is a setter to support the example "Create a new, but unpublished product"
     * as well as "Hide a published product by changing the published attribute to false"
     *
     * This attribute appears to only exist on request resources and is never returned as
     * a boolean. Therefore, self::isPublished is used to determined published status of a
     * response, but both this and self::getPublished can be used to determine the published
     * status of a request.
     *
     * Another peculiarity with this method is that only appears in examples to be used
     * for setting published status to false. This means that true can only be set by setting
     * `published_at`.
     *
     * @see https://help.shopify.com/api/reference/product#create
     * @see https://help.shopify.com/api/reference/product#update
     * @param bool $published
     * @return Product
     */
    public function setPublished(bool $published): Product
    {
        if ($published) {
            $this->publishedAt = new DateTime();
        } else {
            $this->published = $published;
        }

        return $this;
    }
}
