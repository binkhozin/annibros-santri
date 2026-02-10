<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ScheduleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Schedule Detail')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),

                        DatePicker::make('date')
                            ->required()
                            ->default(now()),

                        TimePicker::make('start_time')
                            ->required()
                            ->default(now()),

                        TimePicker::make('end_time'),

                        TextInput::make('location')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('google_maps_url')
                            ->url()
                            ->maxLength(255),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(auth()->id())
                            ->required()
                            ->searchable(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_time')
                    ->time('H:i')
                    ->label('Time'),

                TextColumn::make('location')
                    ->searchable()
                    ->limit(30),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                TextColumn::make('user.name')
                    ->label('By')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
        ];
    }
}
