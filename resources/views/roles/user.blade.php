<div class="user-info mb-[50px] flex flex-col gap-2 items-center dark:text-white">
    @if(empty($user->ava))
        <img class="w-[120px] h-[120px] rounded-full object-cover border-black border-solid border-[1px] dark:border-white" src="/img/icons/profile.svg" alt="">
    @else
        <img class="w-[120px] h-[120px] rounded-full object-cover" src="/storage/avatars/{{$user->ava}}" alt="">
    @endif

    <h2 class="text-2xl">{{ $user->login }}
        <span class="text-black/50 text-sm dark:text-white">
            @if(auth()->check() && $user->id == auth()->user()->id)
                (Вы)
            @endif
        </span></h2>
    @if(auth()->check() && $user->id == auth()->user()->id)
        <a onclick="openWorkModal()"><x-button text="Загрузить работу" /></a>
    @endif
    @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="break-words dark:text-white">{{ $error }}</p>
            @endforeach
    @endif
</div>
<div class="buttons-and-cards flex flex-col items-center w-full">
    <div class="buttons flex gap-5 text-2xl mb-[50px]">
        @if(auth()->check() && $user->id == auth()->user()->id)
            <button id="myWorksBtn" class="w-[230px] text-right underline dark:text-white">
                Мои работы
            </button>
        @else
            <button id="myWorksBtn" class="w-[230px] text-right underline dark:text-white">
                Работы
            </button>
        @endif
        <div class="line w-[1px] h-8 border-black border-solid border-[1px] dark:border-white"></div>
        <button id="myHistoryBtn" class="w-[230px] dark:text-white">
            История скачиваний
        </button>
    </div>
    <div class="cards flex flex-col items-center w-full">
        <div id="my-works" class="flex gap-[30px] flex-wrap w-full justify-center">
            @forelse($works as $work)
                <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg dark:border-white">
                    <img class="h-1/2 w-full rounded-t-md object-cover" src="storage/files_previews/{{$work->img}}" alt="">
                    <p class="text-center dark:text-white">{{$work->name}}</p>
                    <p class="text-center dark:text-white">{{$work->information}}</p>
                    <p class="text-center dark:text-white">{{$work->category->name}}</p>
                    <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black" href="{{ route('downloadFile', $work->id) }}">Скачать</a>
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
