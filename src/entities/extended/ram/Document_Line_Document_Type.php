<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing DocumentLineDocumentType
 *
 * XSD Type: DocumentLineDocumentType
 */
class Document_Line_Document_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $lineID
     */
    private $line_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $parentLineID
     */
    private $parent_line_id;
    /**
     * @var string $lineStatusCode
     */
    private $line_status_code;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $lineStatusReasonCode
     */
    private $line_status_reason_code;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\NoteType[] $includedNote
     */
    private $included_note = [];
    /**
     * Gets as lineID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_line_id()
    {
        return $this->line_id;
    }
    /**
     * Sets a new lineID
     */
    public function set_line_id(\horstoeko\zugferd\entities\extended\udt\Id_Type $line_id): self
    {
        $this->line_id = $line_id;
        return $this;
    }
    /**
     * Gets as parentLineID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_parent_line_id()
    {
        return $this->parent_line_id;
    }
    /**
     * Sets a new parentLineID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $parentLineID
     */
    public function set_parent_line_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $parent_line_id = null): self
    {
        $this->parent_line_id = $parent_line_id;
        return $this;
    }
    /**
     * Gets as lineStatusCode
     *
     * @return string
     */
    public function get_line_status_code()
    {
        return $this->line_status_code;
    }
    /**
     * Sets a new lineStatusCode
     *
     * @param  string $lineStatusCode
     */
    public function set_line_status_code($line_status_code): self
    {
        $this->line_status_code = $line_status_code;
        return $this;
    }
    /**
     * Gets as lineStatusReasonCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_line_status_reason_code()
    {
        return $this->line_status_reason_code;
    }
    /**
     * Sets a new lineStatusReasonCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $lineStatusReasonCode
     */
    public function set_line_status_reason_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $line_status_reason_code = null): self
    {
        $this->line_status_reason_code = $line_status_reason_code;
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
}