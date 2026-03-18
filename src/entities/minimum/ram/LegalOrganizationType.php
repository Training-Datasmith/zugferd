<?php

namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing LegalOrganizationType
 *
 * XSD Type: LegalOrganizationType
 */
class LegalOrganizationType
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
     *
     * @param  \horstoeko\zugferd\entities\minimum\udt\IDType $iD
     */
    public function setID(?\horstoeko\zugferd\entities\minimum\udt\IDType $iD = null): self
    {
        $this->iD = $iD;
        return $this;
    }
}
