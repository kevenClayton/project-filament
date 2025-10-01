<x-filament-panels::page>
    @php
        $user = auth()->user();
        $needsWizard = $user && (!$user->company_id || !$user->company || !$user->company->wizard_completed);
    @endphp

    @if($needsWizard)
        <div class="flex items-center justify-center min-h-screen">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600 mx-auto"></div>
                <p class="mt-4 text-gray-600 dark:text-gray-400">Carregando configuração da empresa...</p>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Fallback: se o modal não abriu automaticamente, força abertura
                    setTimeout(function() {
                        if (!document.querySelector('[role="dialog"]')) {
                            @this.call('mountAction', 'companyWizard');
                        }
                    }, 1000);

                    // Função para controlar visibilidade do botão Salvar
                    function toggleSubmitButton() {
                        const modal = document.querySelector('[role="dialog"]');
                        if (!modal) return;

                        const steps = modal.querySelectorAll('.fi-sc-wizard-header-step');
                        const submitButton = modal.querySelector('.fi-ac-modal-submit-action');

                        if (!submitButton || steps.length === 0) {
                            setTimeout(toggleSubmitButton, 500);
                            return;
                        }

                        // Encontrar o step ativo (último com estado complete ou o atual)
                        let isLastStep = false;
                        const activeStepIndex = Array.from(steps).findIndex(step =>
                            step.getAttribute('aria-current') === 'step'
                        );

                        // Se é o último step (índice 5, pois são 6 steps de 0-5)
                        if (activeStepIndex === steps.length - 1) {
                            isLastStep = true;
                        }

                        // Mostra ou esconde o botão Salvar
                        if (isLastStep) {
                            submitButton.style.display = '';
                        } else {
                            submitButton.style.display = 'none';
                        }
                    }

                    // Observer para detectar mudanças nos steps
                    const observer = new MutationObserver(toggleSubmitButton);

                    // Observa mudanças no body
                    setTimeout(() => {
                        observer.observe(document.body, {
                            childList: true,
                            subtree: true,
                            attributes: true,
                            attributeFilter: ['aria-current']
                        });
                        toggleSubmitButton();
                    }, 1500);
                });
            </script>
        @endpush

        @push('styles')
            <style>
                /* Remove width: max-content dos steps do wizard para evitar scroll horizontal */
                .fi-sc-wizard .fi-sc-wizard-header .fi-sc-wizard-header-step .fi-sc-wizard-header-step-text {
                    width: auto !important;
                    max-width: 100% !important;
                }
            </style>
        @endpush
    @else
        @include('filament.pages.partials.dashboard-mock')
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
