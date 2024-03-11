@extends('layouts.app')



@section('content')
    <div class="container mt-5" style="padding-bottom: 30px">
        <div class="row">
            <div class="col-12">
                <p class="sub-heading">{{ __('site.sub_heading') }}</p>
                <h1 class="main-heading">{{ __('site.main_heading') }}</h1>

            </div>
        </div>

        <!-- Информационные блоки с графиками -->
        <div class="row">
            <div class="col-12">
                <div class="video">
                    <video id="myVideo" width="100%" height="auto" controls autoplay loop>
                        <source src="/assets/video/video_{{ LaravelLocalization::getCurrentLocale() }}.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="info-box">
                   <p class="first">{{ __('site.advantage1') }}</p>
                </div>
                <div class="info-box">
                   <p class="second">{{ __('site.advantage2') }}</p>
                </div>
                <div class="info-box">
                   <p class="third">{{ __('site.advantage3') }}</p>
                </div>
        </div>

        <!-- Кнопки -->
        <div class="" style="display: flex; justify-content: center; margin-bottom: 150px">

                <button class="btn2 btn-custom-start" data-toggle="modal" data-target="#uidModal">{{ __('site.start') }}</button>
                <button class="btn2 btn-custom-uid" data-toggle="modal" data-target="#uidModal">{{ __('site.check') }}</button>
        </div>
    </div>


    <!-- Модальное окно -->
    <div class="modal fade" id="uidModal" tabindex="-1" aria-labelledby="uidModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="justify-content: center;">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="/assets/img/logo.svg">
                    <p>If you have already registered, check your account for activity</p>
                    <form id="uidForm" method="GET">
                        <button type="submit"></button>
                        <input class="form-control" name="uid" placeholder="Enter your UID">
                    </form>
                    <div id="messageContainer" style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 20px"></div>
                </div>


            </div>
        </div>
    </div>

    <script>
        var registet = '{{ __('site.register_text') }}';
        var depost = '{{ __('site.deposit_text') }}';
        document.getElementById('uidForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const uid = event.target.uid.value;
            fetch(`{{ route('checkUid') }}?uid=${uid}`)
                .then(response => response.json())
                .then(data => {
                    const messageContainer = document.getElementById('messageContainer');
                    messageContainer.innerHTML = '';

                    if (data.dpst === false) {
                        // Пользователь не зарегистрирован, показываем ссылку на регистрацию
                        messageContainer.innerHTML = `
        <p>${registet}</p>
        <a class="btn btn-success" href="https://po8.cash/register?utm_source=affiliate&a=7dWuLjF1iNh2H0&ac=po_signals&code=50START">Register</a>
    `;
                    } else if (data.balance < 30) {
                        // У пользователя недостаточно депозита, показываем ссылку на депозит
                        messageContainer.innerHTML = `
        <p>${depost}</p>
        <a class="btn btn-success" href="https://po8.cash/cabinet/demo-high-low/?try-demo=1&redirectUrl=cabinet/deposit-step-1&utm_source=affiliate&a=7dWuLjF1iNh2H0&ac=po_signals&code=50START">Deposit</a>
    `;
                    } else if (data.balance > 30) {
                        // Пользователь подходит, перенаправляем на страницу настроек
                        window.location.href = '{{ route('settingPage') }}';
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        });

        document.addEventListener("DOMContentLoaded", function() {
            var video = document.getElementById('myVideo');

            video.addEventListener('loadeddata', function() {
                if (video.readyState >= 3) { // проверяем, достаточно ли данных загружено
                    video.play();
                }
            });
        });
    </script>
@endsection
