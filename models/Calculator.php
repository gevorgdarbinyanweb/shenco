<?php

namespace app\models;

final class Calculator
{
    public $width;
    public $height;
    public $frame;
    public $shtapik;
    public $leaf_count = 1;
    public $leaves;
    public $tavrik_belt;
    public $glass;
    public $metal;
    public $area;
    public $working_area;
    public $other_expenses;

    public function __construct(float $w, float $h, int $lc = 1)
    {
        $this->width = $w;
        $this->height = $h;
        $this->leaf_count = $lc;
    }

    public function getFrame() : Calculator
    {
        $this->frame = 2 * ($this->width + $this->height);
        return $this;
    }

    public function getTavrikBelt() : Calculator
    {
        $this->tavrik_belt = $this->height;
        return $this;
    }

    public function getShtapik() : Calculator
    {
        $this->getFrame();
        //$this->shtapik = 2 * $this->height * $this->leaf_count + $this->frame;
        $this->shtapik = 2 * $this->height + $this->frame;
        //$this->shtapik = 2 * $this->height + 2 * ($this->width + $this->height);
        return $this;
    }

    public function getLeaves() : Calculator
    {
        $this->leaves = 2 * 0.6 + 2 * $this->height;
        return $this;
    }

    public function getGlass() : Calculator
    {
        $this->glass = $this->width * $this->height;
        return $this;
    }

    public function getMetal() : Calculator
    {
        $this->getFrame();
        $this->getTavrikBelt();
        $this->getLeaves();
        $this->metal = $this->frame + $this->tavrik_belt + $this->leaves;
        return $this;
    }

    public function getArea() : Calculator
    {
        $this->area = number_format($this->width * $this->height, 4, '.', '');
        return $this;
    }

    public function getWorkingArea() : Calculator
    {
        $this->working_area = $this->area * 3500;
        return $this;
    }

    public function getOtherExpenses() : Calculator
    {
        $this->other_expenses = $this->area * 1000;
        return $this;
    }
}