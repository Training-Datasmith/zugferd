<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing HeaderTradeDeliveryType
 *
 * XSD Type: HeaderTradeDeliveryType
 */
class HeaderTradeDeliveryType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $relatedSupplyChainConsignment
     */
    private $relatedSupplyChainConsignment;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipToTradeParty
     */
    private $shipToTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $ultimateShipToTradeParty
     */
    private $ultimateShipToTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipFromTradeParty
     */
    private $shipFromTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    private $actualDeliverySupplyChainEvent;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    private $despatchAdviceReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $receivingAdviceReferencedDocument
     */
    private $receivingAdviceReferencedDocument;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $deliveryNoteReferencedDocument
     */
    private $deliveryNoteReferencedDocument;

    /**
     * Adds as specifiedLogisticsTransportMovement
     */
    public function addToRelatedSupplyChainConsignment(\horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType $specifiedLogisticsTransportMovement): self
    {
        $this->relatedSupplyChainConsignment[] = $specifiedLogisticsTransportMovement;
        return $this;
    }

    /**
     * isset relatedSupplyChainConsignment
     *
     * @param  int|string $index
     */
    public function issetRelatedSupplyChainConsignment($index): bool
    {
        return isset($this->relatedSupplyChainConsignment[$index]);
    }

    /**
     * unset relatedSupplyChainConsignment
     *
     * @param  int|string $index
     */
    public function unsetRelatedSupplyChainConsignment($index): void
    {
        unset($this->relatedSupplyChainConsignment[$index]);
    }

    /**
     * Gets as relatedSupplyChainConsignment
     *
     * @return \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[]
     */
    public function getRelatedSupplyChainConsignment()
    {
        return $this->relatedSupplyChainConsignment;
    }

    /**
     * Sets a new relatedSupplyChainConsignment
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\LogisticsTransportMovementType[] $relatedSupplyChainConsignment
     */
    public function setRelatedSupplyChainConsignment(?array $relatedSupplyChainConsignment = null): self
    {
        $this->relatedSupplyChainConsignment = $relatedSupplyChainConsignment;
        return $this;
    }

    /**
     * Gets as shipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getShipToTradeParty()
    {
        return $this->shipToTradeParty;
    }

    /**
     * Sets a new shipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipToTradeParty
     */
    public function setShipToTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $shipToTradeParty = null): self
    {
        $this->shipToTradeParty = $shipToTradeParty;
        return $this;
    }

    /**
     * Gets as ultimateShipToTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getUltimateShipToTradeParty()
    {
        return $this->ultimateShipToTradeParty;
    }

    /**
     * Sets a new ultimateShipToTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $ultimateShipToTradeParty
     */
    public function setUltimateShipToTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $ultimateShipToTradeParty = null): self
    {
        $this->ultimateShipToTradeParty = $ultimateShipToTradeParty;
        return $this;
    }

    /**
     * Gets as shipFromTradeParty
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradePartyType
     */
    public function getShipFromTradeParty()
    {
        return $this->shipFromTradeParty;
    }

    /**
     * Sets a new shipFromTradeParty
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipFromTradeParty
     */
    public function setShipFromTradeParty(?\horstoeko\zugferd\entities\extended\ram\TradePartyType $shipFromTradeParty = null): self
    {
        $this->shipFromTradeParty = $shipFromTradeParty;
        return $this;
    }

    /**
     * Gets as actualDeliverySupplyChainEvent
     *
     * @return \horstoeko\zugferd\entities\extended\ram\SupplyChainEventType
     */
    public function getActualDeliverySupplyChainEvent()
    {
        return $this->actualDeliverySupplyChainEvent;
    }

    /**
     * Sets a new actualDeliverySupplyChainEvent
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\SupplyChainEventType $actualDeliverySupplyChainEvent
     */
    public function setActualDeliverySupplyChainEvent(?\horstoeko\zugferd\entities\extended\ram\SupplyChainEventType $actualDeliverySupplyChainEvent = null): self
    {
        $this->actualDeliverySupplyChainEvent = $actualDeliverySupplyChainEvent;
        return $this;
    }

    /**
     * Gets as despatchAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getDespatchAdviceReferencedDocument()
    {
        return $this->despatchAdviceReferencedDocument;
    }

    /**
     * Sets a new despatchAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $despatchAdviceReferencedDocument
     */
    public function setDespatchAdviceReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $despatchAdviceReferencedDocument = null): self
    {
        $this->despatchAdviceReferencedDocument = $despatchAdviceReferencedDocument;
        return $this;
    }

    /**
     * Gets as receivingAdviceReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getReceivingAdviceReferencedDocument()
    {
        return $this->receivingAdviceReferencedDocument;
    }

    /**
     * Sets a new receivingAdviceReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $receivingAdviceReferencedDocument
     */
    public function setReceivingAdviceReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $receivingAdviceReferencedDocument = null): self
    {
        $this->receivingAdviceReferencedDocument = $receivingAdviceReferencedDocument;
        return $this;
    }

    /**
     * Gets as deliveryNoteReferencedDocument
     *
     * @return \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType
     */
    public function getDeliveryNoteReferencedDocument()
    {
        return $this->deliveryNoteReferencedDocument;
    }

    /**
     * Sets a new deliveryNoteReferencedDocument
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $deliveryNoteReferencedDocument
     */
    public function setDeliveryNoteReferencedDocument(?\horstoeko\zugferd\entities\extended\ram\ReferencedDocumentType $deliveryNoteReferencedDocument = null): self
    {
        $this->deliveryNoteReferencedDocument = $deliveryNoteReferencedDocument;
        return $this;
    }
}
