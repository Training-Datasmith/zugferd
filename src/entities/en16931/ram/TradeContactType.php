<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeContactType
 *
 * XSD Type: TradeContactType
 */
class TradeContactType
{
    /**
     * @var string $personName
     */
    private $personName;

    /**
     * @var string $departmentName
     */
    private $departmentName;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $telephoneUniversalCommunication
     */
    private $telephoneUniversalCommunication;

    /**
     * @var \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $emailURIUniversalCommunication
     */
    private $emailURIUniversalCommunication;

    /**
     * Gets as personName
     *
     * @return string
     */
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * Sets a new personName
     *
     * @param  string $personName
     */
    public function setPersonName($personName): self
    {
        $this->personName = $personName;
        return $this;
    }

    /**
     * Gets as departmentName
     *
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * Sets a new departmentName
     *
     * @param  string $departmentName
     */
    public function setDepartmentName($departmentName): self
    {
        $this->departmentName = $departmentName;
        return $this;
    }

    /**
     * Gets as telephoneUniversalCommunication
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType
     */
    public function getTelephoneUniversalCommunication()
    {
        return $this->telephoneUniversalCommunication;
    }

    /**
     * Sets a new telephoneUniversalCommunication
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $telephoneUniversalCommunication
     */
    public function setTelephoneUniversalCommunication(?\horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $telephoneUniversalCommunication = null): self
    {
        $this->telephoneUniversalCommunication = $telephoneUniversalCommunication;
        return $this;
    }

    /**
     * Gets as emailURIUniversalCommunication
     *
     * @return \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType
     */
    public function getEmailURIUniversalCommunication()
    {
        return $this->emailURIUniversalCommunication;
    }

    /**
     * Sets a new emailURIUniversalCommunication
     *
     * @param  \horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $emailURIUniversalCommunication
     */
    public function setEmailURIUniversalCommunication(?\horstoeko\zugferd\entities\en16931\ram\UniversalCommunicationType $emailURIUniversalCommunication = null): self
    {
        $this->emailURIUniversalCommunication = $emailURIUniversalCommunication;
        return $this;
    }
}
