<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\AnalyticResource\Pages;
use App\Filament\User\Resources\AnalyticResource\RelationManagers;
use App\Models\Analytic;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnalyticResource extends Resource
{
    protected static ?string $model = Analytic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Main';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('link.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('clicks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnalytics::route('/'),
            // 'create' => Pages\CreateAnalytic::route('/create'),
            // 'edit' => Pages\EditAnalytic::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user_id = auth()->id();
        $links = Link::where('user_id', $user_id)->get();
        $analytics = [];
        foreach ($links as $link) {
            $analytics[] = $link->analytics->pluck('id')->toArray();
        }
        return parent::getEloquentQuery()->whereIn('id', array_merge(...$analytics));
    }
}
