@extends('main/main')
@section('title', 'Profile')
@section('content')
    <div class="user-info mb-[50px] flex flex-col items-center">
        <img class="w-[120px] h-[120px] rounded-full" src="/storage/avatars/{{$user->ava}}" alt="">
        <h2 class="mt-2 text-2xl">{{ $user->login }}</h2>
    </div>
    <div class="buttons-and-cards">
        <div class="buttons flex gap-5 text-2xl mb-[50px]">
            <button id="myWorksBtn" class="w-[230px] text-right underline">
                Мои работы
            </button>
            <div class="line w-[1px] h-8 border-black border-solid border-[1px]"></div>
            <button id="myHistoryBtn" class="w-[230px]">
                История скачиваний
            </button>
        </div>
        <div class="cards flex flex-col items-center">
            <div id="my-works">
                <div class="card w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg">
                    Мои работы
                </div>
            </div>
            <div id="my-history" class="hidden">
                <div class="card w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg">
                    История скачиваний
                </div>
            </div>
        </div>
    </div>
    <script>
        const myWorksBtn = document.getElementById('myWorksBtn');
        const downloadHistoryBtn = document.getElementById('myHistoryBtn');
        const myWorksSection = document.getElementById('my-works');
        const downloadHistorySection = document.getElementById('my-history');

        // Добавляем события на кнопки
        myWorksBtn.addEventListener('click', () => {
            myWorksSection.classList.remove('hidden');
            downloadHistorySection.classList.add('hidden');
            myWorksBtn.style.textDecoration = 'underline';
            downloadHistoryBtn.style.textDecoration = 'none';
        });

        downloadHistoryBtn.addEventListener('click', () => {
            downloadHistorySection.classList.remove('hidden');
            myWorksSection.classList.add('hidden');
            downloadHistoryBtn.style.textDecoration = 'underline';
            myWorksBtn.style.textDecoration = 'none';
        });
    </script>
@endsection
