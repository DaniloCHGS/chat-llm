import { timeAgo } from "../../utils/timeAgo";

const buttonsEditTitleChatPreview = [
    ...document.querySelectorAll("[data-edit-title-chat-preview]"),
];

buttonsEditTitleChatPreview.forEach((button) => {
    button.addEventListener("click", () => {
        const component = button.closest("[data-chat-preview-id]");

        component.setAttribute("data-title-editing", "true");

        const input = component.querySelector("input");
        const title = component.querySelector("h2");

        input.value = title.textContent;

        input.classList.remove("hidden");

        input.focus();

        input.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                event.preventDefault();
                input.blur();
            }
        });

        input.addEventListener("blur", () => {
            const newValue = input.value;
            title.textContent =
                newValue.trim().length > 0 ? newValue : title.innerText;
            component.setAttribute("data-title-editing", "false");

            input.classList.add("hidden");
        });

        const buttonConfirm = component.querySelector(
            "[data-confirm-update-title]",
        );

        buttonConfirm.addEventListener("click", () => {
            const newValue = input.value;

            if (newValue.trim().length > 0) {
                title.textContent = newValue;
            } else {
                input.setAttribute("value", title.innerText);
            }

            component.setAttribute("data-title-editing", "false");

            input.classList.add("hidden");
        });
    });
});

buttonsEditTitleChatPreview.forEach((button) => {
    const component = button.closest("[data-chat-preview-id]");
    const createdAt = component.querySelector("[data-created-at]");
    const time = createdAt.getAttribute("data-created-at");

    console.log(timeAgo("1698153600"));

    createdAt.innerHTML = timeAgo("1698153600");
});
