<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing CodeType
 *
 * XSD Type: CodeType
 */
class CodeType
{
    /**
     * @var string $__value
     */
    private $__value;

    /**
     * @var string $listID
     */
    private $listID;

    /**
     * @var string $listVersionID
     */
    private $listVersionID;

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
     * Gets as listID
     *
     * @return string
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * Sets a new listID
     *
     * @param  string $listID
     */
    public function setListID($listID): self
    {
        $this->listID = $listID;
        return $this;
    }

    /**
     * Gets as listVersionID
     *
     * @return string
     */
    public function getListVersionID()
    {
        return $this->listVersionID;
    }

    /**
     * Sets a new listVersionID
     *
     * @param  string $listVersionID
     */
    public function setListVersionID($listVersionID): self
    {
        $this->listVersionID = $listVersionID;
        return $this;
    }
}
