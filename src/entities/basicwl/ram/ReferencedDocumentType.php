<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing ReferencedDocumentType
 *
 * XSD Type: ReferencedDocumentType
 */
class ReferencedDocumentType
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IDType $issuerAssignedID
     */
    private $issuerAssignedID;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    private $formattedIssueDateTime;

    /**
     * Gets as issuerAssignedID
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IDType
     */
    public function getIssuerAssignedID()
    {
        return $this->issuerAssignedID;
    }

    /**
     * Sets a new issuerAssignedID
     */
    public function setIssuerAssignedID(\horstoeko\zugferd\entities\basicwl\udt\IDType $issuerAssignedID): self
    {
        $this->issuerAssignedID = $issuerAssignedID;
        return $this;
    }

    /**
     * Gets as formattedIssueDateTime
     *
     * @return \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType
     */
    public function getFormattedIssueDateTime()
    {
        return $this->formattedIssueDateTime;
    }

    /**
     * Sets a new formattedIssueDateTime
     *
     * @param  \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    public function setFormattedIssueDateTime(?\horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType $formattedIssueDateTime = null): self
    {
        $this->formattedIssueDateTime = $formattedIssueDateTime;
        return $this;
    }
}
