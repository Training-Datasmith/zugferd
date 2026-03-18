<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SupplyChainConsignmentType
 *
 * XSD Type: SupplyChainConsignmentType
 */
class SupplyChainConsignmentType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $specifiedLogisticsTransportMovement
     */
    private $specifiedLogisticsTransportMovement = [

    ];

    /**
     * Adds as specifiedLogisticsTransportMovement
     */
    public function addToSpecifiedLogisticsTransportMovement(\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType $specifiedLogisticsTransportMovement): self
    {
        $this->specifiedLogisticsTransportMovement[] = $specifiedLogisticsTransportMovement;
        return $this;
    }

    /**
     * isset specifiedLogisticsTransportMovement
     *
     * @param  int|string $index
     */
    public function issetSpecifiedLogisticsTransportMovement($index): bool
    {
        return isset($this->specifiedLogisticsTransportMovement[$index]);
    }

    /**
     * unset specifiedLogisticsTransportMovement
     *
     * @param  int|string $index
     */
    public function unsetSpecifiedLogisticsTransportMovement($index): void
    {
        unset($this->specifiedLogisticsTransportMovement[$index]);
    }

    /**
     * Gets as specifiedLogisticsTransportMovement
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[]
     */
    public function getSpecifiedLogisticsTransportMovement()
    {
        return $this->specifiedLogisticsTransportMovement;
    }

    /**
     * Sets a new specifiedLogisticsTransportMovement
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $specifiedLogisticsTransportMovement
     */
    public function setSpecifiedLogisticsTransportMovement(?array $specifiedLogisticsTransportMovement = null): self
    {
        $this->specifiedLogisticsTransportMovement = $specifiedLogisticsTransportMovement;
        return $this;
    }
}
