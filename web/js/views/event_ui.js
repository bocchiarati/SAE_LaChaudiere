export function load_event() {
    // Récupération du template Handlebars depuis le DOM
    const source = document.getElementById("eventDetailTemplate").innerHTML;

    // Compilation du template avec les données
    const template = Handlebars.compile(source);

    // Données de test
    const eventData = {
        title: "Concert Hibana",
        startDate: "25 juin 2025",
        endDate: "25 juin 2025",
        time: "20h00 – 23h30",
        description: "Un concert exceptionnel mêlant jazz traditionnel et sons électroniques modernes. Venez vibrer au rythme des saxophones et des synthétiseurs.",
        prix: "12.00",
        categorie: "Concert",
        imageUrl: "https://a.storyblok.com/f/178900/1920x1080/73393b35df/ado-hibana-world-tour.png" // image aléatoire
    };

    // Insertion du HTML généré dans l'élément avec l'ID "content"
    document.getElementById("event_detail_container").innerHTML = template(eventData);
}
