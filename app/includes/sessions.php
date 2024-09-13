<?php

namespace App\Includes;

session_start();

if (!isset($_SESSION["session_info"]["last_regen"])) {
    // First time session is created
    session_regenerate_id();
    $_SESSION["session_info"] = [
        "last_regen" => time()
    ];
} else {
    

    if (!isset($_SESSION["session_info"])) {
        $_SESSION["session_info"] = [];
    }

    // Set session information
    $_SESSION["session_info"] = [
        "last_activity" => time(),
        "last_page" => $_SERVER["REQUEST_URI"],
        "last_regen" => $_SESSION["session_info"]["last_regen"]
    ];


    // Regenerate session ID every 30 minutes
    $last_regen = $_SESSION["session_info"]["last_regen"];
    $current_time = time();
    $time_diff = $current_time - $last_regen;
    if ($time_diff > 1800) {
        session_regenerate_id();
        $_SESSION["session_info"]["last_regen"] = time();
    }
}
