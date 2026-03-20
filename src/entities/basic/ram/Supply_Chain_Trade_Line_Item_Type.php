<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SupplyChainTradeLineItemType
 *
 * XSD Type: SupplyChainTradeLineItemType
 */
class Supply_Chain_Trade_Line_Item_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\DocumentLineDocumentType $associatedDocumentLineDocument
     */
    private $associated_document_line_document;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradeProductType $specifiedTradeProduct
     */
    private $specified_trade_product;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LineTradeAgreementType $specifiedLineTradeAgreement
     */
    private $specified_line_trade_agreement;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LineTradeDeliveryType $specifiedLineTradeDelivery
     */
    private $specified_line_trade_delivery;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\LineTradeSettlementType $specifiedLineTradeSettlement
     */
    private $specified_line_trade_settlement;
    /**
     * Gets as associatedDocumentLineDocument
     *
     * @return \horstoeko\zugferd\entities\basic\ram\DocumentLineDocumentType
     */
    public function get_associated_document_line_document()
    {
        return $this->associated_document_line_document;
    }
    /**
     * Sets a new associatedDocumentLineDocument
     */
    public function set_associated_document_line_document(\horstoeko\zugferd\entities\basic\ram\Document_Line_Document_Type $associated_document_line_document): self
    {
        $this->associated_document_line_document = $associated_document_line_document;
        return $this;
    }
    /**
     * Gets as specifiedTradeProduct
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradeProductType
     */
    public function get_specified_trade_product()
    {
        return $this->specified_trade_product;
    }
    /**
     * Sets a new specifiedTradeProduct
     */
    public function set_specified_trade_product(\horstoeko\zugferd\entities\basic\ram\Trade_Product_Type $specified_trade_product): self
    {
        $this->specified_trade_product = $specified_trade_product;
        return $this;
    }
    /**
     * Gets as specifiedLineTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\LineTradeAgreementType
     */
    public function get_specified_line_trade_agreement()
    {
        return $this->specified_line_trade_agreement;
    }
    /**
     * Sets a new specifiedLineTradeAgreement
     */
    public function set_specified_line_trade_agreement(\horstoeko\zugferd\entities\basic\ram\Line_Trade_Agreement_Type $specified_line_trade_agreement): self
    {
        $this->specified_line_trade_agreement = $specified_line_trade_agreement;
        return $this;
    }
    /**
     * Gets as specifiedLineTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\basic\ram\LineTradeDeliveryType
     */
    public function get_specified_line_trade_delivery()
    {
        return $this->specified_line_trade_delivery;
    }
    /**
     * Sets a new specifiedLineTradeDelivery
     */
    public function set_specified_line_trade_delivery(\horstoeko\zugferd\entities\basic\ram\Line_Trade_Delivery_Type $specified_line_trade_delivery): self
    {
        $this->specified_line_trade_delivery = $specified_line_trade_delivery;
        return $this;
    }
    /**
     * Gets as specifiedLineTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\LineTradeSettlementType
     */
    public function get_specified_line_trade_settlement()
    {
        return $this->specified_line_trade_settlement;
    }
    /**
     * Sets a new specifiedLineTradeSettlement
     */
    public function set_specified_line_trade_settlement(\horstoeko\zugferd\entities\basic\ram\Line_Trade_Settlement_Type $specified_line_trade_settlement): self
    {
        $this->specified_line_trade_settlement = $specified_line_trade_settlement;
        return $this;
    }
}