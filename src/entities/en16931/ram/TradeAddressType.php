<?php

namespace horstoeko\zugferd\entities\en16931\ram;

/**
 * Class representing TradeAddressType
 *
 * XSD Type: TradeAddressType
 */
class TradeAddressType
{

    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\CodeType $postcodeCode
     */
    private $postcodeCode;

    /**
     * @var string $lineOne
     */
    private $lineOne;

    /**
     * @var string $lineTwo
     */
    private $lineTwo;

    /**
     * @var string $lineThree
     */
    private $lineThree;

    /**
     * @var string $cityName
     */
    private $cityName;

    /**
     * @var string $countryID
     */
    private $countryID;

    /**
     * @var string $countrySubDivisionName
     */
    private $countrySubDivisionName;

    /**
     * Gets as postcodeCode
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\CodeType
     */
    public function getPostcodeCode()
    {
        return $this->postcodeCode;
    }

    /**
     * Sets a new postcodeCode
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\CodeType $postcodeCode
     */
    public function setPostcodeCode(?\horstoeko\zugferd\entities\en16931\udt\CodeType $postcodeCode = null): self
    {
        $this->postcodeCode = $postcodeCode;
        return $this;
    }

    /**
     * Gets as lineOne
     *
     * @return string
     */
    public function getLineOne()
    {
        return $this->lineOne;
    }

    /**
     * Sets a new lineOne
     *
     * @param  string $lineOne
     */
    public function setLineOne($lineOne): self
    {
        $this->lineOne = $lineOne;
        return $this;
    }

    /**
     * Gets as lineTwo
     *
     * @return string
     */
    public function getLineTwo()
    {
        return $this->lineTwo;
    }

    /**
     * Sets a new lineTwo
     *
     * @param  string $lineTwo
     */
    public function setLineTwo($lineTwo): self
    {
        $this->lineTwo = $lineTwo;
        return $this;
    }

    /**
     * Gets as lineThree
     *
     * @return string
     */
    public function getLineThree()
    {
        return $this->lineThree;
    }

    /**
     * Sets a new lineThree
     *
     * @param  string $lineThree
     */
    public function setLineThree($lineThree): self
    {
        $this->lineThree = $lineThree;
        return $this;
    }

    /**
     * Gets as cityName
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Sets a new cityName
     *
     * @param  string $cityName
     */
    public function setCityName($cityName): self
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * Gets as countryID
     *
     * @return string
     */
    public function getCountryID()
    {
        return $this->countryID;
    }

    /**
     * Sets a new countryID
     *
     * @param  string $countryID
     */
    public function setCountryID($countryID): self
    {
        $this->countryID = $countryID;
        return $this;
    }

    /**
     * Gets as countrySubDivisionName
     *
     * @return string
     */
    public function getCountrySubDivisionName()
    {
        return $this->countrySubDivisionName;
    }

    /**
     * Sets a new countrySubDivisionName
     *
     * @param  string $countrySubDivisionName
     */
    public function setCountrySubDivisionName($countrySubDivisionName): self
    {
        $this->countrySubDivisionName = $countrySubDivisionName;
        return $this;
    }
}
