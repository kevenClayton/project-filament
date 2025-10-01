@php
    $user = auth()->user();
@endphp

<div class="space-y-6">
    {{-- Header --}}
    <div class="rounded-xl bg-gradient-to-r from-blue-500 to-indigo-600 p-8 text-white shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <p class="mt-2 text-blue-100">
                    Bem-vindo, {{ $user?->name }}! 👋
                </p>
                <p class="text-blue-100">
                    Visão geral mockada do sistema Lisboa Sustentável Empresas
                </p>
            </div>
            <div class="hidden h-16 w-16 items-center justify-center rounded-full bg-white/20 md:flex">
                <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75c0 .414.336.75.75.75H6a3 3 0 013 3v0a3 3 0 003-3h4.5a2.25 2.25 0 002.25-2.25V4.5a2.25 2.25 0 00-2.25-2.25H11.25A2.25 2.25 0 009 4.5v.75H3a.75.75 0 00-.75.75z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => 'Empresas Registadas', 'value' => '1 247', 'diff' => '+12% este mês', 'color' => 'bg-blue-500'],
            ['label' => 'Boas Práticas', 'value' => '3 891', 'diff' => '+8% este mês', 'color' => 'bg-green-500'],
            ['label' => 'Maturidade ESG', 'value' => '3.2 / 5', 'diff' => '+0.3 este trimestre', 'color' => 'bg-amber-500'],
            ['label' => 'Utilizadores Ativos', 'value' => '892', 'diff' => '+15% esta semana', 'color' => 'bg-purple-500'],
        ] as $card)
            <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $card['label'] }}</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $card['value'] }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-full {{ $card['color'] }} text-white">
                        <span class="text-lg">📊</span>
                    </div>
                </div>
                <p class="mt-4 text-sm font-medium text-green-500">{{ $card['diff'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Charts Section --}}
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Progresso ESG por Setor
            </h2>
            <div class="mt-6 space-y-4">
                @foreach ([
                    ['label' => 'Tecnologia', 'value' => '4.2/5', 'percent' => '84%', 'color' => 'bg-blue-500'],
                    ['label' => 'Retalho', 'value' => '3.5/5', 'percent' => '70%', 'color' => 'bg-indigo-500'],
                    ['label' => 'Manufatura', 'value' => '3.1/5', 'percent' => '62%', 'color' => 'bg-green-500'],
                    ['label' => 'Serviços', 'value' => '2.8/5', 'percent' => '56%', 'color' => 'bg-amber-500'],
                ] as $bar)
                    <div>
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ $bar['label'] }}</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $bar['value'] }}</span>
                        </div>
                        <div class="mt-2 h-3 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-3 rounded-full {{ $bar['color'] }}" style="width: {{ $bar['percent'] }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Crescimento Mensal
            </h2>
            <div class="mt-6 space-y-4">
                @foreach ([
                    ['label' => 'Janeiro', 'value' => 45, 'percent' => '45%', 'color' => 'bg-blue-500'],
                    ['label' => 'Fevereiro', 'value' => 62, 'percent' => '62%', 'color' => 'bg-green-500'],
                    ['label' => 'Março', 'value' => 78, 'percent' => '78%', 'color' => 'bg-amber-500'],
                    ['label' => 'Abril', 'value' => 91, 'percent' => '91%', 'color' => 'bg-indigo-500'],
                    ['label' => 'Maio', 'value' => 85, 'percent' => '85%', 'color' => 'bg-purple-500'],
                ] as $month)
                    <div>
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ $month['label'] }}</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $month['value'] }}</span>
                        </div>
                        <div class="mt-2 h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-2.5 rounded-full {{ $month['color'] }}" style="width: {{ $month['percent'] }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
            Atividade Recente
        </h2>
        <div class="mt-6 space-y-4">
            @foreach ([
                ['icon' => '✅', 'title' => 'Nova boa prática publicada', 'description' => 'TechCorp - Redução de energia em 30%', 'time' => 'há 2 horas', 'color' => 'border-l-green-500 bg-green-50 dark:bg-green-900/20'],
                ['icon' => '🏢', 'title' => 'Nova empresa registada', 'description' => 'EcoSolutions Lda.', 'time' => 'há 4 horas', 'color' => 'border-l-blue-500 bg-blue-50 dark:bg-blue-900/20'],
                ['icon' => '📊', 'title' => 'Relatório ESG atualizado', 'description' => 'GreenTech - Maturidade aumentou para 4.2', 'time' => 'há 6 horas', 'color' => 'border-l-amber-500 bg-amber-50 dark:bg-amber-900/20'],
            ] as $activity)
                <div class="flex items-start gap-4 rounded-lg border-l-4 {{ $activity['color'] }} p-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white shadow dark:bg-gray-800">
                        <span class="text-lg">{{ $activity['icon'] }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $activity['title'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $activity['description'] }}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $activity['time'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

