<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing LineTradeDeliveryType
 *
 * XSD Type: LineTradeDeliveryType
 */
class LineTradeDeliveryType
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $billedQuantity
     */
    private $billedQuantity;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $chargeFreeQuantity
     */
    private $chargeFreeQuantity;

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\QuantityType $packageQuantity
     */
    private $packageQuantity;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $shipToTradeParty
     */
    private $shipToTradeParty;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradePartyType $ultimateShipToTradeParty
     */
    private $ultimateShipToTradeParty;

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
     * Gets as billedQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function getBilledQuantity()
    {
        return $this->billedQuantity;
    }

    /**
     * Sets a new billedQuantity
     */
    public function setBilledQuantity(\horstoeko\zugferd\entities\extended\udt\QuantityType $billedQuantity): self
    {
        $this->billedQuantity = $billedQuantity;
        return $this;
    }

    /**
     * Gets as chargeFreeQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function getChargeFreeQuantity()
    {
        return $this->chargeFreeQuantity;
    }

    /**
     * Sets a new chargeFreeQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $chargeFreeQuantity
     */
    public function setChargeFreeQuantity(?\horstoeko\zugferd\entities\extended\udt\QuantityType $chargeFreeQuantity = null): self
    {
        $this->chargeFreeQuantity = $chargeFreeQuantity;
        return $this;
    }

    /**
     * Gets as packageQuantity
     *
     * @return \horstoeko\zugferd\entities\extended\udt\QuantityType
     */
    public function getPackageQuantity()
    {
        return $this->packageQuantity;
    }

    /**
     * Sets a new packageQuantity
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\QuantityType $packageQuantity
     */
    public function setPackageQuantity(?\horstoeko\zugferd\entities\extended\udt\QuantityType $packageQuantity = null): self
    {
        $this->packageQuantity = $packageQuantity;
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
