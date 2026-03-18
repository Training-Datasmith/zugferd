<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing DocumentContextParameterType
 *
 * XSD Type: DocumentContextParameterType
 */
class DocumentContextParameterType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\extended\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\extended\udt\IDType $iD): self
    {
        $this->iD = $iD;
        return $this;
    }
}
