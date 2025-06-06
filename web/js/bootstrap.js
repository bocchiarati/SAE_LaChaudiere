import { load_calendar } from './views/calendar_ui.js'
import { load_claire_obscure} from "./claire_obscure.js";
export function load() {
    document.addEventListener('DOMContentLoaded', () => {
        load_calendar();
        load_claire_obscure();
    })
}

// QUE DES LANCEMENTS DE METHODES ICI !!!!!! (EN THEORIE)