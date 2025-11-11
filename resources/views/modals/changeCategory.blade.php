<div id="modalChangeCategory" class="modal z-50 hidden w-full h-full bg-black/80 fixed left-0 top-0 flex justify-center items-start">
    <form method="POST" action="{{ secure_url(route('changeCategory')) }}" class="rounded-lg border-[1px] border-black relative flex flex-col items-center gap-5 bg-white p-10 w-1/3 mt-10 dark:bg-black dark:border-white max-laptopL:w-[50%] max-tablet:w-[80%]"
          enctype="multipart/form-data">
        @csrf
        <a onclick="closeChangeCategoryModal()" class="absolute right-5 top-2 text-4xl cursor-pointer dark:text-white">&times;</a>
        <h2 class="text-2xl font-bold text-center dark:text-white max-mobileL:text-xl max-mobileM:text-lg">ИЗМЕНЕНИЕ КАТЕГОРИЙ</h2>
        <select name="category_id" id="changeCategorySelect" class="w-full border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg dark:bg-black dark:border-white dark:text-white" onchange="showCategoryDetails()">
            <option disabled selected hidden>Выберите категорию для взаимодействия</option>
            @forelse($categories as $category)
                <option value="{{ $category->id }}" data-name="{{ $category->name }}" data-img="{{ asset('storage/categories/' . $category->img) }}">
                    {{ $category->name }}
                </option>
            @empty
                <option disabled>Нет категорий</option>
            @endforelse
        </select>
        <div id="changeCategoryDetails" class="preview w-full hidden">
            <div class="flex items-start gap-5 max-mobileL:flex-col max-mobileL:text-center">
                <div class="shrink-0 relative w-[250px] h-[250px] bg-gray-300 rounded-lg overflow-hidden flex items-center justify-center max-mobileM:w-[200px] max-mobileM:h-[200px]">
                    <img id="changeCatPreview" src="/img/icons/Camera.svg" alt="Аватар" class="object-cover cursor-pointer">
                    <input name="img" type="file" accept="image/*" class="absolute inset-0 cursor-pointer opacity-0" onchange="previewChangeCategory(this)">
                </div>
                <div class="flex-1">
                    <label for="file" class="block text-lg font-medium text-gray-700 dark:text-white max-mobileM:text-base" id="uploadLabel">
                        Загрузите фотографию для категории
                    </label>
                </div>
            </div>
        </div>
        <input id="changeCategoryName" name="name" class="w-full hidden border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg dark:bg-black dark:border-white dark:text-white" type="text" placeholder="Название категории">
        <x-button onclick="setAction('change')" class="mt-5" text="Изменить" />
        @if($errors->any())
            <div class="error text-red-500 mt-10">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>

<script>
    function showCategoryDetails() {
        const selectElement = document.getElementById('changeCategorySelect');
        const selectedOption = selectElement.options[selectElement.selectedIndex];

        const categoryName = selectedOption.getAttribute('data-name');
        const categoryImg = selectedOption.getAttribute('data-img');

        document.getElementById('changeCategoryName').value = categoryName;
        document.getElementById('changeCategoryName').classList.remove('hidden');

        const categoryDetails = document.getElementById('changeCategoryDetails');
        categoryDetails.classList.remove('hidden');

        const imgPreview = document.getElementById('changeCatPreview');
        imgPreview.src = categoryImg;
    }

    function previewChangeCategory(input) {
        const reader = new FileReader();
        reader.onload = function() {
            const previewImg = input.closest('.relative').querySelector('img');
            previewImg.classList.add('w-full', 'h-full', 'object-cover');
            previewImg.src = reader.result;
        }
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
