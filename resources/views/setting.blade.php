@extends('layouts.app')



@section('content')
    <div class="container setting">
        <h1 class="settings-header">TRADING BOT</h1>

        <div class="settings-section">
            <h2>{{ __('site.timeframe') }}</h2>
            <div class="nav nav-tabs" id="timeframe-tab" role="tablist">
                <a class="nav-link active" id="timeframe-3min-tab" data-toggle="tab" href="#timeframe-3min" role="tab" aria-controls="timeframe-3min" aria-selected="true">3 min</a>
                <a class="nav-link" id="timeframe-5min-tab" data-toggle="tab" href="#timeframe-5min" role="tab" aria-controls="timeframe-5min" aria-selected="false">5 min</a>
                <a class="nav-link" id="timeframe-10min-tab" data-toggle="tab" href="#timeframe-10min" role="tab" aria-controls="timeframe-10min" aria-selected="false">10 min</a>
                <a class="nav-link" id="timeframe-15min-tab" data-toggle="tab" href="#timeframe-15min" role="tab" aria-controls="timeframe-15min" aria-selected="false">15 min</a>
                <a class="nav-link" id="timeframe-30min-tab" data-toggle="tab" href="#timeframe-30min" role="tab" aria-controls="timeframe-30min" aria-selected="false">30 min</a>
            </div>
        </div>

        <div class="settings-section underline">
            <h2>{{ __('site.type_analise') }}</h2>
            <div class="nav nav-tabs" id="analysis-tab" role="tablist">
                <a class="nav-link active" id="analysis-technical-tab" data-toggle="tab" href="#analysis-technical" role="tab" aria-controls="analysis-technical" aria-selected="true">{{ __('site.technical') }}</a>
                <a class="nav-link" id="analysis-signal-tab" data-toggle="tab" href="#analysis-signal" role="tab" aria-controls="analysis-signal" aria-selected="false">{{ __('site.trends') }}</a>
                <a class="nav-link" id="analysis-resistance-tab" data-toggle="tab" href="#analysis-resistance" role="tab" aria-controls="analysis-resistance" aria-selected="false">{{ __('site.resistance') }}</a>
            </div>

            <div class="tab-content" style="margin-top: 20px">
                <div class="tab-pane fade show active" id="analysis-technical">
                    {!! __('site.technical_text') !!}
                </div>
                <div class="tab-pane fade" id="analysis-signal">
                    {!! __('site.trends_text') !!}
                </div>
                <div class="tab-pane fade" id="analysis-resistance">
                    {!! __('site.resistance_text') !!}
                </div>
            </div>

        </div>

        <div class="settings-section">
            <ul>
                <li>{{ __('site.signal') }}</li>
                <li>{{ __('site.open') }}</li>
            </ul>
        </div>

        <div class="settings-section" style="display:flex; align-items: center; flex-direction: column; margin-bottom: 40px">
            <p>{{ __('site.select') }}</p>
            <a href="{{ route('currencyPage') }}" class="btn btn-next">
                {{ __('site.next') }}
            </a>
        </div>
    </div>
@endsection
