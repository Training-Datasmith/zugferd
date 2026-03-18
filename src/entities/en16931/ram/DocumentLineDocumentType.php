<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing DocumentLineDocumentType
 *
 * XSD Type: DocumentLineDocumentType
 */
class DocumentLineDocumentType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $lineID
     */
    private $lineID;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\NoteType $includedNote
     */
    private $includedNote;

    /**
     * Gets as lineID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getLineID()
    {
        return $this->lineID;
    }

    /**
     * Sets a new lineID
     */
    public function setLineID(\horstoeko\zugferd\entities\en16931\udt\IDType $lineID): self
    {
        $this->lineID = $lineID;
        return $this;
    }

    /**
     * Gets as includedNote
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\NoteType
     */
    public function getIncludedNote()
    {
        return $this->includedNote;
    }

    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\NoteType $includedNote
     */
    public function setIncludedNote(?\horstoeko\zugferd\entities\en16931\ram\NoteType $includedNote = null): self
    {
        $this->includedNote = $includedNote;
        return $this;
    }
}
