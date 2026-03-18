<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SpecifiedPeriodType
 *
 * XSD Type: SpecifiedPeriodType
 */
class SpecifiedPeriodType
{
    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime
     */
    private $startDateTime;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime
     */
    private $endDateTime;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime
     */
    private $completeDateTime;

    /**
     * Gets as description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets as startDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * Sets a new startDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime
     */
    public function setStartDateTime(?\horstoeko\zugferd\entities\extended\udt\DateTimeType $startDateTime = null): self
    {
        $this->startDateTime = $startDateTime;
        return $this;
    }

    /**
     * Gets as endDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * Sets a new endDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime
     */
    public function setEndDateTime(?\horstoeko\zugferd\entities\extended\udt\DateTimeType $endDateTime = null): self
    {
        $this->endDateTime = $endDateTime;
        return $this;
    }

    /**
     * Gets as completeDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getCompleteDateTime()
    {
        return $this->completeDateTime;
    }

    /**
     * Sets a new completeDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime
     */
    public function setCompleteDateTime(?\horstoeko\zugferd\entities\extended\udt\DateTimeType $completeDateTime = null): self
    {
        $this->completeDateTime = $completeDateTime;
        return $this;
    }
}
