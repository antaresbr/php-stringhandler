<?php

if (!function_exists('stringhandler_infos')) {
    /**
     * Get package infos.
     *
     * @return array
     */
    function stringhandler_infos()
    {
        return json_decode(file_get_contents(stringhandler_path('support/infos.json')));
    }
}

if (!function_exists('stringhandler_path')) {
    /**
     * Return the path of the resource relative to the package
     *
     * @param string $resource
     * @return string
     */
    function stringhandler_path($resource = null)
    {
        if (!empty($resource) and substr($resource, 0, 1) != DIRECTORY_SEPARATOR) {
            $resource = DIRECTORY_SEPARATOR . $resource;
        }
        return dirname(__DIR__) . $resource;
    }
}
