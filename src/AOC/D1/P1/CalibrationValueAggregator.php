<?php

namespace AOC\D1\P1;

/**
 * Class CalibrationValueAggregator
 *
 * @package AOC\D1\P1
 */
class CalibrationValueAggregator
{
    /**
     * Construct
     *
     * @param array $values
     * @param CalibrationValueRetriever $retriever
     */
    public function __construct(
        private array $values,
        private CalibrationValueRetriever $retriever
    ) {}

    /**
     * @return int
     */
    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->values as $value) {
            $total += $this->retriever->retrieve($value);
        }

        return $total;
    }
}
