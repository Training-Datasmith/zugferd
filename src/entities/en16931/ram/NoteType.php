<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

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
     * @var \horstoeko\zugferd\entities\en16931\udt\CodeType $subjectCode
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
     * @return \horstoeko\zugferd\entities\en16931\udt\CodeType
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * Sets a new subjectCode
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\CodeType $subjectCode
     */
    public function setSubjectCode(?\horstoeko\zugferd\entities\en16931\udt\CodeType $subjectCode = null): self
    {
        $this->subjectCode = $subjectCode;
        return $this;
    }
}
