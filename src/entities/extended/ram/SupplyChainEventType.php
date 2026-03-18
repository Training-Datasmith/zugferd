<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing SupplyChainEventType
 *
 * XSD Type: SupplyChainEventType
 */
class SupplyChainEventType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $occurrenceDateTime
     */
    private $occurrenceDateTime;

    /**
     * Gets as occurrenceDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getOccurrenceDateTime()
    {
        return $this->occurrenceDateTime;
    }

    /**
     * Sets a new occurrenceDateTime
     */
    public function setOccurrenceDateTime(\horstoeko\zugferd\entities\extended\udt\DateTimeType $occurrenceDateTime): self
    {
        $this->occurrenceDateTime = $occurrenceDateTime;
        return $this;
    }
}
