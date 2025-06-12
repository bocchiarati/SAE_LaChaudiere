export async function load_favorites() {
    const source = document.getElementById("favoritesTemplate").innerHTML;
    const favorites = JSON.parse(sessionStorage.getItem("favoris") || "[]");
    let listFavorites = [];

    for (const event_id of favorites) {
        try {
            const response = await fetch(`/api/event/${event_id}`);
            if (!response.ok) throw new Error('Erreur API');
            const data = await response.json();
            const event = data.event;
            event.start_time = event.start_date.slice(11, 16); // Extrait HH:mm
            const startDate = new Date(event.start_date);
            event.start_date = startDate.toLocaleDateString('fr-FR');
            const endDate = new Date(event.end_date);
            event.end_date = endDate.toLocaleDateString('fr-FR');
            listFavorites.push(event);
        } catch (error) {
            console.error(`Erreur pour l’événement ${event_id} :`, error);
        }
    }
    console.log(listFavorites);
    const template = Handlebars.compile(source);
    document.getElementById("favorites_container").innerHTML = template({
        favorites: listFavorites
    });
}