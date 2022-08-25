<?php

namespace Mav\Optimacros;

require '../vendor/autoload.php';

$input = $argv[1] ?? 'input.csv';
$output = $argv[2] ?? 'output.json';

new Handler($input,$output);
