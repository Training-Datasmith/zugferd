<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeProductType
 *
 * XSD Type: TradeProductType
 */
class TradeProductType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $globalID
     */
    private $globalID;

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
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $modelID
     */
    private $modelID;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType[] $batchID
     */
    private $batchID = [
        
    ];

    /**
     * @var string $brandName
     */
    private $brandName;

    /**
     * @var string $modelName
     */
    private $modelName;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    private $applicableProductCharacteristic = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ProductClassificationType[] $designatedProductClassification
     */
    private $designatedProductClassification = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType[] $individualTradeProductInstance
     */
    private $individualTradeProductInstance = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeCountryType $originTradeCountry
     */
    private $originTradeCountry;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedProductType[] $includedReferencedProduct
     */
    private $includedReferencedProduct = [
        
    ];

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
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $globalID
     */
    public function setGlobalID(?\horstoeko\zugferd\entities\extended\udt\IDType $globalID = null): self
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
     * Gets as modelID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getModelID()
    {
        return $this->modelID;
    }

    /**
     * Sets a new modelID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $modelID
     */
    public function setModelID(?\horstoeko\zugferd\entities\extended\udt\IDType $modelID = null): self
    {
        $this->modelID = $modelID;
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
     * Adds as batchID
     */
    public function addToBatchID(\horstoeko\zugferd\entities\extended\udt\IDType $batchID): self
    {
        $this->batchID[] = $batchID;
        return $this;
    }

    /**
     * isset batchID
     *
     * @param  int|string $index
     */
    public function issetBatchID($index): bool
    {
        return isset($this->batchID[$index]);
    }

    /**
     * unset batchID
     *
     * @param  int|string $index
     */
    public function unsetBatchID($index): void
    {
        unset($this->batchID[$index]);
    }

    /**
     * Gets as batchID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType[]
     */
    public function getBatchID()
    {
        return $this->batchID;
    }

    /**
     * Sets a new batchID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType[] $batchID
     */
    public function setBatchID(?array $batchID = null): self
    {
        $this->batchID = $batchID;
        return $this;
    }

    /**
     * Gets as brandName
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * Sets a new brandName
     *
     * @param  string $brandName
     */
    public function setBrandName($brandName): self
    {
        $this->brandName = $brandName;
        return $this;
    }

    /**
     * Gets as modelName
     *
     * @return string
     */
    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * Sets a new modelName
     *
     * @param  string $modelName
     */
    public function setModelName($modelName): self
    {
        $this->modelName = $modelName;
        return $this;
    }

    /**
     * Adds as applicableProductCharacteristic
     */
    public function addToApplicableProductCharacteristic(\horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType $applicableProductCharacteristic): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType[]
     */
    public function getApplicableProductCharacteristic()
    {
        return $this->applicableProductCharacteristic;
    }

    /**
     * Sets a new applicableProductCharacteristic
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    public function setApplicableProductCharacteristic(?array $applicableProductCharacteristic = null): self
    {
        $this->applicableProductCharacteristic = $applicableProductCharacteristic;
        return $this;
    }

    /**
     * Adds as designatedProductClassification
     */
    public function addToDesignatedProductClassification(\horstoeko\zugferd\entities\extended\ram\ProductClassificationType $designatedProductClassification): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\ProductClassificationType[]
     */
    public function getDesignatedProductClassification()
    {
        return $this->designatedProductClassification;
    }

    /**
     * Sets a new designatedProductClassification
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ProductClassificationType[] $designatedProductClassification
     */
    public function setDesignatedProductClassification(?array $designatedProductClassification = null): self
    {
        $this->designatedProductClassification = $designatedProductClassification;
        return $this;
    }

    /**
     * Adds as individualTradeProductInstance
     */
    public function addToIndividualTradeProductInstance(\horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType $individualTradeProductInstance): self
    {
        $this->individualTradeProductInstance[] = $individualTradeProductInstance;
        return $this;
    }

    /**
     * isset individualTradeProductInstance
     *
     * @param  int|string $index
     */
    public function issetIndividualTradeProductInstance($index): bool
    {
        return isset($this->individualTradeProductInstance[$index]);
    }

    /**
     * unset individualTradeProductInstance
     *
     * @param  int|string $index
     */
    public function unsetIndividualTradeProductInstance($index): void
    {
        unset($this->individualTradeProductInstance[$index]);
    }

    /**
     * Gets as individualTradeProductInstance
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType[]
     */
    public function getIndividualTradeProductInstance()
    {
        return $this->individualTradeProductInstance;
    }

    /**
     * Sets a new individualTradeProductInstance
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType[] $individualTradeProductInstance
     */
    public function setIndividualTradeProductInstance(?array $individualTradeProductInstance = null): self
    {
        $this->individualTradeProductInstance = $individualTradeProductInstance;
        return $this;
    }

    /**
     * Gets as originTradeCountry
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeCountryType
     */
    public function getOriginTradeCountry()
    {
        return $this->originTradeCountry;
    }

    /**
     * Sets a new originTradeCountry
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeCountryType $originTradeCountry
     */
    public function setOriginTradeCountry(?\horstoeko\zugferd\entities\extended\ram\TradeCountryType $originTradeCountry = null): self
    {
        $this->originTradeCountry = $originTradeCountry;
        return $this;
    }

    /**
     * Adds as includedReferencedProduct
     */
    public function addToIncludedReferencedProduct(\horstoeko\zugferd\entities\extended\ram\ReferencedProductType $includedReferencedProduct): self
    {
        $this->includedReferencedProduct[] = $includedReferencedProduct;
        return $this;
    }

    /**
     * isset includedReferencedProduct
     *
     * @param  int|string $index
     */
    public function issetIncludedReferencedProduct($index): bool
    {
        return isset($this->includedReferencedProduct[$index]);
    }

    /**
     * unset includedReferencedProduct
     *
     * @param  int|string $index
     */
    public function unsetIncludedReferencedProduct($index): void
    {
        unset($this->includedReferencedProduct[$index]);
    }

    /**
     * Gets as includedReferencedProduct
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedProductType[]
     */
    public function getIncludedReferencedProduct()
    {
        return $this->includedReferencedProduct;
    }

    /**
     * Sets a new includedReferencedProduct
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedProductType[] $includedReferencedProduct
     */
    public function setIncludedReferencedProduct(?array $includedReferencedProduct = null): self
    {
        $this->includedReferencedProduct = $includedReferencedProduct;
        return $this;
    }
}
