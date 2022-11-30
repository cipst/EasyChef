<?php

require_once("alert_type.php");
require_once("error.php");

/**
 * Class that create a `custom alert` to display at the user
 * a `successful` or `failed` operation, or for any other purpose
 * 
 * @author Stefano Cipolletta
 */
class Alert
{
    private string $t;
    private string $title;
    private string $message;
    private string $description;
    private string $icon;

    public function __construct(string $t,  string $title,  string $message,  string $description)
    {
        // making sure the type given is an actual alert type
        // and not a random string
        if (in_array($t, AlertType::to_array(), true)) {
            $this->t = $t;
            $this->title = $title;
            $this->message = $message;
            $this->description = $description;
            $this->icon = AlertType::get_icon($t);
        } else {
            display_error("An error occurred while trying to create an Alert!");
        }
    }

    public function get_type()
    {
        return $this->t;
    }

    public function get_title()
    {
        return $this->title;
    }

    public function get_message()
    {
        return $this->message;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function get_icon()
    {
        return $this->icon;
    }
}
