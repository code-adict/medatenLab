<?php

namespace App\Filament\Widgets;

use App\Models\Lab;
use App\Models\Patient;
use App\Models\Test;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Patients Registered', Patient::count())
            ->description('Total Patients Registered')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([2,5,7,4,1,]),

            Stat::make('Laboratories Registered', Lab::count())
                ->description('Total Registered Laboratories')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([2,5,7,4,1,]),

            Stat::make('Tests', Test::count())
                ->description('Available Tests')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([2,5,7,4,1,]),

//            Stat::make('Specialists', LabSpecialist::count())
//                ->description('Approved Specialists')
//                ->descriptionIcon('heroicon-m-arrow-trending-up')
//                ->color('info')
//                ->chart([2,5,7,4,1,]),

            Stat::make('Home Visits', "3")
                ->description('Decrease in home visits ')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([2,5,7,4,1,]),

//            Stat::make('Processed', '192.1k')
//                ->color('success')
//                ->extraAttributes([
//                    'class' => 'cursor-pointer',
//                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
//                ]),
        ];
    }
}
