<?php

namespace Antares\Support;

use voku\helper\ASCII;

class Str
{
    /**
     * Transliterate a UTF-8 value to ASCII.
     *
     * @param  string  $value
     * @param  string  $language
     * @return string
     */
    public static function ascii($value, $language = 'en')
    {
        return ASCII::to_ascii((string) $value, $language);
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|string[]  $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * Cap a string with a single instance of a given value.
     *
     * @param  string  $value
     * @param  string  $cap
     * @return string
     */
    public static function finish($value, $cap)
    {
        $quoted = preg_quote($cap, '/');

        return preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
    }

    /**
     * Case sensitive check if a target string is in a list of strings
     * @param string $target Text to separate strings
     * @param string $list,... unlimited strings to search in
     * @return boolean The result
     */
    public static function csIn($target, $list)
    {
        return static::in(true, ...func_get_args());
    }

    /**
     * Insensitive case check if a target string is in a list of strings
     * @param string $target Text to separate strings
     * @param string $list,... unlimited strings to search in
     * @return boolean The result
     */
    public static function icIn($target, $list)
    {
        return static::in(false, ...func_get_args());
    }

    /**
     * Check if a target string is in a list of strings
     * @param bool $caseSensitive Case sensitive flag
     * @param string $target Text to separate strings
     * @param string $list,... unlimited strings to search in
     * @return boolean The result
     */
    public static function in(bool $caseSensitive, string $target, $list)
    {
        if (!$caseSensitive) {
            $target = strtolower($target);
        }

        $args = func_get_args();
        $argsCount = count($args);
        for ($i = 2; $i < $argsCount; $i++) {
            if ($target == $args[$i] or (!$caseSensitive and $target == strtolower($args[$i]))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string is 7 bit ASCII.
     *
     * @param  string  $value
     * @return bool
     */
    public static function isAscii($value)
    {
        return ASCII::is_ascii((string) $value);
    }

    /**
     * Join strings with a glue
     * @param string $glue Text to separate strings
     * @param string $pieces,... unlimited pieces of the final text
     * @return string The result string
     */
    public static function join($glue, $pieces)
    {
        $args = func_get_args();
        $result = '';
        $argsCount = count($args);
        for ($i = 1; $i < $argsCount; $i++) {
            if (trim($args[$i]) != '') {
                if (!empty($result)) {
                    $result .= $glue;
                }
                $result .= $args[$i];
            }
        }
        return $result;
    }

    /**
     * Return the length of the given string.
     *
     * @param  string  $value
     * @param  string|null  $encoding
     * @return int
     */
    public static function length($value, $encoding = null)
    {
        if ($encoding) {
            return mb_strlen($value, $encoding);
        }

        return mb_strlen($value);
    }

    /**
     * Convert the given string to lower-case.
     *
     * @param  string  $value
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Return a single quoted text
     * @param string $text Tet to be quoted
     * @param bool $force Flag to force wrap even if it is already wrapped
     * @return string The result string
     */
    public static function quoted($text, $force = false)
    {
        return static::wrap($text, "'", $force);
    }

    /**
     * Return a double quoted text
     * @param string $text Tet to be double quoted
     * @param bool $force Flag to force wrap even if it is already wrapped
     * @return string The result string
     */
    public static function quoted2($text, $force = false)
    {
        return static::wrap($text, '"', $force);
    }

    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     */
    public static function random($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }

    /**
     * Replace the first occurrence of a given value in the string.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $subject
     * @return string
     */
    public static function replaceFirst($search, $replace, $subject)
    {
        if ($search == '') {
            return $subject;
        }

        $position = strpos($subject, $search);

        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }

        return $subject;
    }

    /**
     * Replace the last occurrence of a given value in the string.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $subject
     * @return string
     */
    public static function replaceLast($search, $replace, $subject)
    {
        $position = strrpos($subject, $search);

        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }

        return $subject;
    }

    /**
     * Sensitive case check if a target string is in a list of strings
     * @param string $target Text to separate strings
     * @param string $list,... unlimited strings to search in
     * @return boolean The result
     */
    public static function scIn($target, $list)
    {
        return static::in(true, ...func_get_args());
    }

    /**
     * Begin a string with a single instance of a given value.
     *
     * @param  string  $value
     * @param  string  $prefix
     * @return string
     */
    public static function start($value, $prefix)
    {
        $quoted = preg_quote($prefix, '/');

        return $prefix . preg_replace('/^(?:' . $quoted . ')+/u', '', $value);
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|string[]  $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the portion of string specified by the start and length parameters.
     *
     * @param  string  $string
     * @param  int  $start
     * @param  int|null  $length
     * @return string
     */
    public static function substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * Make a string's first character uppercase.
     *
     * @param  string  $string
     * @return string
     */
    public static function ucfirst($string)
    {
        return static::upper(static::substr($string, 0, 1)) . static::substr($string, 1);
    }

    /**
     * Convert the given string to upper-case.
     *
     * @param  string  $value
     * @return string
     */
    public static function upper($value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * Return a wrapped text
     * @param string $text Text to be wrapped
     * @param bool $force Flag to force wrap even if it is already wrapped
     * @return string The result string
     */
    public static function wrap($text, $wrap, $force = false)
    {
        $r = ($force or !static::startsWith($text, $wrap)) ? $wrap : '';
        $r .= $text;
        $r .= ($force or !static::endsWith($text, $wrap)) ? $wrap : '';
        return $r;
    }
}
