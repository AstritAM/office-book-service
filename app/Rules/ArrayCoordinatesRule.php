<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ArrayCoordinatesRule implements Rule
{
    public const COUNT_COORDINATE = 2;

    public function __construct()
    {
    }

    public function isAllIntegers(array $array): bool
    {
        foreach ($array as $element) {
            if (!is_int($element)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!is_array($value)) {
            return false;
        }

        foreach ($value as $point) {
            if (!is_array($point) || count($point) != self::COUNT_COORDINATE || !$this->isAllIntegers($point)) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'Incorrect array format';
    }
}
