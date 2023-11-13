<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ExpensesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('My July Expenses.')
            ->setSubtitle('Weekly expenses in july.')
            ->addData('Bills', [26, 39, 10, 48])
            ->addData('Vacation', [70, 13, 36, 94])
            ->addData('EatOuts',[50, 60, 70, 30])
            ->setXAxis(['Week1', 'Week2', 'Week3', 'Week4']);
    }
}
