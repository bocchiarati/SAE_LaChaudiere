import {loadEvents} from "../lib/calendar.js";

export function category_filtre_action(calendar){
    let activeButton = null;

    document.querySelectorAll(".category_button").forEach(btn => {
        btn.addEventListener("click", function() {
            if(btn.style.backgroundColor === "#FFFFFF"){
                activeButton = null;
                btn.style.background = "";
                calendar.removeAllEvents();
                loadEvents("/api/events", calendar);
            } else {
                document.querySelectorAll(".category_button").forEach(btn => btn.style.backgroundColor = "");
                activeButton = btn;
                btn.style.backgroundColor = "#FFFFFF";
                calendar.removeAllEvents();
                loadEvents("/api/category/" + btn.id + "/events", calendar);
            }
        })
    })
}