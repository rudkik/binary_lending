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
                    <form action="{{ route('checkUid') }}" method="GET">
                        <button type="submit"></button>
                        <input class="form-control" name="uid" placeholder="Enter your UID">
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
