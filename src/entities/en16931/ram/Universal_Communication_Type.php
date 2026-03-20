<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing UniversalCommunicationType
 *
 * XSD Type: UniversalCommunicationType
 */
class Universal_Communication_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\IDType $uRIID
     */
    private $u_riid;
    /**
     * @var string $completeNumber
     */
    private $complete_number;
    /**
     * Gets as uRIID
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\IDType
     */
    public function get_uriid()
    {
        return $this->u_riid;
    }
    /**
     * Sets a new uRIID
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\IDType $uRIID
     */
    public function set_uriid(?\horstoeko\zugferd\entities\en16931\udt\Id_Type $u_riid = null): self
    {
        $this->u_riid = $u_riid;
        return $this;
    }
    /**
     * Gets as completeNumber
     *
     * @return string
     */
    public function get_complete_number()
    {
        return $this->complete_number;
    }
    /**
     * Sets a new completeNumber
     *
     * @param  string $completeNumber
     */
    public function set_complete_number($complete_number): self
    {
        $this->complete_number = $complete_number;
        return $this;
    }
}