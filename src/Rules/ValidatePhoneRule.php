<?php

namespace AleksandroDelPiero\ValidatePhone\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;


class ValidatePhoneRule implements ValidationRule
{
    protected $validatePhoneMessage;

    public function __construct($validatePhoneMessage)
    {
        $this->validatePhoneMessage = $validatePhoneMessage;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regularExpression = config('validate_phone.regular_expression');

        preg_match($regularExpression, $value, $matches);

        if(count($matches) == 0) {
            $fail($this->validatePhoneMessage);
        }
    }
}
