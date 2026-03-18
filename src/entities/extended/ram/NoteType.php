<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing NoteType
 *
 * XSD Type: NoteType
 */
class NoteType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $contentCode
     */
    private $contentCode;

    /**
     * @var string $content
     */
    private $content;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode
     */
    private $subjectCode;

    /**
     * Gets as contentCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function getContentCode()
    {
        return $this->contentCode;
    }

    /**
     * Sets a new contentCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $contentCode
     */
    public function setContentCode(?\horstoeko\zugferd\entities\extended\udt\CodeType $contentCode = null): self
    {
        $this->contentCode = $contentCode;
        return $this;
    }

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
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * Sets a new subjectCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode
     */
    public function setSubjectCode(?\horstoeko\zugferd\entities\extended\udt\CodeType $subjectCode = null): self
    {
        $this->subjectCode = $subjectCode;
        return $this;
    }
}
