<?php declare(strict_types=1);

namespace SudokuMind;

final class Square
{
    private array $cells;

    public function write(int $x, int $y, int $num): void
    {
        $cell = $this->findCell($x, $y);

        $cell->write($num);
        $this->subtract($num);
    }

    private function findCell(int $x, int $y): Cell
    {
        $key = ($y - 1) * 3 + $x - 1;

        return $this->cells[$key];
    }

    private function subtract(int $num): void
    {
        foreach ($this->cells as $cell) {
            $cell->subtract($num);
        }
    }

    public function add(Cell $cell): void
    {
        $this->cells[] = $cell;
    }

    public function writeOriginal(int $x, int $y, int $num)
    {
        $cell = $this->findCell($x, $y);

        $cell->writeOriginal($num);
        $this->subtract($num);
    }
}
