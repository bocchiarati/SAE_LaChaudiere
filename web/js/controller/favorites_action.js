export function toggle_favorites_action(event_id) {
    const btn = document.getElementById("favoris");

    if (!btn) return;

    btn.addEventListener("click", function () {
        // Récupère les favoris depuis la session, ou initialise un tableau vide
        let favoris = sessionStorage.getItem("favoris");
        favoris = favoris ? JSON.parse(favoris) : [];

        const index = favoris.indexOf(event_id);

        if (index !== -1) {
            // Si déjà présent => on le supprime
            favoris.splice(index, 1);
            console.log(`Événement ${event_id} retiré des favoris.`);
        } else {
            // Sinon => on l'ajoute
            favoris.push(event_id);
            console.log(`Événement ${event_id} ajouté aux favoris.`);
        }

        // Mise à jour dans sessionStorage
        sessionStorage.setItem("favoris", JSON.stringify(favoris));

        // (Optionnel) Toggle visuel si ton bouton a une classe "active"
        btn.classList.toggle("text-red-500", index === -1); // devient rouge si ajouté
        btn.classList.toggle("text-gray-400", index !== -1); // redevient gris si retiré
    });
}