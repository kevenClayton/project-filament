<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}
    </form>
</x-filament-panels::page>
@push('styles')
<style>
    /* Remove width: max-content dos steps do wizard para evitar scroll horizontal */
    .fi-sc-wizard .fi-sc-wizard-header .fi-sc-wizard-header-step .fi-sc-wizard-header-step-text {
        width: auto !important;
        max-width: 100% !important;
    }
</style>
@endpush
