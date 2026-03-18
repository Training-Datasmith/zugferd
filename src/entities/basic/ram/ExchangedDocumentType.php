<?php

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing ExchangedDocumentType
 *
 * XSD Type: ExchangedDocumentType
 */
class ExchangedDocumentType
{

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $typeCode
     */
    private $typeCode;

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $issueDateTime
     */
    private $issueDateTime;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\NoteType[] $includedNote
     */
    private $includedNote = [
        
    ];

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\basic\udt\IDType $iD): self
    {
        $this->iD = $iD;
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
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function getIssueDateTime()
    {
        return $this->issueDateTime;
    }

    /**
     * Sets a new issueDateTime
     */
    public function setIssueDateTime(\horstoeko\zugferd\entities\basic\udt\DateTimeType $issueDateTime): self
    {
        $this->issueDateTime = $issueDateTime;
        return $this;
    }

    /**
     * Adds as includedNote
     */
    public function addToIncludedNote(\horstoeko\zugferd\entities\basic\ram\NoteType $includedNote): self
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
     * @return \horstoeko\zugferd\entities\basic\ram\NoteType[]
     */
    public function getIncludedNote()
    {
        return $this->includedNote;
    }

    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\NoteType[] $includedNote
     */
    public function setIncludedNote(?array $includedNote = null): self
    {
        $this->includedNote = $includedNote;
        return $this;
    }
}
