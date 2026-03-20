<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing DocumentContextParameterType
 *
 * XSD Type: DocumentContextParameterType
 */
class Document_Context_Parameter_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $i_d;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     */
    public function set_id(\horstoeko\zugferd\entities\extended\udt\Id_Type $i_d): self
    {
        $this->i_d = $i_d;
        return $this;
    }
}