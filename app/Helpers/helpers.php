<?php

function show_role_name($role = NULL) {
    $role = $role ?? Auth::user()->role;
    return match ($role) {
        'admin' => 'Administrator',
        'staff' => 'Working Staff',
        'user' => 'Customer',
        default => ''
    };
}