<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradePaymentTermsType
 *
 * XSD Type: TradePaymentTermsType
 */
class TradePaymentTermsType
{

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\DateTimeType $dueDateDateTime
     */
    private $dueDateDateTime;

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $directDebitMandateID
     */
    private $directDebitMandateID;

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
     * Gets as dueDateDateTime
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\DateTimeType
     */
    public function getDueDateDateTime()
    {
        return $this->dueDateDateTime;
    }

    /**
     * Sets a new dueDateDateTime
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\DateTimeType $dueDateDateTime
     */
    public function setDueDateDateTime(?\horstoeko\zugferd\entities\en16931\udt\DateTimeType $dueDateDateTime = null): self
    {
        $this->dueDateDateTime = $dueDateDateTime;
        return $this;
    }

    /**
     * Gets as directDebitMandateID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getDirectDebitMandateID()
    {
        return $this->directDebitMandateID;
    }

    /**
     * Sets a new directDebitMandateID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $directDebitMandateID
     */
    public function setDirectDebitMandateID(?\horstoeko\zugferd\entities\en16931\udt\IDType $directDebitMandateID = null): self
    {
        $this->directDebitMandateID = $directDebitMandateID;
        return $this;
    }
}
