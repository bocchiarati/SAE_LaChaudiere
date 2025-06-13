import {loadEvents} from "../lib/calendar.js";
import {toggleDeselection} from "../views/enlever_filtre_ui.js";

export function enlever_filtre_action (calendar) {
    let btnEnlever = document.getElementById("enlever_filtre");

    btnEnlever.addEventListener("click", function (){
        toggleDeselection();
        calendar.removeAllEvents();
        loadEvents("/api/events", calendar);
    })
}