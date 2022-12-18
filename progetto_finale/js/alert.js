import { ALERT_TYPE, ALERT_ICON } from "./constants.js";

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
        this.#icon = ALERT_ICON[type.toUpperCase()];

        this.showAlert();
    }

    showAlert() {
        $("#alert").css("border-color", `var(--${this.#type.toLowerCase()}-color)`); //changing border color
        $("#alert .alert-heading").css("color", `var(--${this.#type.toLowerCase()}-color)`); //changing heading color

        $("#alert .alert-message *").remove(); //removing all previuos messages

        $("#alert .alert-icon").attr("name", this.#icon); //adding icon
        $("#alert .alert-title").text(this.#title); //adding title
        $("#alert .alert-message").append(this.#message); //adding message

        $("#alert").fadeIn(500);
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