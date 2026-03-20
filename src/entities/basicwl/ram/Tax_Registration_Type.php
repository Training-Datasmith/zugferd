<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing TaxRegistrationType
 *
 * XSD Type: TaxRegistrationType
 */
class Tax_Registration_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IDType $iD
     */
    private $i_d;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     */
    public function set_id(\horstoeko\zugferd\entities\basicwl\udt\Id_Type $i_d): self
    {
        $this->i_d = $i_d;
        return $this;
    }
}