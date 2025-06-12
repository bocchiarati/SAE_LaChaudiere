export function toggleFilterVisibility() {
    const filterContainer = document.getElementById("container_filtre");
    const toggleButton = document.getElementById("hide_filter");

    if (filterContainer.classList.contains("hidden")) {
        filterContainer.classList.remove("hidden");
        toggleButton.textContent = "Masquer les filtres";
    } else {
        filterContainer.classList.add("hidden");
        toggleButton.textContent = "Afficher les filtres";
    }
}