<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing DebtorFinancialAccountType
 *
 * XSD Type: DebtorFinancialAccountType
 */
class Debtor_Financial_Account_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $iBANID
     */
    private $i_banid;
    /**
     * Gets as iBANID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_ibanid()
    {
        return $this->i_banid;
    }
    /**
     * Sets a new iBANID
     */
    public function set_ibanid(\horstoeko\zugferd\entities\basic\udt\Id_Type $i_banid): self
    {
        $this->i_banid = $i_banid;
        return $this;
    }
}