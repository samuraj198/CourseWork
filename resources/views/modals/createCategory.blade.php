<div id="modalCategory" class="modal z-50 hidden w-full h-full bg-black/80 fixed left-0 top-0 flex justify-center items-start">
    <form method="POST" action="{{ secure_url(route('createCategory')) }}" class="rounded-lg border-[1px] border-black relative
    flex flex-col items-center gap-5 bg-white p-10 w-1/3 mt-10 dark:bg-black dark:border-white max-laptopL:w-[50%]
    max-tablet:w-[80%]"
          enctype="multipart/form-data">
        @csrf
        <a onclick="closeCategoryModal()" class="absolute right-5 top-2 text-4xl cursor-pointer dark:text-white">&times;</a>
        <h2 class="text-2xl font-bold text-center dark:text-white max-mobileL:text-xl
        max-mobileM:text-lg">СОЗДАТЬ КАТЕГОРИЮ</h2>
        <div class="preview w-full">
            <div class="flex items-start gap-5 max-mobileL:flex-col max-mobileL:text-center">
                <div class="shrink-0 relative w-[250px] h-[250px] bg-gray-300 rounded-lg overflow-hidden
                flex items-center justify-center max-mobileM:w-[200px] max-mobileM:h-[200px]">
                    <img id="CategoryPreview" src="/img/icons/Camera.svg" alt="Аватар" class="object-cover cursor-pointer">
                    <input name="img" type="file" accept="image/*" class="absolute inset-0 cursor-pointer opacity-0" onchange="previewCategory(this)">
                </div>
                <div class="flex-1">
                    <label for="file" class="block text-lg font-medium
                    text-gray-700 dark:text-white max-mobileM:text-base" id="uploadLabel">
                        Загрузите фотографию для категории
                    </label>
                </div>
            </div>
            <button id="cancelButton" type="button" class="hidden mt-2 bg-red-500 text-white px-4 py-1 rounded">Отменить</button>
        </div>
        <input name="name" class="mb-5 w-full border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg dark:bg-black dark:border-white dark:text-white" type="text" placeholder="Название категории">
        <x-button type="submit" text="Создать" />
    </form>
</div>
<script>
    function previewCategory(input){
        const readerCategory = new FileReader();
        readerCategory.onload = function() {
            const outputCategory = document.getElementById('CategoryPreview');
            outputCategory.classList.add('w-full', 'h-full', 'object-cover');
            outputCategory.src = readerCategory.result;
        }
        if (input.files && input.files[0]) {
            readerCategory.readAsDataURL(input.files[0]);
        }
    }
</script>
