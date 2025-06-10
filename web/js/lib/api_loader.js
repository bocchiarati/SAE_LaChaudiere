import { entrypoint } from "../conf.js";

/**
 * Charge une ressource à partir d'une URL donnée.
 *
 * @param {string} url - L'URL de la ressource à charger.
 * @returns {Promise<Object>} Une promesse qui se résout avec les données de la ressource.
 */
async function loadRessource(url) {
    return (await fetch(entrypoint + url)).json();
}

/**
 * Récupère une ressource à partir d'une URL donnée.
 *
 * @param {string} url - L'URL de la ressource à récupérer.
 * @returns {Promise<Object>} Une promesse qui se résout avec les données de la ressource.
 */
export async function getRessource(url) {
    try {
        return await loadRessource(url);
    } catch (err) {
        console.error("Erreur lors du chargement de la ressource :", err);
    }
}