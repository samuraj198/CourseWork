@extends('main/main')
@section('title', 'Home Page')
@section('content')
    <div class="search-block w-3/4 mb-16">
        <form class="relative w-full" action="">
            <input type="text" class="w-full border-[1px] border-solid border-black rounded-lg py-[13px] pl-[15px]" placeholder="Введите название 3d-модели">
            <input type="button" value="Поиск" class="h-full absolute right-0 text-white bg-black rounded-r-lg px-5 cursor-pointer">
        </form>
    </div>
    <div class="categories-block flex flex-col items-center mb-16">
        <h2 class="text-2xl font-bold mb-5">ПОПУЛЯРНЫЕ КАТЕГОРИИ</h2>
        <div class="blocks w-[1600px] bg-black h-[200px]">

        </div>
    </div>
    <div class="categories-block flex flex-col items-center">
        <h2 class="text-2xl font-bold mb-5">ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ МОДЕЛИ</h2>
        <div class="blocks w-[1600px] bg-black h-[375px] mb-10">

        </div>
        <x-button text="Перейти в каталог" />
    </div>
@endsection
