@extends('layouts.app')



@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <p class="sub-heading">New: Our AI integration just landed</p>
                <h1 class="main-heading">Discover endless possibilities in the world of Trading.</h1>

            </div>
        </div>

        <!-- Информационные блоки с графиками -->
        <div class="row">
            <div class="col-12">
                <div class="video">

                </div>
            </div>
        </div>
        <div class="row">
                <div class="info-box">
                   <p class="first">Profitable signals</p>
                </div>
                <div class="info-box">
                   <p class="second">Real-time trading</p>
                </div>
                <div class="info-box">
                   <p class="third">Constant updating of signals</p>
                </div>
        </div>

        <!-- Кнопки -->
        <div class="" style="display: flex; justify-content: center; margin-bottom: 150px">

                <button class="btn2 btn-custom-start" data-toggle="modal" data-target="#uidModal">Start trading now</button>
                <button class="btn2 btn-custom-uid" data-toggle="modal" data-target="#uidModal">Check UID</button>
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
        document.getElementById('uidForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const uid = event.target.uid.value;
            fetch(`{{ route('checkUid') }}?uid=${uid}`)
                .then(response => response.json())
                .then(data => {
                    const messageContainer = document.getElementById('messageContainer');
                    messageContainer.innerHTML = '';

                    if (data.dpst > 50) {
                        // Пользователь подходит
                        window.location.href = '{{ route('settingPage') }}';
                    }
                    if(data.dpst == false){
                        // Пользователь не подходит, показываем ссылки
                        messageContainer.innerHTML = `
                        <p>You are not register,please register on link</p>
                        <a class="btn btn-success" href="https://po8.cash/register?utm_source=affiliate&a=7dWuLjF1iNh2H0&ac=po_signals&code=50START">Register</a>
                            `;
                    }
                    if(data.dpst < 50){
                        messageContainer.innerHTML = `
                        <p>You are not deposit,please deposit on link</p>
                        <a class="btn btn-success" href="https://po8.cash/cabinet/demo-high-low/?try-demo=1&redirectUrl=cabinet/deposit-step-1&utm_source=affiliate&a=7dWuLjF1iNh2H0&ac=po_signals&code=50START">Deposit</a>
                            `;

                    }
                })
                .catch(error => console.error('Ошибка:', error));
        });

    </script>
@endsection
