<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing AdvancePaymentType
 *
 * XSD Type: AdvancePaymentType
 */
class Advance_Payment_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $paidAmount
     */
    private $paid_amount;
    /**
     * @var \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedReceivedDateTime
     */
    private $formatted_received_date_time;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $includedTradeTax
     */
    private $included_trade_tax = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceSpecifiedReferencedDocument
     */
    private $invoice_specified_referenced_document;
    /**
     * Gets as paidAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function get_paid_amount()
    {
        return $this->paid_amount;
    }
    /**
     * Sets a new paidAmount
     */
    public function set_paid_amount(\horstoeko\zugferd\entities\extended\udt\Amount_Type $paid_amount): self
    {
        $this->paid_amount = $paid_amount;
        return $this;
    }
    /**
     * Gets as formattedReceivedDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType
     */
    public function get_formatted_received_date_time()
    {
        return $this->formatted_received_date_time;
    }
    /**
     * Sets a new formattedReceivedDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedReceivedDateTime
     */
    public function set_formatted_received_date_time(?\horstoeko\zugferd\entities\extended\qdt\Formatted_Date_Time_Type $formatted_received_date_time = null): self
    {
        $this->formatted_received_date_time = $formatted_received_date_time;
        return $this;
    }
    /**
     * Adds as includedTradeTax
     */
    public function add_to_included_trade_tax(\horstoeko\zugferd\entities\extended\ram\Trade_Tax_Type $included_trade_tax): self
    {
        $this->included_trade_tax[] = $included_trade_tax;
        return $this;
    }
    /**
     * isset includedTradeTax
     *
     * @param  int|string $index
     */
    public function isset_included_trade_tax($index): bool
    {
        return isset($this->included_trade_tax[$index]);
    }
    /**
     * unset includedTradeTax
     *
     * @param  int|string $index
     */
    public function unset_included_trade_tax($index): void
    {
        unset($this->included_trade_tax[$index]);
    }
    /**
     * Gets as includedTradeTax
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function get_included_trade_tax()
    {
        return $this->included_trade_tax;
    }
    /**
     * Sets a new includedTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $includedTradeTax
     */
    public function set_included_trade_tax(array $included_trade_tax): self
    {
        $this->included_trade_tax = $included_trade_tax;
        return $this;
    }
    /**
     * Gets as invoiceSpecifiedReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_invoice_specified_referenced_document()
    {
        return $this->invoice_specified_referenced_document;
    }
    /**
     * Sets a new invoiceSpecifiedReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceSpecifiedReferencedDocument
     */
    public function set_invoice_specified_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $invoice_specified_referenced_document = null): self
    {
        $this->invoice_specified_referenced_document = $invoice_specified_referenced_document;
        return $this;
    }
}