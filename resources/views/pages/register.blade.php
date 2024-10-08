@vite('resources/css/app.css')
<a href="{{ route('index') }}" class="absolute left-10 top-5 text-black/50 text-2xl dark:text-white/50">Назад</a>
<div class="register-form flex flex-col items-center mt-[100px]">
    <h2 class="text-2xl font-bold mb-5 dark:text-white">РЕГИСТРАЦИЯ</h2>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col items-center gap-5 w-full"
          enctype="multipart/form-data">
        @csrf
        <div class="ava flex flex-col items-center">
            <div class="flex items-center">
                <div class="relative w-20 h-20 rounded-full overflow-hidden">
                    <img id="avatarPreview" src="/img/icons/profile.svg" alt="Аватар"
                         class="w-full h-full object-cover cursor-pointer">
                    <input name="ava" id="avatar" type="file" accept="image/*"
                           class="absolute inset-0 cursor-pointer opacity-0" onchange="previewAvatar(event)">
                </div>
            </div>
            <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-white/50" id="uploadLabel">
                Загрузите аватарку
            </label>
            <button id="cancelButton" type="button" class="hidden mt-2 bg-red-500 text-white px-4 py-1 rounded">
                Отменить
            </button>
        </div>
        <input name="login" class="w-1/3 border-black border-solid border-[1px] py-[13px] pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
               type="text" placeholder="Введите логин">
        <input name="email" class="w-1/3 border-black border-solid border-[1px] py-[13px] pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
               type="email" placeholder="Введите почту">
        <input name="password" class="w-1/3 border-black border-solid border-[1px] py-[13px] pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
               type="password" placeholder="Введите пароль">
        <input name="password_confirmation"
               class="w-1/3 border-black border-solid border-[1px] py-[13px] pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white" type="password"
               placeholder="Повторите пароль">
        <button type="submit">
            <x-button text="Зарегистрироваться"/>
        </button>
    </form>
    <p class="dark:text-white">Уже есть аккаунт? <a href="{{ route('auth') }}"
                            class="underline decoration-solid hover:text-blue-500 transition-all duration-300">Войти</a>
    </p>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="break-words">{{ $error }}</p>
        @endforeach
    @endif
</div>

<script>
    const htmlElement = document.documentElement;

    if (localStorage.getItem('theme') === 'dark') {
        htmlElement.classList.add('dark');
        htmlElement.style.backgroundColor = 'black';
        document.getElementById('avatarPreview').src = '/img/icons/profile(Dark).svg';
    } else {
        htmlElement.classList.remove('dark');
        htmlElement.style.backgroundColor = 'white';
    }

    function previewAvatar(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('avatarPreview');
            output.src = reader.result;

            // Изменяем текст метки и показываем кнопку "Отменить"
            document.getElementById('uploadLabel').innerText = '';
            document.getElementById('cancelButton').classList.remove('hidden'); // Показываем кнопку "Отменить"
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('cancelButton').addEventListener('click', function () {
        // Сбросить поле ввода
        document.getElementById('avatar').value = '';
        // Вернуть изображение к исходному состоянию
        document.getElementById('avatarPreview').src = '/img/icons/profile.svg';

        // Вернуть текст метки и скрыть кнопку "Отменить"
        document.getElementById('uploadLabel').innerText = 'Загрузите аватарку';
        this.classList.add('hidden'); // Скрываем кнопку "Отменить"
    });
</script>
