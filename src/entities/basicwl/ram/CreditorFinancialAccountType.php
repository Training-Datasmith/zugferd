<?php

namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing CreditorFinancialAccountType
 *
 * XSD Type: CreditorFinancialAccountType
 */
class CreditorFinancialAccountType
{

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IDType $iBANID
     */
    private $iBANID;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IDType $proprietaryID
     */
    private $proprietaryID;

    /**
     * Gets as iBANID
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IDType
     */
    public function getIBANID()
    {
        return $this->iBANID;
    }

    /**
     * Sets a new iBANID
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\IDType $iBANID
     */
    public function setIBANID(?\horstoeko\zugferd\entities\basicwl\udt\IDType $iBANID = null): self
    {
        $this->iBANID = $iBANID;
        return $this;
    }

    /**
     * Gets as proprietaryID
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IDType
     */
    public function getProprietaryID()
    {
        return $this->proprietaryID;
    }

    /**
     * Sets a new proprietaryID
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\IDType $proprietaryID
     */
    public function setProprietaryID(?\horstoeko\zugferd\entities\basicwl\udt\IDType $proprietaryID = null): self
    {
        $this->proprietaryID = $proprietaryID;
        return $this;
    }
}
