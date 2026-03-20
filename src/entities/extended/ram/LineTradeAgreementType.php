<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LineTradeAgreementType
 *
 * XSD Type: LineTradeAgreementType
 */
class Line_Trade_Agreement_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    private $seller_order_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    private $buyer_order_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument
     */
    private $quotation_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument
     */
    private $contract_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    private $additional_referenced_document = [];
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice
     */
    private $gross_price_product_trade_price;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePriceType $netPriceProductTradePrice
     */
    private $net_price_product_trade_price;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     */
    private $ultimate_customer_order_referenced_document = [];
    /**
     * Gets as sellerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_seller_order_referenced_document()
    {
        return $this->seller_order_referenced_document;
    }
    /**
     * Sets a new sellerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $sellerOrderReferencedDocument
     */
    public function set_seller_order_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $seller_order_referenced_document = null): self
    {
        $this->seller_order_referenced_document = $seller_order_referenced_document;
        return $this;
    }
    /**
     * Gets as buyerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_buyer_order_referenced_document()
    {
        return $this->buyer_order_referenced_document;
    }
    /**
     * Sets a new buyerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $buyerOrderReferencedDocument
     */
    public function set_buyer_order_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $buyer_order_referenced_document = null): self
    {
        $this->buyer_order_referenced_document = $buyer_order_referenced_document;
        return $this;
    }
    /**
     * Gets as quotationReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_quotation_referenced_document()
    {
        return $this->quotation_referenced_document;
    }
    /**
     * Sets a new quotationReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $quotationReferencedDocument
     */
    public function set_quotation_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $quotation_referenced_document = null): self
    {
        $this->quotation_referenced_document = $quotation_referenced_document;
        return $this;
    }
    /**
     * Gets as contractReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_contract_referenced_document()
    {
        return $this->contract_referenced_document;
    }
    /**
     * Sets a new contractReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $contractReferencedDocument
     */
    public function set_contract_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $contract_referenced_document = null): self
    {
        $this->contract_referenced_document = $contract_referenced_document;
        return $this;
    }
    /**
     * Adds as additionalReferencedDocument
     */
    public function add_to_additional_referenced_document(\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $additional_referenced_document): self
    {
        $this->additional_referenced_document[] = $additional_referenced_document;
        return $this;
    }
    /**
     * isset additionalReferencedDocument
     *
     * @param  int|string $index
     */
    public function isset_additional_referenced_document($index): bool
    {
        return isset($this->additional_referenced_document[$index]);
    }
    /**
     * unset additionalReferencedDocument
     *
     * @param  int|string $index
     */
    public function unset_additional_referenced_document($index): void
    {
        unset($this->additional_referenced_document[$index]);
    }
    /**
     * Gets as additionalReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function get_additional_referenced_document()
    {
        return $this->additional_referenced_document;
    }
    /**
     * Sets a new additionalReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $additionalReferencedDocument
     */
    public function set_additional_referenced_document(?array $additional_referenced_document = null): self
    {
        $this->additional_referenced_document = $additional_referenced_document;
        return $this;
    }
    /**
     * Gets as grossPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePriceType
     */
    public function get_gross_price_product_trade_price()
    {
        return $this->gross_price_product_trade_price;
    }
    /**
     * Sets a new grossPriceProductTradePrice
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePriceType $grossPriceProductTradePrice
     */
    public function set_gross_price_product_trade_price(?\horstoeko\zugferd\entities\extended\ram\Trade_Price_Type $gross_price_product_trade_price = null): self
    {
        $this->gross_price_product_trade_price = $gross_price_product_trade_price;
        return $this;
    }
    /**
     * Gets as netPriceProductTradePrice
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePriceType
     */
    public function get_net_price_product_trade_price()
    {
        return $this->net_price_product_trade_price;
    }
    /**
     * Sets a new netPriceProductTradePrice
     */
    public function set_net_price_product_trade_price(\horstoeko\zugferd\entities\extended\ram\Trade_Price_Type $net_price_product_trade_price): self
    {
        $this->net_price_product_trade_price = $net_price_product_trade_price;
        return $this;
    }
    /**
     * Adds as ultimateCustomerOrderReferencedDocument
     */
    public function add_to_ultimate_customer_order_referenced_document(\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $ultimate_customer_order_referenced_document): self
    {
        $this->ultimate_customer_order_referenced_document[] = $ultimate_customer_order_referenced_document;
        return $this;
    }
    /**
     * isset ultimateCustomerOrderReferencedDocument
     *
     * @param  int|string $index
     */
    public function isset_ultimate_customer_order_referenced_document($index): bool
    {
        return isset($this->ultimate_customer_order_referenced_document[$index]);
    }
    /**
     * unset ultimateCustomerOrderReferencedDocument
     *
     * @param  int|string $index
     */
    public function unset_ultimate_customer_order_referenced_document($index): void
    {
        unset($this->ultimate_customer_order_referenced_document[$index]);
    }
    /**
     * Gets as ultimateCustomerOrderReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[]
     */
    public function get_ultimate_customer_order_referenced_document()
    {
        return $this->ultimate_customer_order_referenced_document;
    }
    /**
     * Sets a new ultimateCustomerOrderReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType[] $ultimateCustomerOrderReferencedDocument
     */
    public function set_ultimate_customer_order_referenced_document(?array $ultimate_customer_order_referenced_document = null): self
    {
        $this->ultimate_customer_order_referenced_document = $ultimate_customer_order_referenced_document;
        return $this;
    }
}