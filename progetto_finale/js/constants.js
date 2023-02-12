export const REGEX = Object.freeze({
    email: /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[A-Za-z]+$/,
    password: /^(?=(.*[a-z]){1,})(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})(?=(.*[!@#$%^&*()\-_+.]){1,}).{8,50}$/,
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

export const RESPONSE_STATUS = Object.freeze({
    "OK": "success",
    "ERROR": "error",
    "REDIRECT": "redirect"
});
