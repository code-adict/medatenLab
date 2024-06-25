<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PatientChart extends ChartWidget
{
    protected static ?string $heading = 'Registered Patients';

    protected static ?string $maxHeight = '300px';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = $this->getRegisteredPatientsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => "Registered Patients",
                    'data' => $data['patientsPerMonth']
                ]
            ],
            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getRegisteredPatientsPerMonth(): array
    {
        $now = Carbon::now();

        $patientsPerMonth = [];


        $months = collect(range(1, 12))->map(function ($month) use ($now, &$patientsPerMonth) {
            $count = Patient::whereMonth('created_at', Carbon::parse($now->month($month)
                ->format('Y-m')))
                ->count();

            $patientsPerMonth[] = $count;

            return $now->month($month)->format('M');

        })->toArray();
        return [
            'patientsPerMonth' => $patientsPerMonth,
            'months' =>$months
        ];
    }
}
