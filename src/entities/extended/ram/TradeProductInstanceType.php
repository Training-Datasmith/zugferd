<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeProductInstanceType
 *
 * XSD Type: TradeProductInstanceType
 */
class TradeProductInstanceType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $batchID
     */
    private $batchID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $supplierAssignedSerialID
     */
    private $supplierAssignedSerialID;

    /**
     * Gets as batchID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getBatchID()
    {
        return $this->batchID;
    }

    /**
     * Sets a new batchID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $batchID
     */
    public function setBatchID(?\horstoeko\zugferd\entities\extended\udt\IDType $batchID = null): self
    {
        $this->batchID = $batchID;
        return $this;
    }

    /**
     * Gets as supplierAssignedSerialID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getSupplierAssignedSerialID()
    {
        return $this->supplierAssignedSerialID;
    }

    /**
     * Sets a new supplierAssignedSerialID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $supplierAssignedSerialID
     */
    public function setSupplierAssignedSerialID(?\horstoeko\zugferd\entities\extended\udt\IDType $supplierAssignedSerialID = null): self
    {
        $this->supplierAssignedSerialID = $supplierAssignedSerialID;
        return $this;
    }
}
