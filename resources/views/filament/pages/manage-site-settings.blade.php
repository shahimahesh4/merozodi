<x-filament-panels::page>
    <form wire:submit.prevent="save" class="space-y-6">
        {{ $this->form }}

        <div class="pt-6 border-t border-gray-200 dark:border-white/10 flex items-center gap-4">
            <button type="submit"
                    wire:click.prevent="save"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 px-7 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-rose-600 via-rose-500 to-pink-600 hover:from-rose-500 hover:to-pink-500 active:scale-[0.98] shadow-lg shadow-rose-500/30 transition-all cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>Save Settings</span>
            </button>

            <div wire:loading wire:target="save" class="inline-flex items-center gap-2 text-xs font-semibold text-rose-500 dark:text-rose-400">
                <svg class="w-4 h-4 animate-spin text-rose-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span>Saving website configurations...</span>
            </div>
        </div>
    </form>
</x-filament-panels::page>
