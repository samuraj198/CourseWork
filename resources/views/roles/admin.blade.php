<div class="user-info mb-[50px] flex flex-col gap-2 items-center">
    @if (empty($user->ava))
        <div class="ava">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="white" stroke="black"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M54.7219 47C49.3118 54.8526 40.2571 60 30.0001 60C19.7432 60 10.6885 54.8526 5.27832 47C10.6885 39.1474 19.7432 34 30.0001 34C40.2571 34 49.3118 39.1474 54.7219 47Z" fill="black"/>
                <rect x="20" y="12" width="20" height="20" rx="10" fill="black"/>
            </svg>
        </div>
    @else
        <img class="w-[120px] h-[120px] rounded-full object-cover" src="/storage/avatars/{{$user->ava}}" alt="">
    @endif
    <h2 class="text-2xl dark:text-white">{{ $user->login }}
        <span class="text-black/50 text-sm dark:text-white/50">
            @if(auth()->check() && $user->id == auth()->user()->id)
                (Admin)
            @endif
        </span></h2>
    <div class="buttons flex gap-5">
        @if(auth()->check() && $user->id == auth()->user()->id)
            @include('modals/createCategory')
            <a onclick="openWorkModal()"><x-button text="Загрузить работу" /></a>
            <a onclick="openCategoryModal()"><x-button text="Создать категорию" /></a>
        @endif
    </div>
</div>
<div class="buttons-and-cards flex flex-col items-center w-full">
    <div class="buttons flex gap-5 text-2xl mb-[35px]">
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
        <div id="my-works" class="flex flex-wrap max-w-[1680px] justify-center">
            @forelse($works as $work)
                <div class="blockForCard p-[15px]">
                    <div class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg dark:border-white">
                        @if($user->id === auth()->user()->id)
                            <div class="buttons flex justify-between pt-2 px-2 absolute w-full h-full opacity-0 hover:opacity-100 transition-all duration-300">
                                <a href=""><img class="opacity-80 h-[20px] hover:opacity-100 transition-all duration-300" src="img/icons/settings.svg" alt=""></a>
                                <a href=""><img class="opacity-80 w-[20px] hover:opacity-100 transition-all duration-300" src="img/icons/trash.svg" alt=""></a>
                            </div>
                        @endif
                        <img class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white" src="storage/files_previews/{{$work->img}}" alt="">
                        <p class="text-center dark:text-white">{{$work->name}}</p>
                        <p class="text-center dark:text-white">{{$work->information}}</p>
                        <p class="text-center dark:text-white">{{$work->category->name}}</p>
                        <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black" href="{{ route('downloadFile', $work->id) }}">Скачать</a>
                    </div>
                </div>
            @empty
                <p>Пока нет загруженных работ</p>
            @endforelse
        </div>
        <div id="my-history" class="hidden flex flex-wrap max-w-[1680px] justify-center">
            @forelse($history as $work)
                <div class="blockForCard p-[15px]">
                    <div class="card flex flex-col items-center relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg dark:border-white">
                        <img class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white" src="storage/files_previews/{{$work->file->img}}" alt="">
                        <p class="text-center dark:text-white">{{$work->file->name}}</p>
                        <p class="text-center dark:text-white">{{$work->file->information}}</p>
                        <p class="text-center dark:text-white">{{$work->file->category->name}}</p>
                        <a class="underline dark:text-white" href="{{ route('profile', $work->file->user->login) }}">{{ $work->file->user->login }}</a>
                        <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black" href="{{ route('downloadFile', $work->file->id) }}">Скачать</a>
                    </div>
                </div>
            @empty
                @if(auth()->user()->id != $user->id)
                    <p class="dark:text-white">Пользователь ничего не скачивал</p>
                @else
                    <p class="dark:text-white">Вы ничего не скачивали</p>
                @endif
            @endforelse
        </div>
    </div>
    <div class="pagination mt-[25px]">
        {{ $works->links('pagination::bootstrap-4') }}
    </div>
</div>
