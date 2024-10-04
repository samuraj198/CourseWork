<div id="modalWork" class="modal z-50 hidden w-full h-full bg-black/80 fixed left-0 top-0 flex justify-center items-start">
    <form method="POST" action="{{ route('createWork') }}" class="rounded-lg relative flex flex-col items-center gap-5 bg-white p-10 w-1/3 mt-20" enctype="multipart/form-data">
        @csrf
        <a onclick="closeWorkModal()" class="absolute right-5 top-2 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold text-center">ОПУБЛИКОВАТЬ РАБОТУ</h2>
        <div class="preview w-full">
            <div class="flex items-start gap-5">
                <div class="shrink-0 relative w-[250px] h-[250px] bg-gray-300 rounded-lg overflow-hidden flex items-center justify-center">
                    <img id="filePreview" src="/img/icons/Camera.svg" alt="Аватар" class="object-cover cursor-pointer">
                    <input name="img" id="file" type="file" accept="image/*" class="absolute inset-0 cursor-pointer opacity-0" onchange="previewFile(event)">
                </div>
                <div class="flex-1">
                    <label for="file" class="block text-lg font-medium text-gray-700" id="uploadLabel">
                        Загрузите фотографию модели
                        <p class="text-sm text-gray-400">Это не обязательно, но желательно.<br> Так пользователи смогут посмотреть модель без скачивания</p>
                    </label>
                </div>
            </div>
            <button id="cancelButton" type="button" class="hidden mt-2 bg-red-500 text-white px-4 py-1 rounded">Отменить</button>
        </div>
        <input name="name" class="w-full border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg" type="text" placeholder="Название модели">
        <select name="category_id" class="w-full border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg" type="text" placeholder="Выберите наиболее подходящую категорию">
            <option disabled selected hidden>Выберите наиболее подходящую категорию</option>
            @forelse($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @empty
                <option disabled>Нет категорий</option>
            @endforelse
        </select>
        <textarea name="information" class="w-full min-h-[150px] border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg" type="password" placeholder="Описание модели"></textarea>
        <div class="flex flex-col items-center gap-2">
            <input name="file" type="file">
            <label for="file" class="text-sm text-black/50">*Загружайте только архивы</label>
        </div>
        <a type="submit" class="mt-5"><x-button text="Опубликовать" /></a>
    </form>
</div>
<script>
    function previewFile(event){
        const readerFile = new FileReader();
        readerFile.onload = function() {
            const outputFile = document.getElementById('filePreview');
            outputFile.classList.add('w-full', 'h-full', 'object-cover');
            outputFile.src = readerFile.result;
        }
        readerFile.readAsDataURL(event.target.files[0]);
    }
</script>
