<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class Exchanged_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var string $typeCode
     */
    private $type_code;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $issueDateTime
     */
    private $issue_date_time;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\NoteType[] $includedNote
     */
    private $included_note = [];
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     */
    public function set_id(\horstoeko\zugferd\entities\basic\udt\Id_Type $i_d): self
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
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function get_issue_date_time()
    {
        return $this->issue_date_time;
    }
    /**
     * Sets a new issueDateTime
     */
    public function set_issue_date_time(\horstoeko\zugferd\entities\basic\udt\Date_Time_Type $issue_date_time): self
    {
        $this->issue_date_time = $issue_date_time;
        return $this;
    }
    /**
     * Adds as includedNote
     */
    public function add_to_included_note(\horstoeko\zugferd\entities\basic\ram\Note_Type $included_note): self
    {
        $this->included_note[] = $included_note;
        return $this;
    }
    /**
     * isset includedNote
     *
     * @param  int|string $index
     */
    public function isset_included_note($index): bool
    {
        return isset($this->included_note[$index]);
    }
    /**
     * unset includedNote
     *
     * @param  int|string $index
     */
    public function unset_included_note($index): void
    {
        unset($this->included_note[$index]);
    }
    /**
     * Gets as includedNote
     *
     * @return \horstoeko\zugferd\entities\basic\ram\NoteType[]
     */
    public function get_included_note()
    {
        return $this->included_note;
    }
    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\NoteType[] $includedNote
     */
    public function set_included_note(?array $included_note = null): self
    {
        $this->included_note = $included_note;
        return $this;
    }
}