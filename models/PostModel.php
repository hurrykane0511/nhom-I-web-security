<?php

require_once 'BaseModel.php';

class PostModel extends BaseModel
{

    public function findPostById($id)
    {
        $sql = 'SELECT * FROM post WHERE post_id = ' . $id;
        $post = $this->select($sql);
        return $post;
    }

    public function findPost($keyword)
    {
        $sql = 'SELECT * FROM post WHERE post_title LIKE %' . $keyword . '%';
        $post = $this->select($sql);

        return $post;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deletePostById($postId, $userId)
    {
        $sql = 'DELETE FROM post WHERE post_id = ' . $postId . ' AND user_id = ' . $userId;
        return $this->delete($sql);
    }

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertPost($title,$content,$userID)
    {
        $sql = self::$_connection->prepare("INSERT INTO `post` (`post_id`, `post_title`, `post_content`, `user_id`) VALUES (NULL,?, ?, ?)");
        $sql->bind_param("ssi",$title,$content,$userID);
        return $sql->execute(); //return an object
    }

    /**
     * Post
     * @param array $params
     * @return array
     */
    public function allPost()
    {
        //Keyword
        $sql = 'SELECT * FROM post';
        $users = $this->select($sql);
        return $users;
    }
}
