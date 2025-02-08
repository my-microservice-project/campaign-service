<?php

namespace App\Traits;

trait EnumTrait
{
    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public static function allCaseValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
