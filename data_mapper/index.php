<?php

    class User
    {
        public int $id;
        public int $age;
        public string $name;
    }

    class Repository
    {
        private $db;
        function __construct()
        {
            try
            {
                $this->db = new PDO('mysql:host=localhost;dbname=ar', 'Minori', 'nengfhjkm');
            }
            catch (PDOException $e)
            {
                printf("ERROR: %s", $e->getMessage());
                die();
            }
        }

        public function save(User $user)
        {
            $save_stmt = $this->db->prepare("insert into users(age, name) values(?, ?)");
            $save_stmt->execute(array($this->age, $this->name));
        }

        public function remove(User $user)
        {
            $delete_stmt = $this->db->prepare("delete from users where age = ? and name = ?");
            $delete_stmt->execute(array($this->age, $this->name));
        }

        public function getById(int $id) : User
        {
            $find_stmt = $this->db->prepare("select * from users where id = ?");
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

        public function all() : array
        {
            foreach($this->db->query("select * from users") as $res)
            {
                $user = new User();
                $user->id =   $res["id"];
                $user->name = $res["name"];
                $user->age =  $res["age"];
                $users[] = $user;
            }
            return $users;
        }

        public function getByName(string $name) : User
        {
            $find_stmt = $this->db->prepare("select * from users where name = ?");
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

    $rep = new Repository();
    $ex1 = new User();
    $ex1->age = 45;
    $ex1->name = "James";

    $ex2 = $rep->getById(6);
    $all = $rep->all();
    $ex3 = $rep->getByName("James");
    echo $ex3->age;

?>

