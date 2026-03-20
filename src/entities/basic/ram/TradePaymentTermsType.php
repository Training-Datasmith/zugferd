<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradePaymentTermsType
 *
 * XSD Type: TradePaymentTermsType
 */
class Trade_Payment_Terms_Type
{
    /**
     * @var string $description
     */
    private $description;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\DateTimeType $dueDateDateTime
     */
    private $due_date_date_time;
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $directDebitMandateID
     */
    private $direct_debit_mandate_id;
    /**
     * Gets as description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->description;
    }
    /**
     * Sets a new description
     *
     * @param  string $description
     */
    public function set_description($description): self
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Gets as dueDateDateTime
     *
     * @return \horstoeko\zugferd\entities\basic\udt\DateTimeType
     */
    public function get_due_date_date_time()
    {
        return $this->due_date_date_time;
    }
    /**
     * Sets a new dueDateDateTime
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\DateTimeType $dueDateDateTime
     */
    public function set_due_date_date_time(?\horstoeko\zugferd\entities\basic\udt\Date_Time_Type $due_date_date_time = null): self
    {
        $this->due_date_date_time = $due_date_date_time;
        return $this;
    }
    /**
     * Gets as directDebitMandateID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_direct_debit_mandate_id()
    {
        return $this->direct_debit_mandate_id;
    }
    /**
     * Sets a new directDebitMandateID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $directDebitMandateID
     */
    public function set_direct_debit_mandate_id(?\horstoeko\zugferd\entities\basic\udt\Id_Type $direct_debit_mandate_id = null): self
    {
        $this->direct_debit_mandate_id = $direct_debit_mandate_id;
        return $this;
    }
}