<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradePaymentTermsType
 *
 * XSD Type: TradePaymentTermsType
 */
class Trade_Payment_Terms_Type
{
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\DateTimeType $dueDateDateTime
     */
    private $due_date_date_time;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $directDebitMandateID
     */
    private $direct_debit_mandate_id;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $partialPaymentAmount
     */
    private $partial_payment_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType $applicableTradePaymentPenaltyTerms
     */
    private $applicable_trade_payment_penalty_terms;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType $applicableTradePaymentDiscountTerms
     */
    private $applicable_trade_payment_discount_terms;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     */
    private $payee_trade_party;
    /**
     * Gets as description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function set_description($description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets as dueDateDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\udt\DateTimeType
     */
    public function get_due_date_date_time()
    {
        return $this->due_date_date_time;
    }
    /**
     * Sets a new dueDateDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\DateTimeType $dueDateDateTime
     */
    public function set_due_date_date_time(?\horstoeko\zugferd\entities\extended\udt\Date_Time_Type $due_date_date_time = null): self
    {
        $this->due_date_date_time = $due_date_date_time;
        return $this;
    }
    /**
     * Gets as directDebitMandateID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_direct_debit_mandate_id()
    {
        return $this->direct_debit_mandate_id;
    }
    /**
     * Sets a new directDebitMandateID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $directDebitMandateID
     */
    public function set_direct_debit_mandate_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $direct_debit_mandate_id = null): self
    {
        $this->direct_debit_mandate_id = $direct_debit_mandate_id;
        return $this;
    }
    /**
     * Gets as partialPaymentAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_partial_payment_amount()
    {
        return $this->partial_payment_amount;
    }
    /**
     * Sets a new partialPaymentAmount
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\AmountType $partialPaymentAmount
     */
    public function set_partial_payment_amount(?\horstoeko\zugferd\entities\extended\udt\Amount_Type $partial_payment_amount = null): self
    {
        $this->partial_payment_amount = $partial_payment_amount;
        return $this;
    }
    /**
     * Gets as applicableTradePaymentPenaltyTerms
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType
     */
    public function get_applicable_trade_payment_penalty_terms()
    {
        return $this->applicable_trade_payment_penalty_terms;
    }
    /**
     * Sets a new applicableTradePaymentPenaltyTerms
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePaymentPenaltyTermsType $applicableTradePaymentPenaltyTerms
     */
    public function set_applicable_trade_payment_penalty_terms(?\horstoeko\zugferd\entities\extended\ram\Trade_Payment_Penalty_Terms_Type $applicable_trade_payment_penalty_terms = null): self
    {
        $this->applicable_trade_payment_penalty_terms = $applicable_trade_payment_penalty_terms;
        return $this;
    }
    /**
     * Gets as applicableTradePaymentDiscountTerms
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType
     */
    public function get_applicable_trade_payment_discount_terms()
    {
        return $this->applicable_trade_payment_discount_terms;
    }
    /**
     * Sets a new applicableTradePaymentDiscountTerms
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePaymentDiscountTermsType $applicableTradePaymentDiscountTerms
     */
    public function set_applicable_trade_payment_discount_terms(?\horstoeko\zugferd\entities\extended\ram\Trade_Payment_Discount_Terms_Type $applicable_trade_payment_discount_terms = null): self
    {
        $this->applicable_trade_payment_discount_terms = $applicable_trade_payment_discount_terms;
        return $this;
    }
    /**
     * Gets as payeeTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function get_payee_trade_party()
    {
        return $this->payee_trade_party;
    }
    /**
     * Sets a new payeeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     */
    public function set_payee_trade_party(?\horstoeko\zugferd\entities\extended\ram\Trade_Party_Type $payee_trade_party = null): self
    {
        $this->payee_trade_party = $payee_trade_party;
        return $this;
    }
}