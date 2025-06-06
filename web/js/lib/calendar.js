import {load_event} from "../views/event_ui.js";

export function initCalendar() {
    fetch('http://127.0.0.1:89/api/categories')
        .then(response => response.json())
        .then(data => console.log(data))
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        eventColor: '#e11d48', // Couleur par défaut (rose-600 Tailwind)
        eventTextColor: '#ffffff', // Texte blanc
        events: [
            {
                title: 'Concert Jazz',
                start: '2025-06-15',
                description: 'Un concert de jazz avec des artistes locaux',
            },
            {
                title: 'Concert Rock',
                start: '2025-06-25',
                description: 'Groupe de rock alternatif en live',
            },

            {
                title: 'Exposition Peinture',
                start: '2025-06-20',
                description: 'Œuvres contemporaines de jeunes artistes',
            },

            {
                title: 'Spectacle Théâtre',
                start: '2025-06-28',
                description: 'Représentation d’une pièce classique',
            },

            {
                title: 'Conférence “Art et Politique”',
                start: '2025-06-18',
                description: 'Rencontre avec des penseurs contemporains',
            }
        ],
        eventClick: function(info) {
            load_event()
        }
    });

    calendar.render();
}

export function loadEvents() {
    // À implémenter plus tard pour charger les données dynamiquement via API
}
