<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}
    </form>

    @push('styles')
    <style>
        /* Hide sidebar completely during wizard */
        .fi-sidebar,
        .fi-sidebar-nav,
        aside {
            display: none !important;
        }

        /* Remove sidebar space and make content full width */
        .fi-layout {
            grid-template-columns: 1fr !important;
        }

        .fi-main {
            margin-inline-start: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Make the page container full width */
        .fi-page {
            max-width: 100% !important;
            width: 100% !important;
        }

        /* Center the wizard content and give it proper width */
        .fi-main-content {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 auto !important;
        }

        /* Make wizard form full width */
        .fi-page > form {
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Wizard component full width */
        .fi-sc-wizard {
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Remove any constraints on the content */
        .fi-page-content {
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Remove width: max-content dos steps do wizard para evitar scroll horizontal */
        .fi-sc-wizard .fi-sc-wizard-header .fi-sc-wizard-header-step .fi-sc-wizard-header-step-text {
            width: auto !important;
            max-width: 100% !important;
        }
    </style>
    @endpush
</x-filament-panels::page>
