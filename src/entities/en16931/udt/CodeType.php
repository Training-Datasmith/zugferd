<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing CodeType
 *
 * XSD Type: CodeType
 */
class Code_Type
{
    /**
     * @var string $__value
     */
    private $__value;
    /**
     * @var string $listID
     */
    private $list_id;
    /**
     * @var string $listVersionID
     */
    private $list_version_id;
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
    public function get_list_id()
    {
        return $this->list_id;
    }
    /**
     * Sets a new listID
     *
     * @param  string $listID
     */
    public function set_list_id($list_id): self
    {
        $this->list_id = $list_id;
        return $this;
    }
    /**
     * Gets as listVersionID
     *
     * @return string
     */
    public function get_list_version_id()
    {
        return $this->list_version_id;
    }
    /**
     * Sets a new listVersionID
     *
     * @param  string $listVersionID
     */
    public function set_list_version_id($list_version_id): self
    {
        $this->list_version_id = $list_version_id;
        return $this;
    }
}