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
    constructor(type, title, message = null, callback = null) {
        if (!Object.values(ALERT_TYPE).includes(type))
            return;

        if (callback !== null){
            this.showButtons();
            $("#alert #alert-button-confirm").on("click", () => {
                callback();
                this.hideButtons();
            });
        }

        this.#type = type;
        this.#title = title;
        this.#message = message;
        this.#icon = ALERT_ICON[type.toUpperCase()];

        this.showAlert();

        $("#alert i.close").on("click", this.closeAlert);
        $("#alert #alert-button-cancel").on("click", this.closeAlert);
    }

    showAlert() {
        $("#alert").css("border-color", `var(--${this.#type.toLowerCase()}-color)`); //changing border color
        $("#alert .alert-heading").css("color", `var(--${this.#type.toLowerCase()}-color)`); //changing heading color

        $("#alert .alert-icon").addClass(this.#icon); //adding icon
        $("#alert .alert-title").text(this.#title); //adding title
        $("#alert .alert-message").html(this.#message); //adding message

        $("#alert").fadeIn(500);
        $("#alert").show();
        $("#mask").show();
    }

    closeAlert = (e) => {
        $("#alert").fadeOut(200, () => {
            $("#alert .alert-icon").removeClass(this.#icon);
            $("#alert .alert-message").text("");
        });
        $("#mask").fadeOut(200);
        e.preventDefault();
    }

    showButtons() {
        $("#alert .alert-buttons").css({ "display": "flex" });
    }

    hideButtons() {
        $("#alert .alert-buttons").css({ "display": "none" });
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