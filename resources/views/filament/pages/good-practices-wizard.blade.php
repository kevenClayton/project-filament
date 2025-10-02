<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}
    </form>

    @push('styles')
    <style>
        .fi-sc-wizard .fi-sc-wizard-header .fi-sc-wizard-header-step .fi-sc-wizard-header-step-text {
            width: auto !important;
            max-width: 100% !important;
        }
    </style>
    @endpush
</x-filament-panels::page>
