import {getRessource} from "../lib/api_loader.js";
import {go_back} from "../controller/retour_action.js";
import {imageEntrypoint} from "../conf";

export async function load_event(url) {
    // Récupération du template Handlebars depuis le DOM
    const source = document.getElementById("eventDetailTemplate").innerHTML;

    // Compilation du template avec les données
    const template = Handlebars.compile(source);

    // Données de test
    const templateData = (await getRessource(url)).event + { imageEntrypoint: imageEntrypoint };
    console.log(templateData);
    // Insertion du HTML généré dans l'élément avec l'ID "content"
    document.getElementById("event_detail_container").innerHTML = template(templateData);
    go_back()
}
