<?php

namespace App\Filament\User\Widgets;

use App\Models\Analytic;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ClicksChart extends ChartWidget
{
    protected static ?string $heading = 'Clicks Chart';
    protected static string $color = 'success';
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function getLinks(): Collection
    {
        $user_links = User::where('id', Auth::id())->first()->links;
        foreach ($user_links as $link) {
            $link->analytics = Analytic::where('link_id', $link->id)->get();
        }
        return $user_links;
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Clicks',
                    'data' => $this->getLinks()->map(function ($link) {
                        return $link->analytics->count();
                    })->toArray(),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
