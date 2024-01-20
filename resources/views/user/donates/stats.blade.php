
@foreach ($statistics as $stats)
<h6>
    {{ __('Статистика для :currency', ['currency' =>$stats->currency_id]) }}
</h6>

<div class="row mb-3">
    @can('stats', App\Models\User::class)
    <div class="col-12 col-md-4">
        <x-card>
            <x-card-body>
                <div class="mb-1 text-muted small">
                    Кол-во донатов
                </div>
                <h5 class="m-0">
                    {{$stats['total_count']}}
                </h5>
            </x-card-body>
        </x-card>
    </div>
@endcan

    @can('stats', App\Models\User::class )
    <div class="col-12 col-md-4">
        <x-card>
            <x-card-body>
                <div class="mb-1 text-muted small">
                    Общая сумма
                </div>
                <h5 class="m-0">
                    {{ __money($stats->total_amount, $stats->currency_id) }}
                </h5>
            </x-card-body>
        </x-card>
    </div>
    @endcan

    <div class="col-12 col-md-4">
        <x-card>
            <x-card-body>
                <div class="mb-1 text-muted small">
                    Средний чек 
                </div>
                <h5 class="m-0">
                    {{ __money($stats->avg_amount, $stats->currency_id) }}
                </h5>
            </x-card-body>
        </x-card>
    </div>

    <div class="col-12 col-md-4">
        <x-card>
            <x-card-body>
                <div class="mb-1 text-muted small">
                    Минимальный донат
                </div>
                <h5 class="m-0">
                    {{ __money($stats->min_amount, $stats->currency_id) }}
                </h5>
            </x-card-body>
        </x-card>
    </div>

    <div class="col-12 col-md-4">
        <x-card>
            <x-card-body>
                <div class="mb-1 text-muted small">
                    Максимальный донат
                </div>
                <h5 class="m-0">
                    {{ __money($stats->max_amount, $stats->currency_id) }}
                </h5>
            </x-card-body>
        </x-card>
    </div>
</div>
@endforeach