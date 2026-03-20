<?php

declare (strict_types=1);
namespace horstoeko\zugferd\entities\basic\qdt;

/**
 * Class representing FormattedDateTimeType
 *
 * XSD Type: FormattedDateTimeType
 */
class Formatted_Date_Time_Type
{
    /**
     * @var \horstoeko\zugferd\entities\basic\qdt\FormattedDateTimeType\DateTimeStringAType $dateTimeString
     */
    private $date_time_string;
    /**
     * Gets as dateTimeString
     *
     * @return \horstoeko\zugferd\entities\basic\qdt\FormattedDateTimeType\DateTimeStringAType
     */
    public function get_date_time_string()
    {
        return $this->date_time_string;
    }
    /**
     * Sets a new dateTimeString
     */
    public function set_date_time_string(\horstoeko\zugferd\entities\basic\qdt\Formatted_Date_Time_Type\Date_Time_String_A_Type $date_time_string): self
    {
        $this->date_time_string = $date_time_string;
        return $this;
    }
}