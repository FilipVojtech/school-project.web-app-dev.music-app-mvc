/** @type { HTMLInputElement[] } */
const inputsToKeep = document.querySelectorAll("[data-fk-keep]");

for (const input of inputsToKeep) {
    console.log(input);
    const actionType = input.tagName === "SELECT" ? "change" : "blur";

    input.addEventListener(actionType, () => {
        if (input.value) {
            localStorage.setItem(`fk-${input.dataset["fkKeep"]}-${input.name}`, input.value);
        } else {
            localStorage.removeItem(`fk-${input.dataset["fkKeep"]}-${input.name}`);
        }
    });

    const localStorageValue = localStorage.getItem(`fk-${input.dataset["fkKeep"]}-${input.name}`);
    if (localStorageValue !== null) {
        input.value = localStorageValue;
    }
}

// if (inputsToKeep.length > 0) {
//     const form = inputsToKeep[0].form;
//     form.addEventListener("submit", () => {
//         for (const input of inputsToKeep) {
//             localStorage.removeItem(`fk-${input.dataset["fkKeep"]}-${input.name}`);
//         }
//     });
// }
