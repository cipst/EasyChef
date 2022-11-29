<?php

require_once("alert_type.php");

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
            print "
            <div class='d-flex justify-content-center m-5'>
                <span class='text-danger text-center fw-bold border border-danger p-2 rounded-3'>
                    An error occurred while trying to create an Alert!
                </span>
            </div>
            ";
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
