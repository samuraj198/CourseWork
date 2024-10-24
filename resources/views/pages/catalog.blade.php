@extends('main/main')
@section('title', 'Catalog')
@section('content')
    <div class="search-block w-3/4 mb-14">
        <div class="forms flex items-center gap-5">
            <form class="relative w-full" action="{{ route('catalog') }}">
                @csrf
                <input name="categ" class="hidden" value="@if(!empty($categ)){{ $categ }}@endif">
                <input name="filename" type="text" class="w-full border-[1px] border-solid border-black rounded-lg py-[13px] pl-[15px] pr-[100px] dark:border-white dark:bg-black dark:text-white" placeholder="Введите название 3d-модели">
                <input type="submit" value="Поиск" class="h-full absolute right-0 text-white bg-black rounded-r-lg px-5 cursor-pointer border-solid border-[1px] border-black dark:border-white">
            </form>
            <form class="rounded-lg border-black border-[1px] dark:border-white dark:bg-black dark:text-white" action="{{ route('catalog') }}">
                @csrf
                <input name="filename" class="hidden" value="@if(!empty($filename)){{ $filename }}@endif">
                <select name="categ" onchange="this.form.submit()" class="py-[13px] px-[15px] rounded-lg dark:bg-black">
                    <option disabled selected hidden>Выберите категорию</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                        <option disabled>Нет категорий</option>
                    @endforelse
                </select>
            </form>
        </div>
        <div class="requests mt-2 flex gap-2">
            @if(!empty($filename))
                <div class="last flex gap-1 rounded-lg px-2 py-1 border-black border-[1px] dark:border-white dark:text-white">
                    <form method="GET" action="{{ route('searchClear') }}">
                        <input name="categ" class="hidden" value="@if(!empty($categ)){{ $categ }}@endif">
                        <input name="filename" class="hidden" value="@if(!empty($filename)){{ $filename }}@endif">
                        <input name="clear_filename" class="hidden" value="true">
                        <span>{{ $filename }}</span>
                        <button class="cursor-pointer" type="submit">&times;</button>
                    </form>
                </div>
            @endif
            @if(!empty($categ))
                <div class="last flex gap-1 items-center">
                    <form class="rounded-lg px-2 py-1 border-black border-[1px] dark:border-white dark:text-white" method="GET" action="{{ route('searchClear') }}">
                        <input name="categ" class="hidden" value="@if(!empty($categ)){{ $categ }}@endif">
                        <input name="filename" class="hidden" value="@if(!empty($filename)){{ $filename }}@endif">
                        <input name="clear_categ" class="hidden" value="true">
                        <span>
                            @if(!empty($categ_name))
                                {{ $categ_name }}
                            @endif
                        </span>
                        <button class="cursor-pointer" type="submit">&times;</button>
                    </form>
                    <form class="ml-5 text-black dark:text-white" action="{{ route('searchClear') }}">
                        <input name="categ" class="hidden" value="@if(!empty($categ)){{ $categ }}@endif">
                        <input name="filename" class="hidden" value="@if(!empty($filename)){{ $filename }}@endif">
                        <input name="clear_all" class="hidden" value="true">
                        <button type="submit">Очистить все</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <div class="cards flex flex-wrap max-w-[1680px]">
        @forelse($files as $file)
            <div class="blockForCard p-[15px]">
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg flex flex-col items-center dark:border-[1px] dark:border-white">
                    <img class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white" src="storage/files_previews/{{$file->img}}" alt="">
                    <p class="text-center dark:text-white">{{$file->name}}</p>
                    <p class="text-center dark:text-white">{{$file->information}}</p>
                    <p class="text-center dark:text-white">{{$file->category->name}}</p>
                    <a class="underline dark:text-white" href="{{ route('profile', $file->user->login) }}">{{ $file->user->login }}</a>
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black"
                       href="{{ route('downloadFile', $file->id) }}">Скачать</a>
                </div>
            </div>
        @empty
            <p class="dark:text-white">Нет таких работ</p>
        @endforelse
    </div>
@endsection
