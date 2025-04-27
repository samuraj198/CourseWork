<div id="changeStatus" class="modal hidden z-50 w-full h-full bg-black/80 fixed left-0 top-0 flex justify-center items-start">
    <form method="POST" action="{{ secure_url(route('changeStatus')) }}" class="rounded-lg border-[1px] border-black relative flex flex-col items-center gap-5 bg-white p-10 w-1/3 mt-10 dark:bg-black dark:border-white max-laptopL:w-[50%] max-tablet:w-[80%]"
          enctype="multipart/form-data">
        @csrf
        <a onclick="closeChangeStatusModal()" class="absolute right-5 top-2 text-4xl cursor-pointer dark:text-white">&times;</a>
        <h2 class="text-2xl font-bold text-center dark:text-white max-mobileL:text-xl max-mobileM:text-lg">ИЗМЕНЕНИЕ СТАТУСА</h2>
        <input type="hidden" value="" id="idFile" name="id">
        <select name="status"
                class="w-full border-black border-solid border-[1px] py-[13px] px-[15px] rounded-lg
                dark:bg-black dark:border-white dark:text-white">
            <option disabled selected hidden>Выберите статус</option>
            <option value="Одобрено">Одобрено</option>
            <option value="Отклонено">Отклонено</option>
        </select>
        <x-button text="Изменить" type="submit" />
    </form>
</div>

<script>
    function openChangeStatusModal(id) {
        document.getElementById('changeStatus').classList.remove('hidden');
        document.getElementById('idFile').value = id;
    }
    function closeChangeStatusModal() {
        document.getElementById('changeStatus').classList.add('hidden');
        document.getElementById('idFile').value = null;
    }
</script>
