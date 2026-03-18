<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SupplyChainEventType
 *
 * XSD Type: SupplyChainEventType
 */
class SupplyChainEventType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $occurrenceDateTime
     */
    private $occurrenceDateTime;

    /**
     * Gets as occurrenceDateTime
     *
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function getOccurrenceDateTime()
    {
        return $this->occurrenceDateTime;
    }

    /**
     * Sets a new occurrenceDateTime
     */
    public function setOccurrenceDateTime(\horstoeko\zugferd\entities\basic\udt\DateTimeType $occurrenceDateTime): self
    {
        $this->occurrenceDateTime = $occurrenceDateTime;
        return $this;
    }
}
