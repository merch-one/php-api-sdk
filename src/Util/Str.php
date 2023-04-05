<?php

namespace MerchOne\PhpApiSdk\Util;

final class Str
{
    /**
     * @param  string  $value
     * @return string
     */
    public static function title(string $value): string
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @param  string  $value
     * @return string
     */
    public static function lower(string $value): string
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * @param  string  $haystack
     * @param $needles
     * @return bool
     */
    public static function startsWith(string $haystack, $needles): bool
    {
        if (! is_iterable($needles)) {
            $needles = [$needles];
        }

        foreach ((array) $needles as $needle) {
            if ((string) $needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  string  $value
     * @param  string  $delimiter
     * @return mixed|string
     */
    public static function snake(string $value, string $delimiter = '_')
    {
        static $snakeCache = [];
        $key = $value;

        if (isset($snakeCache[$key][$delimiter])) {
            return $snakeCache[$key][$delimiter];
        }

        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = self::lower(
                preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $value)
            );
        }

        return $snakeCache[$key][$delimiter] = $value;
    }

    /**
     * @param  string  $value
     * @param $encoding
     * @return false|int
     */
    public static function length(string $value, $encoding = null)
    {
        if ($encoding) {
            return mb_strlen($value, $encoding);
        }

        return mb_strlen($value);
    }

    /**
     * @param $haystack
     * @param $needles
     * @return bool
     */
    public static function contains($haystack, $needles): bool
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}
