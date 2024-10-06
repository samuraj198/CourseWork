<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="flex flex-col items-center dark:bg-black">
    <header class="mb-20 mt-[50px] flex justify-between items-center w-[95%]">
        <a href="{{ route('index') }}">
            <div class="logo-and-name flex items-center gap-2">
                <img id="logo" src="img/logos/logo.svg" alt="">
                <p class="name text-2xl font-bold dark:text-white">FreeModels</p>
            </div>
        </a>
        <nav>
            <ul class="flex gap-5 text-xl dark:text-white">
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li><a href="{{ route('catalog') }}">Каталог</a></li>
                <li><a href="{{ route('aboutUs') }}">О Сервисе</a></li>
            </ul>
        </nav>
        <div class="buttons flex gap-[15px] items-center">
            <button id="themeToggle">
                <img id="moon" src="img/icons/Moon.svg" alt="">
            </button>
            @if(\Illuminate\Support\Facades\Auth::user())
                <a href="{{ route('profile', auth()->user()->login) }}"><x-button text="Профиль" /></a>
                <form method="POST" action="{{ route('auth') }}">
                    @csrf
                    @method('DELETE')
                    <a type="submit"><x-button text="Выйти" /></a>
                </form>
            @else
                <a href="{{ route('auth') }}"><x-button text="Войти" /></a>
                <a href="{{ route('register') }}"><x-button text="Зарегистрироваться" /></a>
            @endif
        </div>
    </header>
    <main class="w-[95%] flex flex-col items-center">
        @yield('content')
    </main>
    <footer class="pt-20 w-[95%] border-t-[1px] border-solid border-black mt-14 flex flex-col items-center justify-center pb-[25px] dark:border-white">
        <nav>
            <ul class="flex gap-5 text-xl dark:text-white">
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li><a href="{{ route('catalog') }}">Каталог</a></li>
                <li><a href="{{ route('aboutUs') }}">О Сервисе</a></li>
            </ul>
        </nav>
        <div class="footer-logo-and-name flex flex-col items-center justify-center mt-20">
            <img id="logo-footer" src="img/logos/logo.svg" alt="">
            <p class="name text-2xl font-bold dark:text-white">FreeModels</p>
            <p class="text-black/50 font-bold dark:text-white/50">©FreeModels 2023-2024</p>
        </div>
    </footer>
</body>
</html>
<script>
    @yield('js')
    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;
    const moon = document.getElementById('moon');
    const logo = document.getElementById('logo');
    const logoF = document.getElementById('logo-footer');


    if (localStorage.getItem('theme') === 'dark') {
        htmlElement.classList.add('dark');
        moon.src = 'img/icons/Moon(Dark).svg';
        logo.src = 'img/logos/logo(Dark).svg';
        logoF.src = 'img/logos/logo(Dark).svg';
        if (typeof logoA !== 'undefined') {
            logoA.src = 'img/logos/logo(Dark).svg';
        }
    }

    themeToggle.addEventListener('click', () => {
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
            moon.src = 'img/icons/Moon.svg';
            logo.src = 'img/logos/logo.svg';
            logoF.src = 'img/logos/logo.svg';
            if (typeof logoA !== 'undefined') {
                logoA.src = 'img/logos/logo.svg';
            }
        } else {
            htmlElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            moon.src = 'img/icons/Moon(Dark).svg';
            logo.src = 'img/logos/logo(Dark).svg';
            logoF.src = 'img/logos/logo(Dark).svg';
            if (typeof logoA !== 'undefined') {
                logoA.src = 'img/logos/logo(Dark).svg';
            }
        }
    });
</script>
