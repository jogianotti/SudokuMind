<?php declare(strict_types=1);

namespace SudokuMind;

final class Cell
{
    private array $posibleNumbers;
    private int $number = 0;
    private bool $original = false;

    public function __construct()
    {
        $numbers = array();
        for ($i = 1; $i <= 9; $i++) {
            $numbers[] = $i;
        }

        $this->posibleNumbers = $numbers;
    }

    public function writeOriginal(int $num)
    {
        $this->write($num);
        $this->setOriginal();
    }

    public function write(int $num)
    {
        if ($this->isOriginal()) {
            return;
        }

        $this->number = $num;
        $this->posibleNumbers = [];
    }

    private function isOriginal(): bool
    {
        return $this->original;
    }

    private function setOriginal(): void
    {
        $this->original = true;
    }

    public function subtract(int $num): void
    {
        unset($this->posibleNumbers[$num - 1]);
    }

    public function number(): int
    {
        return $this->number;
    }

    public function print(): void
    {
        $format = '[0m';
        $number = $this->number;

        if ($this->original) {
            $format = '[1;30;42m';
        } elseif ($this->number != 0) {
            $format = '[1;30;47m';
        } elseif (count($this->posibleNumbers) === 1) {
            $format = '[1;30;41m';
            $number = array_values($this->posibleNumbers)[0];
        }

        echo "\033$format $number \033[0m";
    }
}
