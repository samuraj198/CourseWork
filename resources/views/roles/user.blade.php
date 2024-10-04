<div class="user-info mb-[50px] flex flex-col gap-2 items-center">
    <img class="w-[120px] h-[120px] rounded-full object-cover" src="/storage/avatars/{{$user->ava}}" alt="">
    <h2 class="text-2xl">{{ $user->login }}
        <span class="text-black/50 text-sm">
            @if($user->id == auth()->user()->id)
                (Вы)
            @endif
        </span></h2>
    @if($user->id == auth()->user()->id)
        <a onclick="openWorkModal()"><x-button text="Загрузить работу" /></a>
    @endif
    @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="break-words">{{ $error }}</p>
            @endforeach
    @endif
</div>
<div class="buttons-and-cards">
    <div class="buttons flex gap-5 text-2xl mb-[50px]">
        @if($user->id == auth()->user()->id)
            <button id="myWorksBtn" class="w-[230px] text-right underline">
                Мои работы
            </button>
        @else
            <button id="myWorksBtn" class="w-[230px] text-right underline">
                Работы
            </button>
        @endif
        <div class="line w-[1px] h-8 border-black border-solid border-[1px]"></div>
        <button id="myHistoryBtn" class="w-[230px]">
            История скачиваний
        </button>
    </div>
    <div class="cards flex flex-col items-center">
        <div id="my-works" class="flex gap-[30px]">
            @forelse($works as $work)
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg">
                    {{$work->name}}
                    <a class="underline" href="{{ route('user.show', $work->user->login) }}">{{ $work->user->login }}</a>
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300" href="{{ route('downloadFile', $work->id) }}">Скачать</a>
                </div>
            @empty
                <p>Пока нет загруженных работ</p>
            @endforelse
        </div>
        <div id="my-history" class="hidden">
            <div class="card w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg">
                История скачиваний
            </div>
        </div>
    </div>
</div>
