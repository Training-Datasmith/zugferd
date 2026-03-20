<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

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
     * @var string $information
     */
    private $information;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard
     */
    private $applicable_trade_settlement_financial_card;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    private $payer_party_debtor_financial_account;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    private $payee_party_creditor_financial_account;
    /**
     * @var \horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution
     */
    private $payee_specified_creditor_financial_institution;
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
     * Gets as information
     *
     * @return string
     */
    public function get_information()
    {
        return $this->information;
    }
    /**
     * Sets a new information
     *
     * @param  string $information
     */
    public function set_information($information): self
    {
        $this->information = $information;
        return $this;
    }
    /**
     * Gets as applicableTradeSettlementFinancialCard
     *
     * @return \horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType
     */
    public function get_applicable_trade_settlement_financial_card()
    {
        return $this->applicable_trade_settlement_financial_card;
    }
    /**
     * Sets a new applicableTradeSettlementFinancialCard
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\TradeSettlementFinancialCardType $applicableTradeSettlementFinancialCard
     */
    public function set_applicable_trade_settlement_financial_card(?\horstoeko\zugferd\entities\extended\ram\Trade_Settlement_Financial_Card_Type $applicable_trade_settlement_financial_card = null): self
    {
        $this->applicable_trade_settlement_financial_card = $applicable_trade_settlement_financial_card;
        return $this;
    }
    /**
     * Gets as payerPartyDebtorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType
     */
    public function get_payer_party_debtor_financial_account()
    {
        return $this->payer_party_debtor_financial_account;
    }
    /**
     * Sets a new payerPartyDebtorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\DebtorFinancialAccountType $payerPartyDebtorFinancialAccount
     */
    public function set_payer_party_debtor_financial_account(?\horstoeko\zugferd\entities\extended\ram\Debtor_Financial_Account_Type $payer_party_debtor_financial_account = null): self
    {
        $this->payer_party_debtor_financial_account = $payer_party_debtor_financial_account;
        return $this;
    }
    /**
     * Gets as payeePartyCreditorFinancialAccount
     *
     * @return \horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType
     */
    public function get_payee_party_creditor_financial_account()
    {
        return $this->payee_party_creditor_financial_account;
    }
    /**
     * Sets a new payeePartyCreditorFinancialAccount
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\CreditorFinancialAccountType $payeePartyCreditorFinancialAccount
     */
    public function set_payee_party_creditor_financial_account(?\horstoeko\zugferd\entities\extended\ram\Creditor_Financial_Account_Type $payee_party_creditor_financial_account = null): self
    {
        $this->payee_party_creditor_financial_account = $payee_party_creditor_financial_account;
        return $this;
    }
    /**
     * Gets as payeeSpecifiedCreditorFinancialInstitution
     *
     * @return \horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType
     */
    public function get_payee_specified_creditor_financial_institution()
    {
        return $this->payee_specified_creditor_financial_institution;
    }
    /**
     * Sets a new payeeSpecifiedCreditorFinancialInstitution
     *
     * @param  \horstoeko\zugferd\entities\extended\ram\CreditorFinancialInstitutionType $payeeSpecifiedCreditorFinancialInstitution
     */
    public function set_payee_specified_creditor_financial_institution(?\horstoeko\zugferd\entities\extended\ram\Creditor_Financial_Institution_Type $payee_specified_creditor_financial_institution = null): self
    {
        $this->payee_specified_creditor_financial_institution = $payee_specified_creditor_financial_institution;
        return $this;
    }
}