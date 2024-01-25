<?php

namespace AOC\D1\P2;

use AOC\D1\P1\CalibrationValueRetriever;

/**
 * Class Part2ValueRetriever
 *
 * @package AOC\D1\P2
 */
class Part2ValueRetriever implements CalibrationValueRetriever
{
    /** @var string[] */
    private const NUMBER_MAP = [
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine'
    ];

    /**
     * Retrieve the calibration value for part 2
     *
     * "zoneight234" demonstrates why this one is tricky
     *
     * At first glance, a simple solution would seem to be to perform a str_replace of "one" for "1", and "eight" for 8.
     *
     * However replacing "one" for 1 would yield "z1ight234", losing our ability to know "eight" existed
     *
     * This solution performs multiple iterations over a word, starting at position 0 of the string, and looking ahead
     * up to five characters at a time to see if we match a word:
     *
     * Iteration 1, starting position 0:
     *  zonei [NO WORD]
     *
     * Iteration 2, starting position 1:
     *  oneig [CONTAINS "one"]
     *
     * Iteration 3, starting position 2:
     *  neigh [NO WORD]
     *
     * Iteration 4, starting position 3:
     *  eight [CONTAINS "eight"]
     *
     * Each time we find a numeric value, or a word which describes a number, we record the numeric value
     * of the number (8 = 8, "eight" = 8) at the position the number or word started
     *
     * Recording the starting position provides a chronology of matches which facilitates finding the first
     * and last numbers so we can stitch them together for the final number
     *
     * @param string $value    The original calibration value
     */
    public function retrieve(string $value): int
    {
        $foundNumbers = array_fill(0, strlen($value) - 1, []);
        $chars = str_split($value);

        for ($start = 0; $start < strlen($value); $start++) {

            if (is_numeric($chars[$start])) {
                $foundNumbers[$start][] = (int) $chars[$start];
                continue;
            }

            $word = '';

            for ($length = 0; $length < 5; $length++) {
                $index = $start + $length;

                if ($index + 1 > count($chars)) {
                    break;
                }

                $word .= $chars[$index];

                if (in_array($word, self::NUMBER_MAP)) {
                    $foundNumbers[$start][] = array_search($word, self::NUMBER_MAP) + 1;
                }
            }
        }

        $ordered = [];
        foreach ($foundNumbers as $numbers) {
            foreach ($numbers as $number) {
                $ordered[] = $number;
            }
        }

        $first = $ordered[0];
        $count = count($ordered);
        $last =  $count > 1 ? $ordered[$count - 1] : $first;

        return "$first$last";
    }
}
