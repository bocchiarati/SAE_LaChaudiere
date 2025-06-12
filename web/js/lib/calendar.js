import {load_event} from "../views/event_ui.js";
import {getRessource} from "./api_loader.js";
import {category_filtre_action} from "../controller/category_filtre_action.js";
import {enlever_filtre} from "../controller/enlever_filtre_action";

export function initCalendar() {


    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        eventColor: '#e11d48', // Couleur par défaut (rose-600 Tailwind)
        eventTextColor: '#ffffff', // Texte blanc
        events: [],
        eventClick: async function (info) {
            await load_event(info.event.id);
            document.getElementById("calendar_container").classList.add("hidden");
        }
    });
    calendar.render();
    loadEvents("/api/events", calendar);
    category_filtre_action(calendar);
    enlever_filtre(calendar);
}

export async function loadEvents(url, calendar) {
    const events = (await getRessource(url)).events;
    events.forEach(event => {
        calendar.addEvent({
            'id':event.url,
            'title': event.title,
            'description': event.description,
            'start':formatDate(event.start),
            'end':formatDate(event.end),
        });
    })
}

function formatDate(dateStr) {
    // Vérifie si la date contient déjà un "T"
    if (dateStr.includes('T')) return dateStr;

    // Remplace l'espace entre la date et l'heure par un "T"
    return dateStr.replace(' ', 'T');
}

