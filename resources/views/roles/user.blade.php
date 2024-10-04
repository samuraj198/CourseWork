<div class="user-info mb-[50px] flex flex-col gap-2 items-center">
    <img class="w-[120px] h-[120px] rounded-full object-cover" src="/storage/avatars/{{$user->ava}}" alt="">
    <h2 class="text-2xl">{{ $user->login }}</h2>
    <a onclick="openWorkModal()"><x-button text="Загрузить работу" /></a>
    @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="break-words">{{ $error }}</p>
            @endforeach
    @endif
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
            @forelse($works as $work)
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg">
                    {{$work->name}}
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300" href="{{ route('downloadFile', $work->id) }}">Скачать</a>
                </div>
            @empty
                <p>Нет работ</p>
            @endforelse
        </div>
        <div id="my-history" class="hidden">
            <div class="card w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg">
                История скачиваний
            </div>
        </div>
    </div>
</div>
