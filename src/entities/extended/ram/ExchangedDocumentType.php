<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class ExchangedDocumentType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $typeCode
     */
    private $typeCode;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $issueDateTime
     */
    private $issueDateTime;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator
     */
    private $copyIndicator;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $languageID
     */
    private $languageID;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    private $includedNote = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod
     */
    private $effectiveSpecifiedPeriod;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\extended\udt\IDType $iD): self
    {
        $this->iD = $iD;
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
     * Gets as issueDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getIssueDateTime()
    {
        return $this->issueDateTime;
    }

    /**
     * Sets a new issueDateTime
     */
    public function setIssueDateTime(\horstoeko\zugferd\entities\extended\udt\DateTimeType $issueDateTime): self
    {
        $this->issueDateTime = $issueDateTime;
        return $this;
    }

    /**
     * Gets as copyIndicator
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IndicatorType
     */
    public function getCopyIndicator()
    {
        return $this->copyIndicator;
    }

    /**
     * Sets a new copyIndicator
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator
     */
    public function setCopyIndicator(?\horstoeko\zugferd\entities\extended\udt\IndicatorType $copyIndicator = null): self
    {
        $this->copyIndicator = $copyIndicator;
        return $this;
    }

    /**
     * Gets as languageID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getLanguageID()
    {
        return $this->languageID;
    }

    /**
     * Sets a new languageID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $languageID
     */
    public function setLanguageID(?\horstoeko\zugferd\entities\extended\udt\IDType $languageID = null): self
    {
        $this->languageID = $languageID;
        return $this;
    }

    /**
     * Adds as includedNote
     */
    public function addToIncludedNote(\horstoeko\zugferd\entities\extended\ram\NoteType $includedNote): self
    {
        $this->includedNote[] = $includedNote;
        return $this;
    }

    /**
     * isset includedNote
     *
     * @param  int|string $index
     */
    public function issetIncludedNote($index): bool
    {
        return isset($this->includedNote[$index]);
    }

    /**
     * unset includedNote
     *
     * @param  int|string $index
     */
    public function unsetIncludedNote($index): void
    {
        unset($this->includedNote[$index]);
    }

    /**
     * Gets as includedNote
     *
     * @return \horstoeko\zugferd\entities\extended\ram\NoteType[]
     */
    public function getIncludedNote()
    {
        return $this->includedNote;
    }

    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    public function setIncludedNote(?array $includedNote = null): self
    {
        $this->includedNote = $includedNote;
        return $this;
    }

    /**
     * Gets as effectiveSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType
     */
    public function getEffectiveSpecifiedPeriod()
    {
        return $this->effectiveSpecifiedPeriod;
    }

    /**
     * Sets a new effectiveSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod
     */
    public function setEffectiveSpecifiedPeriod(?\horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $effectiveSpecifiedPeriod = null): self
    {
        $this->effectiveSpecifiedPeriod = $effectiveSpecifiedPeriod;
        return $this;
    }
}
