<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing CreditorFinancialAccountType
 *
 * XSD Type: CreditorFinancialAccountType
 */
class Creditor_Financial_Account_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $iBANID
     */
    private $i_banid;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $proprietaryID
     */
    private $proprietary_id;
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
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $iBANID
     */
    public function set_ibanid(?\horstoeko\zugferd\entities\basic\udt\Id_Type $i_banid = null): self
    {
        $this->i_banid = $i_banid;
        return $this;
    }
    /**
     * Gets as proprietaryID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_proprietary_id()
    {
        return $this->proprietary_id;
    }
    /**
     * Sets a new proprietaryID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $proprietaryID
     */
    public function set_proprietary_id(?\horstoeko\zugferd\entities\basic\udt\Id_Type $proprietary_id = null): self
    {
        $this->proprietary_id = $proprietary_id;
        return $this;
    }
}