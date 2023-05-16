<?php

namespace Core\Classes;

class Session
{
    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        static::flush();

        session_destroy();
    }
}