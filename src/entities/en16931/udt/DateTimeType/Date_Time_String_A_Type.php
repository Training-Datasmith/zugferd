<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\udt\Date_Time_Type;

/**
 * Class representing DateTimeStringAType
 */
class Date_Time_String_A_Type
{
    /**
     * @var string $__value
     */
    private $__value;
    /**
     * @var string $format
     */
    private $format;
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
     * Gets as format
     *
     * @return string
     */
    public function get_format()
    {
        return $this->format;
    }
    /**
     * Sets a new format
     *
     * @param  string $format
     */
    public function set_format($format): self
    {
        $this->format = $format;
        return $this;
    }
}