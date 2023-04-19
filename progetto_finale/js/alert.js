import { ALERT_TYPE, ALERT_ICON } from "./constants.js";

/**
 * Class that create a `custom alert` to display at the user
 * a `successful` or `failed` operation, or for any other purpose
 * 
 * @author Stefano Cipolletta
 */
export class Alert {

    static #type;
    static #title;
    static #message;
    static #icon;

    /**
     * @param {ALERT_TYPE} type 
     * @param {String} title 
     * @param {String|null} message 
     * @returns 
     */
    static init(type, title, message = null, callback = null) {
        if (!Object.values(ALERT_TYPE).includes(type))
            return;

        if (callback !== null) {
            Alert.showButtons();
            $("#alert #alert-button-confirm").on("click", () => {
                callback();
                Alert.hideButtons();
            });
        }

        Alert.#type = type;
        Alert.#title = title;
        Alert.#message = message;
        Alert.#icon = ALERT_ICON[type.toUpperCase()];

        Alert.showAlert();

        $("#alert i.close").on("click", Alert.closeAlert);
        $("#alert #alert-button-cancel").on("click", Alert.closeAlert);
    }

    static showAlert() {
        $("#alert").css("border-color", `var(--${Alert.#type.toLowerCase()}-color)`); //changing border color
        $("#alert .alert-heading").css("color", `var(--${Alert.#type.toLowerCase()}-color)`); //changing heading color

        $("#alert .alert-icon").removeClass(ALERT_ICON.ERROR);
        $("#alert .alert-icon").removeClass(ALERT_ICON.INFO);
        $("#alert .alert-icon").removeClass(ALERT_ICON.SUCCESS);
        $("#alert .alert-icon").removeClass(ALERT_ICON.WARNING);

        $("#alert .alert-icon").addClass(Alert.#icon); //adding icon
        $("#alert .alert-title").text(Alert.#title); //adding title
        $("#alert .alert-message").html(Alert.#message); //adding message

        $("#alert").fadeIn(500);
        $("#alert").show();
        $("#mask").show();
    }

    static closeAlert = (e) => {
        $("#alert").fadeOut(200, () => {
            $("#alert .alert-icon").removeClass(Alert.#icon);
            $("#alert .alert-message").text("");
        });
        $("#mask").fadeOut(200);
        e.preventDefault();
    }

    static showButtons() {
        $("#alert .alert-buttons").css({ "display": "flex" });
    }

    static hideButtons() {
        $("#alert .alert-buttons").css({ "display": "none" });
    }

    get title() {
        return Alert.#title;
    }
    get message() {
        return Alert.#message;
    }
    get icon() {
        return `${Alert.#icon}`;
    }
}