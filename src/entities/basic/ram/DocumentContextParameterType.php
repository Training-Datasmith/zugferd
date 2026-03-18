<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing DocumentContextParameterType
 *
 * XSD Type: DocumentContextParameterType
 */
class DocumentContextParameterType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $iD
     */
    private $iD;

    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getID()
    {
        return $this->iD;
    }

    /**
     * Sets a new iD
     */
    public function setID(\horstoeko\zugferd\entities\basic\udt\IDType $iD): self
    {
        $this->iD = $iD;
        return $this;
    }
}
