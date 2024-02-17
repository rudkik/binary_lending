@extends('layouts.app')



@section('content')
    <script src="{{ asset('/assets/js/chart.js') }}"></script>
    <style>
        body {
            background-color: #0D1117; /* Темный фон */
            color: #C9D1D9; /* Светлый текст */
            font-family: Arial, sans-serif; /* Шрифт */
        }
        .chart-container {
            position: relative;
            margin: auto;
            height: 90vh;
            width: 100%;
            align-items: center;
            display: flex;
            flex-direction: column;
        }
        /* Стили для кнопки и других элементов... */
        .button {
            background-color: #DFA1ED; /* Цвет фона кнопки */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 25px;
        }
        .percent{
            display: none;
        }
        .percent .up{
            color: darkgreen;
            font-size: 25px;
            font-weight: bold;
            margin-right: 20px;
        }
        .percent .down{
            color: darkred;
            font-size: 25px;
            font-weight: bold;
        }
    </style>
    <div class="container setting">
        <h1 class="settings-header">TRADING BOT</h1>

        <div class="settings-section">
            <h2>TIMEFRAME</h2>
            <div class="nav nav-tabs" id="timeframe-tab" role="tablist">
                <a class="nav-link active" id="timeframe-3min-tab" data-toggle="tab" href="#USD/JPY" role="tab" aria-controls="timeframe-3min" aria-selected="true">USD/JPY</a>
                <a class="nav-link" id="timeframe-5min-tab" data-toggle="tab" href="#USD/CHF" role="tab" aria-controls="timeframe-5min" aria-selected="false">USD/CHF</a>
                <a class="nav-link" id="timeframe-5min-tab" data-toggle="tab" href="#USD/CAD" role="tab" aria-controls="timeframe-5min" aria-selected="false">USD/CAD</a>
                <a class="nav-link" id="timeframe-5min-tab" data-toggle="tab" href="#GBP/USD" role="tab" aria-controls="timeframe-5min" aria-selected="false">GBP/USD</a>
                <a class="nav-link" id="timeframe-5min-tab" data-toggle="tab" href="#EUR/USD" role="tab" aria-controls="timeframe-5min" aria-selected="false">EUR/USD</a>
                <a class="nav-link" id="timeframe-5min-tab" data-toggle="tab" href="#AUD/USD" role="tab" aria-controls="timeframe-5min" aria-selected="false">AUD/USD</a>
           </div>
            <p style="margin-top:20px; text-align: start">Technical analysis</p>
        </div>


        <div class="chart-container">
            <canvas id="forexChart"></canvas>
            <button class="button" id="start">{{ __('site.start_signal') }}</button>
            <div class="percent">
                <div class="up">0%</div>
                <div class="down">0%</div>
            </div>
        </div>

        <script>
            // Функция для получения данных и построения графика
            document.addEventListener('DOMContentLoaded', function() {
                let forexChart;

                function fetchDataAndBuildChart(currency, source) {
                    fetch(`/signal-data2?currencies=${currency}&source=${source}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (forexChart) {
                                forexChart.destroy();
                            }

                            // Переворачиваем массив данных
                            const reversedData = data.results.values.reverse();
                            // Преобразование данных для графика
                            const labels = reversedData.map(item => new Date(item.timestamp).toLocaleDateString("en-US"));
                            const dataPoints = reversedData.map(item => item.value);

                            const chartData = {
                                labels: labels,
                                datasets: [{
                                    label: `${currency}/${source}`,
                                    data: dataPoints,
                                    fill: true,
                                    borderColor: '#DFA1ED',
                                    tension: 0.1,
                                    backgroundColor: 'rgba(223, 161, 237, 0.5)'
                                }]
                            };

                            const config = {
                                type: 'line',
                                data: chartData,
                                options: { /* options */ }
                            };

                            forexChart = new Chart(document.getElementById('forexChart').getContext('2d'), config);
                        })
                        .catch(error => {
                            console.error('Ошибка при получении данных:', error);
                        });
                }


                document.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const [currency, source] = e.target.getAttribute('href').substring(1).split('/');
                        fetchDataAndBuildChart(currency, source);
                        updatePercentages();
                    });
                });

                fetchDataAndBuildChart('USD', 'JPY'); // Загрузка начальных данных
            });
        </script>



        <script>
            function updatePercentages() {
                // Assuming up and down are percentage values that should total 100
                let down = Math.random() * 30; // Random delta up to 10%
                let up = 100 - down; // Ensuring the sum is 100%

                // Update the UI elements with new values
                document.querySelector('.percent .up').textContent = 'UP '+ up.toFixed(1) + '%';
                document.querySelector('.percent .down').textContent = 'DOWN '+ down.toFixed(1) + '%';
            }


            setInterval(updatePercentages, 10000);

            // Initial update
            updatePercentages();

            // Add event listener to the start button if needed
            document.getElementById('start').addEventListener('click', function() {
                document.querySelector('.percent').style.display = 'flex';
            });
        </script>
    </div>
@endsection
