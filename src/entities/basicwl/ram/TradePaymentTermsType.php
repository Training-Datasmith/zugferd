<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basicwl\ram;

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
     * @var \horstoeko\zugferd\entities\basicwl\udt\DateTimeType $dueDateDateTime
     */
    private $dueDateDateTime;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\udt\IDType $directDebitMandateID
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
     * @return \horstoeko\zugferd\entities\basicwl\udt\DateTimeType
     */
    public function getDueDateDateTime()
    {
        return $this->dueDateDateTime;
    }

    /**
     * Sets a new dueDateDateTime
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\DateTimeType $dueDateDateTime
     */
    public function setDueDateDateTime(?\horstoeko\zugferd\entities\basicwl\udt\DateTimeType $dueDateDateTime = null): self
    {
        $this->dueDateDateTime = $dueDateDateTime;
        return $this;
    }

    /**
     * Gets as directDebitMandateID
     *
     * @return \horstoeko\zugferd\entities\basicwl\udt\IDType
     */
    public function getDirectDebitMandateID()
    {
        return $this->directDebitMandateID;
    }

    /**
     * Sets a new directDebitMandateID
     *
     * @param  \horstoeko\zugferd\entities\basicwl\udt\IDType $directDebitMandateID
     */
    public function setDirectDebitMandateID(?\horstoeko\zugferd\entities\basicwl\udt\IDType $directDebitMandateID = null): self
    {
        $this->directDebitMandateID = $directDebitMandateID;
        return $this;
    }
}
