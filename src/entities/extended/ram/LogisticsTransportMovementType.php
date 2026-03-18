<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LogisticsTransportMovementType
 *
 * XSD Type: LogisticsTransportMovementType
 */
class LogisticsTransportMovementType
{

    /**
     * @var string $modeCode
     */
    private $modeCode;

    /**
     * Gets as modeCode
     *
     * @return string
     */
    public function getModeCode()
    {
        return $this->modeCode;
    }

    /**
     * Sets a new modeCode
     *
     * @param  string $modeCode
     */
    public function setModeCode($modeCode): self
    {
        $this->modeCode = $modeCode;
        return $this;
    }
}
