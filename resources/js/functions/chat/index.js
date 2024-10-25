async function sendMessage(message = "") {
    try {
        const response = await fetch("/api/chat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                message,
            }),
        });

        const data = await response.json();

        return {
            message: data.message,
        };
    } catch (error) {
        console.log(error);
    }
}

const chat = document.getElementById("chat");
const formPrommpt = document.getElementById("form-chat");
const inputPrompt = document.getElementById("input-prompt");

formPrommpt.addEventListener("submit", async (event) => {
    event.preventDefault();

    if (!inputPrompt.value.trim().length) {
        return;
    }

    chat.innerHTML += createMessageInChat(inputPrompt.value);

    const { message } = await sendMessage(inputPrompt.value);

    inputPrompt.value = "";

    chat.innerHTML += createMessageInChat(message, false);
});

function createMessageInChat(message, isUser = true) {
    const avatar = isUser ? "default-avatar.png" : "grimore-avatar.webp";
    const element = `
        <div data-is-user="${isUser}" class="flex data-[is-user=true]:flex-row-reverse gap-2 mb-2">
            <div class="w-6 h-6 overflow-hidden rounded-full">
                <img src="${avatar}" alt="Avatar" class="" />
            </div>
            <p class="flex-1 py-3 px-6 rounded-3xl bg-purple-300/10 text-sm font-sans font-medium whitespace-pre-wrap break-words">${message}<p>
        </div>
    `;

    return element;
}
