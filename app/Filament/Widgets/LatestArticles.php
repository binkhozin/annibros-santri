<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestArticles extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Article::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Recent Articles')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->label('Published Date'),
                Tables\Columns\TextColumn::make('views_count')
                    ->label('Views')
                    ->badge(),
            ]);
    }
}
