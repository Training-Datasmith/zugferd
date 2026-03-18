<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TaxRegistrationType
 *
 * XSD Type: TaxRegistrationType
 */
class TaxRegistrationType
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $iD
     */
    private $iD;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\en16931\udt\IDType $iD): self
    {
        $this->iD = $iD;
        return $this;
    }
}
