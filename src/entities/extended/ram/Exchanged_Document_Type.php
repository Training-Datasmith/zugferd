<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class Exchanged_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $i_d;
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var string $typeCode
     */
    private $type_code;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $issueDateTime
     */
    private $issue_date_time;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator
     */
    private $copy_indicator;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $languageID
     */
    private $language_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    private $included_note = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod
     */
    private $effective_specified_period;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     */
    public function set_id(\horstoeko\zugferd\entities\extended\udt\Id_Type $i_d): self
    {
        $this->i_d = $i_d;
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
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_issue_date_time()
    {
        return $this->issue_date_time;
    }
    /**
     * Sets a new issueDateTime
     */
    public function set_issue_date_time(\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $issue_date_time): self
    {
        $this->issue_date_time = $issue_date_time;
        return $this;
    }
    /**
     * Gets as copyIndicator
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IndicatorType
     */
    public function get_copy_indicator()
    {
        return $this->copy_indicator;
    }
    /**
     * Sets a new copyIndicator
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator
     */
    public function set_copy_indicator(?\horstoeko\zugferd\entities\extended\udt\Indicator_Type $copy_indicator = null): self
    {
        $this->copy_indicator = $copy_indicator;
        return $this;
    }
    /**
     * Gets as languageID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_language_id()
    {
        return $this->language_id;
    }
    /**
     * Sets a new languageID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $languageID
     */
    public function set_language_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $language_id = null): self
    {
        $this->language_id = $language_id;
        return $this;
    }
    /**
     * Adds as includedNote
     */
    public function add_to_included_note(\horstoeko\zugferd\entities\extended\ram\Note_Type $included_note): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\NoteType[]
     */
    public function get_included_note()
    {
        return $this->included_note;
    }
    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    public function set_included_note(?array $included_note = null): self
    {
        $this->included_note = $included_note;
        return $this;
    }
    /**
     * Gets as effectiveSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType
     */
    public function get_effective_specified_period()
    {
        return $this->effective_specified_period;
    }
    /**
     * Sets a new effectiveSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod
     */
    public function set_effective_specified_period(?\horstoeko\zugferd\entities\extended\ram\Specified_Period_Type $effective_specified_period = null): self
    {
        $this->effective_specified_period = $effective_specified_period;
        return $this;
    }
}