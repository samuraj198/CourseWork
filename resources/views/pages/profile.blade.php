@extends('main/main')
@section('title', 'Profile')
@section('content')
    @if(auth()->check())
        @if(auth()->user()->hasRole('User'))
            @include('roles/user')
            @include('modals/createWork')
        @elseif(auth()->user()->hasRole('Admin'))
            @include('roles/admin')
            @include('modals/createWork')
        @endif
    @else
        @include('roles/user')
    @endif

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
