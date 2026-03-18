<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing SupplyChainEventType
 *
 * XSD Type: SupplyChainEventType
 */
class SupplyChainEventType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\DateTimeType $occurrenceDateTime
     */
    private $occurrenceDateTime;

    /**
     * Gets as occurrenceDateTime
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\DateTimeType
     */
    public function getOccurrenceDateTime()
    {
        return $this->occurrenceDateTime;
    }

    /**
     * Sets a new occurrenceDateTime
     */
    public function setOccurrenceDateTime(\horstoeko\zugferd\entities\en16931\udt\DateTimeType $occurrenceDateTime): self
    {
        $this->occurrenceDateTime = $occurrenceDateTime;
        return $this;
    }
}
