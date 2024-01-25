<?php

namespace AOC\D1\P1;

/**
 * Class Part1ValueRetriever
 *
 * @package AOC\D1\P1
 */
class Part1ValueRetriever implements CalibrationValueRetriever
{
    /**
     * @param string $value
     *
     * @return int
     */
    public function retrieve(string $value): int
    {
        $matches = [];
        preg_match_all('/\d+/', $value, $matches);
        $numbers = array_map(fn (string $number) => (int) $number, str_split(implode($matches[0])));
        $first = $numbers[0];
        $count = count($numbers);
        $last =  $count > 1 ? $numbers[$count - 1] : $first;

        return (int) "$first$last";
    }
}
