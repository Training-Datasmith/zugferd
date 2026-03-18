<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

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
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $dueDateDateTime
     */
    private $dueDateDateTime;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $directDebitMandateID
     */
    private $directDebitMandateID;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $partialPaymentAmount
     */
    private $partialPaymentAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType $applicableTradePaymentPenaltyTerms
     */
    private $applicableTradePaymentPenaltyTerms;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType $applicableTradePaymentDiscountTerms
     */
    private $applicableTradePaymentDiscountTerms;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     */
    private $payeeTradeParty;

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
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function getDueDateDateTime()
    {
        return $this->dueDateDateTime;
    }

    /**
     * Sets a new dueDateDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $dueDateDateTime
     */
    public function setDueDateDateTime(?\horstoeko\zugferd\entities\extended\udt\DateTimeType $dueDateDateTime = null): self
    {
        $this->dueDateDateTime = $dueDateDateTime;
        return $this;
    }

    /**
     * Gets as directDebitMandateID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getDirectDebitMandateID()
    {
        return $this->directDebitMandateID;
    }

    /**
     * Sets a new directDebitMandateID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $directDebitMandateID
     */
    public function setDirectDebitMandateID(?\horstoeko\zugferd\entities\extended\udt\IDType $directDebitMandateID = null): self
    {
        $this->directDebitMandateID = $directDebitMandateID;
        return $this;
    }

    /**
     * Gets as partialPaymentAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getPartialPaymentAmount()
    {
        return $this->partialPaymentAmount;
    }

    /**
     * Sets a new partialPaymentAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $partialPaymentAmount
     */
    public function setPartialPaymentAmount(?\horstoeko\zugferd\entities\extended\udt\AmountType $partialPaymentAmount = null): self
    {
        $this->partialPaymentAmount = $partialPaymentAmount;
        return $this;
    }

    /**
     * Gets as applicableTradePaymentPenaltyTerms
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType
     */
    public function getApplicableTradePaymentPenaltyTerms()
    {
        return $this->applicableTradePaymentPenaltyTerms;
    }

    /**
     * Sets a new applicableTradePaymentPenaltyTerms
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType $applicableTradePaymentPenaltyTerms
     */
    public function setApplicableTradePaymentPenaltyTerms(?\horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType $applicableTradePaymentPenaltyTerms = null): self
    {
        $this->applicableTradePaymentPenaltyTerms = $applicableTradePaymentPenaltyTerms;
        return $this;
    }

    /**
     * Gets as applicableTradePaymentDiscountTerms
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType
     */
    public function getApplicableTradePaymentDiscountTerms()
    {
        return $this->applicableTradePaymentDiscountTerms;
    }

    /**
     * Sets a new applicableTradePaymentDiscountTerms
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType $applicableTradePaymentDiscountTerms
     */
    public function setApplicableTradePaymentDiscountTerms(?\horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType $applicableTradePaymentDiscountTerms = null): self
    {
        $this->applicableTradePaymentDiscountTerms = $applicableTradePaymentDiscountTerms;
        return $this;
    }

    /**
     * Gets as payeeTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getPayeeTradeParty()
    {
        return $this->payeeTradeParty;
    }

    /**
     * Sets a new payeeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     */
    public function setPayeeTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty = null): self
    {
        $this->payeeTradeParty = $payeeTradeParty;
        return $this;
    }
}
