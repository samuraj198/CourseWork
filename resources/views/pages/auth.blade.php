@vite('resources/css/app.css')
<a href="{{ route('index') }}" class="absolute left-10 top-5 text-black/50 text-2xl">Назад</a>
<div class="auth-form flex flex-col items-center mt-[100px]">
    <h2 class="text-2xl font-bold mb-5">ВХОД</h2>
    <form method="POST" action="{{ route('auth') }}" class="flex flex-col items-center gap-5 w-full">
        @csrf
        <input name="login" class="w-1/3 border-black border-solid border-[1px] py-[13px] pl-[15px] rounded-lg" type="text" placeholder="Введите логин">
        <input name="password" class="w-1/3 border-black border-solid border-[1px] py-[13px] pl-[15px] rounded-lg" type="password" placeholder="Введите пароль">
        <a type="submit"><x-button text="Войти" /></a>
    </form>
    <p>Нет аккаунта? <a href="{{ route('register') }}" class="underline decoration-solid hover:text-blue-500 transition-all duration-300">Зарегистрироваться</a></p>
</div>
