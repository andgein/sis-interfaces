<?php

define('TEMPLATES_FOLDER', 'templates/');
define('ASSETS_BASE_URL', '/assets');
    
function ejudge_contest_url($contest_id) {
    // TODO
    return 'EJUDGE-CONTEST-LINK?contest=' . $contest_id;
}

function ejudge_results_url($contest_id) {
    // TODO
    return 'EJUDGE-RESULTS-LINK?contest=' . $contest_id;
}

function replace_html_values_in_array($array, $ignore_keys=[]) {
    $result = [];

    foreach ($array as $key => $value) {
        if (! in_array($key, $ignore_keys)) {
            if (! ends_with($key, '.html')) {
                if (is_string($value))
                    $value = htmlspecialchars($value);
            }
            else
                $key = substr($key, 0, strlen($key) - strlen('.html'));
        }

        $result[$key] = $value;
    }

    return $result;
}

function ends_with($string, $needle) {
    if (strlen($string) < strlen($needle))
        return false;

    if (strlen($needle) == 0)
        return true;

    return substr($string, -strlen($needle)) === $needle;
}

function template($template_file, $variables) {
    return _template($template_file, replace_html_values_in_array($variables));
}

function _template($__template_file, $__variables)
{
    foreach ($__variables as $__key => $__value)
        $$__key = $__value;

    ob_start();
    include(TEMPLATES_FOLDER . $__template_file);
    return ob_get_clean();
}

function set_default_value(&$array, $key, $default_value) {
    if (! array_key_exists($key, $array))
        $array[$key] = $default_value;
}