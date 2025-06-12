import {getRessource} from "../lib/api_loader.js";
import {go_back} from "../controller/retour_action.js";
import {entrypoint} from "../conf.js";
import {toggle_favorites_action} from "../controller/favorites_action.js";

export async function load_event(url) {
    // Récupération du template Handlebars depuis le DOM
    const source = document.getElementById("eventDetailTemplate").innerHTML;

    // Compilation du template avec les données
    const template = Handlebars.compile(source);

    // Données de tests
    const templateData = {
        event: (await getRessource(url)).event,
        entrypoint: entrypoint
    };

    templateData['event']['start_time'] = templateData['event']['start_date'].slice(11, 16);
    const startDate = new Date(templateData['event']['start_date']);
    templateData['event']['start_date'] = startDate.toLocaleDateString('fr-FR');
    const endDate = new Date(templateData['event']['end_date']);
    templateData['event']['end_date'] = endDate.toLocaleDateString('fr-FR');


    // Insertion du HTML généré dans l'élément avec l'ID "content"
    document.getElementById("event_detail_container").innerHTML = template(templateData);
    go_back();
    toggle_favorites_action(templateData['event']["id"]);
}
