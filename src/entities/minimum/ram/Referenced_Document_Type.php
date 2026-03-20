<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing ReferencedDocumentType
 *
 * XSD Type: ReferencedDocumentType
 */
class Referenced_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\IDType $issuerAssignedID
     */
    private $issuer_assigned_id;
    /**
     * Gets as issuerAssignedID
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\IDType
     */
    public function get_issuer_assigned_id()
    {
        return $this->issuer_assigned_id;
    }
    /**
     * Sets a new issuerAssignedID
     */
    public function set_issuer_assigned_id(\horstoeko\zugferd\entities\minimum\udt\Id_Type $issuer_assigned_id): self
    {
        $this->issuer_assigned_id = $issuer_assigned_id;
        return $this;
    }
}