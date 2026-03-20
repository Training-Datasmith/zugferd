<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeContactType
 *
 * XSD Type: TradeContactType
 */
class Trade_Contact_Type
{
    /**
     * @var string $personName
     */
    private $person_name;
    /**
     * @var string $departmentName
     */
    private $department_name;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $telephoneUniversalCommunication
     */
    private $telephone_universal_communication;
    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $emailURIUniversalCommunication
     */
    private $email_uri_universal_communication;
    /**
     * Gets as personName
     *
     * @return string
     */
    public function get_person_name()
    {
        return $this->person_name;
    }
    /**
     * Sets a new personName
     *
     * @param  string $personName
     */
    public function set_person_name($person_name): self
    {
        $this->person_name = $person_name;
        return $this;
    }
    /**
     * Gets as departmentName
     *
     * @return string
     */
    public function get_department_name()
    {
        return $this->department_name;
    }
    /**
     * Sets a new departmentName
     *
     * @param  string $departmentName
     */
    public function set_department_name($department_name): self
    {
        $this->department_name = $department_name;
        return $this;
    }
    /**
     * Gets as telephoneUniversalCommunication
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType
     */
    public function get_telephone_universal_communication()
    {
        return $this->telephone_universal_communication;
    }
    /**
     * Sets a new telephoneUniversalCommunication
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $telephoneUniversalCommunication
     */
    public function set_telephone_universal_communication(?\horstoeko\zugferd\entities\en16931\ram\Universal_Communication_Type $telephone_universal_communication = null): self
    {
        $this->telephone_universal_communication = $telephone_universal_communication;
        return $this;
    }
    /**
     * Gets as emailURIUniversalCommunication
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType
     */
    public function get_email_uri_universal_communication()
    {
        return $this->email_uri_universal_communication;
    }
    /**
     * Sets a new emailURIUniversalCommunication
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $emailURIUniversalCommunication
     */
    public function set_email_uri_universal_communication(?\horstoeko\zugferd\entities\en16931\ram\Universal_Communication_Type $email_uri_universal_communication = null): self
    {
        $this->email_uri_universal_communication = $email_uri_universal_communication;
        return $this;
    }
}