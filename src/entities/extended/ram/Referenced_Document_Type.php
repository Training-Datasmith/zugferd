<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ReferencedDocumentType
 *
 * XSD Type: ReferencedDocumentType
 */
class Referenced_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $issuerAssignedID
     */
    private $issuer_assigned_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $uRIID
     */
    private $u_riid;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $lineID
     */
    private $line_id;
    /**
     * @var string $typeCode
     */
    private $type_code;
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\BinaryObjectType $attachmentBinaryObject
     */
    private $attachment_binary_object;
    /**
     * @var string $referenceTypeCode
     */
    private $reference_type_code;
    /**
     * @var \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    private $formatted_issue_date_time;
    /**
     * Gets as issuerAssignedID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_issuer_assigned_id()
    {
        return $this->issuer_assigned_id;
    }
    /**
     * Sets a new issuerAssignedID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $issuerAssignedID
     */
    public function set_issuer_assigned_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $issuer_assigned_id = null): self
    {
        $this->issuer_assigned_id = $issuer_assigned_id;
        return $this;
    }
    /**
     * Gets as uRIID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_uriid()
    {
        return $this->u_riid;
    }
    /**
     * Sets a new uRIID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $uRIID
     */
    public function set_uriid(?\horstoeko\zugferd\entities\extended\udt\Id_Type $u_riid = null): self
    {
        $this->u_riid = $u_riid;
        return $this;
    }
    /**
     * Gets as lineID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_line_id()
    {
        return $this->line_id;
    }
    /**
     * Sets a new lineID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $lineID
     */
    public function set_line_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $line_id = null): self
    {
        $this->line_id = $line_id;
        return $this;
    }
    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function get_type_code()
    {
        return $this->type_code;
    }
    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function set_type_code($type_code): self
    {
        $this->type_code = $type_code;
        return $this;
    }
    /**
     * Gets as name
     *
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }
    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function set_name($name): self
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Gets as attachmentBinaryObject
     *
     * @return \horstoeko\zugferd\entities\extended\udt\BinaryObjectType
     */
    public function get_attachment_binary_object()
    {
        return $this->attachment_binary_object;
    }
    /**
     * Sets a new attachmentBinaryObject
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\BinaryObjectType $attachmentBinaryObject
     */
    public function set_attachment_binary_object(?\horstoeko\zugferd\entities\extended\udt\Binary_Object_Type $attachment_binary_object = null): self
    {
        $this->attachment_binary_object = $attachment_binary_object;
        return $this;
    }
    /**
     * Gets as referenceTypeCode
     *
     * @return string
     */
    public function get_reference_type_code()
    {
        return $this->reference_type_code;
    }
    /**
     * Sets a new referenceTypeCode
     *
     * @param  string $referenceTypeCode
     */
    public function set_reference_type_code($reference_type_code): self
    {
        $this->reference_type_code = $reference_type_code;
        return $this;
    }
    /**
     * Gets as formattedIssueDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType
     */
    public function get_formatted_issue_date_time()
    {
        return $this->formatted_issue_date_time;
    }
    /**
     * Sets a new formattedIssueDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    public function set_formatted_issue_date_time(?\horstoeko\zugferd\entities\extended\qdt\Formatted_Date_Time_Type $formatted_issue_date_time = null): self
    {
        $this->formatted_issue_date_time = $formatted_issue_date_time;
        return $this;
    }
}