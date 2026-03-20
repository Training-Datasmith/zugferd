<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ReferencedProductType
 *
 * XSD Type: ReferencedProductType
 */
class Referenced_Product_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType[] $globalID
     */
    private $global_id = [];
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
    private $unit_quantity;
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
     * Adds as globalID
     */
    public function add_to_global_id(\horstoeko\zugferd\entities\extended\udt\Id_Type $global_id): self
    {
        $this->global_id[] = $global_id;
        return $this;
    }
    /**
     * isset globalID
     *
     * @param  int|string $index
     */
    public function isset_global_id($index): bool
    {
        return isset($this->global_id[$index]);
    }
    /**
     * unset globalID
     *
     * @param  int|string $index
     */
    public function unset_global_id($index): void
    {
        unset($this->global_id[$index]);
    }
    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType[]
     */
    public function get_global_id()
    {
        return $this->global_id;
    }
    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType[] $globalID
     */
    public function set_global_id(?array $global_id = null): self
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
     * Gets as unitQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function get_unit_quantity()
    {
        return $this->unit_quantity;
    }
    /**
     * Sets a new unitQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $unitQuantity
     */
    public function set_unit_quantity(?\horstoeko\zugferd\entities\extended\udt\Quantity_Type $unit_quantity = null): self
    {
        $this->unit_quantity = $unit_quantity;
        return $this;
    }
}