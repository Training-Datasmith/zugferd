<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing NoteType
 *
 * XSD Type: NoteType
 */
class Note_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $contentCode
     */
    private $content_code;
    /**
     * @var string $content
     */
    private $content;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode
     */
    private $subject_code;
    /**
     * Gets as contentCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_content_code()
    {
        return $this->content_code;
    }
    /**
     * Sets a new contentCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $contentCode
     */
    public function set_content_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $content_code = null): self
    {
        $this->content_code = $content_code;
        return $this;
    }
    /**
     * Gets as content
     *
     * @return string
     */
    public function get_content()
    {
        return $this->content;
    }
    /**
     * Sets a new content
     *
     * @param  string $content
     */
    public function set_content($content): self
    {
        $this->content = $content;
        return $this;
    }
    /**
     * Gets as subjectCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_subject_code()
    {
        return $this->subject_code;
    }
    /**
     * Sets a new subjectCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode
     */
    public function set_subject_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $subject_code = null): self
    {
        $this->subject_code = $subject_code;
        return $this;
    }
}