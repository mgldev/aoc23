<?php

use AOC\D1\P1\CalibrationValueAggregator;
use AOC\D1\P1\Part1ValueRetriever;
use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$input = InputReader::fileToLines(__DIR__ . '/../input.txt');
$total = (new CalibrationValueAggregator($input, new Part1ValueRetriever()))->getTotal();

echo 'Part 1: ' . $total . "\n";