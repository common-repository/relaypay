<?php

namespace RelayPayDeps;

// Don't redefine the functions if included multiple times.
if (!\function_exists('RelayPayDeps\\GuzzleHttp\\Psr7\\str')) {
    require __DIR__ . '/functions.php';
}
