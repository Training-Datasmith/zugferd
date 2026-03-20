<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing CreditorFinancialInstitutionType
 *
 * XSD Type: CreditorFinancialInstitutionType
 */
class Creditor_Financial_Institution_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $bICID
     */
    private $b_icid;
    /**
     * Gets as bICID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_bicid()
    {
        return $this->b_icid;
    }
    /**
     * Sets a new bICID
     */
    public function set_bicid(\horstoeko\zugferd\entities\en16931\udt\Id_Type $b_icid): self
    {
        $this->b_icid = $b_icid;
        return $this;
    }
}