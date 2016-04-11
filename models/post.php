<?php

class Post {
    private $db;
    
    function __construct($db){
        $this->db = $db;
    }
    
        // Safely acquire the rows for getStudents function
    function select($query){
        $select = $this->db->prepare($query);
        $select->bindParam('username', $this->username, PDO::PARAM_STR);
        $select->bindParam('title', $this->title, PDO::PARAM_STR);
        $select->bindParam('post', $this->post, PDO::PARAM_STR);
        $select->bindParam('vote', $this->vote, PDO::PARAM_INT);
        $select->bindParam('post_ID', $this->post_ID, PDO::PARAM_INT);
        $select->execute();
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Attempt to add post
    function post($username, $post, $title){
        $insert = $this->db->prepare('insert into posts(username, post, title) values(:username, :post, :title)');
        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':post', $post, PDO::PARAM_STR);
        $insert->bindParam(':title', $title, PDO::PARAM_STR);
        return $insert->execute();
    }
    
    function getPosts(){
        return $this->select("select * from posts order by title");
    }
    
}