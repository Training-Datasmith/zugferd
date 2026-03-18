<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing HeaderTradeDeliveryType
 *
 * XSD Type: HeaderTradeDeliveryType
 */
class HeaderTradeDeliveryType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\TradePartyType $shipToTradeParty
     */
    private $shipToTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    private $actualDeliverySupplyChainEvent;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    private $despatchAdviceReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $receivingAdviceReferencedDocument
     */
    private $receivingAdviceReferencedDocument;

    /**
     * Gets as shipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\TradePartyType
     */
    public function getShipToTradeParty()
    {
        return $this->shipToTradeParty;
    }

    /**
     * Sets a new shipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\TradePartyType $shipToTradeParty
     */
    public function setShipToTradeParty(?\horstoeko\zugferd\entities\en16931\ram\TradePartyType $shipToTradeParty = null): self
    {
        $this->shipToTradeParty = $shipToTradeParty;
        return $this;
    }

    /**
     * Gets as actualDeliverySupplyChainEvent
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\SupplyChainEventType
     */
    public function getActualDeliverySupplyChainEvent()
    {
        return $this->actualDeliverySupplyChainEvent;
    }

    /**
     * Sets a new actualDeliverySupplyChainEvent
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    public function setActualDeliverySupplyChainEvent(?\horstoeko\zugferd\entities\en16931\ram\SupplyChainEventType $actualDeliverySupplyChainEvent = null): self
    {
        $this->actualDeliverySupplyChainEvent = $actualDeliverySupplyChainEvent;
        return $this;
    }

    /**
     * Gets as despatchAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getDespatchAdviceReferencedDocument()
    {
        return $this->despatchAdviceReferencedDocument;
    }

    /**
     * Sets a new despatchAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    public function setDespatchAdviceReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $despatchAdviceReferencedDocument = null): self
    {
        $this->despatchAdviceReferencedDocument = $despatchAdviceReferencedDocument;
        return $this;
    }

    /**
     * Gets as receivingAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType
     */
    public function getReceivingAdviceReferencedDocument()
    {
        return $this->receivingAdviceReferencedDocument;
    }

    /**
     * Sets a new receivingAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $receivingAdviceReferencedDocument
     */
    public function setReceivingAdviceReferencedDocument(?\horstoeko\zugferd\entities\en16931\ram\ReferencedDocumentType $receivingAdviceReferencedDocument = null): self
    {
        $this->receivingAdviceReferencedDocument = $receivingAdviceReferencedDocument;
        return $this;
    }
}
