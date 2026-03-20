<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing HeaderTradeSettlementType
 *
 * XSD Type: HeaderTradeSettlementType
 */
class Header_Trade_Settlement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $creditorReferenceID
     */
    private $creditor_reference_id;
    /**
     * @var string $paymentReference
     */
    private $payment_reference;
    /**
     * @var string $taxCurrencyCode
     */
    private $tax_currency_code;
    /**
     * @var string $invoiceCurrencyCode
     */
    private $invoice_currency_code;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $payeeTradeParty
     */
    private $payee_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    private $specified_trade_settlement_payment_means = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeTaxType[] $applicableTradeTax
     */
    private $applicable_trade_tax = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billing_specified_period;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specified_trade_allowance_charge = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType $specifiedTradePaymentTerms
     */
    private $specified_trade_payment_terms;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     */
    private $specified_trade_settlement_header_monetary_summation;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    private $invoice_referenced_document = [];
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    private $receivable_specified_trade_accounting_account;
    /**
     * Gets as creditorReferenceID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_creditor_reference_id()
    {
        return $this->creditor_reference_id;
    }
    /**
     * Sets a new creditorReferenceID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $creditorReferenceID
     */
    public function set_creditor_reference_id(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $creditor_reference_id = null): self
    {
        $this->creditor_reference_id = $creditor_reference_id;
        return $this;
    }
    /**
     * Gets as paymentReference
     *
     * @return string
     */
    public function get_payment_reference()
    {
        return $this->payment_reference;
    }
    /**
     * Sets a new paymentReference
     *
     * @param  string $paymentReference
     */
    public function set_payment_reference($payment_reference): self
    {
        $this->payment_reference = $payment_reference;
        return $this;
    }
    /**
     * Gets as taxCurrencyCode
     *
     * @return string
     */
    public function get_tax_currency_code()
    {
        return $this->tax_currency_code;
    }
    /**
     * Sets a new taxCurrencyCode
     *
     * @param  string $taxCurrencyCode
     */
    public function set_tax_currency_code($tax_currency_code): self
    {
        $this->tax_currency_code = $tax_currency_code;
        return $this;
    }
    /**
     * Gets as invoiceCurrencyCode
     *
     * @return string
     */
    public function get_invoice_currency_code()
    {
        return $this->invoice_currency_code;
    }
    /**
     * Sets a new invoiceCurrencyCode
     *
     * @param  string $invoiceCurrencyCode
     */
    public function set_invoice_currency_code($invoice_currency_code): self
    {
        $this->invoice_currency_code = $invoice_currency_code;
        return $this;
    }
    /**
     * Gets as payeeTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function get_payee_trade_party()
    {
        return $this->payee_trade_party;
    }
    /**
     * Sets a new payeeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePartyType $payeeTradeParty
     */
    public function set_payee_trade_party(?\horstoeko\zugferd\entities\en16931\ram\Trade_Party_Type $payee_trade_party = null): self
    {
        $this->payee_trade_party = $payee_trade_party;
        return $this;
    }
    /**
     * Adds as specifiedTradeSettlementPaymentMeans
     */
    public function add_to_specified_trade_settlement_payment_means(\horstoeko\zugferd\entities\en16931\ram\Trade_Settlement_Payment_Means_Type $specified_trade_settlement_payment_means): self
    {
        $this->specified_trade_settlement_payment_means[] = $specified_trade_settlement_payment_means;
        return $this;
    }
    /**
     * isset specifiedTradeSettlementPaymentMeans
     *
     * @param  int|string $index
     */
    public function isset_specified_trade_settlement_payment_means($index): bool
    {
        return isset($this->specified_trade_settlement_payment_means[$index]);
    }
    /**
     * unset specifiedTradeSettlementPaymentMeans
     *
     * @param  int|string $index
     */
    public function unset_specified_trade_settlement_payment_means($index): void
    {
        unset($this->specified_trade_settlement_payment_means[$index]);
    }
    /**
     * Gets as specifiedTradeSettlementPaymentMeans
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType[]
     */
    public function get_specified_trade_settlement_payment_means()
    {
        return $this->specified_trade_settlement_payment_means;
    }
    /**
     * Sets a new specifiedTradeSettlementPaymentMeans
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    public function set_specified_trade_settlement_payment_means(?array $specified_trade_settlement_payment_means = null): self
    {
        $this->specified_trade_settlement_payment_means = $specified_trade_settlement_payment_means;
        return $this;
    }
    /**
     * Adds as applicableTradeTax
     */
    public function add_to_applicable_trade_tax(\horstoeko\zugferd\entities\en16931\ram\Trade_Tax_Type $applicable_trade_tax): self
    {
        $this->applicable_trade_tax[] = $applicable_trade_tax;
        return $this;
    }
    /**
     * isset applicableTradeTax
     *
     * @param  int|string $index
     */
    public function isset_applicable_trade_tax($index): bool
    {
        return isset($this->applicable_trade_tax[$index]);
    }
    /**
     * unset applicableTradeTax
     *
     * @param  int|string $index
     */
    public function unset_applicable_trade_tax($index): void
    {
        unset($this->applicable_trade_tax[$index]);
    }
    /**
     * Gets as applicableTradeTax
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeTaxType[]
     */
    public function get_applicable_trade_tax()
    {
        return $this->applicable_trade_tax;
    }
    /**
     * Sets a new applicableTradeTax
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeTaxType[] $applicableTradeTax
     */
    public function set_applicable_trade_tax(array $applicable_trade_tax): self
    {
        $this->applicable_trade_tax = $applicable_trade_tax;
        return $this;
    }
    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType
     */
    public function get_billing_specified_period()
    {
        return $this->billing_specified_period;
    }
    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    public function set_billing_specified_period(?\horstoeko\zugferd\entities\en16931\ram\Specified_Period_Type $billing_specified_period = null): self
    {
        $this->billing_specified_period = $billing_specified_period;
        return $this;
    }
    /**
     * Adds as specifiedTradeAllowanceCharge
     */
    public function add_to_specified_trade_allowance_charge(\horstoeko\zugferd\entities\en16931\ram\Trade_Allowance_Charge_Type $specified_trade_allowance_charge): self
    {
        $this->specified_trade_allowance_charge[] = $specified_trade_allowance_charge;
        return $this;
    }
    /**
     * isset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function isset_specified_trade_allowance_charge($index): bool
    {
        return isset($this->specified_trade_allowance_charge[$index]);
    }
    /**
     * unset specifiedTradeAllowanceCharge
     *
     * @param  int|string $index
     */
    public function unset_specified_trade_allowance_charge($index): void
    {
        unset($this->specified_trade_allowance_charge[$index]);
    }
    /**
     * Gets as specifiedTradeAllowanceCharge
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[]
     */
    public function get_specified_trade_allowance_charge()
    {
        return $this->specified_trade_allowance_charge;
    }
    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    public function set_specified_trade_allowance_charge(?array $specified_trade_allowance_charge = null): self
    {
        $this->specified_trade_allowance_charge = $specified_trade_allowance_charge;
        return $this;
    }
    /**
     * Gets as specifiedTradePaymentTerms
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType
     */
    public function get_specified_trade_payment_terms()
    {
        return $this->specified_trade_payment_terms;
    }
    /**
     * Sets a new specifiedTradePaymentTerms
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePaymentTermsType $specifiedTradePaymentTerms
     */
    public function set_specified_trade_payment_terms(?\horstoeko\zugferd\entities\en16931\ram\Trade_Payment_Terms_Type $specified_trade_payment_terms = null): self
    {
        $this->specified_trade_payment_terms = $specified_trade_payment_terms;
        return $this;
    }
    /**
     * Gets as specifiedTradeSettlementHeaderMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeSettlementHeaderMonetarySummationType
     */
    public function get_specified_trade_settlement_header_monetary_summation()
    {
        return $this->specified_trade_settlement_header_monetary_summation;
    }
    /**
     * Sets a new specifiedTradeSettlementHeaderMonetarySummation
     */
    public function set_specified_trade_settlement_header_monetary_summation(\horstoeko\zugferd\entities\en16931\ram\Trade_Settlement_Header_Monetary_Summation_Type $specified_trade_settlement_header_monetary_summation): self
    {
        $this->specified_trade_settlement_header_monetary_summation = $specified_trade_settlement_header_monetary_summation;
        return $this;
    }
    /**
     * Adds as invoiceReferencedDocument
     */
    public function add_to_invoice_referenced_document(\horstoeko\zugferd\entities\en16931\ram\Referenced_Document_Type $invoice_referenced_document): self
    {
        $this->invoice_referenced_document[] = $invoice_referenced_document;
        return $this;
    }
    /**
     * isset invoiceReferencedDocument
     *
     * @param  int|string $index
     */
    public function isset_invoice_referenced_document($index): bool
    {
        return isset($this->invoice_referenced_document[$index]);
    }
    /**
     * unset invoiceReferencedDocument
     *
     * @param  int|string $index
     */
    public function unset_invoice_referenced_document($index): void
    {
        unset($this->invoice_referenced_document[$index]);
    }
    /**
     * Gets as invoiceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[]
     */
    public function get_invoice_referenced_document()
    {
        return $this->invoice_referenced_document;
    }
    /**
     * Sets a new invoiceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    public function set_invoice_referenced_document(?array $invoice_referenced_document = null): self
    {
        $this->invoice_referenced_document = $invoice_referenced_document;
        return $this;
    }
    /**
     * Gets as receivableSpecifiedTradeAccountingAccount
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType
     */
    public function get_receivable_specified_trade_accounting_account()
    {
        return $this->receivable_specified_trade_accounting_account;
    }
    /**
     * Sets a new receivableSpecifiedTradeAccountingAccount
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradeAccountingAccountType $receivableSpecifiedTradeAccountingAccount
     */
    public function set_receivable_specified_trade_accounting_account(?\horstoeko\zugferd\entities\en16931\ram\Trade_Accounting_Account_Type $receivable_specified_trade_accounting_account = null): self
    {
        $this->receivable_specified_trade_accounting_account = $receivable_specified_trade_accounting_account;
        return $this;
    }
}