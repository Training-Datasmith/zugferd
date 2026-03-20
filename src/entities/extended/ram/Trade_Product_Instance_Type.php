<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeProductInstanceType
 *
 * XSD Type: TradeProductInstanceType
 */
class Trade_Product_Instance_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $batchID
     */
    private $batch_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $supplierAssignedSerialID
     */
    private $supplier_assigned_serial_id;
    /**
     * Gets as batchID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_batch_id()
    {
        return $this->batch_id;
    }
    /**
     * Sets a new batchID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $batchID
     */
    public function set_batch_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $batch_id = null): self
    {
        $this->batch_id = $batch_id;
        return $this;
    }
    /**
     * Gets as supplierAssignedSerialID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_supplier_assigned_serial_id()
    {
        return $this->supplier_assigned_serial_id;
    }
    /**
     * Sets a new supplierAssignedSerialID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $supplierAssignedSerialID
     */
    public function set_supplier_assigned_serial_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $supplier_assigned_serial_id = null): self
    {
        $this->supplier_assigned_serial_id = $supplier_assigned_serial_id;
        return $this;
    }
}