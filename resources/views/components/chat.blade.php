<main class="flex-1 card flex flex-col">
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
    <div id="chat" class="flex-1 p-8 max-h-[496px] overflow-y-auto"></div>
    <footer class="bg-[#f6f8fecc] flex items-center gap-2 border-t py-6 px-8">
        <form id="form-chat" class="flex-1 bg-white rounded-full border p-2 pr-3 flex items-center gap-2">
            <button class="w-10 h-10 rounded-full bg-purple-400 text-white flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paperclip">
                    <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                </svg>
            </button>
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
    async function sendMessage(message = "") {
        try {
            const response = await fetch("/api/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    message
                }),
            });
            const data = await response.json();
            return data.message;
        } catch (error) {
            console.error("Erro ao enviar mensagem:", error);
            return "Erro ao enviar mensagem.";
        }
    }

    const chatContainer = document.getElementById("chat");
    const formChat = document.getElementById("form-chat");
    const inputPrompt = document.getElementById("input-prompt");

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
    });

    function appendMessage({
        message,
        isUser = true,
        isTyping = false
    }) {
        const avatarSrc = isUser ? 'default-avatar.png' : 'grimore-avatar.webp';
        const typingClass = isTyping ? "animate-pulse" : "";
        const messageHTML = `
            <div data-is-user="${isUser}" class="flex data-[is-user=true]:flex-row-reverse gap-2 mb-2">
                <div class="w-6 h-6 overflow-hidden rounded-full">
                    <img src="${avatarSrc}" alt="Avatar" class="" />
                </div>
                <p class="flex-1 py-3 px-6 rounded-3xl bg-purple-300/10 text-sm font-sans font-medium whitespace-pre-wrap break-words ${typingClass}">${message}</p>
            </div>
        `;
        chatContainer.insertAdjacentHTML('beforeend', messageHTML);
        chatContainer.scrollTop = chatContainer.scrollHeight;
        return chatContainer.lastElementChild;
    }

    function toggleSubmitButton(isDisabled) {
        const submitButton = document.querySelector('[form="form-chat"]');
        submitButton.disabled = isDisabled;
        submitButton.classList.toggle("opacity-50", isDisabled);
    }
</script>