@extends('main/main')
@section('title', 'Profile')
@section('content')
    @include('modals/createWork')
    <div class="user-info mb-[50px] flex flex-col gap-2 items-center dark:text-white">
        @if(empty($user->ava))
            <div class="logo">
                <svg width="120" height="120" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect class="fill-white stroke-black dark:fill-black dark:stroke-white" x="0.5" y="0.5" width="59"
                          height="59" rx="29.5"/>
                    <path class="dark:fill-white" fill-rule="evenodd" clip-rule="evenodd"
                          d="M54.7219 47C49.3118 54.8526 40.2571 60 30.0001 60C19.7432 60 10.6885 54.8526 5.27832 47C10.6885 39.1474 19.7432 34 30.0001 34C40.2571 34 49.3118 39.1474 54.7219 47Z"
                          fill="black"/>
                    <rect class="fill-black dark:fill-white" x="20" y="12" width="20" height="20" rx="10" fill="black"/>
                </svg>
            </div>
        @else
            <img class="w-[120px] h-[120px] rounded-full object-cover" src="/storage/avatars/{{$user->ava}}" alt="">
        @endif

        <h2 class="text-2xl">{{ $user->login }}
            <span class="text-black/50 text-sm dark:text-white/50">
            @if(auth()->check() && $user->id == auth()->user()->id)
                    @if($user->hasRole('User'))
                        (Вы)
                    @elseif($user->hasRole('Admin'))
                        (Вы)(Admin)
                    @endif
            @endif
        </span></h2>
        @if(auth()->check() && $user->id == auth()->user()->id)
            @if($user->hasRole('User'))
                <a onclick="openWorkModal()"><x-button text="Загрузить работу"/></a>
            @elseif($user->hasRole('Admin'))
                @include('modals/createCategory')
                <div class="btns flex gap-5">
                    <a onclick="openWorkModal()"><x-button text="Загрузить работу"/></a>
                    <a onclick="openCategoryModal()"><x-button text="Создать категорию"/></a>
                </div>
            @endif
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="break-words dark:text-white">{{ $error }}</p>
            @endforeach
        @endif
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
            <div id="my-works" class="flex max-w-[1680px] flex-wrap w-full justify-center">
                @forelse($works as $work)
                    <div class="blockForCard p-[15px]">
                        <div
                            class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg dark:border-white">
                            @if(auth()->check() && $user->id === auth()->user()->id)
                                <div
                                    class="buttons flex justify-between pt-2 px-2 absolute w-full h-full opacity-0 hover:opacity-100 transition-all duration-300">
                                    <a class="cursor-pointer w-[20px] h-[20px]"
                                       onclick="changeWorkModal({{ $work->id }}, '{{ $work->img }}', '{{ $work->name }}', '{{ $work->category_id }}', '{{ $work->information }}', '{{ $work->file }}')"><img
                                            class="opacity-80 h-[20px] hover:opacity-100 transition-all duration-300"
                                            src="img/icons/settings.svg" alt=""></a>
                                    <form class="h-[20px] w-[20px]" method="POST" action="{{ route('deleteFile') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input class="hidden" name="id" type="text" value="{{ $work->id }}">
                                        <button type="submit"><img
                                                class="opacity-80 w-[20px] hover:opacity-100 transition-all duration-300"
                                                src="img/icons/trash.svg" alt=""></button>
                                    </form>
                                </div>
                            @endif
                            <img
                                class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white"
                                src="storage/files_previews/{{$work->img}}" alt="">
                            <p class="text-center dark:text-white">{{$work->name}}</p>
                            <p class="text-center dark:text-white">{{$work->information}}</p>
                            <p class="text-center dark:text-white">{{$work->category->name}}</p>
                            <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black"
                               href="{{ route('downloadFile', $work->id) }}">Скачать</a>
                        </div>
                    </div>
                @empty
                    <p class="dark:text-white">Пока нет загруженных работ</p>
                @endforelse
            </div>
            <div id="my-history" class="hidden flex flex-wrap max-w-[1680px] justify-center">
                @forelse($history as $work)
                    <div class="blockForCard p-[15px]">
                        <div
                            class="card flex flex-col items-center relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg dark:border-white">
                            <img
                                class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white"
                                src="storage/files_previews/{{$work->file->img}}" alt="">
                            <p class="text-center dark:text-white">{{$work->file->name}}</p>
                            <p class="text-center dark:text-white">{{$work->file->information}}</p>
                            <p class="text-center dark:text-white">{{$work->file->category->name}}</p>
                            <a class="underline dark:text-white"
                               href="{{ route('profile', $work->file->user->login) }}">{{ $work->file->user->login }}</a>
                            <a class="absolute left-0 bottom-0 w-full text-center text-2xl font-bold py-[10px] border-solid border-black rounded-b-md border-t-[1px] hover:bg-black hover:text-white transition-all duration-300 dark:text-white dark:border-white dark:hover:bg-white dark:hover:text-black"
                               href="{{ route('downloadFile', $work->file->id) }}">Скачать</a>
                        </div>
                    </div>
                @empty
                    @if(auth()->check() && auth()->user()->id != $user->id)
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {

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
        });

        function openWorkModal() {
            document.getElementById('modalWork').classList.remove('hidden');

            //Очистка полей
            //Заполнение полей
            document.getElementById('name').value = '';
            document.getElementById('information').value = '';
            document.getElementById('category_id').value = 0;
            document.getElementById('filePreview').src = '/img/icons/Camera.svg';
            document.getElementById('filePreview').classList.remove('h-full');

            document.getElementById('upText').textContent = 'Загрузите фотографию модели';
            document.getElementById('fileBlock').classList.remove('hidden');
            document.getElementById('formName').textContent = 'ОПУБЛИКОВАТЬ РАБОТУ';
        }

        function changeWorkModal(id, img, name, category_id, information, file) {
            document.getElementById('modalWork').classList.remove('hidden');

            //Заполнение полей
            document.getElementById('name').value = name;
            document.getElementById('information').value = information;
            document.getElementById('category_id').value = category_id;
            document.getElementById('filePreview').src = 'storage/files_previews/' + img;
            document.getElementById('filePreview').classList.add('h-full');
            document.getElementById('changeId').value = id;

            //Изменение формы под модалку изменения файла
            document.getElementById('upText').textContent = 'Выберите новое фото';
            document.getElementById('fileBlock').classList.add('hidden');
            document.getElementById('formName').textContent = 'ИЗМЕНИТЬ РАБОТУ';
        }

        function closeWorkModal() {
            document.getElementById('modalWork').classList.add('hidden');
        }

        function openCategoryModal() {
            document.getElementById('modalCategory').classList.remove('hidden');
        }

        function closeCategoryModal() {
            document.getElementById('modalCategory').classList.add('hidden');
        }
    </script>
@endsection
