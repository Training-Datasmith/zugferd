<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing CreditorFinancialInstitutionType
 *
 * XSD Type: CreditorFinancialInstitutionType
 */
class Creditor_Financial_Institution_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $bICID
     */
    private $b_icid;
    /**
     * Gets as bICID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_bicid()
    {
        return $this->b_icid;
    }
    /**
     * Sets a new bICID
     */
    public function set_bicid(\horstoeko\zugferd\entities\extended\udt\Id_Type $b_icid): self
    {
        $this->b_icid = $b_icid;
        return $this;
    }
}