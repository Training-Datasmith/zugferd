<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing SupplyChainTradeTransactionType
 *
 * XSD Type: SupplyChainTradeTransactionType
 */
class Supply_Chain_Trade_Transaction_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType[] $includedSupplyChainTradeLineItem
     */
    private $included_supply_chain_trade_line_item = [];
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\HeaderTradeAgreementType $applicableHeaderTradeAgreement
     */
    private $applicable_header_trade_agreement;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\HeaderTradeDeliveryType $applicableHeaderTradeDelivery
     */
    private $applicable_header_trade_delivery;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\HeaderTradeSettlementType $applicableHeaderTradeSettlement
     */
    private $applicable_header_trade_settlement;
    /**
     * Adds as includedSupplyChainTradeLineItem
     */
    public function add_to_included_supply_chain_trade_line_item(\horstoeko\zugferd\entities\basic\ram\Supply_Chain_Trade_Line_Item_Type $included_supply_chain_trade_line_item): self
    {
        $this->included_supply_chain_trade_line_item[] = $included_supply_chain_trade_line_item;
        return $this;
    }
    /**
     * isset includedSupplyChainTradeLineItem
     *
     * @param  int|string $index
     */
    public function isset_included_supply_chain_trade_line_item($index): bool
    {
        return isset($this->included_supply_chain_trade_line_item[$index]);
    }
    /**
     * unset includedSupplyChainTradeLineItem
     *
     * @param  int|string $index
     */
    public function unset_included_supply_chain_trade_line_item($index): void
    {
        unset($this->included_supply_chain_trade_line_item[$index]);
    }
    /**
     * Gets as includedSupplyChainTradeLineItem
     *
     * @return \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType[]
     */
    public function get_included_supply_chain_trade_line_item()
    {
        return $this->included_supply_chain_trade_line_item;
    }
    /**
     * Sets a new includedSupplyChainTradeLineItem
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\SupplyChainTradeLineItemType[] $includedSupplyChainTradeLineItem
     */
    public function set_included_supply_chain_trade_line_item(array $included_supply_chain_trade_line_item): self
    {
        $this->included_supply_chain_trade_line_item = $included_supply_chain_trade_line_item;
        return $this;
    }
    /**
     * Gets as applicableHeaderTradeAgreement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\HeaderTradeAgreementType
     */
    public function get_applicable_header_trade_agreement()
    {
        return $this->applicable_header_trade_agreement;
    }
    /**
     * Sets a new applicableHeaderTradeAgreement
     */
    public function set_applicable_header_trade_agreement(\horstoeko\zugferd\entities\basic\ram\Header_Trade_Agreement_Type $applicable_header_trade_agreement): self
    {
        $this->applicable_header_trade_agreement = $applicable_header_trade_agreement;
        return $this;
    }
    /**
     * Gets as applicableHeaderTradeDelivery
     *
     * @return \horstoeko\zugferd\entities\basic\ram\HeaderTradeDeliveryType
     */
    public function get_applicable_header_trade_delivery()
    {
        return $this->applicable_header_trade_delivery;
    }
    /**
     * Sets a new applicableHeaderTradeDelivery
     */
    public function set_applicable_header_trade_delivery(\horstoeko\zugferd\entities\basic\ram\Header_Trade_Delivery_Type $applicable_header_trade_delivery): self
    {
        $this->applicable_header_trade_delivery = $applicable_header_trade_delivery;
        return $this;
    }
    /**
     * Gets as applicableHeaderTradeSettlement
     *
     * @return \horstoeko\zugferd\entities\basic\ram\HeaderTradeSettlementType
     */
    public function get_applicable_header_trade_settlement()
    {
        return $this->applicable_header_trade_settlement;
    }
    /**
     * Sets a new applicableHeaderTradeSettlement
     */
    public function set_applicable_header_trade_settlement(\horstoeko\zugferd\entities\basic\ram\Header_Trade_Settlement_Type $applicable_header_trade_settlement): self
    {
        $this->applicable_header_trade_settlement = $applicable_header_trade_settlement;
        return $this;
    }
}