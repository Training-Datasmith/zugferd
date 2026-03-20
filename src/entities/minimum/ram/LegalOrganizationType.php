<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\minimum\ram;

/**
 * Class representing LegalOrganizationType
 *
 * XSD Type: LegalOrganizationType
 */
class Legal_Organization_Type
{
    /**
     * @var \horstoeko\zugferd\entities\minimum\udt\IDType $iD
     */
    private $i_d;
    /**
     * Gets as iD
     *
     * @return \horstoeko\zugferd\entities\minimum\udt\IDType
     */
    public function get_id()
    {
        return $this->i_d;
    }
    /**
     * Sets a new iD
     *
     * @param  \horstoeko\zugferd\entities\minimum\udt\IDType $iD
     */
    public function set_id(?\horstoeko\zugferd\entities\minimum\udt\Id_Type $i_d = null): self
    {
        $this->i_d = $i_d;
        return $this;
    }
}