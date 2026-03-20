<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing DocumentLineDocumentType
 *
 * XSD Type: DocumentLineDocumentType
 */
class Document_Line_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $lineID
     */
    private $line_id;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\NoteType $includedNote
     */
    private $included_note;
    /**
     * Gets as lineID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_line_id()
    {
        return $this->line_id;
    }
    /**
     * Sets a new lineID
     */
    public function set_line_id(\horstoeko\zugferd\entities\basic\udt\Id_Type $line_id): self
    {
        $this->line_id = $line_id;
        return $this;
    }
    /**
     * Gets as includedNote
     *
     * @return \horstoeko\zugferd\entities\basic\ram\NoteType
     */
    public function get_included_note()
    {
        return $this->included_note;
    }
    /**
     * Sets a new includedNote
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\NoteType $includedNote
     */
    public function set_included_note(?\horstoeko\zugferd\entities\basic\ram\Note_Type $included_note = null): self
    {
        $this->included_note = $included_note;
        return $this;
    }
}