<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Articles', Article::count())
                ->description('Total khutbah/articles published')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            Stat::make('Total Views', Article::sum('views_count'))
                ->description('Overall engagement')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),
            Stat::make('Active Users', User::count())
                ->description('Total registered administrators')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
        ];
    }
}
