@if($href)
    <a href="{{ $href }}"
       class="bg-white border-black border-solid border-[1px] rounded-md px-[15px] py-[5px] text-xl dark:bg-black dark:text-white dark:border-white dark:border-[1px] disabled:opacity-50"
       @if($onclick) onclick="{{ $onclick }}" @endif>
        {{ $text }}
    </a>
@else
    <button id="{{ $id }}" type="{{ $type }}"
            class="bg-white border-black border-solid border-[1px] rounded-md px-[15px] py-[5px] text-xl dark:bg-black dark:text-white dark:border-white dark:border-[1px] disabled:opacity-50"
            @if($onclick) onclick="{{ $onclick }}" @endif>
        {{ $text }}
    </button>
@endif
