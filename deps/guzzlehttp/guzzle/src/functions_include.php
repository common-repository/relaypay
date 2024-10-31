<?php

namespace RelayPayDeps;

// Don't redefine the functions if included multiple times.
if (!\function_exists('RelayPayDeps\\GuzzleHttp\\uri_template')) {
    require __DIR__ . '/functions.php';
}
