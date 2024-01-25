<?php

namespace AOC\D1\P1;

/**
 * Interface CalibrationValueRetriever
 *
 * @package AOC\D1\P1
 */
interface CalibrationValueRetriever
{
    /**
     * Retrieve the calibration value for the given string input
     *
     * @param string $value
     *
     * @return int
     */
    public function retrieve(string $value): int;
}
