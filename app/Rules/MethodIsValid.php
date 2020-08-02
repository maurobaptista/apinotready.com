<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MethodIsValid implements Rule
{
    public function validate()
    {
        return false;
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
        $methods = config('endpoint.methods');

        return in_array(strtoupper($value), $methods);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is invalid';
    }
}
