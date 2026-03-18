<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basicwl\ram;

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
     * @var \horstoeko\zugferd\entities\basicwl\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    private $payerPartyDebtorFinancialAccount;

    /**
     * @var \horstoeko\zugferd\entities\basicwl\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    private $payeePartyCreditorFinancialAccount;

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
     * Gets as payerPartyDebtorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\DebtorFinancialAccountType
     */
    public function getPayerPartyDebtorFinancialAccount()
    {
        return $this->payerPartyDebtorFinancialAccount;
    }

    /**
     * Sets a new payerPartyDebtorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    public function setPayerPartyDebtorFinancialAccount(?\horstoeko\zugferd\entities\basicwl\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount = null): self
    {
        $this->payerPartyDebtorFinancialAccount = $payerPartyDebtorFinancialAccount;
        return $this;
    }

    /**
     * Gets as payeePartyCreditorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\basicwl\ram\CreditorFinancialAccountType
     */
    public function getPayeePartyCreditorFinancialAccount()
    {
        return $this->payeePartyCreditorFinancialAccount;
    }

    /**
     * Sets a new payeePartyCreditorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\basicwl\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    public function setPayeePartyCreditorFinancialAccount(?\horstoeko\zugferd\entities\basicwl\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount = null): self
    {
        $this->payeePartyCreditorFinancialAccount = $payeePartyCreditorFinancialAccount;
        return $this;
    }
}
