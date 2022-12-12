const AlertType = Object.freeze({
    "SUCCESS": "success",
    "DANGER": "danger",
    "WARNING": "warning",
    "INFO": "info"
});

const AlertIcon = Object.freeze({
    "SUCCESS": "bi-check-lg",
    "DANGER": "bi-exclamation-circle",
    "WARNING": "bi-exclamation-triangle",
    "INFO": "bi-question-lg"
});

/**
 * Class that create a `custom alert` to display at the user
 * a `successful` or `failed` operation, or for any other purpose
 * 
 * @author Stefano Cipolletta
 */
class Alert {

    #t;
    #title;
    #message;
    #icon;

    /**
     * @param {AlertType} t 
     * @param {String} title 
     * @param {String|null} message 
     * @returns 
     */
    constructor(t, title, message = null) {
        if (!Object.values(AlertType).includes(t))
            return;

        this.#t = t;
        this.#title = title;
        this.#message = message;
        this.#icon = AlertIcon[t.toUpperCase()];

        this.showAlert();
    }

    showAlert() {
        $("#alert .alert-message *").remove();
        $("#alert").addClass(`alert-${this.#t}`);
        $("#alert .alert-heading").text(this.#title);
        $("#alert .alert-message").append(this.#message);
        $("#alert .alert-icon").addClass(this.#icon);
        $("#alert .alert-icon").addClass(`text-${this.#t}`);
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