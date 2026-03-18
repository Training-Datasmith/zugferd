<?php

declare(strict_types=1);

namespace horstoeko\zugferd\entities\basic\ram;

/**
 * Class representing TradeProductType
 *
 * XSD Type: TradeProductType
 */
class TradeProductType
{
    /**
     * @var \horstoeko\zugferd\entities\basic\udt\IDType $globalID
     */
    private $globalID;

    /**
     * @var string $name
     */
    private $name;

    /**
     * Gets as globalID
     *
     * @return \horstoeko\zugferd\entities\basic\udt\IDType
     */
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * Sets a new globalID
     *
     * @param  \horstoeko\zugferd\entities\basic\udt\IDType $globalID
     */
    public function setGlobalID(?\horstoeko\zugferd\entities\basic\udt\IDType $globalID = null): self
    {
        $this->globalID = $globalID;
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
