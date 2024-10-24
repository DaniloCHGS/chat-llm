<div data-active="{{$active}}" data-chat-preview-id="{{$id}}" data-title-editing="false" class="group relative p-4 border-b hover:cursor-pointer flex items-center justify-between data-[active=false]:before:hidden before:absolute before:w-[3px] before:left-0 before:h-10 before:bg-gradient-to-b from-[#a48fe6] to-transparent">
    <div class="flex gap-3">
        <svg stroke-width="1.5" class="size-6 shrink-0 group-hover:text-theme-purple transition group-data-[active=true]:text-theme-purple" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 9h8"></path>
            <path d="M8 13h6"></path>
            <path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path>
        </svg>
        <header class="flex flex-col">
            <div>
                <h2 class="text-sm font-semibold group-hover:text-theme-purple transition group-data-[active=true]:text-theme-purple group-data-[title-editing=true]:hidden">{{$title}}</h2>
                <input type="text" class="hidden outline-none focus:border-theme-purple focus:border-2 rounded-md bg-theme-purple/10 text-theme-purple h-5 text-sm">
            </div>
            <span data-created-at="" class="col-start-2 text-xs block text-zinc-400 opacity-60 group-hover:text-theme-purple transition group-data-[active=true]:text-theme-purple">há 1 segundo</span>
        </header>
    </div>
    <div class="items-center gap-2 hidden group-data-[title-editing=false]:group-hover:flex transition duration-1000">
        <button data-edit-title-chat-preview class="border bg-white rounded-full w-7 h-7 flex items-center justify-center hover:scale-110 transition">
            <svg class="size-4 group-[&amp;.edit-mode]:hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                <path d="M13.5 6.5l4 4"></path>
            </svg>
        </button>
        <button class="border bg-theme-red text-white rounded-full w-7 h-7 flex items-center justify-center hover:scale-110 transition">
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6l-12 12"></path>
                <path d="M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <button data-confirm-update-title class="border bg-emerald-500 text-white rounded-full w-7 h-7 hidden items-center justify-center hover:scale-110 transition group-data-[title-editing=true]:flex">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check text-base">
            <path d="M20 6 9 17l-5-5" />
        </svg>
    </button>
</div>