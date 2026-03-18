<?php

namespace horstoeko\zugferd\entities\basic\udt;

/**
 * Class representing IDType
 *
 * XSD Type: IDType
 */
class IDType
{

    /**
     * @var string $__value
     */
    private $__value;

    /**
     * @var string $schemeID
     */
    private $schemeID;

    /**
     * Construct
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value
     *
     * @param  string $value
     * @return string
     */
    public function value()
    {
        if ($args = func_get_args()) {
            $this->__value = $args[0];
        }
        return $this->__value;
    }

    /**
     * Gets a string value
     */
    public function __toString(): string
    {
        return strval($this->__value);
    }

    /**
     * Gets as schemeID
     *
     * @return string
     */
    public function getSchemeID()
    {
        return $this->schemeID;
    }

    /**
     * Sets a new schemeID
     *
     * @param  string $schemeID
     */
    public function setSchemeID($schemeID): self
    {
        $this->schemeID = $schemeID;
        return $this;
    }
}
