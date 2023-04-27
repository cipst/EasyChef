export const REGEX = Object.freeze({
    email: /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[A-Za-z]+$/,
    username: /^[a-zA-Z]+$/
});

export const ALERT_TYPE = Object.freeze({
    "SUCCESS": "success",
    "ERROR": "error",
    "WARNING": "warning",
    "INFO": "info"
});

export const ALERT_ICON = Object.freeze({
    "SUCCESS": "fa-circle-check",
    "ERROR": "fa-triangle-exclamation",
    "WARNING": "fa-triangle-exclamation",
    "INFO": "fa-circle-info"
});