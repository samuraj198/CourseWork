@extends('main.main')
@section('title', 'Панель администратора')
@section('content')
    @include('modals/createWork')
    @include('modals/createCategory')
    @include('modals/changeDelCategory')
    @include('modals/changeStatus')
    <h2 class="text-2xl font-bold mb-5 dark:text-white max-mobileL:text-xl max-mobileM:text-lg max-mobileS:text-sm">
        Панель администратора
    </h2>
    <h2 class="text-xl font-bold my-[15px] dark:text-white max-mobileL:text-xl max-mobileM:text-lg max-mobileS:text-sm">
        Взаимодействие с категориями
    </h2>
    <div class="categories flex gap-5 mb-5">
        <x-button onclick="openCategoryModal()" text="Создать категорию"/>
        <x-button onclick="openChangeCategoryModal()" text="Изменить категории"/>
    </div>
   <div class="flex gap-5 my-[15px] items-center">
       <h2 class="text-xl font-bold dark:text-white max-mobileL:text-xl max-mobileM:text-lg max-mobileS:text-sm">
           Взаимодействие с проектами
       </h2>
       <form method="GET">
           @csrf
           <select class="border-black border-solid border-[1px] py-[13px]
           px-[15px] rounded-lg dark:bg-black dark:border-white dark:text-white"
                   onchange="this.form.submit()" name="status">
               <option value="">Все</option>
               <option {{ request('status') == 'Проверяется' ? 'selected' : '' }} value="Проверяется">В проверке</option>
               <option {{ request('status') == 'Одобрено' ? 'selected' : '' }} value="Одобрено">Одобрены</option>
               <option {{ request('status') == 'Отклонено' ? 'selected' : '' }} value="Отклонено">Отклонены</option>
           </select>
       </form>
   </div>
    <div class="files flex max-w-[1680px] flex-wrap w-full justify-center">
        @forelse($files as $work)
            <div class="blockForCard p-[15px]">
                <div
                    class="card relative w-[250px] h-[375px] border-solid border-black border-[1px] rounded-lg dark:border-white">
                    <div
                        class="buttons flex justify-between pt-2 px-2 absolute w-full  opacity-0 hover:opacity-100 transition-all duration-300">
                        <a class="cursor-pointer w-[20px] h-[20px]"
                            onclick="changeWorkModal({{ $work->id }}, '{{ addslashes($work->img) }}', '{{ addslashes($work->name) }}', '{{ $work->category_id }}', '{{ addslashes($work->information) }}', '{{ addslashes($work->file) }}')"><img
                            class="opacity-80 h-[20px] hover:opacity-100 transition-all duration-300"
                            src="img/icons/settings.svg" alt=""></a>
                        <form class="h-[20px] w-[20px]" method="POST" action="{{ secure_url(route('deleteFile')) }}">
                            @csrf
                            @method('DELETE')
                            <input class="hidden" name="id" type="text" value="{{ $work->id }}">
                            <button type="submit"><img
                                    class="opacity-80 w-[20px] hover:opacity-100 transition-all duration-300"
                                    src="img/icons/trash.svg" alt=""></button>
                        </form>
                    </div>
                    <img
                        class="h-1/2 w-full rounded-t-md object-cover border-solid border-black border-b-[1px] dark:border-white"
                        src="{{ asset('storage/files_previews/' . $work->img) }}" alt="">
                    <p class="text-center dark:text-white">{{$work->name}}</p>
                    <p class="text-center dark:text-white">{{$work->information}}</p>
                    <form class="z-10" action="{{ secure_url(route('catalog')) }}">
                        @csrf
                        <input class="hidden" name="categ" value="{{ $work->category->id }}">
                        <input type="submit" class="text-center cursor-pointer underline dark:text-white w-full z-10"
                               value="{{$work->category->name}}">
                    </form>
                    <p class="dark:text-white text-center">{{ $work->status }}</p>
                    <div class="absolute left-0 bottom-0 w-full flex">
                        <a class="w-full flex items-center justify-center text-center cursor-pointer
                        text-xl font-bold py-[10px] border-solid border-black rounded-bl-md border-t-[1px]
                        hover:bg-black hover:text-white transition-all duration-300 dark:text-white
                        dark:border-white dark:hover:bg-white dark:hover:text-black"
                           onclick="openChangeStatusModal({{ $work->id }})">
                            Изменить статус
                        </a>
                        <a class="w-full flex items-center justify-center text-center
                        text-xl font-bold py-[10px] border-solid border-black rounded-br-md border-t-[1px]
                        hover:bg-black hover:text-white transition-all duration-300 dark:text-white
                        dark:border-white dark:hover:bg-white dark:hover:text-black"
                           href="{{ route('downloadFile', $work->id) }}">
                            Скачать
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="dark:text-white py-5">Пока нет работ на проверке</p>
        @endforelse
    </div>
    <div class="pagination mt-[25px]">
        {{ $files->links('pagination::bootstrap-4') }}
    </div>
@endsection
@section('js')
    function openCategoryModal() {
    document.getElementById('modalCategory').classList.remove('hidden');
    document.body.classList.add('no-scroll');
    }

    function closeCategoryModal() {
    document.getElementById('modalCategory').classList.add('hidden');
    document.body.classList.remove('no-scroll');
    }

    function openChangeCategoryModal() {
    document.getElementById('modalChangeCategory').classList.remove('hidden');
    }
    function closeChangeCategoryModal() {
    document.getElementById('modalChangeCategory').classList.add('hidden');
    }

    document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mouseenter', () => {
    card.querySelector('.buttons').style.opacity = '1';
    });
    card.addEventListener('mouseleave', () => {
    card.querySelector('.buttons').style.opacity = '0';
    });
    });
@endsection
