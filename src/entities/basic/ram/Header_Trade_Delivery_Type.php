<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing HeaderTradeDeliveryType
 *
 * XSD Type: HeaderTradeDeliveryType
 */
class Header_Trade_Delivery_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\TradePartyType $shipToTradeParty
     */
    private $ship_to_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    private $actual_delivery_supply_chain_event;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    private $despatch_advice_referenced_document;
    /**
     * Gets as shipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\basic\ram\TradePartyType
     */
    public function get_ship_to_trade_party()
    {
        return $this->ship_to_trade_party;
    }
    /**
     * Sets a new shipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\TradePartyType $shipToTradeParty
     */
    public function set_ship_to_trade_party(?\horstoeko\zugferd\entities\basic\ram\Trade_Party_Type $ship_to_trade_party = null): self
    {
        $this->ship_to_trade_party = $ship_to_trade_party;
        return $this;
    }
    /**
     * Gets as actualDeliverySupplyChainEvent
     *
     * @return \horstoeko\zugferd\entities\basic\ram\SupplyChainEventType
     */
    public function get_actual_delivery_supply_chain_event()
    {
        return $this->actual_delivery_supply_chain_event;
    }
    /**
     * Sets a new actualDeliverySupplyChainEvent
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    public function set_actual_delivery_supply_chain_event(?\horstoeko\zugferd\entities\basic\ram\Supply_Chain_Event_Type $actual_delivery_supply_chain_event = null): self
    {
        $this->actual_delivery_supply_chain_event = $actual_delivery_supply_chain_event;
        return $this;
    }
    /**
     * Gets as despatchAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType
     */
    public function get_despatch_advice_referenced_document()
    {
        return $this->despatch_advice_referenced_document;
    }
    /**
     * Sets a new despatchAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    public function set_despatch_advice_referenced_document(?\horstoeko\zugferd\entities\basic\ram\Referenced_Document_Type $despatch_advice_referenced_document = null): self
    {
        $this->despatch_advice_referenced_document = $despatch_advice_referenced_document;
        return $this;
    }
}