import { load_calendar } from './views/calendar_ui.js'
import { load_claire_obscure} from "./claire_obscure.js";
import { load_favorites} from "./views/favorites.js";
export function load() {
    if (window.location.pathname === "/index.html") {
        document.addEventListener('DOMContentLoaded', () => {
            load_calendar();
        })
    } else {
        if (window.location.pathname === "/favoris.html") {
            load_favorites();
        }
    }
    load_claire_obscure();

}

// QUE DES LANCEMENTS DE METHODES ICI !!!!!! (EN THEORIE)