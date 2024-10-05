@extends('main/main')
@section('title', 'Catalog')
@section('content')
    <div class="search-block w-3/4 mb-16">
        <form id="searchForm" class="relative w-full" action="{{ route('catalog') }}">
            @csrf
            <input name="filename" type="text" class="w-full border-[1px] border-solid border-black rounded-lg py-[13px] pl-[15px]" placeholder="Введите название 3d-модели">
            <input type="submit" value="Поиск" class="h-full absolute right-0 text-white bg-black rounded-r-lg px-5 cursor-pointer">
        </form>
    </div>
    <div class="cards flex flex-wrap gap-[30px] max-w-[1600px]">
        @if($files->isNotEmpty())
            @forelse($files as $file)
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg flex flex-col items-center">
                    <img class="h-1/2 w-full rounded-t-md" src="storage/files_previews/{{$file->img}}" alt="">
                    <p class="text-center">{{$file->name}}</p>
                    <p class="text-center">{{$file->information}}</p>
                    <p class="text-center">{{$file->category->name}}</p>
                    <a class="underline" href="{{ route('profile', $file->user->login) }}">{{ $file->user->login }}</a>
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300" href="{{ route('downloadFile', $file->id) }}">Скачать</a>
                </div>
            @empty
                <p>Нет таких работ</p>
            @endforelse
        @else
            @forelse($works as $work)
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg flex flex-col items-center">
                    <img class="h-1/2 w-full rounded-t-md" src="storage/files_previews/{{$work->img}}" alt="">
                    <p class="text-center">{{$work->name}}</p>
                    <p class="text-center">{{$work->information}}</p>
                    <p class="text-center">{{$work->category->name}}</p>
                    <a class="underline" href="{{ route('profile', $work->user->login) }}">{{ $work->user->login }}</a>
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300" href="{{ route('downloadFile', $work->id) }}">Скачать</a>
                </div>
            @empty
                <p>Нет работ</p>
            @endforelse
        @endif
    </div>
@endsection
