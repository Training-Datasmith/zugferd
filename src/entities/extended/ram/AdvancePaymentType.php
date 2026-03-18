<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing AdvancePaymentType
 *
 * XSD Type: AdvancePaymentType
 */
class AdvancePaymentType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\AmountType $paidAmount
     */
    private $paidAmount;

    /**
     * @var \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedReceivedDateTime
     */
    private $formattedReceivedDateTime;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $includedTradeTax
     */
    private $includedTradeTax = [
        
    ];

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceSpecifiedReferencedDocument
     */
    private $invoiceSpecifiedReferencedDocument;

    /**
     * Gets as paidAmount
     *
     * @return \horstoeko\zugferd\entities\extended\udt\AmountType
     */
    public function getPaidAmount()
    {
        return $this->paidAmount;
    }

    /**
     * Sets a new paidAmount
     */
    public function setPaidAmount(\horstoeko\zugferd\entities\extended\udt\AmountType $paidAmount): self
    {
        $this->paidAmount = $paidAmount;
        return $this;
    }

    /**
     * Gets as formattedReceivedDateTime
     *
     * @return \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType
     */
    public function getFormattedReceivedDateTime()
    {
        return $this->formattedReceivedDateTime;
    }

    /**
     * Sets a new formattedReceivedDateTime
     *
     * @param  \horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedReceivedDateTime
     */
    public function setFormattedReceivedDateTime(?\horstoeko\zugferd\entities\extended\qdt\FormattedDateTimeType $formattedReceivedDateTime = null): self
    {
        $this->formattedReceivedDateTime = $formattedReceivedDateTime;
        return $this;
    }

    /**
     * Adds as includedTradeTax
     */
    public function addToIncludedTradeTax(\horstoeko\zugferd\entities\extended\ram\TradeTaxType $includedTradeTax): self
    {
        $this->includedTradeTax[] = $includedTradeTax;
        return $this;
    }

    /**
     * isset includedTradeTax
     *
     * @param  int|string $index
     */
    public function issetIncludedTradeTax($index): bool
    {
        return isset($this->includedTradeTax[$index]);
    }

    /**
     * unset includedTradeTax
     *
     * @param  int|string $index
     */
    public function unsetIncludedTradeTax($index): void
    {
        unset($this->includedTradeTax[$index]);
    }

    /**
     * Gets as includedTradeTax
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeTaxType[]
     */
    public function getIncludedTradeTax()
    {
        return $this->includedTradeTax;
    }

    /**
     * Sets a new includedTradeTax
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeTaxType[] $includedTradeTax
     */
    public function setIncludedTradeTax(array $includedTradeTax): self
    {
        $this->includedTradeTax = $includedTradeTax;
        return $this;
    }

    /**
     * Gets as invoiceSpecifiedReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getInvoiceSpecifiedReferencedDocument()
    {
        return $this->invoiceSpecifiedReferencedDocument;
    }

    /**
     * Sets a new invoiceSpecifiedReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceSpecifiedReferencedDocument
     */
    public function setInvoiceSpecifiedReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $invoiceSpecifiedReferencedDocument = null): self
    {
        $this->invoiceSpecifiedReferencedDocument = $invoiceSpecifiedReferencedDocument;
        return $this;
    }
}
