<?php
    require_once('vendor/autoload.php');
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $db = file_get_contents("db.json");
    $data = json_decode($db, true);

    $login = $_GET["login"];
    $pass = $_GET["pass"];
    $message = $_GET["message"];

    $data =
    [
        [
            "login" => "user1",
            "message" => "Hellow"
        ],
        [
            "login" => "user2",
            "message" => "Hi!",
        ],
        [
            "login" => "user1",
            "message" => "Good to see ya!",
        ]
    ];

    echo $twig->render('main.twig', ['data' => $data]);

    
?>
