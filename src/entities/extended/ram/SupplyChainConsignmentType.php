<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SupplyChainConsignmentType
 *
 * XSD Type: SupplyChainConsignmentType
 */
class Supply_Chain_Consignment_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $specifiedLogisticsTransportMovement
     */
    private $specified_logistics_transport_movement = [];
    /**
     * Adds as specifiedLogisticsTransportMovement
     */
    public function add_to_specified_logistics_transport_movement(\horstoeko\zugferd\entities\extended\ram\Logistics_Transport_Movement_Type $specified_logistics_transport_movement): self
    {
        $this->specified_logistics_transport_movement[] = $specified_logistics_transport_movement;
        return $this;
    }
    /**
     * isset specifiedLogisticsTransportMovement
     *
     * @param  int|string $index
     */
    public function isset_specified_logistics_transport_movement($index): bool
    {
        return isset($this->specified_logistics_transport_movement[$index]);
    }
    /**
     * unset specifiedLogisticsTransportMovement
     *
     * @param  int|string $index
     */
    public function unset_specified_logistics_transport_movement($index): void
    {
        unset($this->specified_logistics_transport_movement[$index]);
    }
    /**
     * Gets as specifiedLogisticsTransportMovement
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[]
     */
    public function get_specified_logistics_transport_movement()
    {
        return $this->specified_logistics_transport_movement;
    }
    /**
     * Sets a new specifiedLogisticsTransportMovement
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $specifiedLogisticsTransportMovement
     */
    public function set_specified_logistics_transport_movement(?array $specified_logistics_transport_movement = null): self
    {
        $this->specified_logistics_transport_movement = $specified_logistics_transport_movement;
        return $this;
    }
}