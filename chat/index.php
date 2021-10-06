<?php
    $db = file_get_contents("db.json");
    $data = json_decode($db, true);
    $login = $_GET["login"];
    $pass = $_GET["pass"];
    $message = $_GET["message"];

    echo "login: " . $login;
    echo "<br>";
    echo "pass: " . $pass;
    echo "<br>";
    echo "message: " . $message;
    echo "<br>";

    for ($i = 0; $i < count($data["messages"]); $i++)
    {
        echo "user: ";
        echo $data["messages"][$i]["login"];
        echo " ";
        echo "message: ";
        echo $data["messages"][$i]["text"];
        echo "<br>";
    }

    $error = 0;
    $last = count($data["messages"]);
    for ($i = 0; $i < count($data["users"]); $i++)
    {
        if(($data["users"][$i]["login"] == $login) && ($data["users"][$i]["pass"] == $pass))
        {
            $data["messages"][$last]["login"] = $login;
            $data["messages"][$last]["text"] = $message;
            file_put_contents("db.json", json_encode($data));
            $error = 0;
            break;
        }
        $error = 1;
    }
    if($error == 1)
    {
        echo "YOU SHOULD LOGIN TO BE ABLE TO CHAT";
        echo "<br>";
    }
?>
