<?php

namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing NoteType
 *
 * XSD Type: NoteType
 */
class NoteType
{

    /**
     * @var string $content
     */
    private $content;

    /**
     * @var string $subjectCode
     */
    private $subjectCode;

    /**
     * Gets as content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets a new content
     *
     * @param  string $content
     */
    public function setContent($content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Gets as subjectCode
     *
     * @return string
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * Sets a new subjectCode
     *
     * @param  string $subjectCode
     */
    public function setSubjectCode($subjectCode): self
    {
        $this->subjectCode = $subjectCode;
        return $this;
    }
}
