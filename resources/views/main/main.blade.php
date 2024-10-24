<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0%);
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        .success{
            animation: slideIn 0.5s ease-out, fadeOut 0.5s ease-out 4.5s;
        }
        .error{
            animation: slideIn 0.5s ease-out, fadeOut 0.5s ease-out 4.5s;
        }
    </style>
    <title>@yield('title')</title>
</head>
<div class="notifs-case absolute top-0 left-0 w-full z-50 flex">
    @if(session('success'))
        <div class="success fixed max-w-96 hidden border-black border-[1px] bg-white text-black px-5 py-3 rounded-lg bottom-5 right-5 z-50 dark:text-white dark:bg-black dark:border-white">
            <p class="break-words">{{ session('success') }}</p>
        </div>
    @elseif($errors->any())
        <div class="error fixed hidden max-w-96 border-black border-[1px] bg-white text-black px-5 py-3 rounded-lg bottom-5 right-5 z-50 dark:text-white dark:bg-black dark:border-white">
            @foreach($errors->all() as $error)
                <p class="break-words">{{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>
<body class="flex flex-col items-center dark:bg-black">
    <header class="mb-20 mt-[50px] flex justify-between items-center w-[95%]">
        <a href="{{ route('index') }}">
            <div class="logo-and-name flex items-center gap-2">
                <div class="logo">
                    <svg width="100" height="63" viewBox="0 0 100 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="stroke-black dark:stroke-white" d="M82.2223 43.9117C82.2223 48.4396 81.3151 51.5395 79.8985 53.7157C78.4978 55.8673 76.4421 57.3572 73.6777 58.3896C70.8701 59.4382 67.4095 59.9837 63.3512 60.2511C59.5447 60.5019 55.3689 60.5009 50.8774 60.4998C50.5863 60.4998 50.2938 60.4997 50.0001 60.4997C49.7063 60.4997 49.4138 60.4998 49.1227 60.4998C44.6312 60.5009 40.4554 60.5019 36.6489 60.2511C32.5906 59.9837 29.1301 59.4382 26.3224 58.3896C23.558 57.3572 21.5023 55.8673 20.1016 53.7157C18.685 51.5395 17.7778 48.4396 17.7778 43.9117C17.7778 25.8622 32.2317 11.2803 50.0001 11.2803C67.7684 11.2803 82.2223 25.8622 82.2223 43.9117Z" stroke="black" stroke-width="5"/>
                        <path class="fill-black dark:fill-white" d="M66.2038 40.1643C66.2038 46.6318 63.6129 45.7853 60.4168 45.7853C57.2207 45.7853 54.6298 46.6318 54.6298 40.1643C54.6298 33.6968 57.2207 28.4539 60.4168 28.4539C63.6129 28.4539 66.2038 33.6968 66.2038 40.1643Z" fill="black"/>
                        <ellipse class="fill-white dark:fill-black" cx="62.1529" cy="33.4893" rx="1.73611" ry="1.75657" fill="white"/>
                        <path class="fill-black dark:fill-white" d="M45.3705 40.1643C45.3705 46.6318 42.7795 45.7853 39.5834 45.7853C36.3873 45.7853 33.7964 46.6318 33.7964 40.1643C33.7964 33.6968 36.3873 28.4539 39.5834 28.4539C42.7795 28.4539 45.3705 33.6968 45.3705 40.1643Z" fill="black"/>
                        <ellipse class="fill-white dark:fill-black" cx="41.3195" cy="33.4893" rx="1.73611" ry="1.75657" fill="white"/>
                        <path class="stroke-black dark:stroke-white dark:fill-white" d="M15.2777 49.451C15.2777 52.2125 13.0391 54.451 10.2777 54.451H5.21244C4.22848 54.451 3.25313 54.1595 2.64169 53.3886C1.54728 52.0088 -6.77109e-05 49.1344 -6.77109e-05 43.9116C-6.77109e-05 38.6889 1.54728 35.8145 2.64168 34.4347C3.25313 33.6638 4.22848 33.3722 5.21244 33.3722H10.2777C13.0391 33.3722 15.2777 35.6108 15.2777 38.3722L15.2777 49.451Z" fill="black"/>
                        <path class="stroke-black dark:stroke-white dark:fill-white" d="M84.7222 38.3722C84.7222 35.6108 86.9607 33.3722 89.7222 33.3722H94.7874C95.7714 33.3722 96.7467 33.6638 97.3582 34.4347C98.4526 35.8145 99.9999 38.6889 99.9999 43.9116C99.9999 49.1344 98.4526 52.0088 97.3582 53.3886C96.7467 54.1595 95.7714 54.4511 94.7874 54.4511H89.7222C86.9607 54.4511 84.7222 52.2125 84.7222 49.4511V38.3722Z" fill="black"/>
                        <path class="stroke-black dark:stroke-white" d="M92 34.3653C92 26.0467 87.575 18.0688 79.6985 12.1867C71.8219 6.30455 61.1391 3 50 3C38.8609 3 28.178 6.30455 20.3015 12.1867C12.425 18.0688 8 26.0467 8 34.3653" stroke="black" stroke-width="5"/>
                    </svg>
                </div>
                <p class="name text-2xl font-bold dark:text-white">FreeModels</p>
            </div>
        </a>
        <nav>
            <ul class="flex gap-5 text-xl dark:text-white">
                <li class="{{ request()->routeIs('index') ? 'underline' : '' }}"><a href="{{ route('index') }}">Главная</a></li>
                <li class="{{ request()->routeIs('catalog') ? 'underline' : '' }}"><a href="{{ route('catalog') }}">Каталог</a></li>
                <li class="{{ request()->routeIs('aboutUs') ? 'underline' : '' }}"><a href="{{ route('aboutUs') }}">О Сервисе</a></li>
            </ul>
        </nav>
        <div class="buttons flex gap-[15px] items-center">
            <button id="themeToggle">
                <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-black dark:fill-white" d="M40.5698 24.3744C40.2991 24.1507 39.9711 24.0074 39.623 23.961C39.2749 23.9146 38.9208 23.9669 38.601 24.1119C36.6183 25.0192 34.4626 25.4861 32.2823 25.4806C28.2489 25.4757 24.381 23.8764 21.5219 21.0314C18.6628 18.1864 17.0445 14.3264 17.0198 10.2931C17.0283 9.02905 17.1856 7.77039 17.4885 6.54312C17.5528 6.216 17.5287 5.87767 17.4187 5.56297C17.3087 5.24827 17.1168 4.96859 16.8627 4.75274C16.6087 4.53689 16.3017 4.39268 15.9733 4.33496C15.645 4.27724 15.3072 4.3081 14.9948 4.42437C12.0554 5.74607 9.50021 7.79329 7.56931 10.3737C5.63841 12.9541 4.39516 15.983 3.95635 19.1759C3.51755 22.3688 3.89758 25.6208 5.06077 28.6264C6.22395 31.6321 8.1321 34.2927 10.6059 36.3584C13.0798 38.424 16.0382 39.8269 19.2031 40.4353C22.368 41.0436 25.6357 40.8374 28.699 39.836C31.7624 38.8347 34.5209 37.071 36.7155 34.7108C38.9101 32.3505 40.4686 29.4711 41.2448 26.3431C41.3393 25.985 41.3256 25.6069 41.2055 25.2565C41.0854 24.9061 40.8642 24.5992 40.5698 24.3744ZM22.7573 36.9181C19.6106 36.8959 16.5476 35.9016 13.9879 34.0714C11.4281 32.2411 9.49663 29.6644 8.45792 26.694C7.4192 23.7236 7.32402 20.5047 8.1854 17.4781C9.04678 14.4515 10.8226 11.7652 13.2698 9.78687V10.2931C13.2747 15.334 15.2794 20.167 18.8439 23.7315C22.4083 27.296 27.2414 29.3007 32.2823 29.3056C33.6058 29.3105 34.926 29.1722 36.2198 28.8931C34.9258 31.341 32.9881 33.3891 30.6157 34.8165C28.2432 36.244 25.526 36.9966 22.7573 36.9931V36.9181Z" fill="black"/>
                </svg>
            </button>
            @if(\Illuminate\Support\Facades\Auth::user())
                <a href="{{ route('profile', auth()->user()->login) }}"><x-button text="Профиль" /></a>
                <form class="mb-0 !important" method="POST" action="{{ route('auth') }}">
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
            <div class="logo">
                <svg width="100" height="63" viewBox="0 0 100 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="stroke-black dark:stroke-white" d="M82.2223 43.9117C82.2223 48.4396 81.3151 51.5395 79.8985 53.7157C78.4978 55.8673 76.4421 57.3572 73.6777 58.3896C70.8701 59.4382 67.4095 59.9837 63.3512 60.2511C59.5447 60.5019 55.3689 60.5009 50.8774 60.4998C50.5863 60.4998 50.2938 60.4997 50.0001 60.4997C49.7063 60.4997 49.4138 60.4998 49.1227 60.4998C44.6312 60.5009 40.4554 60.5019 36.6489 60.2511C32.5906 59.9837 29.1301 59.4382 26.3224 58.3896C23.558 57.3572 21.5023 55.8673 20.1016 53.7157C18.685 51.5395 17.7778 48.4396 17.7778 43.9117C17.7778 25.8622 32.2317 11.2803 50.0001 11.2803C67.7684 11.2803 82.2223 25.8622 82.2223 43.9117Z" stroke="black" stroke-width="5"/>
                    <path class="fill-black dark:fill-white" d="M66.2038 40.1643C66.2038 46.6318 63.6129 45.7853 60.4168 45.7853C57.2207 45.7853 54.6298 46.6318 54.6298 40.1643C54.6298 33.6968 57.2207 28.4539 60.4168 28.4539C63.6129 28.4539 66.2038 33.6968 66.2038 40.1643Z" fill="black"/>
                    <ellipse class="fill-white dark:fill-black" cx="62.1529" cy="33.4893" rx="1.73611" ry="1.75657" fill="white"/>
                    <path class="fill-black dark:fill-white" d="M45.3705 40.1643C45.3705 46.6318 42.7795 45.7853 39.5834 45.7853C36.3873 45.7853 33.7964 46.6318 33.7964 40.1643C33.7964 33.6968 36.3873 28.4539 39.5834 28.4539C42.7795 28.4539 45.3705 33.6968 45.3705 40.1643Z" fill="black"/>
                    <ellipse class="fill-white dark:fill-black" cx="41.3195" cy="33.4893" rx="1.73611" ry="1.75657" fill="white"/>
                    <path class="stroke-black dark:stroke-white dark:fill-white" d="M15.2777 49.451C15.2777 52.2125 13.0391 54.451 10.2777 54.451H5.21244C4.22848 54.451 3.25313 54.1595 2.64169 53.3886C1.54728 52.0088 -6.77109e-05 49.1344 -6.77109e-05 43.9116C-6.77109e-05 38.6889 1.54728 35.8145 2.64168 34.4347C3.25313 33.6638 4.22848 33.3722 5.21244 33.3722H10.2777C13.0391 33.3722 15.2777 35.6108 15.2777 38.3722L15.2777 49.451Z" fill="black"/>
                    <path class="stroke-black dark:stroke-white dark:fill-white" d="M84.7222 38.3722C84.7222 35.6108 86.9607 33.3722 89.7222 33.3722H94.7874C95.7714 33.3722 96.7467 33.6638 97.3582 34.4347C98.4526 35.8145 99.9999 38.6889 99.9999 43.9116C99.9999 49.1344 98.4526 52.0088 97.3582 53.3886C96.7467 54.1595 95.7714 54.4511 94.7874 54.4511H89.7222C86.9607 54.4511 84.7222 52.2125 84.7222 49.4511V38.3722Z" fill="black"/>
                    <path class="stroke-black dark:stroke-white" d="M92 34.3653C92 26.0467 87.575 18.0688 79.6985 12.1867C71.8219 6.30455 61.1391 3 50 3C38.8609 3 28.178 6.30455 20.3015 12.1867C12.425 18.0688 8 26.0467 8 34.3653" stroke="black" stroke-width="5"/>
                </svg>
            </div>
            <p class="name text-2xl font-bold dark:text-white">FreeModels</p>
            <p class="text-black/50 font-bold dark:text-white/50">©FreeModels 2023-2024</p>
        </div>
    </footer>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const success = document.querySelector('.success');
        if (success) {
            success.classList.remove('hidden');
            setTimeout(() => {
                success.classList.add('hidden');
            }, 5000);
        }
        const error = document.querySelector('.error');
        if (error) {
            error.classList.remove('hidden');
            setTimeout(() => {
                error.classList.add('hidden');
            }, 5000);
        }
    });

    const themeToggle = document.getElementById('themeToggle');
    const htmlElement = document.documentElement;

    if (localStorage.getItem('theme') === 'dark') {
        htmlElement.classList.add('dark');
    }

    themeToggle.addEventListener('click', () => {
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            htmlElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    });
    @yield('js')
</script>
