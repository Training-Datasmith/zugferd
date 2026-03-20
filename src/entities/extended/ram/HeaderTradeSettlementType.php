<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing HeaderTradeSettlementType
 *
 * XSD Type: HeaderTradeSettlementType
 */
class Header_Trade_Settlement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $creditorReferenceID
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
     * @var string $invoiceIssuerReference
     */
    private $invoice_issuer_reference;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $invoicerTradeParty
     */
    private $invoicer_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $invoiceeTradeParty
     */
    private $invoicee_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $payeeTradeParty
     */
    private $payee_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $payerTradeParty
     */
    private $payer_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType $taxApplicableTradeCurrencyExchange
     */
    private $tax_applicable_trade_currency_exchange;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    private $specified_trade_settlement_payment_means = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $applicableTradeTax
     */
    private $applicable_trade_tax = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    private $billing_specified_period;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    private $specified_trade_allowance_charge = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType[] $specifiedLogisticsServiceCharge
     */
    private $specified_logistics_service_charge = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType[] $specifiedTradePaymentTerms
     */
    private $specified_trade_payment_terms = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeSettlementHeaderMonetarySummationType $specifiedTradeSettlementHeaderMonetarySummation
     */
    private $specified_trade_settlement_header_monetary_summation;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    private $invoice_referenced_document = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType[] $receivableSpecifiedTradeAccountingAccount
     */
    private $receivable_specified_trade_accounting_account = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\AdvancePaymentType[] $specifiedAdvancePayment
     */
    private $specified_advance_payment = [];
    /**
     * Gets as creditorReferenceID
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function get_creditor_reference_id()
    {
        return $this->creditor_reference_id;
    }
    /**
     * Sets a new creditorReferenceID
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\IDType $creditorReferenceID
     */
    public function set_creditor_reference_id(?\horstoeko\zugferd\entities\extended\udt\Id_Type $creditor_reference_id = null): self
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
     * Gets as invoiceIssuerReference
     *
     * @return string
     */
    public function get_invoice_issuer_reference()
    {
        return $this->invoice_issuer_reference;
    }
    /**
     * Sets a new invoiceIssuerReference
     *
     * @param  string $invoiceIssuerReference
     */
    public function set_invoice_issuer_reference($invoice_issuer_reference): self
    {
        $this->invoice_issuer_reference = $invoice_issuer_reference;
        return $this;
    }
    /**
     * Gets as invoicerTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function get_invoicer_trade_party()
    {
        return $this->invoicer_trade_party;
    }
    /**
     * Sets a new invoicerTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $invoicerTradeParty
     */
    public function set_invoicer_trade_party(?\horstoeko\zugferd\entities\extended\ram\Trade_Party_Type $invoicer_trade_party = null): self
    {
        $this->invoicer_trade_party = $invoicer_trade_party;
        return $this;
    }
    /**
     * Gets as invoiceeTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function get_invoicee_trade_party()
    {
        return $this->invoicee_trade_party;
    }
    /**
     * Sets a new invoiceeTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $invoiceeTradeParty
     */
    public function set_invoicee_trade_party(?\horstoeko\zugferd\entities\extended\ram\Trade_Party_Type $invoicee_trade_party = null): self
    {
        $this->invoicee_trade_party = $invoicee_trade_party;
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
    /**
     * Gets as payerTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function get_payer_trade_party()
    {
        return $this->payer_trade_party;
    }
    /**
     * Sets a new payerTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $payerTradeParty
     */
    public function set_payer_trade_party(?\horstoeko\zugferd\entities\extended\ram\Trade_Party_Type $payer_trade_party = null): self
    {
        $this->payer_trade_party = $payer_trade_party;
        return $this;
    }
    /**
     * Gets as taxApplicableTradeCurrencyExchange
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType
     */
    public function get_tax_applicable_trade_currency_exchange()
    {
        return $this->tax_applicable_trade_currency_exchange;
    }
    /**
     * Sets a new taxApplicableTradeCurrencyExchange
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeCurrencyExchangeType $taxApplicableTradeCurrencyExchange
     */
    public function set_tax_applicable_trade_currency_exchange(?\horstoeko\zugferd\entities\extended\ram\Trade_Currency_Exchange_Type $tax_applicable_trade_currency_exchange = null): self
    {
        $this->tax_applicable_trade_currency_exchange = $tax_applicable_trade_currency_exchange;
        return $this;
    }
    /**
     * Adds as specifiedTradeSettlementPaymentMeans
     */
    public function add_to_specified_trade_settlement_payment_means(\horstoeko\zugferd\entities\extended\ram\Trade_Settlement_Payment_Means_Type $specified_trade_settlement_payment_means): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType[]
     */
    public function get_specified_trade_settlement_payment_means()
    {
        return $this->specified_trade_settlement_payment_means;
    }
    /**
     * Sets a new specifiedTradeSettlementPaymentMeans
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeSettlementPaymentMeansType[] $specifiedTradeSettlementPaymentMeans
     */
    public function set_specified_trade_settlement_payment_means(?array $specified_trade_settlement_payment_means = null): self
    {
        $this->specified_trade_settlement_payment_means = $specified_trade_settlement_payment_means;
        return $this;
    }
    /**
     * Adds as applicableTradeTax
     */
    public function add_to_applicable_trade_tax(\horstoeko\zugferd\entities\extended\ram\Trade_Tax_Type $applicable_trade_tax): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function get_applicable_trade_tax()
    {
        return $this->applicable_trade_tax;
    }
    /**
     * Sets a new applicableTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $applicableTradeTax
     */
    public function set_applicable_trade_tax(array $applicable_trade_tax): self
    {
        $this->applicable_trade_tax = $applicable_trade_tax;
        return $this;
    }
    /**
     * Gets as billingSpecifiedPeriod
     *
     * @return \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType
     */
    public function get_billing_specified_period()
    {
        return $this->billing_specified_period;
    }
    /**
     * Sets a new billingSpecifiedPeriod
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\SpecifiedPeriodType $billingSpecifiedPeriod
     */
    public function set_billing_specified_period(?\horstoeko\zugferd\entities\extended\ram\Specified_Period_Type $billing_specified_period = null): self
    {
        $this->billing_specified_period = $billing_specified_period;
        return $this;
    }
    /**
     * Adds as specifiedTradeAllowanceCharge
     */
    public function add_to_specified_trade_allowance_charge(\horstoeko\zugferd\entities\extended\ram\Trade_Allowance_Charge_Type $specified_trade_allowance_charge): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[]
     */
    public function get_specified_trade_allowance_charge()
    {
        return $this->specified_trade_allowance_charge;
    }
    /**
     * Sets a new specifiedTradeAllowanceCharge
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAllowanceChargeType[] $specifiedTradeAllowanceCharge
     */
    public function set_specified_trade_allowance_charge(?array $specified_trade_allowance_charge = null): self
    {
        $this->specified_trade_allowance_charge = $specified_trade_allowance_charge;
        return $this;
    }
    /**
     * Adds as specifiedLogisticsServiceCharge
     */
    public function add_to_specified_logistics_service_charge(\horstoeko\zugferd\entities\extended\ram\Logistics_Service_Charge_Type $specified_logistics_service_charge): self
    {
        $this->specified_logistics_service_charge[] = $specified_logistics_service_charge;
        return $this;
    }
    /**
     * isset specifiedLogisticsServiceCharge
     *
     * @param  int|string $index
     */
    public function isset_specified_logistics_service_charge($index): bool
    {
        return isset($this->specified_logistics_service_charge[$index]);
    }
    /**
     * unset specifiedLogisticsServiceCharge
     *
     * @param  int|string $index
     */
    public function unset_specified_logistics_service_charge($index): void
    {
        unset($this->specified_logistics_service_charge[$index]);
    }
    /**
     * Gets as specifiedLogisticsServiceCharge
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType[]
     */
    public function get_specified_logistics_service_charge()
    {
        return $this->specified_logistics_service_charge;
    }
    /**
     * Sets a new specifiedLogisticsServiceCharge
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\LogisticsServiceChargeType[] $specifiedLogisticsServiceCharge
     */
    public function set_specified_logistics_service_charge(?array $specified_logistics_service_charge = null): self
    {
        $this->specified_logistics_service_charge = $specified_logistics_service_charge;
        return $this;
    }
    /**
     * Adds as specifiedTradePaymentTerms
     */
    public function add_to_specified_trade_payment_terms(\horstoeko\zugferd\entities\extended\ram\Trade_Payment_Terms_Type $specified_trade_payment_terms): self
    {
        $this->specified_trade_payment_terms[] = $specified_trade_payment_terms;
        return $this;
    }
    /**
     * isset specifiedTradePaymentTerms
     *
     * @param  int|string $index
     */
    public function isset_specified_trade_payment_terms($index): bool
    {
        return isset($this->specified_trade_payment_terms[$index]);
    }
    /**
     * unset specifiedTradePaymentTerms
     *
     * @param  int|string $index
     */
    public function unset_specified_trade_payment_terms($index): void
    {
        unset($this->specified_trade_payment_terms[$index]);
    }
    /**
     * Gets as specifiedTradePaymentTerms
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType[]
     */
    public function get_specified_trade_payment_terms()
    {
        return $this->specified_trade_payment_terms;
    }
    /**
     * Sets a new specifiedTradePaymentTerms
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePaymentTermsType[] $specifiedTradePaymentTerms
     */
    public function set_specified_trade_payment_terms(?array $specified_trade_payment_terms = null): self
    {
        $this->specified_trade_payment_terms = $specified_trade_payment_terms;
        return $this;
    }
    /**
     * Gets as specifiedTradeSettlementHeaderMonetarySummation
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeSettlementHeaderMonetarySummationType
     */
    public function get_specified_trade_settlement_header_monetary_summation()
    {
        return $this->specified_trade_settlement_header_monetary_summation;
    }
    /**
     * Sets a new specifiedTradeSettlementHeaderMonetarySummation
     */
    public function set_specified_trade_settlement_header_monetary_summation(\horstoeko\zugferd\entities\extended\ram\Trade_Settlement_Header_Monetary_Summation_Type $specified_trade_settlement_header_monetary_summation): self
    {
        $this->specified_trade_settlement_header_monetary_summation = $specified_trade_settlement_header_monetary_summation;
        return $this;
    }
    /**
     * Adds as invoiceReferencedDocument
     */
    public function add_to_invoice_referenced_document(\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $invoice_referenced_document): self
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
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function get_invoice_referenced_document()
    {
        return $this->invoice_referenced_document;
    }
    /**
     * Sets a new invoiceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $invoiceReferencedDocument
     */
    public function set_invoice_referenced_document(?array $invoice_referenced_document = null): self
    {
        $this->invoice_referenced_document = $invoice_referenced_document;
        return $this;
    }
    /**
     * Adds as receivableSpecifiedTradeAccountingAccount
     */
    public function add_to_receivable_specified_trade_accounting_account(\horstoeko\zugferd\entities\extended\ram\Trade_Accounting_Account_Type $receivable_specified_trade_accounting_account): self
    {
        $this->receivable_specified_trade_accounting_account[] = $receivable_specified_trade_accounting_account;
        return $this;
    }
    /**
     * isset receivableSpecifiedTradeAccountingAccount
     *
     * @param  int|string $index
     */
    public function isset_receivable_specified_trade_accounting_account($index): bool
    {
        return isset($this->receivable_specified_trade_accounting_account[$index]);
    }
    /**
     * unset receivableSpecifiedTradeAccountingAccount
     *
     * @param  int|string $index
     */
    public function unset_receivable_specified_trade_accounting_account($index): void
    {
        unset($this->receivable_specified_trade_accounting_account[$index]);
    }
    /**
     * Gets as receivableSpecifiedTradeAccountingAccount
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType[]
     */
    public function get_receivable_specified_trade_accounting_account()
    {
        return $this->receivable_specified_trade_accounting_account;
    }
    /**
     * Sets a new receivableSpecifiedTradeAccountingAccount
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeAccountingAccountType[] $receivableSpecifiedTradeAccountingAccount
     */
    public function set_receivable_specified_trade_accounting_account(?array $receivable_specified_trade_accounting_account = null): self
    {
        $this->receivable_specified_trade_accounting_account = $receivable_specified_trade_accounting_account;
        return $this;
    }
    /**
     * Adds as specifiedAdvancePayment
     */
    public function add_to_specified_advance_payment(\horstoeko\zugferd\entities\extended\ram\Advance_Payment_Type $specified_advance_payment): self
    {
        $this->specified_advance_payment[] = $specified_advance_payment;
        return $this;
    }
    /**
     * isset specifiedAdvancePayment
     *
     * @param  int|string $index
     */
    public function isset_specified_advance_payment($index): bool
    {
        return isset($this->specified_advance_payment[$index]);
    }
    /**
     * unset specifiedAdvancePayment
     *
     * @param  int|string $index
     */
    public function unset_specified_advance_payment($index): void
    {
        unset($this->specified_advance_payment[$index]);
    }
    /**
     * Gets as specifiedAdvancePayment
     *
     * @return \horstoeko\zugferd\entities\extended\ram\AdvancePaymentType[]
     */
    public function get_specified_advance_payment()
    {
        return $this->specified_advance_payment;
    }
    /**
     * Sets a new specifiedAdvancePayment
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\AdvancePaymentType[] $specifiedAdvancePayment
     */
    public function set_specified_advance_payment(?array $specified_advance_payment = null): self
    {
        $this->specified_advance_payment = $specified_advance_payment;
        return $this;
    }
}