<div id="modalCategory" class="modal z-50 hidden w-full h-full bg-black/80 fixed left-0 top-0 flex justify-center items-start">
    <form method="POST" action="{{ route('createCategory') }}" class="rounded-lg relative flex flex-col items-center gap-5 bg-white p-10 w-1/3 mt-20" enctype="multipart/form-data">
        @csrf
        <a onclick="closeCategoryModal()" class="absolute right-5 top-2 text-4xl cursor-pointer">&times;</a>
        <h2 class="text-2xl font-bold text-center">СОЗДАТЬ КАТЕГОРИЮ</h2>
        <div class="preview w-full">
            <div class="flex items-start gap-5">
                <div class="shrink-0 relative w-[250px] h-[200px] bg-gray-300 rounded-lg overflow-hidden flex items-center justify-center">
                    <img id="CategoryPreview" src="/img/icons/Camera.svg" alt="Аватар" class="object-cover cursor-pointer">
                    <input name="img" id="file" type="file" accept="image/*" class="absolute inset-0 cursor-pointer opacity-0" onchange="previewCategory(event)">
                </div>
                <div class="flex-1">
                    <label for="file" class="block text-lg font-medium text-gray-700" id="uploadLabel">
                        Загрузите фотографию для категории
                    </label>
                </div>
            </div>
            <button id="cancelButton" type="button" class="hidden mt-2 bg-red-500 text-white px-4 py-1 rounded">Отменить</button>
        </div>
        <input name="name" class="w-full border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg" type="text" placeholder="Название категории">
        <a type="submit" class="mt-5"><x-button text="Создать" /></a>
    </form>
</div>
<script>
    function previewCategory(event){
        const readerCategory = new FileReader();
        readerCategory.onload = function() {
            const outputCategory = document.getElementById('CategoryPreview');
            outputCategory.classList.add('w-full', 'h-full', 'object-cover');
            outputCategory.src = readerCategory.result;
        }
        readerCategory.readAsDataURL(event.target.files[0]);
    }
</script>
