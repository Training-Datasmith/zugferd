<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing ReferencedDocumentType
 *
 * XSD Type: ReferencedDocumentType
 */
class ReferencedDocumentType
{

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\IDType $issuerAssignedID
     */
    private $issuerAssignedID;

    /**
     * Gets as issuerAssignedID
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\IDType
     */
    public function getIssuerAssignedID()
    {
        return $this->issuerAssignedID;
    }

    /**
     * Sets a new issuerAssignedID
     */
    public function setIssuerAssignedID(\horstoeko\zugferd\entities\minimum\udt\IDType $issuerAssignedID): self
    {
        $this->issuerAssignedID = $issuerAssignedID;
        return $this;
    }
}
