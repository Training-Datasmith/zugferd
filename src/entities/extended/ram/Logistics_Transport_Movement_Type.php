<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LogisticsTransportMovementType
 *
 * XSD Type: LogisticsTransportMovementType
 */
class Logistics_Transport_Movement_Type
{
    /**
     * @var string $modeCode
     */
    private $mode_code;
    /**
     * Gets as modeCode
     *
     * @return string
     */
    public function get_mode_code()
    {
        return $this->mode_code;
    }
    /**
     * Sets a new modeCode
     *
     * @param  string $modeCode
     */
    public function set_mode_code($mode_code): self
    {
        $this->mode_code = $mode_code;
        return $this;
    }
}