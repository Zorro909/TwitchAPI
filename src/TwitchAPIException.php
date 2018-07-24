<?php

class TwitchAPIException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        // etwas Code

        // sicherstellen, dass alles korrekt zugewiesen wird
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}