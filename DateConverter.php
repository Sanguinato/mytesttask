<?php

class DateConverter
{
    
    public $total_days = 0;
    public $invert = false;
    private $year_input = 0;
    private $month_input = 0;
    private $day_input = 0;


    public $years = 0;
    public $month = 0;
    public $days = 0;
    
    public function index($start_date = [], $end_date = [])
    {

        $start_date = explode('-', $start_date);
        $end_date = explode('-', $end_date);

        $year_start = $start_date['0'];
        $month_start = $start_date['1'];
        $day_start = $start_date['2'];

        $year_end = $end_date['0'];
        $month_end = $end_date['1'];
        $day_end = $end_date['2'];

        $this->calcYears($year_start, $year_end);
        $this->calcMonth($month_start, $month_end);
        $this->calcDays($day_start, $day_end);

        /// very simple solution for invert
        if(implode('',$start_date) > implode('',$end_date)) {
            $this->invert = true;
        }

        $this->total_days = abs($this->total_days);

        return json_encode($this);
    }

    private function calcYears($year_start, $year_end)
    {
        if ($year_start == $year_end) {

            $this->years = 0;
            $this->year_input = $year_end;

        } else {

            $this->years = abs($year_start - $year_end);
        }

        for($i = 1; $i <= abs($this->years); ++$i) {

            if($i % 4 == 0 && $i % 100 != 0 || $i % 400 == 0) {

                $this->total_days +=  366;

            } else {

                $this->total_days += 365;
            }
        }

    }

    private function calcMonth($month_start, $month_end)
    {
        if ($month_end == $month_start) {

            $this->month = 0;
            $this->month_input = $month_end;

        } else {

            $this->month = abs($month_start - $month_end);

        }

        for ($i = $month_start; $i < $month_end; ++$i) {

            $this->total_days += $this->daysInMonth($i);

        }
    }

    private function calcDays($day_start, $day_end)
    {
        if ($day_start == $day_end) {

            $this->days = 0;
            $this->day_input = $day_end;

        } else {

            $this->days = abs($day_end - $day_start);

            if($day_end - $day_start < 0 && $this->year_input == 0) {

                if(--$this->month < 0) {

                    --$this->years;

                    $this->month = 12 - abs($this->month);

                    if($this->years <= 0) {
                        $this->years = 0;
                        $this->days = $this->daysInMonth($this->month_input) - $this->days;

                    }
                }
            }

        }

        $this->total_days += $day_end - $day_start;
    }

    private function daysInMonth($month)
    {
        return intval(28 + ($month + floor($month/8)) % 2 + 2 % $month + 2 * floor(1/$month));
    }
}