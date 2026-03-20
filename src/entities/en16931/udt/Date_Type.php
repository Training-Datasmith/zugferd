<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\en16931\udt;

/**
 * Class representing DateType
 *
 * XSD Type: DateType
 */
class Date_Type
{
    /**
     * @var \horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType $dateString
     */
    private $date_string;
    /**
     * Gets as dateString
     *
     * @return \horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType
     */
    public function get_date_string()
    {
        return $this->date_string;
    }
    /**
     * Sets a new dateString
     *
     * @param  \horstoeko\zugferd\entities\en16931\udt\DateType\DateStringAType $dateString
     */
    public function set_date_string(?\horstoeko\zugferd\entities\en16931\udt\Date_Type\Date_String_A_Type $date_string = null): self
    {
        $this->date_string = $date_string;
        return $this;
    }
}