<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LineTradeDeliveryType
 *
 * XSD Type: LineTradeDeliveryType
 */
class Line_Trade_Delivery_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $billedQuantity
     */
    private $billed_quantity;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $chargeFreeQuantity
     */
    private $charge_free_quantity;
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $packageQuantity
     */
    private $package_quantity;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipToTradeParty
     */
    private $ship_to_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $ultimateShipToTradeParty
     */
    private $ultimate_ship_to_trade_party;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    private $actual_delivery_supply_chain_event;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    private $despatch_advice_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $receivingAdviceReferencedDocument
     */
    private $receiving_advice_referenced_document;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $deliveryNoteReferencedDocument
     */
    private $delivery_note_referenced_document;
    /**
     * Gets as billedQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function get_billed_quantity()
    {
        return $this->billed_quantity;
    }
    /**
     * Sets a new billedQuantity
     */
    public function set_billed_quantity(\horstoeko\zugferd\entities\extended\udt\Quantity_Type $billed_quantity): self
    {
        $this->billed_quantity = $billed_quantity;
        return $this;
    }
    /**
     * Gets as chargeFreeQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function get_charge_free_quantity()
    {
        return $this->charge_free_quantity;
    }
    /**
     * Sets a new chargeFreeQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $chargeFreeQuantity
     */
    public function set_charge_free_quantity(?\horstoeko\zugferd\entities\extended\udt\Quantity_Type $charge_free_quantity = null): self
    {
        $this->charge_free_quantity = $charge_free_quantity;
        return $this;
    }
    /**
     * Gets as packageQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function get_package_quantity()
    {
        return $this->package_quantity;
    }
    /**
     * Sets a new packageQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $packageQuantity
     */
    public function set_package_quantity(?\horstoeko\zugferd\entities\extended\udt\Quantity_Type $package_quantity = null): self
    {
        $this->package_quantity = $package_quantity;
        return $this;
    }
    /**
     * Gets as shipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function get_ship_to_trade_party()
    {
        return $this->ship_to_trade_party;
    }
    /**
     * Sets a new shipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipToTradeParty
     */
    public function set_ship_to_trade_party(?\horstoeko\zugferd\entities\extended\ram\Trade_Party_Type $ship_to_trade_party = null): self
    {
        $this->ship_to_trade_party = $ship_to_trade_party;
        return $this;
    }
    /**
     * Gets as ultimateShipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function get_ultimate_ship_to_trade_party()
    {
        return $this->ultimate_ship_to_trade_party;
    }
    /**
     * Sets a new ultimateShipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $ultimateShipToTradeParty
     */
    public function set_ultimate_ship_to_trade_party(?\horstoeko\zugferd\entities\extended\ram\Trade_Party_Type $ultimate_ship_to_trade_party = null): self
    {
        $this->ultimate_ship_to_trade_party = $ultimate_ship_to_trade_party;
        return $this;
    }
    /**
     * Gets as actualDeliverySupplyChainEvent
     *
     * @return \horstoeko\zugferd\entities\extended\ram\SupplyChainEventType
     */
    public function get_actual_delivery_supply_chain_event()
    {
        return $this->actual_delivery_supply_chain_event;
    }
    /**
     * Sets a new actualDeliverySupplyChainEvent
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    public function set_actual_delivery_supply_chain_event(?\horstoeko\zugferd\entities\extended\ram\Supply_Chain_Event_Type $actual_delivery_supply_chain_event = null): self
    {
        $this->actual_delivery_supply_chain_event = $actual_delivery_supply_chain_event;
        return $this;
    }
    /**
     * Gets as despatchAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_despatch_advice_referenced_document()
    {
        return $this->despatch_advice_referenced_document;
    }
    /**
     * Sets a new despatchAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    public function set_despatch_advice_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $despatch_advice_referenced_document = null): self
    {
        $this->despatch_advice_referenced_document = $despatch_advice_referenced_document;
        return $this;
    }
    /**
     * Gets as receivingAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_receiving_advice_referenced_document()
    {
        return $this->receiving_advice_referenced_document;
    }
    /**
     * Sets a new receivingAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $receivingAdviceReferencedDocument
     */
    public function set_receiving_advice_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $receiving_advice_referenced_document = null): self
    {
        $this->receiving_advice_referenced_document = $receiving_advice_referenced_document;
        return $this;
    }
    /**
     * Gets as deliveryNoteReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function get_delivery_note_referenced_document()
    {
        return $this->delivery_note_referenced_document;
    }
    /**
     * Sets a new deliveryNoteReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $deliveryNoteReferencedDocument
     */
    public function set_delivery_note_referenced_document(?\horstoeko\zugferd\entities\extended\ram\Referenced_Document_Type $delivery_note_referenced_document = null): self
    {
        $this->delivery_note_referenced_document = $delivery_note_referenced_document;
        return $this;
    }
}