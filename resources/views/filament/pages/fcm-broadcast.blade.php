<x-filament::page>
    <div class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
            <x-filament::button
                wire:click="send"
                color="primary"
                icon="heroicon-o-paper-airplane"
                wire:loading.attr="disabled"
                wire:target="send"
            >
                <span wire:loading.remove wire:target="send">{{ __('page.fcm_broadcast.actions.send') }}</span>
                <span wire:loading wire:target="send">{{ __('page.fcm_broadcast.actions.sending') }}</span>
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
