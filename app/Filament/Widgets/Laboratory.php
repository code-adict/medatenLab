<?php

namespace App\Filament\Widgets;

use App\Models\Lab;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class Laboratory extends ChartWidget
{
    protected static ?string $heading = 'Laboratories';
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $payLoad = $this->getLabData();
        return [
            'datasets' => [
                [
                    'label' => 'Laboratories',
                    'data' => $payLoad['counts'],
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56'],
                ],
            ],
            'labels' => $payLoad['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    private function getLabData():array
    {
        $approvedLabCount = Lab::where('approved', 1)->count();
        $onlineLabCount = Lab::where('status', 1)->count();
        $registeredLabCount = Lab::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return [
            'counts'=>[$approvedLabCount, $onlineLabCount, $registeredLabCount],
            'labels'=>['Approved Laboratories', 'Online Laboratories', 'Registered Laboratories'],
        ];
    }
}
