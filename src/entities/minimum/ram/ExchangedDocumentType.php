<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class Exchanged_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var string $typeCode
     */
    private $type_code;
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\DateTimeType $issueDateTime
     */
    private $issue_date_time;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     */
    public function set_id(\horstoeko\zugferd\entities\minimum\udt\Id_Type $i_d): self
    {
        $this->i_d = $i_d;
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
     * Gets as issueDateTime
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\DateTimeType
     */
    public function get_issue_date_time()
    {
        return $this->issue_date_time;
    }
    /**
     * Sets a new issueDateTime
     */
    public function set_issue_date_time(\horstoeko\zugferd\entities\minimum\udt\Date_Time_Type $issue_date_time): self
    {
        $this->issue_date_time = $issue_date_time;
        return $this;
    }
}