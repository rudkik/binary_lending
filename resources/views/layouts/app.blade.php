<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Binary</title>

        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body>

    @include('includes.header')


    @yield('content')
    <!-- Кнопка для открытия модального окна -->
    <button type="button" class="btn btn-primary contacts" data-toggle="modal" data-target="#contactModal">
        <img src="/assets/img/contacts.svg" alt="">
    </button>

    <!-- Модальное окно -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content" style="padding:50px 20px;">
                <div class="modal-body">
                    <p>Contacts</p>
                    <a href="https://t.me/caelysp" class="btn btn-info">Telegram</a>
                </div>
            </div>
        </div>
    </div>

    </body>
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <script src="{{ asset('/assets/js/custom.js') }}"></script>

    <!-- endinject -->

</html>
