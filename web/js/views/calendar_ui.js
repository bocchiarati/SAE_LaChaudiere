import { initCalendar } from "../lib/calendar.js";

export function load_calendar() {
    // Récupération du template Handlebars depuis le DOM
    const source = document.getElementById("calendarTemplate").innerHTML;

    // Compilation du template avec les données
    const template = Handlebars.compile(source);
    // Insertion du HTML généré dans l'élément avec l'ID "content"
    document.getElementById("calendar_container").innerHTML = template({
        categories: categories
    });

    initCalendar();
}