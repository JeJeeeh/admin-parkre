<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidHour implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $end_hour;
    private $end_minute;
    private $start_minute;
    private $start_ampm;
    private $end_ampm;
    public function __construct($end_hour, $end_minute, $start_minute, $start_ampm, $end_ampm)
    {
        $this->end_hour = $end_hour;
        $this->end_minute = $end_minute;
        $this->start_minute = $start_minute;
        $this->start_ampm = $start_ampm;
        $this->end_ampm = $end_ampm;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $start_hour = $value;
        $start_minute = $this->start_minute;
        $end_hour = $this->end_hour;
        $end_minute = $this->end_minute;

        if ($this->start_ampm == 'pm') {
            $start_hour += 12;
        }
        if ($this->end_ampm == 'pm') {
            $end_hour += 12;
        }

        if ($start_hour > $end_hour) {
            return false;
        } else if ($start_hour == $end_hour) {
            if ($start_minute >= $end_minute) {
                return false;
            }
        } else if ($end_hour - $start_hour < 1) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Start time must be less than end time or at least 1 hour.';
    }
}
