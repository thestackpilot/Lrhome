<?php

function formatKey ($key) {
    $result = preg_replace('/([A-Z|0-9])/', ' $1', $key);
    $result = trim($result);
    $result = str_replace('_', ' ', $result);
    return ucfirst(preg_replace('/([A-Z])\s(?=[A-Z])/', '$1', $result));
}
