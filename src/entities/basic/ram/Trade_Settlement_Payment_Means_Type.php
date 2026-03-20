<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradeSettlementPaymentMeansType
 *
 * XSD Type: TradeSettlementPaymentMeansType
 */
class Trade_Settlement_Payment_Means_Type
{
    /**
     * @var string $typeCode
     */
    private $type_code;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    private $payer_party_debtor_financial_account;
    /**
     * @var \horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    private $payee_party_creditor_financial_account;
    /**
     * Gets as typeCode
     *
     * @return string
     */
    public function get_type_code()
    {
        return $this->type_code;
    }
    /**
     * Sets a new typeCode
     *
     * @param  string $typeCode
     */
    public function set_type_code($type_code): self
    {
        $this->type_code = $type_code;
        return $this;
    }
    /**
     * Gets as payerPartyDebtorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType
     */
    public function get_payer_party_debtor_financial_account()
    {
        return $this->payer_party_debtor_financial_account;
    }
    /**
     * Sets a new payerPartyDebtorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    public function set_payer_party_debtor_financial_account(?\horstoeko\zugferd\entities\basic\ram\Debtor_Financial_Account_Type $payer_party_debtor_financial_account = null): self
    {
        $this->payer_party_debtor_financial_account = $payer_party_debtor_financial_account;
        return $this;
    }
    /**
     * Gets as payeePartyCreditorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType
     */
    public function get_payee_party_creditor_financial_account()
    {
        return $this->payee_party_creditor_financial_account;
    }
    /**
     * Sets a new payeePartyCreditorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\basic\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    public function set_payee_party_creditor_financial_account(?\horstoeko\zugferd\entities\basic\ram\Creditor_Financial_Account_Type $payee_party_creditor_financial_account = null): self
    {
        $this->payee_party_creditor_financial_account = $payee_party_creditor_financial_account;
        return $this;
    }
}