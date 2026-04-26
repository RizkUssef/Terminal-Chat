<?php

if (!function_exists('detect_field')) {
    function detect_field(string $login)
    {
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        return [
            $field => $login
        ];
    }
}
