<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailDomain implements ValidationRule
{
    /**
     * The allowed email domain.
     *
     * @var string
     */
    protected $domain;

    /**
     * Create a new rule instance.
     *
     * @param  string  $domain
     * @return void
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (substr($value, -strlen($this->domain)) !== $this->domain) {
            $fail('The :attribute must be a valid email address from '.$this->domain.'.');
        }
    }
}
