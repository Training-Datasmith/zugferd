<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing UniversalCommunicationType
 *
 * XSD Type: UniversalCommunicationType
 */
class Universal_Communication_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $uRIID
     */
    private $u_riid;
    /**
     * Gets as uRIID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function get_uriid()
    {
        return $this->u_riid;
    }
    /**
     * Sets a new uRIID
     */
    public function set_uriid(\horstoeko\zugferd\entities\basic\udt\Id_Type $u_riid): self
    {
        $this->u_riid = $u_riid;
        return $this;
    }
}