import { toggleFilterVisibility } from "../views/filter_ui.js";

export function toggle_filter_action() {
    const toggleButton = document.getElementById("hide_filter");
    if (toggleButton) {
        toggleButton.addEventListener("click", () => {
            toggleFilterVisibility();
        });
    }
}