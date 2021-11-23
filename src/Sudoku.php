<?php declare(strict_types=1);

namespace SudokuMind;

final class Sudoku
{
    private array $squares;
    private array $columns;
    private array $rows;

    public function __construct()
    {
        for ($i = 0; $i <= 8; $i++) {
            $this->squares[] = new Square();
        }

        for ($y = 0; $y <= 8; $y++) {
            for ($x = 0; $x <= 8; $x++) {
                $cell = new Cell();

                $this->addToColumn($x, $cell);
                $this->addToRow($y, $cell);
                $this->addToSquare($x, $y, $cell);
            }
        }
    }

    private function addToColumn(int $x, Cell $cell): void
    {
        $this->columns[$x][] = $cell;
    }

    private function addToRow(int $y, Cell $cell): void
    {
        $this->rows[$y][] = $cell;
    }

    private function addToSquare(int $x, int $y, Cell $cell): void
    {
        $square = $this->findSquare($x+1, $y+1);
        $square->add($cell);
    }

    private function findSquare(int $x, int $y): Square
    {
        $key = (int)(($y - 1) / 3) * 3 + (int)(($x - 1) / 3);

        return $this->squares[$key];
    }

    public function write(int $x, int $y, int $num)
    {
        $square = $this->findSquare($x, $y);

        $square->write($x % 3 ?: 3, $y % 3 ?: 3, $num);

        $this->subtract($x, $y, $num);
    }

    private function subtract(int $x, int $y, int $num): void
    {
        $this->subtractForRow($y, $num);
        $this->subtractForColumn($x, $num);
    }

    private function subtractForRow(int $y, int $num): void
    {
        $cells = $this->rows[--$y];

        foreach ($cells as $cell) {
            $cell->subtract($num);
        }
    }

    private function subtractForColumn(int $x, int $num): void
    {
        $cells = $this->columns[--$x];

        foreach ($cells as $cell) {
            $cell->subtract($num);
        }
    }

    public function print()
    {
        for($i = 0; $i <= 10; $i++) {
            echo "\r\033[K\033[1A\r\033[K\r";
        }

        foreach ($this->rows as $row) {
            foreach ($row as $cell) {
                print($cell->print());
            }
            print PHP_EOL;
        }

    }

    public function writeOriginal(int $x, int $y, int $num)
    {
        $square = $this->findSquare($x, $y);

        $square->writeOriginal($x % 3 ?: 3, $y % 3 ?: 3, $num);

        $this->subtract($x, $y, $num);
    }
}
