<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\extended\ram;

/**
 * Class representing TradeAddressType
 *
 * XSD Type: TradeAddressType
 */
class Trade_Address_Type
{
    /**
     * @var \horstoeko\zugferd\entities\extended\udt\CodeType $postcodeCode
     */
    private $postcode_code;
    /**
     * @var string $lineOne
     */
    private $line_one;
    /**
     * @var string $lineTwo
     */
    private $line_two;
    /**
     * @var string $lineThree
     */
    private $line_three;
    /**
     * @var string $cityName
     */
    private $city_name;
    /**
     * @var string $countryID
     */
    private $country_id;
    /**
     * @var string $countrySubDivisionName
     */
    private $country_sub_division_name;
    /**
     * Gets as postcodeCode
     *
     * @return \horstoeko\zugferd\entities\extended\udt\CodeType
     */
    public function get_postcode_code()
    {
        return $this->postcode_code;
    }
    /**
     * Sets a new postcodeCode
     *
     * @param  \horstoeko\zugferd\entities\extended\udt\CodeType $postcodeCode
     */
    public function set_postcode_code(?\horstoeko\zugferd\entities\extended\udt\Code_Type $postcode_code = null): self
    {
        $this->postcode_code = $postcode_code;
        return $this;
    }
    /**
     * Gets as lineOne
     *
     * @return string
     */
    public function get_line_one()
    {
        return $this->line_one;
    }
    /**
     * Sets a new lineOne
     *
     * @param  string $lineOne
     */
    public function set_line_one($line_one): self
    {
        $this->line_one = $line_one;
        return $this;
    }
    /**
     * Gets as lineTwo
     *
     * @return string
     */
    public function get_line_two()
    {
        return $this->line_two;
    }
    /**
     * Sets a new lineTwo
     *
     * @param  string $lineTwo
     */
    public function set_line_two($line_two): self
    {
        $this->line_two = $line_two;
        return $this;
    }
    /**
     * Gets as lineThree
     *
     * @return string
     */
    public function get_line_three()
    {
        return $this->line_three;
    }
    /**
     * Sets a new lineThree
     *
     * @param  string $lineThree
     */
    public function set_line_three($line_three): self
    {
        $this->line_three = $line_three;
        return $this;
    }
    /**
     * Gets as cityName
     *
     * @return string
     */
    public function get_city_name()
    {
        return $this->city_name;
    }
    /**
     * Sets a new cityName
     *
     * @param  string $cityName
     */
    public function set_city_name($city_name): self
    {
        $this->city_name = $city_name;
        return $this;
    }
    /**
     * Gets as countryID
     *
     * @return string
     */
    public function get_country_id()
    {
        return $this->country_id;
    }
    /**
     * Sets a new countryID
     *
     * @param  string $countryID
     */
    public function set_country_id($country_id): self
    {
        $this->country_id = $country_id;
        return $this;
    }
    /**
     * Gets as countrySubDivisionName
     *
     * @return string
     */
    public function get_country_sub_division_name()
    {
        return $this->country_sub_division_name;
    }
    /**
     * Sets a new countrySubDivisionName
     *
     * @param  string $countrySubDivisionName
     */
    public function set_country_sub_division_name($country_sub_division_name): self
    {
        $this->country_sub_division_name = $country_sub_division_name;
        return $this;
    }
}