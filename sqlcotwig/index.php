<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=sqlcotwig', 'Minori', 'nengfhjkm');
    }
    catch (PDOException $e)
    {
        printf("ERROR: %s", $e->getMessage());
        die();
    }

    require_once('vendor/autoload.php');
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $login = $_GET["login"];
    $password = $_GET["password"];
    $message = $_GET["message"];

    try
    {
        foreach($db->query('select * from messages') as $m)
        {
            $messages[] = $m;
        }
    }
    catch (PDOException $e)
    {
        printf("ERROR: %s", $e->getMessage());
        die();
    }

    $user_query = "select * from users where login = ? and password = ?";
    $user_stmt = $db->prepare($user_query);
    $user_stmt->execute(array($login, $password));
    $user = $user_stmt->fetchAll();

    $warning = false;
    if(!empty($user))
    {
        if(!empty($message))
        {
            $message_query = "insert into messages(author, message) values(?, ?)";
            $message_stmt = $db->prepare($message_query);
            $message_stmt->execute(array($login, $message));
        }
    }
    else
    {
        $warning = true;
    }

    echo $twig->render('main.twig', ['messages' => $messages, 'warning' => $warning]);


?>
