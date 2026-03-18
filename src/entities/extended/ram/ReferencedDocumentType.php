<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ReferencedDocumentType
 *
 * XSD Type: ReferencedDocumentType
 */
class ReferencedDocumentType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $issuerAssignedID
     */
    private $issuerAssignedID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $uRIID
     */
    private $uRIID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $lineID
     */
    private $lineID;

    /**
     * @var string $typeCode
     */
    private $typeCode;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\BinaryObjectType $attachmentBinaryObject
     */
    private $attachmentBinaryObject;

    /**
     * @var string $referenceTypeCode
     */
    private $referenceTypeCode;

    /**
     * @var \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    private $formattedIssueDateTime;

    /**
     * Gets as issuerAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getIssuerAssignedID()
    {
        return $this->issuerAssignedID;
    }

    /**
     * Sets a new issuerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $issuerAssignedID
     */
    public function setIssuerAssignedID(?\horstoeko\zugferd\entities\extended\udt\IDType $issuerAssignedID = null): self
    {
        $this->issuerAssignedID = $issuerAssignedID;
        return $this;
    }

    /**
     * Gets as uRIID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getURIID()
    {
        return $this->uRIID;
    }

    /**
     * Sets a new uRIID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $uRIID
     */
    public function setURIID(?\horstoeko\zugferd\entities\extended\udt\IDType $uRIID = null): self
    {
        $this->uRIID = $uRIID;
        return $this;
    }

    /**
     * Gets as lineID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getLineID()
    {
        return $this->lineID;
    }

    /**
     * Sets a new lineID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $lineID
     */
    public function setLineID(?\horstoeko\zugferd\entities\extended\udt\IDType $lineID = null): self
    {
        $this->lineID = $lineID;
        return $this;
    }

    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function setTypeCode($typeCode): self
    {
        $this->typeCode = $typeCode;
        return $this;
    }

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as attachmentBinaryObject
     *
     * @return \horstoeko\zugferd\entities\extended\udt\BinaryObjectType
     */
    public function getAttachmentBinaryObject()
    {
        return $this->attachmentBinaryObject;
    }

    /**
     * Sets a new attachmentBinaryObject
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\BinaryObjectType $attachmentBinaryObject
     */
    public function setAttachmentBinaryObject(?\horstoeko\zugferd\entities\extended\udt\BinaryObjectType $attachmentBinaryObject = null): self
    {
        $this->attachmentBinaryObject = $attachmentBinaryObject;
        return $this;
    }

    /**
     * Gets as referenceTypeCode
     *
     * @return string
     */
    public function getReferenceTypeCode()
    {
        return $this->referenceTypeCode;
    }

    /**
     * Sets a new referenceTypeCode
     *
     * @param  string $referenceTypeCode
     */
    public function setReferenceTypeCode($referenceTypeCode): self
    {
        $this->referenceTypeCode = $referenceTypeCode;
        return $this;
    }

    /**
     * Gets as formattedIssueDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType
     */
    public function getFormattedIssueDateTime()
    {
        return $this->formattedIssueDateTime;
    }

    /**
     * Sets a new formattedIssueDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    public function setFormattedIssueDateTime(?\horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedIssueDateTime = null): self
    {
        $this->formattedIssueDateTime = $formattedIssueDateTime;
        return $this;
    }
}
