@extends('main/main')
@section('title', 'Home Page')
@section('content')
    <style>
        @forelse($categories as $category)
            #card-{{$category->id}} {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)) ,url("storage/categories/{{$category->img}}");
            background-size: cover;
        }
        @empty

        @endforelse
    </style>
    <div class="search-block w-3/4 mb-16">
        <form class="relative w-full" action="{{ route('catalog') }}">
            @csrf
            <input name="filename" type="text" class="w-full border-[1px] border-solid border-black rounded-lg py-[13px] pl-[15px] pr-[100px] dark:border-white dark:bg-black dark:text-white" placeholder="Введите название 3d-модели">
            <input type="submit" value="Поиск" class="h-full absolute right-0 text-white bg-black rounded-r-lg px-5 cursor-pointer border-solid border-[1px] border-black dark:border-white">
        </form>
    </div>
    <div class="categories-block flex flex-col items-center mb-16">
        <h2 class="text-2xl font-bold mb-5 dark:text-white">ПОПУЛЯРНЫЕ КАТЕГОРИИ</h2>
        <div class="blocks w-[1600px] h-[200px] flex gap-5">
            @forelse($categories as $category)
                <div id="card-{{$category->id}}" class="block rounded-lg border-black border-solid border-[1px] w-[250px] h-[200px] font-bold text-white text-2xl flex items-center justify-center dark:border-[1px] dark:border-white">
                    {{ $category->name }}
                </div>
            @empty
                <p class="dark:text-white">Нет категорий</p>
            @endforelse
        </div>
    </div>
    <div class="categories-block flex flex-col items-center">
        <h2 class="text-2xl font-bold mb-5 dark:text-white">ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ МОДЕЛИ</h2>
        <div class="blocks flex gap-[30px] max-w-[1600px] mb-10">
            @forelse($works as $work)
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg flex flex-col items-center dark:border-[1px] dark:border-white">
                    <img class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white" src="storage/files_previews/{{$work->img}}" alt="">
                    <p class="text-center dark:text-white">{{$work->name}}</p>
                    <p class="text-center dark:text-white">{{$work->information}}</p>
                    <p class="text-center dark:text-white">{{$work->category->name}}</p>
                    <a class="underline dark:text-white" href="{{ route('profile', $work->user->login) }}">{{ $work->user->login }}</a>
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black" href="{{ route('downloadFile', $work->id) }}">Скачать</a>
                </div>
            @empty
                <p class="dark:text-white">Нет работ</p>
            @endforelse
        </div>
        <a href="{{ route('catalog') }}"><x-button text="Перейти в каталог" /></a>
    </div>
@endsection
