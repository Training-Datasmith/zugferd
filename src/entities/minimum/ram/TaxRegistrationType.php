<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing TaxRegistrationType
 *
 * XSD Type: TaxRegistrationType
 */
class TaxRegistrationType
{

    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\IDType $iD
     */
    private $iD;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\minimum\udt\IDType $iD): self
    {
        $this->iD = $iD;
        return $this;
    }
}
