<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing NoteType
 *
 * XSD Type: NoteType
 */
class Note_Type
{
    /**
     * @var string $content
     */
    private $content;
    /**
     * @var string $subjectCode
     */
    private $subject_code;
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
     * @return string
     */
    public function get_subject_code()
    {
        return $this->subject_code;
    }
    /**
     * Sets a new subjectCode
     *
     * @param  string $subjectCode
     */
    public function set_subject_code($subject_code): self
    {
        $this->subject_code = $subject_code;
        return $this;
    }
}