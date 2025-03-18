<?php

namespace App\Filament\User\Widgets;

use App\Models\Analytic;
use App\Models\Link;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{

    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    protected static ?int $sort = 2;


    public function getLinks(): Collection
    {
        $user_links = User::where('id', Auth::id())->first()->links;
        foreach ($user_links as $link) {
            $link->analytics = Analytic::where('link_id', $link->id)->get();
        }
        return $user_links;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Links', Link::where('user_id', Auth::id())->count(),)
                ->description('Total links created')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([
                    'labels' => ["Last Week", "Last Month", "Last Year"],
                    'values' => [
                        Link::where('user_id', Auth::id())
                            ->whereBetween('created_at', [now()->subDay(), now()])
                            ->count(),
                        Link::where('user_id', Auth::id())
                            ->whereBetween('created_at', [now()->subWeek(), now()])
                            ->count(),
                        Link::where('user_id', Auth::id())
                            ->whereBetween('created_at', [now()->subMonth(), now()])
                            ->count(),
                        Link::where('user_id', Auth::id())
                            ->whereBetween('created_at', [now()->subYear(), now()])
                            ->count(),
                    ],
                ])
                ->color('success'),

            Stat::make('Total Clicks', $this->getLinks()->sum(function ($link) {
                return $link->analytics->count();
            }),)
                ->description('Total clicks')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([
                    'labels' => ["Last Week", "Last Month", "Last Year"],
                    'values' => [
                        $this->getLinks()->sum(function ($link) {
                            return $link->analytics->whereBetween('created_at', [now()->subDay(), now()])->count();
                        }),
                        $this->getLinks()->sum(function ($link) {
                            return $link->analytics->whereBetween('created_at', [now()->subWeek(), now()])->count();
                        }),
                        $this->getLinks()->sum(function ($link) {
                            return $link->analytics->whereBetween('created_at', [now()->subMonth(), now()])->count();
                        }),
                        $this->getLinks()->sum(function ($link) {
                            return $link->analytics->whereBetween('created_at', [now()->subYear(), now()])->count();
                        }),
                    ],
                ])
                ->color('success'),
        ];
    }
}
