<?php
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=ar', 'Minori', 'nengfhjkm');
    }
    catch (PDOException $e)
    {
        printf("ERROR: %s", $e->getMessage());
        die();
    }

    class User
    {
        private int $id;
        public int $age;
        public string $name;

        public function save($db)
        {
            $save_stmt = $db->prepare("insert into users(age, name) values(?, ?)");
            $save_stmt->execute(array($this->age, $this->name));
        }

        public function remove($db)
        {
            $delete_stmt = $db->prepare("delete from users where age = ? and name = ?");
            $delete_stmt->execute(array($this->age, $this->name));
        }

        static public function getById($db, int $id) : User
        {
            $find_stmt = $db->prepare("select * from users where id = ?");
            $find_stmt->execute(array($id));
            $res = $find_stmt->fetch();
            if(empty($res))
            {
                throw new Exception("not found user with id " . $id);
            }
            $user = new User();
            $user->id =   $res["id"];
            $user->name = $res["name"];
            $user->age =  $res["age"];
            return $user;
        }

        static public function all($db) : array
        {
            foreach($db->query("select * from users") as $res)
            {
                $user = new User();
                $user->id =   $res["id"];
                $user->name = $res["name"];
                $user->age =  $res["age"];
                $users[] = $user;
            }
            return $users;
        }

        static public function getByName($db, string $name) : User
        {
            $find_stmt = $db->prepare("select * from users where name = ?");
            $find_stmt->execute(array($name));
            $res = $find_stmt->fetch();
            if(empty($res))
            {
                throw new Exception("not found user with name " . $name);
            }
            $user = new User();
            $user->id =   $res["id"];
            $user->name = $res["name"];
            $user->age =  $res["age"];
            return $user;
        }
    }

    $ex1 = new User();
    $ex1->age = 45;
    $ex1->name = "James";
    // $ex1->save($db);
    // $ex1->remove($db);
    $ex2 = User::getById($db, 6);
    $all = User::all($db);
    $ex3 = User::getByName($db, "James");
    echo $ex3->age;

?>

