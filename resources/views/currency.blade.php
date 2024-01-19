@extends('layouts.app')



@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #0D1117; /* Темный фон */
            color: #C9D1D9; /* Светлый текст */
            font-family: Arial, sans-serif; /* Шрифт */
        }
        .chart-container {
            position: relative;
            margin: auto;
            height: 40vh;
            width: 80vw;
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
    </style>
    <div class="container setting">
        <h1 class="settings-header">TRADING BOT</h1>
        <div class="chart-container">
            <canvas id="forexChart"></canvas>
        </div>

        <button class="button">Start Signals</button>

        <script>
            const data = {
                labels: Object.keys(quotes),
                datasets: [{
                    label: 'USD/GBP',
                    data: Object.values(quotes).map(q => q.USDGBP),
                    fill: true,
                    borderColor: '#DFA1ED',
                    tension: 0.1,
                    backgroundColor: 'rgba(223, 161, 237, 0.5)' // Полупрозрачный фон под графиком
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {
                                color: 'white' // Цвет текста на осях
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white' // Цвет текста на осях
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: 'white' // Цвет легенды
                            }
                        }
                    }
                }
            };

            // Инициализация графика
            const forexChart = new Chart(
                document.getElementById('forexChart'),
                config
            );
        </script>
    </div>
@endsection
