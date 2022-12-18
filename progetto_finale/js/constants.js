export const REGEX = Object.freeze({
    email: /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[A-Za-z]+$/,
    password: /^(?=(.*[a-z]){1,})(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})(?=(.*[!@#$%^&*()\-_+.]){1,}).{8,50}$/,
    username: /^[a-zA-Z]+$/
});

export const ALERT_TYPE = Object.freeze({
    "SUCCESS": "success",
    "DANGER": "danger",
    "WARNING": "warning",
    "INFO": "info"
});