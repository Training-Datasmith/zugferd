<?php

namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing ProcuringProjectType
 *
 * XSD Type: ProcuringProjectType
 */
class ProcuringProjectType
{

    /**
     * @var \horstoeko\zugferd\entities\extended\udt\IDType $iD
     */
    private $iD;

    /**
     * @var string $name
     */
    private $name;

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

    /**
     * Gets as name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name
     *
     * @param  string $name
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }
}
