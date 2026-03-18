<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing CreditorFinancialAccountType
 *
 * XSD Type: CreditorFinancialAccountType
 */
class CreditorFinancialAccountType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iBANID
     */
    private $iBANID;

    /**
     * @var string $accountName
     */
    private $accountName;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $proprietaryID
     */
    private $proprietaryID;

    /**
     * Gets as iBANID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getIBANID()
    {
        return $this->iBANID;
    }

    /**
     * Sets a new iBANID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $iBANID
     */
    public function setIBANID(?\horstoeko\zugferd\entities\en16931\udt\IDType $iBANID = null): self
    {
        $this->iBANID = $iBANID;
        return $this;
    }

    /**
     * Gets as accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Sets a new accountName
     *
     * @param  string $accountName
     */
    public function setAccountName($accountName): self
    {
        $this->accountName = $accountName;
        return $this;
    }

    /**
     * Gets as proprietaryID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getProprietaryID()
    {
        return $this->proprietaryID;
    }

    /**
     * Sets a new proprietaryID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $proprietaryID
     */
    public function setProprietaryID(?\horstoeko\zugferd\entities\en16931\udt\IDType $proprietaryID = null): self
    {
        $this->proprietaryID = $proprietaryID;
        return $this;
    }
}
