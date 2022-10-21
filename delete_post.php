<?php
session_start();
require_once 'models/PostModel.php';
$postModel = new PostModel();

$user_id = $_SESSION['id'];
$token =  md5($user_id);
echo $token;

echo $_SESSION['token'];
echo '<br/>';
echo  $_GET['token'];
echo $user_id;
$post_id = NULL;

if (!empty($_GET['id']) && $_GET['token'] == $token) {
    $post_id = $_GET['id'];
    $postModel->deletePostById($post_id,$user_id);
}
?>