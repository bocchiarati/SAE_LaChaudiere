import { initCalendar } from "../lib/calendar.js";
import {getRessource} from "../lib/api_loader.js";

export async function load_calendar() {
    // Récupération du template Handlebars depuis le DOM
    const source = document.getElementById("calendarTemplate").innerHTML;
    const categories = (await getRessource("/api/categories")).categories;
    // Compilation du template avec les données
    const template = Handlebars.compile(source);
    // Insertion du HTML généré dans l'élément avec l'ID "content"
    document.getElementById("calendar_container").innerHTML = template({
        categories: categories
    });

    initCalendar();
}