<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ReferencedProductType
 *
 * XSD Type: ReferencedProductType
 */
class ReferencedProductType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType[] $globalID
     */
    private $globalID = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $sellerAssignedID
     */
    private $sellerAssignedID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $buyerAssignedID
     */
    private $buyerAssignedID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $industryAssignedID
     */
    private $industryAssignedID;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $unitQuantity
     */
    private $unitQuantity;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    public function setID(?\horstoeko\zugferd\entities\extended\udt\IDType $iD = null): self
    {
        $this->iD = $iD;
        return $this;
    }

    /**
     * Adds as globalID
     */
    public function addToGlobalID(\horstoeko\zugferd\entities\extended\udt\IDType $globalID): self
    {
        $this->globalID[] = $globalID;
        return $this;
    }

    /**
     * isset globalID
     *
     * @param  int|string $index
     */
    public function issetGlobalID($index): bool
    {
        return isset($this->globalID[$index]);
    }

    /**
     * unset globalID
     *
     * @param  int|string $index
     */
    public function unsetGlobalID($index): void
    {
        unset($this->globalID[$index]);
    }

    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType[]
     */
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType[] $globalID
     */
    public function setGlobalID(?array $globalID = null): self
    {
        $this->globalID = $globalID;
        return $this;
    }

    /**
     * Gets as sellerAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getSellerAssignedID()
    {
        return $this->sellerAssignedID;
    }

    /**
     * Sets a new sellerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $sellerAssignedID
     */
    public function setSellerAssignedID(?\horstoeko\zugferd\entities\extended\udt\IDType $sellerAssignedID = null): self
    {
        $this->sellerAssignedID = $sellerAssignedID;
        return $this;
    }

    /**
     * Gets as buyerAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getBuyerAssignedID()
    {
        return $this->buyerAssignedID;
    }

    /**
     * Sets a new buyerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $buyerAssignedID
     */
    public function setBuyerAssignedID(?\horstoeko\zugferd\entities\extended\udt\IDType $buyerAssignedID = null): self
    {
        $this->buyerAssignedID = $buyerAssignedID;
        return $this;
    }

    /**
     * Gets as industryAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getIndustryAssignedID()
    {
        return $this->industryAssignedID;
    }

    /**
     * Sets a new industryAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $industryAssignedID
     */
    public function setIndustryAssignedID(?\horstoeko\zugferd\entities\extended\udt\IDType $industryAssignedID = null): self
    {
        $this->industryAssignedID = $industryAssignedID;
        return $this;
    }

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as unitQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function getUnitQuantity()
    {
        return $this->unitQuantity;
    }

    /**
     * Sets a new unitQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $unitQuantity
     */
    public function setUnitQuantity(?\horstoeko\zugferd\entities\extended\udt\QuantityType $unitQuantity = null): self
    {
        $this->unitQuantity = $unitQuantity;
        return $this;
    }
}
