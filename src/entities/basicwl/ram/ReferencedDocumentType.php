<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing ReferencedDocumentType
 *
 * XSD Type: ReferencedDocumentType
 */
class Referenced_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IDType $issuerAssignedID
     */
    private $issuer_assigned_id;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    private $formatted_issue_date_time;
    /**
     * Gets as issuerAssignedID
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IDType
     */
    public function get_issuer_assigned_id()
    {
        return $this->issuer_assigned_id;
    }
    /**
     * Sets a new issuerAssignedID
     */
    public function set_issuer_assigned_id(\horstoeko\zugferd\entities\basicwl\udt\Id_Type $issuer_assigned_id): self
    {
        $this->issuer_assigned_id = $issuer_assigned_id;
        return $this;
    }
    /**
     * Gets as formattedIssueDateTime
     *
     * @return \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType
     */
    public function get_formatted_issue_date_time()
    {
        return $this->formatted_issue_date_time;
    }
    /**
     * Sets a new formattedIssueDateTime
     *
     * @param  \horstoeko\zugferd\entities\basicwl\qdt\FormattedDateTimeType $formattedIssueDateTime
     */
    public function set_formatted_issue_date_time(?\horstoeko\zugferd\entities\basicwl\qdt\Formatted_Date_Time_Type $formatted_issue_date_time = null): self
    {
        $this->formatted_issue_date_time = $formatted_issue_date_time;
        return $this;
    }
}