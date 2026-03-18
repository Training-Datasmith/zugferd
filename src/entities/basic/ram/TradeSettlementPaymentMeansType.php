<?php

namespace horstoeko\zugferd\entities\basic\ram;

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
     * @var \horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    private $payerPartyDebtorFinancialAccount;

    /**
     * @var \horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
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
     * @return \horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType
     */
    public function getPayerPartyDebtorFinancialAccount()
    {
        return $this->payerPartyDebtorFinancialAccount;
    }

    /**
     * Sets a new payerPartyDebtorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    public function setPayerPartyDebtorFinancialAccount(?\horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount = null): self
    {
        $this->payerPartyDebtorFinancialAccount = $payerPartyDebtorFinancialAccount;
        return $this;
    }

    /**
     * Gets as payeePartyCreditorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType
     */
    public function getPayeePartyCreditorFinancialAccount()
    {
        return $this->payeePartyCreditorFinancialAccount;
    }

    /**
     * Sets a new payeePartyCreditorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    public function setPayeePartyCreditorFinancialAccount(?\horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount = null): self
    {
        $this->payeePartyCreditorFinancialAccount = $payeePartyCreditorFinancialAccount;
        return $this;
    }
}
