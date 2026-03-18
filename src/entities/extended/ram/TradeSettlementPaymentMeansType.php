<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeSettlementPaymentMeansType
 *
 * XSD Type: TradeSettlementPaymentMeansType
 */
class TradeSettlementPaymentMeansType
{

    /**
     * @var string $typeCode
     */
    private $typeCode;

    /**
     * @var string $information
     */
    private $information;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard
     */
    private $applicableTradeSettlementFinancialCard;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    private $payerPartyDebtorFinancialAccount;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    private $payeePartyCreditorFinancialAccount;

    /**
     * @var \horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution
     */
    private $payeeSpecifiedCreditorFinancialInstitution;

    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function setTypeCode($typeCode): self
    {
        $this->typeCode = $typeCode;
        return $this;
    }

    /**
     * Gets as information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Sets a new information
     *
     * @param  string $information
     */
    public function setInformation($information): self
    {
        $this->information = $information;
        return $this;
    }

    /**
     * Gets as applicableTradeSettlementFinancialCard
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType
     */
    public function getApplicableTradeSettlementFinancialCard()
    {
        return $this->applicableTradeSettlementFinancialCard;
    }

    /**
     * Sets a new applicableTradeSettlementFinancialCard
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard
     */
    public function setApplicableTradeSettlementFinancialCard(?\horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard = null): self
    {
        $this->applicableTradeSettlementFinancialCard = $applicableTradeSettlementFinancialCard;
        return $this;
    }

    /**
     * Gets as payerPartyDebtorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType
     */
    public function getPayerPartyDebtorFinancialAccount()
    {
        return $this->payerPartyDebtorFinancialAccount;
    }

    /**
     * Sets a new payerPartyDebtorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    public function setPayerPartyDebtorFinancialAccount(?\horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount = null): self
    {
        $this->payerPartyDebtorFinancialAccount = $payerPartyDebtorFinancialAccount;
        return $this;
    }

    /**
     * Gets as payeePartyCreditorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType
     */
    public function getPayeePartyCreditorFinancialAccount()
    {
        return $this->payeePartyCreditorFinancialAccount;
    }

    /**
     * Sets a new payeePartyCreditorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    public function setPayeePartyCreditorFinancialAccount(?\horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount = null): self
    {
        $this->payeePartyCreditorFinancialAccount = $payeePartyCreditorFinancialAccount;
        return $this;
    }

    /**
     * Gets as payeeSpecifiedCreditorFinancialInstitution
     *
     * @return \horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType
     */
    public function getPayeeSpecifiedCreditorFinancialInstitution()
    {
        return $this->payeeSpecifiedCreditorFinancialInstitution;
    }

    /**
     * Sets a new payeeSpecifiedCreditorFinancialInstitution
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution
     */
    public function setPayeeSpecifiedCreditorFinancialInstitution(?\horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution = null): self
    {
        $this->payeeSpecifiedCreditorFinancialInstitution = $payeeSpecifiedCreditorFinancialInstitution;
        return $this;
    }
}
