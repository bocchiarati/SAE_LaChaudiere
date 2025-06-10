export function go_back(){
    document.getElementById("go_back").addEventListener("click", () => {
        document.getElementById("event_detail_container").innerHTML = "";
        document.getElementById("calendar_container").classList.remove("hidden");
    });
}