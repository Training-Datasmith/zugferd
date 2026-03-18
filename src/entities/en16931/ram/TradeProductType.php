<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeProductType
 *
 * XSD Type: TradeProductType
 */
class TradeProductType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $globalID
     */
    private $globalID;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $sellerAssignedID
     */
    private $sellerAssignedID;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $buyerAssignedID
     */
    private $buyerAssignedID;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    private $applicableProductCharacteristic = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ProductClassificationType[] $designatedProductClassification
     */
    private $designatedProductClassification = [

    ];

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeCountryType $originTradeCountry
     */
    private $originTradeCountry;

    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $globalID
     */
    public function setGlobalID(?\horstoeko\zugferd\entities\en16931\udt\IDType $globalID = null): self
    {
        $this->globalID = $globalID;
        return $this;
    }

    /**
     * Gets as sellerAssignedID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getSellerAssignedID()
    {
        return $this->sellerAssignedID;
    }

    /**
     * Sets a new sellerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $sellerAssignedID
     */
    public function setSellerAssignedID(?\horstoeko\zugferd\entities\en16931\udt\IDType $sellerAssignedID = null): self
    {
        $this->sellerAssignedID = $sellerAssignedID;
        return $this;
    }

    /**
     * Gets as buyerAssignedID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getBuyerAssignedID()
    {
        return $this->buyerAssignedID;
    }

    /**
     * Sets a new buyerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $buyerAssignedID
     */
    public function setBuyerAssignedID(?\horstoeko\zugferd\entities\en16931\udt\IDType $buyerAssignedID = null): self
    {
        $this->buyerAssignedID = $buyerAssignedID;
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
     * Adds as applicableProductCharacteristic
     */
    public function addToApplicableProductCharacteristic(\horstoeko\zugferd\entities\en16931\ram\ProductCharacteristicType $applicableProductCharacteristic): self
    {
        $this->applicableProductCharacteristic[] = $applicableProductCharacteristic;
        return $this;
    }

    /**
     * isset applicableProductCharacteristic
     *
     * @param  int|string $index
     */
    public function issetApplicableProductCharacteristic($index): bool
    {
        return isset($this->applicableProductCharacteristic[$index]);
    }

    /**
     * unset applicableProductCharacteristic
     *
     * @param  int|string $index
     */
    public function unsetApplicableProductCharacteristic($index): void
    {
        unset($this->applicableProductCharacteristic[$index]);
    }

    /**
     * Gets as applicableProductCharacteristic
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ProductCharacteristicType[]
     */
    public function getApplicableProductCharacteristic()
    {
        return $this->applicableProductCharacteristic;
    }

    /**
     * Sets a new applicableProductCharacteristic
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    public function setApplicableProductCharacteristic(?array $applicableProductCharacteristic = null): self
    {
        $this->applicableProductCharacteristic = $applicableProductCharacteristic;
        return $this;
    }

    /**
     * Adds as designatedProductClassification
     */
    public function addToDesignatedProductClassification(\horstoeko\zugferd\entities\en16931\ram\ProductClassificationType $designatedProductClassification): self
    {
        $this->designatedProductClassification[] = $designatedProductClassification;
        return $this;
    }

    /**
     * isset designatedProductClassification
     *
     * @param  int|string $index
     */
    public function issetDesignatedProductClassification($index): bool
    {
        return isset($this->designatedProductClassification[$index]);
    }

    /**
     * unset designatedProductClassification
     *
     * @param  int|string $index
     */
    public function unsetDesignatedProductClassification($index): void
    {
        unset($this->designatedProductClassification[$index]);
    }

    /**
     * Gets as designatedProductClassification
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ProductClassificationType[]
     */
    public function getDesignatedProductClassification()
    {
        return $this->designatedProductClassification;
    }

    /**
     * Sets a new designatedProductClassification
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ProductClassificationType[] $designatedProductClassification
     */
    public function setDesignatedProductClassification(?array $designatedProductClassification = null): self
    {
        $this->designatedProductClassification = $designatedProductClassification;
        return $this;
    }

    /**
     * Gets as originTradeCountry
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeCountryType
     */
    public function getOriginTradeCountry()
    {
        return $this->originTradeCountry;
    }

    /**
     * Sets a new originTradeCountry
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeCountryType $originTradeCountry
     */
    public function setOriginTradeCountry(?\horstoeko\zugferd\entities\en16931\ram\TradeCountryType $originTradeCountry = null): self
    {
        $this->originTradeCountry = $originTradeCountry;
        return $this;
    }
}
