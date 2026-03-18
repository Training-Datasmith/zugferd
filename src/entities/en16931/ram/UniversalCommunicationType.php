<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing UniversalCommunicationType
 *
 * XSD Type: UniversalCommunicationType
 */
class UniversalCommunicationType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $uRIID
     */
    private $uRIID;

    /**
     * @var string $completeNumber
     */
    private $completeNumber;

    /**
     * Gets as uRIID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getURIID()
    {
        return $this->uRIID;
    }

    /**
     * Sets a new uRIID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $uRIID
     */
    public function setURIID(?\horstoeko\zugferd\entities\en16931\udt\IDType $uRIID = null): self
    {
        $this->uRIID = $uRIID;
        return $this;
    }

    /**
     * Gets as completeNumber
     *
     * @return string
     */
    public function getCompleteNumber()
    {
        return $this->completeNumber;
    }

    /**
     * Sets a new completeNumber
     *
     * @param  string $completeNumber
     */
    public function setCompleteNumber($completeNumber): self
    {
        $this->completeNumber = $completeNumber;
        return $this;
    }
}
