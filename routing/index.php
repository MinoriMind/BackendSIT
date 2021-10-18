<?php

    $route = $_GET["route"];
    switch($route)
    {
        case "404":
            header("Location: ./404.php");
            exit();
        break;

        default:
            echo "Invalid route";
            exit();
    }
?>
