<?php

if (! function_exists('concat_uri')) {
    /**
     * Concatenates paths to an absolute uri with management
     * Returns a uri without a trailing slash
     * Manages prefix and trailing slashes
     * Output ex. http://volumes/hello
     *
     * @param null|string ...$paths
     *
     * @return string
     */
    function concat_uri(?string ...$paths)
    {
        return concat_uri_array($paths);
    }
}

if (! function_exists('concat_uri_array')) {
    /**
     * @param array $paths
     *
     * @return false|mixed|string
     */
    function concat_uri_array(array $paths)
    {
        $SEPARATOR = '/';
        $result = '';

        foreach ($paths as $path) {
            while (substr($path, -1) == $SEPARATOR) { // remove all trailing slashes
                $path = substr($path, 0, -1);
            }

            while (substr($path, 0, 1) == $SEPARATOR) { // remove all prefix slashes
                $path = substr($path, 1);
            }

            if ($result === '') { // First/empty result
                $result = $path;
            } else { // Concatenate the next
                $result .= $SEPARATOR . $path;
            }
        }

        return $result;
    }
}
