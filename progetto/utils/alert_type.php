<?php


class AlertType
{
    const SUCCESS = "success";
    const DANGER = "danger";
    const WARNING = "warning";
    const INFO = "info";

    private const SUCCESS_ICON = "bi-check-lg";
    private const DANGER_ICON = "bi-exclamation-circle";
    private const WARNING_ICON = "bi-exclamation-triangle";
    private const INFO_ICON = "bi-question-lg";

    static function to_array()
    {
        return array(
            AlertType::SUCCESS,
            AlertType::DANGER,
            AlertType::WARNING,
            AlertType::INFO,
        );
    }

    static function get_icon(string $type){
        switch ($type) {
            case AlertType::SUCCESS:
                return AlertType::SUCCESS_ICON;
                break;
            case AlertType::DANGER:
                return AlertType::DANGER_ICON;
                break;
            case AlertType::WARNING:
                return AlertType::WARNING_ICON;
                break;
            case AlertType::INFO:
                return AlertType::INFO_ICON;
                break;
            
            default:
                # code...
                break;
        }
    }
}
