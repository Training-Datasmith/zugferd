<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeProductType
 *
 * XSD Type: TradeProductType
 */
class Trade_Product_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $globalID
     */
    private $global_id;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $sellerAssignedID
     */
    private $seller_assigned_id;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $buyerAssignedID
     */
    private $buyer_assigned_id;
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
    private $applicable_product_characteristic = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ProductClassificationType[] $designatedProductClassification
     */
    private $designated_product_classification = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeCountryType $originTradeCountry
     */
    private $origin_trade_country;
    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_global_id()
    {
        return $this->global_id;
    }
    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $globalID
     */
    public function set_global_id(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $global_id = null): self
    {
        $this->global_id = $global_id;
        return $this;
    }
    /**
     * Gets as sellerAssignedID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_seller_assigned_id()
    {
        return $this->seller_assigned_id;
    }
    /**
     * Sets a new sellerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $sellerAssignedID
     */
    public function set_seller_assigned_id(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $seller_assigned_id = null): self
    {
        $this->seller_assigned_id = $seller_assigned_id;
        return $this;
    }
    /**
     * Gets as buyerAssignedID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_buyer_assigned_id()
    {
        return $this->buyer_assigned_id;
    }
    /**
     * Sets a new buyerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $buyerAssignedID
     */
    public function set_buyer_assigned_id(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $buyer_assigned_id = null): self
    {
        $this->buyer_assigned_id = $buyer_assigned_id;
        return $this;
    }
    /**
     * Gets as name
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }
    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function set_name($name): self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Gets as description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function set_description($description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Adds as applicableProductCharacteristic
     */
    public function add_to_applicable_product_characteristic(\horstoeko\zugferd\entities\en16931\ram\Product_Characteristic_Type $applicable_product_characteristic): self
    {
        $this->applicable_product_characteristic[] = $applicable_product_characteristic;
        return $this;
    }
    /**
     * isset applicableProductCharacteristic
     *
     * @param  int|string $index
     */
    public function isset_applicable_product_characteristic($index): bool
    {
        return isset($this->applicable_product_characteristic[$index]);
    }
    /**
     * unset applicableProductCharacteristic
     *
     * @param  int|string $index
     */
    public function unset_applicable_product_characteristic($index): void
    {
        unset($this->applicable_product_characteristic[$index]);
    }
    /**
     * Gets as applicableProductCharacteristic
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ProductCharacteristicType[]
     */
    public function get_applicable_product_characteristic()
    {
        return $this->applicable_product_characteristic;
    }
    /**
     * Sets a new applicableProductCharacteristic
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    public function set_applicable_product_characteristic(?array $applicable_product_characteristic = null): self
    {
        $this->applicable_product_characteristic = $applicable_product_characteristic;
        return $this;
    }
    /**
     * Adds as designatedProductClassification
     */
    public function add_to_designated_product_classification(\horstoeko\zugferd\entities\en16931\ram\Product_Classification_Type $designated_product_classification): self
    {
        $this->designated_product_classification[] = $designated_product_classification;
        return $this;
    }
    /**
     * isset designatedProductClassification
     *
     * @param  int|string $index
     */
    public function isset_designated_product_classification($index): bool
    {
        return isset($this->designated_product_classification[$index]);
    }
    /**
     * unset designatedProductClassification
     *
     * @param  int|string $index
     */
    public function unset_designated_product_classification($index): void
    {
        unset($this->designated_product_classification[$index]);
    }
    /**
     * Gets as designatedProductClassification
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ProductClassificationType[]
     */
    public function get_designated_product_classification()
    {
        return $this->designated_product_classification;
    }
    /**
     * Sets a new designatedProductClassification
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ProductClassificationType[] $designatedProductClassification
     */
    public function set_designated_product_classification(?array $designated_product_classification = null): self
    {
        $this->designated_product_classification = $designated_product_classification;
        return $this;
    }
    /**
     * Gets as originTradeCountry
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeCountryType
     */
    public function get_origin_trade_country()
    {
        return $this->origin_trade_country;
    }
    /**
     * Sets a new originTradeCountry
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeCountryType $originTradeCountry
     */
    public function set_origin_trade_country(?\horstoeko\zugferd\entities\en16931\ram\Trade_Country_Type $origin_trade_country = null): self
    {
        $this->origin_trade_country = $origin_trade_country;
        return $this;
    }
}