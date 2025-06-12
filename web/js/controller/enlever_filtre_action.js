import {loadEvents} from "../lib/calendar";

export function enlever_filtre (calendar) {
    let btnEnlever = document.getElementById("enlever_filtre");

    btnEnlever.addEventListener("click", function (){
        document.querySelectorAll(".category_button").forEach(btn => btn.style.backgroundColor = "");
        calendar.removeAllEvents();
        loadEvents("/api/events", calendar);
    })
}