<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class DateTimeSplitCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (empty($value)) {
            return null;
        }

        $carbon = Carbon::parse($value);

        $date = $carbon->format('Y/m/d');     // YYYY/MM/DD
        $time = $carbon->format('h:i A');        // 12h format with colon and AM/PM (e.g. 07:25 PM)
        // $time = str_replace(["AM", "PM"], ["ص", "م"], $time); // Arabic AM/PM replacement to ص/م

        return [
            'date' => $date,
            'time' => $time,
        ];
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
