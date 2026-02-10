<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\SpatieTagsInput;

class ArticleResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Content')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Article::class, 'slug', ignoreRecord: true),

                                RichEditor::make('content')
                                    ->required()
                                    ->fileAttachmentsDirectory('articles')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('SEO')
                            ->schema([
                                TextInput::make('seo_title')
                                    ->placeholder('Optional: Custom meta title'),
                                Textarea::make('seo_description')
                                    ->placeholder('Optional: Custom meta description')
                                    ->rows(2),
                            ])
                            ->collapsed(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Status')
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('Featured Article')
                                    ->helperText('Show this article on the homepage slider.'),

                                DateTimePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->default(now()),
                                    
                                Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->default(auth()->id())
                                    ->required()
                                    ->searchable(),
                            ]),

                        Section::make('Media')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('article-thumbnails')
                                    ->imageEditor(),
                            ]),
                        
                        Section::make('Tags')
                            ->schema([
                                SpatieTagsInput::make('tags'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->square(),
                
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->description(fn (Article $record) => Str::limit(strip_tags($record->content), 50)),

                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state <= now() ? 'success' : 'warning')
                    ->label('Published'),

                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('views_count')
                    ->icon('heroicon-m-eye')
                    ->sortable()
                    ->label('Views'),
            ])
            ->filters([
                Tables\Filters\Filter::make('published')
                    ->query(fn (Builder $query) => $query->where('published_at', '<=', now())),
                Tables\Filters\Filter::make('draft')
                    ->query(fn (Builder $query) => $query->whereNull('published_at')->orWhere('published_at', '>', now())),
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
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
            'force_delete',
            'force_delete_any',
            'restore',
            'restore_any',
        ];
    }
}
