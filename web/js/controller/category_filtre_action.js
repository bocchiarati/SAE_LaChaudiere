import {loadEvents} from "../lib/calendar.js";

export function category_filtre_action(calendar){
    document.querySelectorAll(".category_button").forEach(btn => {
        btn.addEventListener("click", function() {
            calendar.removeAllEvents();
            loadEvents("/api/category/" + btn.id + "/events", calendar);
        })
    })
}