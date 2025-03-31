@vite('resources/css/app.css')
<a href="{{ secure_url(route('index')) }}" class="absolute left-10 top-5 text-black/50 text-2xl dark:text-white/50">Назад</a>
<div class="auth-form flex flex-col items-center mt-[100px]">
    <h2 class="text-2xl font-bold mb-5 dark:text-white">ВХОД</h2>
    <form method="POST" action="{{ secure_url(route('auth')) }}" class="flex flex-col items-center gap-5 w-full">
        @csrf
        <div class="loginBlock w-full flex flex-col items-center">
            <input id="loginInput" name="login" class="w-1/3 border-black !important border-solid border-[1px]
             py-[13px] pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
                   type="text" placeholder="Введите логин" required autocomplete="login">
            <p class="hidden text-red-500 mt-2" id="loginError"></p>
        </div>
        <div class="passwordBlock w-full flex flex-col items-center">
            <input id="passwordInput" name="password" class="w-1/3 border-black border-solid border-[1px] py-[13px]
             pl-[15px] rounded-lg dark:border-white dark:bg-black dark:text-white"
                   type="password" placeholder="Введите пароль" required autocomplete="current-password">
            <p class="hidden text-red-500 mt-2" id="passwordError"></p>
        </div>
        <x-button type="submit" id="loginButton" text="Войти" />
    </form>
    <p class="dark:text-white">Нет аккаунта? <a href="{{ secure_url(route('register')) }}" class="underline decoration-solid hover:text-blue-500 transition-all duration-300">Зарегистрироваться</a></p>
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
        passwordInput = document.getElementById('passwordInput');
        loginButton = document.getElementById('loginButton');

        //disabled for button
        if (loginInput.value.trim() === '' || passwordInput.value.trim() === '') {
            loginButton.disabled = true;
        } else {
            loginButton.disabled = false;
        }
        loginButton.classList.add('disabled');

        //blocks for errors
        loginError = document.getElementById('loginError');
        passwordError = document.getElementById('passwordError');

        function loginValidate() {
            let valid = true;

            loginError.textContent = '';
            passwordError.textContent = '';
            if (localStorage.getItem('theme') === 'dark') {
                loginInput.style.borderColor = 'white';
                passwordInput.style.borderColor = 'white';
            } else {
                loginInput.style.borderColor = 'black';
                passwordInput.style.borderColor = 'black';
            }

            if (loginInput.value.trim() === '' || passwordInput.value.trim() === '') {
                valid = false;
                loginError.textContent = '';
                passwordError.textContent = '';
                if (localStorage.getItem('theme') === 'dark') {
                    loginInput.style.borderColor = 'white';
                    passwordInput.style.borderColor = 'white';
                } else if (localStorage.getItem('theme') === 'white') {
                    loginInput.style.borderColor = 'black';
                    passwordInput.style.borderColor = 'black';
                }
                passwordError.classList.add('hidden');
                loginError.classList.add('hidden');
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

            loginButton.disabled = !valid;
            loginInput.classList.toggle('disabled', !valid);
        }

        loginInput.addEventListener('input', loginValidate);
        passwordInput.addEventListener('input', loginValidate);
    });

    const htmlElement = document.documentElement;

    if (localStorage.getItem('theme') === 'dark') {
        htmlElement.classList.add('dark');
        htmlElement.style.backgroundColor = 'black';
    }
</script>
