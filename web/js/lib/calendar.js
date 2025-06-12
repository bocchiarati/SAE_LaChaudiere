import {load_event} from "../views/event_ui.js";
import {getRessource} from "./api_loader.js";
import {category_filtre_action} from "../controller/category_filtre_action.js";
import {filtre_favoris_action} from "../controller/favorites_action.js";

export function initCalendar() {


    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        eventColor: '#e11d48', // Couleur par défaut (rose-600 Tailwind)
        eventTextColor: '#ffffff', // Texte blanc
        events: [],
        eventClick: async function (info) {
            await load_event(info.event.extendedProps.apiUrl);
            document.getElementById("calendar_container").classList.add("hidden");
        }
    });
    calendar.render();
    loadEvents("/api/events", calendar);
    category_filtre_action(calendar);
    filtre_favoris_action(calendar);
}

export async function loadEvents(url, calendar) {
    const events = (await getRessource(url)).events;
    events.forEach(event => {
        calendar.addEvent({
            id:event.id,
            title: event.title,
            start:formatDate(event.start),
            end:formatDate(event.end),
            extendedProps: {
                apiUrl: event.url
            }
        });
    })
}

function formatDate(dateStr) {
    // Vérifie si la date contient déjà un "T"
    if (dateStr.includes('T')) return dateStr;

    // Remplace l'espace entre la date et l'heure par un "T"
    return dateStr.replace(' ', 'T');
}

