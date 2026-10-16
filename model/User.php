<?php
require_once __DIR__ . "/../dbConnection.php";
class User
{
    private $conn;
    function __construct()
    {
        $instanseConnection = PdoConnect::get_instanse();
        $this->conn = $instanseConnection->get_connection();
    }

    function get_all_users()
    {

        // 🎯 الحل الصحيح: حددنا users.id باسم id الصريح، وجلبنا اسم الـ role بدون تضارب
        $query = "SELECT users.id AS id, users.username, users.email, users.telephone, users.birth_date, roles.role 
          FROM users 
          INNER JOIN roles ON users.role_id = roles.id";

        $allUsers = $this->conn->prepare($query);
        $allUsers->execute();
        $users = $allUsers->fetchAll();
        return $users;
    }

    function get_user($id)
    {

        $query = "SELECT * FROM users WHERE id=?";
        $oneUser = $this->conn->prepare($query);
        $oneUser->execute([$id]);
        $user = $oneUser->fetch();
        return $user;
    }
    function delete_user($id)
    {

        $query = "DELETE  FROM users WHERE id=?";
        $oneUser = $this->conn->prepare($query);
        $oneUser->execute([$id]);
        $user = $oneUser->rowCount();
        return $user;
    }

    function update_user($username,$email,$password,$birth_date,$telephone,$role_id,$id )
    {
        if(trim($password)==""){
            $query = "UPDATE users SET username = ?, email = ?,birth_date=?,telephone=?,role_id=? WHERE id = ?";
            $oneUser = $this->conn->prepare($query);
            $oneUser->execute([$username,$email,$birth_date,$telephone,$role_id,$id]);
        }
        else{
        $query = "UPDATE users SET username = ?, email = ?,password=?,birth_date=?,telephone=?,role_id=? WHERE id = ?";
            $oneUser = $this->conn->prepare($query);
            $oneUser->execute([$username, $email,$password, $birth_date, $telephone, $role_id, $id]);
        }
     
        $user = $oneUser->rowCount();
        return $user;
    }

    function insert_user( $insertUser)
    {


        $query = "INSERT INTO users(username,email,password,birth_date,telephone,role_id) VALUES(?,?,?,?,?,?) ";
        $oneUser = $this->conn->prepare($query);
        $oneUser->execute(array_values($insertUser));
        $user = $oneUser->rowCount();
        return $user;
    }


    function get_all_roles()
    {

        $query = "SELECT * FROM roles";
        $allRoles = $this->conn->prepare($query);
        $allRoles->execute();
        $roles = $allRoles->fetchAll();
        return $roles;
    }
    
}
