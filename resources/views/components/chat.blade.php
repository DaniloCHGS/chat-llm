<main data-chat-id="{{$chatId}}" class="flex-1 card flex flex-col">
    <header class="py-3 px-5 flex items-center justify-between border-b bg-[#f6f8fecc]">
        <div class="flex gap-2">
            <div class="w-11 h-11 overflow-hidden rounded-full">
                <img src="grimore-avatar.webp" alt="Grimore Avatar" class="" />
            </div>
            <div class="flex flex-col">
                <h3 class="text-sm font-semibold">Grimore</h3>
                <span class="text-xs text-zinc-500/60 font-semibold">Mago da programação especialista em IA</span>
            </div>
        </div>
        <div class="group relative hover:cursor-pointer">
            <svg stroke-width="1.5" class="size-6 text-zinc-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h3m9 -9v-5a2 2 0 0 0 -2 -2h-2"></path>
                <path d="M13 17v-1a1 1 0 0 1 1 -1h1m3 0h1a1 1 0 0 1 1 1v1m0 3v1a1 1 0 0 1 -1 1h-1m-3 0h-1a1 1 0 0 1 -1 -1v-1"></path>
                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
            </svg>
            <div class="absolute -top-1 -left-[8.3125rem] invisible group-hover:visible transition flex items-center gap-1 rounded-md overflow-hidden group-hover:-translate-y-5">
                <button class="py-1 px-3 bg-purple-400 text-white font-semibold text-[0.6875rem]">PDF</button>
                <button class="py-1 px-3 bg-purple-400 text-white font-semibold text-[0.6875rem]">Palavras</button>
                <button class="py-1 px-3 bg-purple-400 text-white font-semibold text-[0.6875rem]">Txt</button>
            </div>
        </div>
    </header>
    <div id="chat" class="flex-1 p-8 max-h-[496px] overflow-y-auto">
        @foreach($messages as $message)
        <div data-is-user="{{$message->role === 'user' ? 'true':'false'}}" class="flex data-[is-user=true]:flex-row-reverse gap-2 mb-2">
            <div class="w-6 h-6 overflow-hidden rounded-full">
                <img src="{{$message->role === 'user' ? 'default-avatar.png':'grimore-avatar.webp'}}" alt="Avatar" class="" />
            </div>
            <div data-is-user="{{$message->role === 'user' ? 'true':'false'}}" class="group relative">
                <p id="{{$message->id}}" class="flex-1  py-3 px-6 rounded-3xl bg-purple-300/10 text-sm font-sans font-medium whitespace-pre-wrap break-words max-w-max ${typingClass}">{{$message->content}}</p>
                <button data-copy-message="${id}" class="bg-white hidden group-hover:flex absolute top-0 -right-6 group-data-[is-user=true]:-left-6 rounded-full w-10 h-10 items-center justify-center transition-all hover:scale-110">
                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z"></path>
                        <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    <footer class="bg-[#f6f8fecc] flex items-center gap-2 border-t py-6 px-8">
        <form id="form-chat" enctype="multipart/form-data" class="flex-1 bg-white rounded-full border p-2 pr-3 flex items-center gap-2">
            @csrf
            <label for="image-upload" class="w-10 h-10 rounded-full bg-purple-400 text-white flex items-center justify-center hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paperclip">
                    <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                </svg>
            </label>
            <input type="file" id="image-upload" accept="image/*" class="hidden" />
            <input id="input-prompt" type="text" placeholder="Digite uma mensagem" class="flex-1 outline-none text-base">
            <div class="flex items-center gap-2">
                <button class="w-10 h-10 flex items-center justify-center rounded-full transition-all hover:bg-purple-300 hover:text-white">
                    <svg stroke-width="1.5" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                        <path d="M7 8h10"></path>
                        <path d="M7 12h10"></path>
                        <path d="M7 16h10"></path>
                    </svg>
                </button>
                <button title="Gravar" class="w-10 h-10 flex items-center justify-center rounded-full transition-all hover:bg-purple-300 hover:text-white">
                    <svg stroke-width="1.5" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 2m0 3a3 3 0 0 1 3 -3h0a3 3 0 0 1 3 3v5a3 3 0 0 1 -3 3h0a3 3 0 0 1 -3 -3z"></path>
                        <path d="M5 10a7 7 0 0 0 14 0"></path>
                        <path d="M8 21l8 0"></path>
                        <path d="M12 17l0 4"></path>
                    </svg>
                </button>
            </div>
        </form>
        <button form="form-chat" class="w-[52px] h-[52px] flex items-center justify-center button-send text-zinc-100 rounded-full hover:text-white transition-all hover:-translate-y-1 hover:shadow-lg">
            <svg stroke-width="1.5" class="size-6 rtl:-scale-x-100" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z"></path>
                <path d="M6.5 12h14.5"></path>
            </svg>
        </button>
    </footer>
</main>
<script>
    const promptId = document.querySelector('[data-chat-id]').getAttribute('data-chat-id')
    const chatContainer = document.getElementById("chat");
    const formChat = document.getElementById("form-chat");
    const inputPrompt = document.getElementById("input-prompt");
    const inputFile = document.getElementById('image-upload');

    formChat.addEventListener("submit", async (event) => {
        event.preventDefault();

        if (!inputPrompt.value.trim()) return;

        const userMessage = inputPrompt.value.trim();
        appendMessage({
            message: userMessage,
            isUser: true
        });
        inputPrompt.value = "";

        toggleSubmitButton(true);

        const botTypingMessage = appendMessage({
            message: "...",
            isUser: false,
            isTyping: true
        });

        const botMessage = await sendMessage(userMessage);

        botTypingMessage.remove();
        appendMessage({
            message: botMessage,
            isUser: false
        });
        toggleSubmitButton(false);

        const buttonCopyMessages = [...document.querySelectorAll('[data-copy-message]')];
        buttonCopyMessages.forEach(button => {
            button.addEventListener('click', () => {
                console.log('asdasd');

                const messageId = button.dataset.copyMessage;

                const messageToCopy = document.getElementById(messageId).innerText;

                copyToClipboard(messageToCopy);
            });
        });
    });

    inputFile.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = async (event) => {
            const imageUrl = event.target.result;

            // URL do avatar do usuário
            const userAvatarUrl = "default-avatar.png";

            // HTML do avatar e da imagem enviada
            const imageContainer = `
            <div data-is-user="true" class="flex flex-row-reverse gap-2 mb-2">
                <div class="w-6 h-6 overflow-hidden rounded-full">
                    <img src="${userAvatarUrl}" alt="Avatar" class="object-cover w-full h-full" />
                </div>
                <img src="${imageUrl}" alt="Uploaded Image" class="w-[200px] h-auto py-3 px-6 rounded-3xl bg-purple-300/10" />
            </div>
        `;

            // Inserir o HTML no chatContainer
            chatContainer.insertAdjacentHTML('beforeend', imageContainer);

            // Enviar a imagem para a API
            const botMessage = await sendImageToAPI(file);

            appendMessage({
                message: botMessage,
                isUser: false
            });
        };

        reader.readAsDataURL(file);
    });

    async function sendMessage(message = "") {
        try {
            const response = await fetch("/api/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "prompt_id": promptId,
                    message,
                }),
            });

            const data = await response.json();

            return data.message;
        } catch (error) {
            console.error("Erro ao enviar mensagem:", error);
            return "Erro ao enviar mensagem.";
        }
    }


    function appendMessage({
        message,
        isUser = true,
        isTyping = false,
    }) {
        const avatarSrc = isUser ? 'default-avatar.png' : 'grimore-avatar.webp';
        const typingClass = isTyping ? "animate-pulse" : "";
        const id = window.crypto.randomUUID();
        const messageHTML = `
            <div data-is-user="${isUser}" class="flex data-[is-user=true]:flex-row-reverse gap-2 mb-2">
                <div class="w-6 h-6 overflow-hidden rounded-full">
                    <img src="${avatarSrc}" alt="Avatar" class="" />
                </div>
                <div data-is-user="${isUser}" class="group relative">
                    <p id="${id}" class="flex-1 py-3 px-6 rounded-3xl bg-purple-300/10 text-sm font-sans font-medium whitespace-pre-wrap break-words max-w-max ${typingClass}">${message}</p>
                    <button data-copy-message="${id}" class="bg-white hidden group-hover:flex absolute top-0 -right-6 group-data-[is-user=true]:-left-6 rounded-full w-10 h-10 items-center justify-center transition-all hover:scale-110">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 7m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z"></path>
                            <path d="M4.012 16.737a2.005 2.005 0 0 1 -1.012 -1.737v-10c0 -1.1 .9 -2 2 -2h10c.75 0 1.158 .385 1.5 1"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        chatContainer.insertAdjacentHTML('beforeend', messageHTML);
        chatContainer.scrollTop = chatContainer.scrollHeight;
        return chatContainer.lastElementChild;
    }

    function apeendImage(imageUrl) {
        const imageContainer = `
            <div data-is-user="true" class="flex flex-row-reverse gap-2 mb-2">
                <div class="w-6 h-6 overflow-hidden rounded-full">
                    <img src="default-avatar.png" alt="Avatar" class="object-cover w-full h-full" />
                </div>
                <img src="${imageUrl}" alt="Uploaded Image" class="w-[200px] h-auto py-3 px-6 rounded-3xl bg-purple-300/10" />
            </div>
        `;
    }

    async function sendImageToAPI(file) {
        const csrfToken = document.querySelector('input[name="_token"]').value; // Captura o token CSRF
        const formData = new FormData();
        formData.append('image', file);
        formData.append("prompt_id", promptId)

        try {
            const response = await fetch('/api/chat/upload-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            if (response.ok) {
                const data = await response.json();
                return data.message;

            } else {
                console.error('Erro ao enviar a imagem para a API.');
            }
        } catch (error) {
            console.error('Erro de conexão com a API:', error);
        }
    }

    function toggleSubmitButton(isDisabled) {
        const submitButton = document.querySelector('[form="form-chat"]');
        submitButton.disabled = isDisabled;
        submitButton.classList.toggle("opacity-50", isDisabled);
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
    }

    const messageElements = document.querySelectorAll('p');

    if (messageElements.length > 0) {
        const lastMessage = messageElements[messageElements.length - 1];

        lastMessage.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
</script>