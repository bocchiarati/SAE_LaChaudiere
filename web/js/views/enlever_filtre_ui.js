export function toggleDeselection() {
    const deselectionButton = document.getElementById("enlever_filtre");
    document.querySelectorAll(".category_button").forEach(
        btn => {btn.style.backgroundColor = ""});
}