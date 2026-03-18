<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing DocumentLineDocumentType
 *
 * XSD Type: DocumentLineDocumentType
 */
class DocumentLineDocumentType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $lineID
     */
    private $lineID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $parentLineID
     */
    private $parentLineID;

    /**
     * @var string $lineStatusCode
     */
    private $lineStatusCode;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $lineStatusReasonCode
     */
    private $lineStatusReasonCode;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    private $includedNote = [

    ];

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
     */
    public function setLineID(\horstoeko\zugferd\entities\extended\udt\IDType $lineID): self
    {
        $this->lineID = $lineID;
        return $this;
    }

    /**
     * Gets as parentLineID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getParentLineID()
    {
        return $this->parentLineID;
    }

    /**
     * Sets a new parentLineID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $parentLineID
     */
    public function setParentLineID(?\horstoeko\zugferd\entities\extended\udt\IDType $parentLineID = null): self
    {
        $this->parentLineID = $parentLineID;
        return $this;
    }

    /**
     * Gets as lineStatusCode
     *
     * @return string
     */
    public function getLineStatusCode()
    {
        return $this->lineStatusCode;
    }

    /**
     * Sets a new lineStatusCode
     *
     * @param  string $lineStatusCode
     */
    public function setLineStatusCode($lineStatusCode): self
    {
        $this->lineStatusCode = $lineStatusCode;
        return $this;
    }

    /**
     * Gets as lineStatusReasonCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function getLineStatusReasonCode()
    {
        return $this->lineStatusReasonCode;
    }

    /**
     * Sets a new lineStatusReasonCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $lineStatusReasonCode
     */
    public function setLineStatusReasonCode(?\horstoeko\zugferd\entities\extended\udt\CodeType $lineStatusReasonCode = null): self
    {
        $this->lineStatusReasonCode = $lineStatusReasonCode;
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
}
