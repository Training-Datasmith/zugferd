<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeProductType
 *
 * XSD Type: TradeProductType
 */
class Trade_Product_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $globalID
     */
    private $global_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $sellerAssignedID
     */
    private $seller_assigned_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $buyerAssignedID
     */
    private $buyer_assigned_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $industryAssignedID
     */
    private $industry_assigned_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $modelID
     */
    private $model_id;
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
    private $batch_id = [];
    /**
     * @var string $brandName
     */
    private $brand_name;
    /**
     * @var string $modelName
     */
    private $model_name;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    private $applicable_product_characteristic = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ProductClassificationType[] $designatedProductClassification
     */
    private $designated_product_classification = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType[] $individualTradeProductInstance
     */
    private $individual_trade_product_instance = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeCountryType $originTradeCountry
     */
    private $origin_trade_country;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedProductType[] $includedReferencedProduct
     */
    private $included_referenced_product = [];
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    public function set_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $i_d = null): self
    {
        $this->i_d = $i_d;
        return $this;
    }
    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_global_id()
    {
        return $this->global_id;
    }
    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $globalID
     */
    public function set_global_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $global_id = null): self
    {
        $this->global_id = $global_id;
        return $this;
    }
    /**
     * Gets as sellerAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_seller_assigned_id()
    {
        return $this->seller_assigned_id;
    }
    /**
     * Sets a new sellerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $sellerAssignedID
     */
    public function set_seller_assigned_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $seller_assigned_id = null): self
    {
        $this->seller_assigned_id = $seller_assigned_id;
        return $this;
    }
    /**
     * Gets as buyerAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_buyer_assigned_id()
    {
        return $this->buyer_assigned_id;
    }
    /**
     * Sets a new buyerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $buyerAssignedID
     */
    public function set_buyer_assigned_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $buyer_assigned_id = null): self
    {
        $this->buyer_assigned_id = $buyer_assigned_id;
        return $this;
    }
    /**
     * Gets as industryAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_industry_assigned_id()
    {
        return $this->industry_assigned_id;
    }
    /**
     * Sets a new industryAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $industryAssignedID
     */
    public function set_industry_assigned_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $industry_assigned_id = null): self
    {
        $this->industry_assigned_id = $industry_assigned_id;
        return $this;
    }
    /**
     * Gets as modelID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_model_id()
    {
        return $this->model_id;
    }
    /**
     * Sets a new modelID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $modelID
     */
    public function set_model_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $model_id = null): self
    {
        $this->model_id = $model_id;
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
     * Adds as batchID
     */
    public function add_to_batch_id(\horstoeko\zugferd\entities\extended\udt\Id_Type $batch_id): self
    {
        $this->batch_id[] = $batch_id;
        return $this;
    }
    /**
     * isset batchID
     *
     * @param  int|string $index
     */
    public function isset_batch_id($index): bool
    {
        return isset($this->batch_id[$index]);
    }
    /**
     * unset batchID
     *
     * @param  int|string $index
     */
    public function unset_batch_id($index): void
    {
        unset($this->batch_id[$index]);
    }
    /**
     * Gets as batchID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType[]
     */
    public function get_batch_id()
    {
        return $this->batch_id;
    }
    /**
     * Sets a new batchID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType[] $batchID
     */
    public function set_batch_id(?array $batch_id = null): self
    {
        $this->batch_id = $batch_id;
        return $this;
    }
    /**
     * Gets as brandName
     *
     * @return string
     */
    public function get_brand_name()
    {
        return $this->brand_name;
    }
    /**
     * Sets a new brandName
     *
     * @param  string $brandName
     */
    public function set_brand_name($brand_name): self
    {
        $this->brand_name = $brand_name;
        return $this;
    }
    /**
     * Gets as modelName
     *
     * @return string
     */
    public function get_model_name()
    {
        return $this->model_name;
    }
    /**
     * Sets a new modelName
     *
     * @param  string $modelName
     */
    public function set_model_name($model_name): self
    {
        $this->model_name = $model_name;
        return $this;
    }
    /**
     * Adds as applicableProductCharacteristic
     */
    public function add_to_applicable_product_characteristic(\horstoeko\zugferd\entities\extended\ram\Product_Characteristic_Type $applicable_product_characteristic): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType[]
     */
    public function get_applicable_product_characteristic()
    {
        return $this->applicable_product_characteristic;
    }
    /**
     * Sets a new applicableProductCharacteristic
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ProductCharacteristicType[] $applicableProductCharacteristic
     */
    public function set_applicable_product_characteristic(?array $applicable_product_characteristic = null): self
    {
        $this->applicable_product_characteristic = $applicable_product_characteristic;
        return $this;
    }
    /**
     * Adds as designatedProductClassification
     */
    public function add_to_designated_product_classification(\horstoeko\zugferd\entities\extended\ram\Product_Classification_Type $designated_product_classification): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\ProductClassificationType[]
     */
    public function get_designated_product_classification()
    {
        return $this->designated_product_classification;
    }
    /**
     * Sets a new designatedProductClassification
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ProductClassificationType[] $designatedProductClassification
     */
    public function set_designated_product_classification(?array $designated_product_classification = null): self
    {
        $this->designated_product_classification = $designated_product_classification;
        return $this;
    }
    /**
     * Adds as individualTradeProductInstance
     */
    public function add_to_individual_trade_product_instance(\horstoeko\zugferd\entities\extended\ram\Trade_Product_Instance_Type $individual_trade_product_instance): self
    {
        $this->individual_trade_product_instance[] = $individual_trade_product_instance;
        return $this;
    }
    /**
     * isset individualTradeProductInstance
     *
     * @param  int|string $index
     */
    public function isset_individual_trade_product_instance($index): bool
    {
        return isset($this->individual_trade_product_instance[$index]);
    }
    /**
     * unset individualTradeProductInstance
     *
     * @param  int|string $index
     */
    public function unset_individual_trade_product_instance($index): void
    {
        unset($this->individual_trade_product_instance[$index]);
    }
    /**
     * Gets as individualTradeProductInstance
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType[]
     */
    public function get_individual_trade_product_instance()
    {
        return $this->individual_trade_product_instance;
    }
    /**
     * Sets a new individualTradeProductInstance
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeProductInstanceType[] $individualTradeProductInstance
     */
    public function set_individual_trade_product_instance(?array $individual_trade_product_instance = null): self
    {
        $this->individual_trade_product_instance = $individual_trade_product_instance;
        return $this;
    }
    /**
     * Gets as originTradeCountry
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeCountryType
     */
    public function get_origin_trade_country()
    {
        return $this->origin_trade_country;
    }
    /**
     * Sets a new originTradeCountry
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeCountryType $originTradeCountry
     */
    public function set_origin_trade_country(?\horstoeko\zugferd\entities\extended\ram\Trade_Country_Type $origin_trade_country = null): self
    {
        $this->origin_trade_country = $origin_trade_country;
        return $this;
    }
    /**
     * Adds as includedReferencedProduct
     */
    public function add_to_included_referenced_product(\horstoeko\zugferd\entities\extended\ram\Referenced_Product_Type $included_referenced_product): self
    {
        $this->included_referenced_product[] = $included_referenced_product;
        return $this;
    }
    /**
     * isset includedReferencedProduct
     *
     * @param  int|string $index
     */
    public function isset_included_referenced_product($index): bool
    {
        return isset($this->included_referenced_product[$index]);
    }
    /**
     * unset includedReferencedProduct
     *
     * @param  int|string $index
     */
    public function unset_included_referenced_product($index): void
    {
        unset($this->included_referenced_product[$index]);
    }
    /**
     * Gets as includedReferencedProduct
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedProductType[]
     */
    public function get_included_referenced_product()
    {
        return $this->included_referenced_product;
    }
    /**
     * Sets a new includedReferencedProduct
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedProductType[] $includedReferencedProduct
     */
    public function set_included_referenced_product(?array $included_referenced_product = null): self
    {
        $this->included_referenced_product = $included_referenced_product;
        return $this;
    }
}