<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="/assets/img/logo.svg"></a>
        <div class="dropdown" style=" margin-left: auto; margin-right: 10px;">

            <a class="dropdown-toggle" href="#" role="button" id="languagelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                <img src="{{asset("assets/img/icons/". LaravelLocalization::getCurrentLocale(). '.svg')}}" alt="" style="height: 18px; width: 18px"> {{ LaravelLocalization::getCurrentLocale() }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languagelink" style="">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <img src="{{asset("assets/img/icons/". $localeCode. '.svg')}}" alt="" style="height: 18px; width: 18px">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </div>
        </div>
        <a href="https://po8.cash/register?utm_source=affiliate&a=7dWuLjF1iNh2H0&ac=po_signals&code=50START" class="btn btn-success">Register</a>
    </div>
</nav>
