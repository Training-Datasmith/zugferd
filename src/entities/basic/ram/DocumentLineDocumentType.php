<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing DocumentLineDocumentType
 *
 * XSD Type: DocumentLineDocumentType
 */
class DocumentLineDocumentType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $lineID
     */
    private $lineID;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\NoteType $includedNote
     */
    private $includedNote;

    /**
     * Gets as lineID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getLineID()
    {
        return $this->lineID;
    }

    /**
     * Sets a new lineID
     */
    public function setLineID(\horstoeko\zugferd\entities\basic\udt\IDType $lineID): self
    {
        $this->lineID = $lineID;
        return $this;
    }

    /**
     * Gets as includedNote
     *
     * @return \horstoeko\zugferd\entities\basic\ram\NoteType
     */
    public function getIncludedNote()
    {
        return $this->includedNote;
    }

    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\NoteType $includedNote
     */
    public function setIncludedNote(?\horstoeko\zugferd\entities\basic\ram\NoteType $includedNote = null): self
    {
        $this->includedNote = $includedNote;
        return $this;
    }
}
