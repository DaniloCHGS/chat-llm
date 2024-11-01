<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chat LLM</title>

    <link rel="shortcut icon" href="favicon.svg" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex h-[35.813rem] w-[80.5rem] gap-6 px-2">
            <aside class="w-[20.125rem] card flex flex-col justify-between">
                <div class="">
                    <div class="p-4 border-b">
                        <x-search-input />
                    </div>
                    <div class="flex flex-col max-h-[25rem] overflow-y-auto">
                        @foreach ($prompts as $prompt)
                        <x-chat-preview active="{{$prompt->active ? 'true':'false'}}" id="{{ $prompt->id }}" title="{{ $prompt->name }}" createdAt="{{ $prompt->created_at }}" />
                        @endforeach
                    </div>
                </div>
                <footer class=" py-8 px-6">
                    <a id="new-prompt" href="{{route('chat.new-prompt')}}" class="py-2 px-4 bg-black text-white rounded-full w-full transition hover:bg-purple-200 flex items-center gap-2 justify-center font-semibold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg> Nova conversa
                    </a>
                </footer>
            </aside>
            @if($using_prompt)
            <x-chat chatId="{{ $prompt->id }}" :messages="$messages" />
            @else
            <div class="flex-1 card flex items-center justify-center"></div>
            @endif
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>