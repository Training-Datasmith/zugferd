<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing CreditorFinancialAccountType
 *
 * XSD Type: CreditorFinancialAccountType
 */
class Creditor_Financial_Account_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iBANID
     */
    private $i_banid;
    /**
     * @var string $accountName
     */
    private $account_name;
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $proprietaryID
     */
    private $proprietary_id;
    /**
     * Gets as iBANID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_ibanid()
    {
        return $this->i_banid;
    }
    /**
     * Sets a new iBANID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $iBANID
     */
    public function set_ibanid(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $i_banid = null): self
    {
        $this->i_banid = $i_banid;
        return $this;
    }
    /**
     * Gets as accountName
     *
     * @return string
     */
    public function get_account_name()
    {
        return $this->account_name;
    }
    /**
     * Sets a new accountName
     *
     * @param  string $accountName
     */
    public function set_account_name($account_name): self
    {
        $this->account_name = $account_name;
        return $this;
    }
    /**
     * Gets as proprietaryID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_proprietary_id()
    {
        return $this->proprietary_id;
    }
    /**
     * Sets a new proprietaryID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $proprietaryID
     */
    public function set_proprietary_id(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $proprietary_id = null): self
    {
        $this->proprietary_id = $proprietary_id;
        return $this;
    }
}