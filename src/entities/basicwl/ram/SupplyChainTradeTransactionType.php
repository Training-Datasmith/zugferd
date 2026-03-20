<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing SupplyChainTradeTransactionType
 *
 * XSD Type: SupplyChainTradeTransactionType
 */
class Supply_Chain_Trade_Transaction_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\HeaderTradeAgreementType $applicableHeaderTradeAgreement
     */
    private $applicable_header_trade_agreement;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\HeaderTradeDeliveryType $applicableHeaderTradeDelivery
     */
    private $applicable_header_trade_delivery;
    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\HeaderTradeSettlementType $applicableHeaderTradeSettlement
     */
    private $applicable_header_trade_settlement;
    /**
     * Gets as applicableHeaderTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\HeaderTradeAgreementType
     */
    public function get_applicable_header_trade_agreement()
    {
        return $this->applicable_header_trade_agreement;
    }
    /**
     * Sets a new applicableHeaderTradeAgreement
     */
    public function set_applicable_header_trade_agreement(\horstoeko\zugferd\entities\basicwl\ram\Header_Trade_Agreement_Type $applicable_header_trade_agreement): self
    {
        $this->applicable_header_trade_agreement = $applicable_header_trade_agreement;
        return $this;
    }
    /**
     * Gets as applicableHeaderTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\HeaderTradeDeliveryType
     */
    public function get_applicable_header_trade_delivery()
    {
        return $this->applicable_header_trade_delivery;
    }
    /**
     * Sets a new applicableHeaderTradeDelivery
     */
    public function set_applicable_header_trade_delivery(\horstoeko\zugferd\entities\basicwl\ram\Header_Trade_Delivery_Type $applicable_header_trade_delivery): self
    {
        $this->applicable_header_trade_delivery = $applicable_header_trade_delivery;
        return $this;
    }
    /**
     * Gets as applicableHeaderTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\HeaderTradeSettlementType
     */
    public function get_applicable_header_trade_settlement()
    {
        return $this->applicable_header_trade_settlement;
    }
    /**
     * Sets a new applicableHeaderTradeSettlement
     */
    public function set_applicable_header_trade_settlement(\horstoeko\zugferd\entities\basicwl\ram\Header_Trade_Settlement_Type $applicable_header_trade_settlement): self
    {
        $this->applicable_header_trade_settlement = $applicable_header_trade_settlement;
        return $this;
    }
}