<?php

namespace horstoeko\zugferd\entities\basicwl\ram;

/**
 * Class representing HeaderTradeDeliveryType
 *
 * XSD Type: HeaderTradeDeliveryType
 */
class HeaderTradeDeliveryType
{

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\TradePartyType $shipToTradeParty
     */
    private $shipToTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    private $actualDeliverySupplyChainEvent;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    private $despatchAdviceReferencedDocument;

    /**
     * Gets as shipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\TradePartyType
     */
    public function getShipToTradeParty()
    {
        return $this->shipToTradeParty;
    }

    /**
     * Sets a new shipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\TradePartyType $shipToTradeParty
     */
    public function setShipToTradeParty(?\horstoeko\zugferd\entities\basicwl\ram\TradePartyType $shipToTradeParty = null): self
    {
        $this->shipToTradeParty = $shipToTradeParty;
        return $this;
    }

    /**
     * Gets as actualDeliverySupplyChainEvent
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\SupplyChainEventType
     */
    public function getActualDeliverySupplyChainEvent()
    {
        return $this->actualDeliverySupplyChainEvent;
    }

    /**
     * Sets a new actualDeliverySupplyChainEvent
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    public function setActualDeliverySupplyChainEvent(?\horstoeko\zugferd\entities\basicwl\ram\SupplyChainEventType $actualDeliverySupplyChainEvent = null): self
    {
        $this->actualDeliverySupplyChainEvent = $actualDeliverySupplyChainEvent;
        return $this;
    }

    /**
     * Gets as despatchAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType
     */
    public function getDespatchAdviceReferencedDocument()
    {
        return $this->despatchAdviceReferencedDocument;
    }

    /**
     * Sets a new despatchAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    public function setDespatchAdviceReferencedDocument(?\horstoeko\zugferd\entities\basicwl\ram\ReferencedDocumentType $despatchAdviceReferencedDocument = null): self
    {
        $this->despatchAdviceReferencedDocument = $despatchAdviceReferencedDocument;
        return $this;
    }
}
