import { ALERT_TYPE } from "./constants.js";

/**
 * Class that create a `custom alert` to display at the user
 * a `successful` or `failed` operation, or for any other purpose
 * 
 * @author Stefano Cipolletta
 */
export class Alert {

    #type;
    #title;
    #message;
    #icon;

    /**
     * @param {ALERT_TYPE} type 
     * @param {String} title 
     * @param {String|null} message 
     * @returns 
     */
    constructor(type, title, message = null) {
        if (!Object.values(ALERT_TYPE).includes(type))
            return;

        this.#type = type;
        this.#title = title;
        this.#message = message;
        this.#icon = AlertIcon[type.toUpperCase()];

        this.showAlert();
    }

    showAlert() {
        $("#alert .alert-message *").remove();
        $("#alert").addClass(`alert-${this.#type}`);
        $("#alert .alert-heading").text(this.#title);
        $("#alert .alert-message").append(this.#message);
        $("#alert .alert-icon").addClass(this.#icon);
        $("#alert").slideDown(500);
    }

    get title() {
        return this.#title;
    }
    get message() {
        return this.#message;
    }
    get icon() {
        return `${this.#icon}`;
    }
}

const AlertIcon = Object.freeze({
    "SUCCESS": "bi-check-lg",
    "DANGER": "bi-exclamation-circle",
    "WARNING": "bi-exclamation-triangle",
    "INFO": "bi-question-lg"
});