<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

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
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $dueDateDateTime
     */
    private $dueDateDateTime;

    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $directDebitMandateID
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
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function getDueDateDateTime()
    {
        return $this->dueDateDateTime;
    }

    /**
     * Sets a new dueDateDateTime
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\DateTimeType $dueDateDateTime
     */
    public function setDueDateDateTime(?\horstoeko\zugferd\entities\basic\udt\DateTimeType $dueDateDateTime = null): self
    {
        $this->dueDateDateTime = $dueDateDateTime;
        return $this;
    }

    /**
     * Gets as directDebitMandateID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getDirectDebitMandateID()
    {
        return $this->directDebitMandateID;
    }

    /**
     * Sets a new directDebitMandateID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $directDebitMandateID
     */
    public function setDirectDebitMandateID(?\horstoeko\zugferd\entities\basic\udt\IDType $directDebitMandateID = null): self
    {
        $this->directDebitMandateID = $directDebitMandateID;
        return $this;
    }
}
