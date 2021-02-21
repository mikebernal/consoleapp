<?php

/**
 * publishPost function
 *
 * @param [string] $publish
 * @return 1 or 1 integer
 */
function publishPost($publish) {
    if (strtolower($publish) === 'y') {
       return 1;
    } else {
        return 0;
    }
}

/**
 * displayBool function
 *
 * @param [string] $publish
 * @return string for display only
 */
function displayBool($publish) {
    if ($publish === 1) {
       return "true";
    } else {
        return "false";
    }
}

/**
 * excerpt function
 *
 * @param [string] $body
 * @return string shorten version of the body text
 */
function excerpt($body) {
    if (strlen($body) > 100) {
        return substr($body, 0, 100) . "...";
    } else {
        return $body;
    }
}

/**
 * checkVal function
 *
 * @param [string] $val
 * @param [string] $currentVal
 * @return $val or $currentVal
 */
function checkVal($val, $currentVal) {
    if (empty($val)) {
      return $currentVal;
    } else {
        return $val;
    }
}