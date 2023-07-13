<?php

class UserManager extends AbstractManager {
    
    public function getAllUsers() : array
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        $usersTab = [];
        foreach ($users as $user){
            $userInstance = new User($user['username'], $user['email'], $user['password']);
          $userTab[] = $userInstance;
        }
        return $userTab;  
    }
    public function getUserById( int $id) : User 
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $parameters = [
                "id" => $id
            ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;

    }
    public function getUserByUsername(string $username) : User 
    {
		$query = $this->db->prepare('SELECT * FROM users WHERE username = :username');
		$parameters = [
			'username' => $username
		];
		$query->execute($parameters);
		$user = $query->fetch(PDO::FETCH_ASSOC);
		$userInstance = new User(
         $user['username'],
         $user['email'],
         $user['password']
      );
      $userInstance->setId($user['id']);
      return $userInstance;
	}
    public function insertUser(User $user):User
    {
        $query = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $parameters = [
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' =>$user->getPassword()
            ];
        $query->execute($parameters);
        $id = $this->db->lastInsertId();
        $user->setId($id);
        return $user;
    }
    public function editUser(User $user)
    {
        $hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($hash);
        $query = $this->db->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id");
        $parameters = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ];
        $query->execute($parameters);
        $user = $this->getUserById($user->getId());
        return $user;
    }
    
}   
?>