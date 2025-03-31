@vite('resources/css/app.css')
<a href="{{ secure_url(route('index')) }}" class="absolute left-10 top-5 text-black/50 text-2xl dark:text-white/50">Назад</a>
<div class="register-form flex flex-col items-center mt-[100px]">
    <h2 class="text-2xl font-bold mb-5 dark:text-white">РЕГИСТРАЦИЯ</h2>
    <form method="POST" action="{{ secure_url(route('register')) }}" class="flex flex-col items-center gap-5 w-full"
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
        <div class="loginBlock flex flex-col items-center w-full">
            <input id="loginInput" name="login" class="w-1/3 border-black border-solid border-[1px] py-[13px]
             pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
                   type="text" placeholder="Введите логин">
            <p class="hidden text-red-500 mt-2" id="loginError"></p>
        </div>
        <div class="emailBlock flex flex-col items-center w-full">
            <input id="emailInput" name="email" class="w-1/3 border-black border-solid border-[1px] py-[13px]
             pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
                   type="email" placeholder="Введите почту">
            <p class="hidden text-red-500 mt-2" id="emailError"></p>
        </div>
        <div class="passwordError flex flex-col items-center w-full">
            <input id="passwordInput" name="password" class="w-1/3 border-black border-solid border-[1px] py-[13px]
             pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
                   type="password" placeholder="Введите пароль">
            <p class="hidden text-red-500 mt-2" id="passwordError"></p>
        </div>
        <div class="confError flex flex-col items-center w-full">
            <input id="confInput" name="password_confirmation"
                   class="w-1/3 border-black border-solid border-[1px] py-[13px]
             pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white" type="password"
                   placeholder="Повторите пароль">
            <p class="hidden text-red-500 mt-2" id="confError"></p>
        </div>
        <x-button type="submit" id="regButton" text="Зарегистрироваться"/>
    </form>
    <p class="dark:text-white">Уже есть аккаунт? <a href="{{ secure_url(route('auth')) }}"
                            class="underline decoration-solid hover:text-blue-500 transition-all duration-300">Войти</a>
    </p>
    @if($errors->any())
        <div class="error text-red-500 mt-10">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        loginInput = document.getElementById('loginInput');
        emailInput = document.getElementById('emailInput');
        passwordInput = document.getElementById('passwordInput');
        confInput = document.getElementById('confInput');
        regButton = document.getElementById('regButton');

        //disabled for button
        regButton.disabled = true;
        regButton.classList.add('disabled');

        //blocks for errors
        loginError = document.getElementById('loginError');
        emailError = document.getElementById('emailError');
        passwordError = document.getElementById('passwordError');
        confError = document.getElementById('confError');

        function regValidate() {
            let valid = true;

            loginError.textContent = '';
            emailError.textContent = '';
            passwordError.textContent = '';
            confError.textContent = '';
            if (localStorage.getItem('theme') === 'dark') {
                loginInput.style.borderColor = 'white';
                emailInput.style.borderColor = 'white';
                passwordInput.style.borderColor = 'white';
                confInput.style.borderColor = 'white';
            } else {
                loginInput.style.borderColor = 'black';
                emailInput.style.borderColor = 'black';
                passwordInput.style.borderColor = 'black';
                confInput.style.borderColor = 'black';
            }

            if (loginInput.value.trim() === '' || passwordInput.value.trim() === '' || emailInput.value.trim() === '' || confInput.value.trim() === '' ) {
                valid = false;
                loginError.textContent = '';
                emailError.textContent = '';
                passwordError.textContent = '';
                confError.textContent = '';
                loginInput.style.borderColor = 'white';
                emailInput.style.borderColor = 'white';
                passwordInput.style.borderColor = 'white';
                confInput.style.borderColor = 'white';
                passwordError.classList.add('hidden');
                loginError.classList.add('hidden');
                emailError.classList.add('hidden');
                confError.classList.add('hidden');
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(emailInput.value.trim()) && emailInput.value.trim() !== '') {
                valid = false;
                emailError.textContent = 'Неверный формат почты';
                emailInput.style.borderColor = '#ef4444'
                emailError.classList.remove('hidden');
            }
            if (!/^\w+$/.test(loginInput.value.trim()) && loginInput.value.trim() !== '') {
                valid = false;
                loginError.textContent = 'Логин должен быть написан на латинице';
                loginInput.style.borderColor = '#ef4444';
                loginError.classList.remove('hidden');
            }
            if(passwordInput.value.trim() !== '' && passwordInput.value.trim().length < 8){
                valid = false;
                passwordError.textContent = 'Пароль должен содержать минимум 8 символов';
                passwordInput.style.borderColor  = '#ef4444';
                passwordError.classList.remove('hidden');
            }
            if (confInput.value.trim() !== '' && passwordInput.value.trim() !== '' && confInput.value.trim() !== passwordInput.value.trim()) {
                valid = false;
                confError.textContent = 'Пароли не совпадают';
                confInput.style.borderColor = '#ef4444';
                confError.classList.remove('hidden');
            }

            regButton.disabled = !valid;
            loginInput.classList.toggle('disabled', !valid);
        }

        loginInput.addEventListener('input', regValidate);
        emailInput.addEventListener('input', regValidate);
        passwordInput.addEventListener('input', regValidate);
        confInput.addEventListener('input', regValidate);
    });

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
