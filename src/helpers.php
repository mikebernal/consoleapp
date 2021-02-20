<?php

function publishPost($publish) {
    if (strtolower($publish) === 'y') {
       return 1;
    }

    return 0;
}

function excerpt($body) {
    if (strlen($body) > 100) {
        return substr($body, 0, 100) . "...";
    }

    return $body;
}