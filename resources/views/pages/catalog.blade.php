@extends('main/main')
@section('title', 'Catalog')
@section('content')
    <div class="search-block w-3/4 mb-16">
        <form class="relative w-full" action="{{ route('catalog') }}">
            @csrf
            <input value="{{ old('filename', $filename) }}" name="filename" type="text" class="w-full border-[1px] border-solid border-black rounded-lg py-[13px] pl-[15px] pr-[100px] dark:border-white dark:bg-black dark:text-white" placeholder="Введите название 3d-модели">
            <input type="submit" value="Поиск" class="h-full absolute right-0 text-white bg-black rounded-r-lg px-5 cursor-pointer border-solid border-[1px] border-black dark:border-white">
        </form>
    </div>
    <div class="cards flex flex-wrap gap-[30px] max-w-[1600px]">
        @forelse($files as $file)
            <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg flex flex-col items-center dark:border-[1px] dark:border-white">
                <img class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white" src="storage/files_previews/{{$file->img}}" alt="">
                <p class="text-center dark:text-white">{{$file->name}}</p>
                <p class="text-center dark:text-white">{{$file->information}}</p>
                <p class="text-center dark:text-white">{{$file->category->name}}</p>
                <a class="underline dark:text-white" href="{{ route('profile', $file->user->login) }}">{{ $file->user->login }}</a>
                <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black"
                   href="{{ route('downloadFile', $file->id) }}">Скачать</a>
            </div>
        @empty
            <p class="dark:text-white">Нет таких работ</p>
        @endforelse
    </div>
@endsection
