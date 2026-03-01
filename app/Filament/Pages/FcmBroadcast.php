<?php

namespace App\Filament\Pages;

use App\Services\FcmService;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class FcmBroadcast extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?int $navigationSort = 10;

    protected static string $view = 'filament.pages.fcm-broadcast';

    public ?array $data = [];

    protected FcmService $fcmService;

    public function boot(FcmService $fcmService): void
    {
        $this->fcmService = $fcmService;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('page.fcm_broadcast.fields.title'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('body')
                            ->label(__('page.fcm_broadcast.fields.body'))
                            ->required()
                            ->rows(4)
                            ->maxLength(1000),

                        Forms\Components\Select::make('target')
                            ->label(__('page.fcm_broadcast.fields.target'))
                            ->options([
                                'semua_santri' => __('page.fcm_broadcast.targets.semua_santri'),
                                'wali_santri' => __('page.fcm_broadcast.targets.wali_santri'),
                            ])
                            ->required()
                            ->default('semua_santri'),
                    ]),
            ])
            ->statePath('data');
    }

    public function send(): void
    {
        $data = $this->form->getState();

        $fcmService = $this->fcmService;
        $result = $fcmService->sendToTopic($data['title'], $data['body'], $data['target']);

        if ($result['success']) {
            Notification::make()
                ->title(__('page.fcm_broadcast.notifications.success_title'))
                ->body(__('page.fcm_broadcast.notifications.success_body'))
                ->success()
                ->send();

            $this->form->fill();
        } else {
            Notification::make()
                ->title(__('page.fcm_broadcast.notifications.error_title'))
                ->body($result['message'])
                ->danger()
                ->send();
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.content');
    }

    public static function getNavigationLabel(): string
    {
        return __('page.fcm_broadcast.navigationLabel');
    }

    public function getTitle(): string|Htmlable
    {
        return __('page.fcm_broadcast.title');
    }

    public function getHeading(): string|Htmlable
    {
        return __('page.fcm_broadcast.heading');
    }

    public function getSubheading(): string|Htmlable|null
    {
        return __('page.fcm_broadcast.subheading');
    }
}
