@extends('main.main')
@section('title', 'Проект ' . $file->name)
@section('content')
    <div class="flex flex-col gap-5 items-center">
        <div class="nameAndImg flex gap-5 justify-center max-mobileL:flex-col">
            <img width="400px" src="{{ asset('storage/files_previews/' . $file->img) }}" alt="{{ $file->name }}">
            <div class="text relative">
                <h2 class="text-2xl flex items-end gap-1 font-bold mb-5 dark:text-white max-mobileL:text-xl">
                    {{ $file->name }}
                    <p class="text-black/50 dark:text-white/50 text-lg">
                        (<a class="underline" href="{{ secure_url(route('profile', $file->user->login)) }}">{{ $file->user->login }}</a>)
                    </p>
                </h2>
                <p class="dark:text-white">{{ $file->information}}</p>
                <form class="mb-5" action="{{ secure_url(route('catalog')) }}">
                    @csrf
                    <input class="hidden" name="categ" value="{{ $file->category->id }}">
                    <input type="submit" class="text-center cursor-pointer underline dark:text-white" value="{{ $file->category->name}}">
                </form>
                <x-button text="Скачать" href="{{ route('downloadFile', $file->id) }}" />
                <p class="dark:text-white mt-5">Скачиваний: {{ $file->downloadCount }}</p>
            </div>
        </div>
        @if($error)
            <p class="text-red-500">{{ $error }}</p>
        @else
            <model-viewer class="w-full h-[500px]"
                          alt="3D модель {{ $file->name }}"
                          src="{{ $modelPath }}"
                          camera-orbit="0deg 75deg 2m"
                          field-of-view="25deg"
                          ar
                          camera-controls
                          auto-rotate
                          shadow-intensity="1.5"
                          environment-image="neutral"
                          touch-action="pan-y"
            ></model-viewer>
        @endif
    </div>

@endsection
