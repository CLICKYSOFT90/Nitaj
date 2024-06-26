<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckInvestmentLimit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $setting;
    public function __construct($setting)
    {
        $this->setting = $setting;
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
        if(auth()->user()->type == 0){
            if($value > $this->setting->regular_limit){
                return false;
            } else{
                return true;
            }
        } else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
