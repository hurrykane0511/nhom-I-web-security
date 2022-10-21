<?php
// Start the session
session_start();
require_once 'models/PostModel.php';
$postModel = new PostModel();
$allPost = $postModel->allPost();

$user_id = '';
$token =  md5($user_id);
echo $token;
$_SESSION['token'] = md5($user_id);
$post_id = NULL;

if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}
if (!empty($_GET['id'])) {
    $post_id = $_GET['id'];
    $post_id = $postModel->findPostById($post_id); //Update existing user
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://apis.google.com">
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if (!empty($allPost)) { ?>
            <div class="alert alert-warning" role="alert">
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">User</th>
                        <th scope="col">Token</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allPost as $post) { ?>
                        <tr>
                            <th scope="row"><?php echo $post['post_id'] ?></th>
                            <td>
                                <?php echo $post['post_title'] ?>
                            </td>
                            <td>
                                <?php echo $post['post_content'] ?>
                            </td>
                            <td>
                                <?php echo $post['user_id'] ?>
                            </td>
                            <td>
                                <?php echo $token ?>
                            </td>
                            <td>
                                <a href="delete_post.php?id=<?php echo $post['post_id']."&token=".$token ?>">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <?php
        echo $_SESSION['token'];
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $user_id = $user_id;
            $_SESSION['token']= $token;
            $postModel->insertPost($title, $content, $user_id);
        }
        if ($user_id) { ?>
            <div class="alert alert-warning" role="alert">
                Post form
            </div>
            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" name="title" placeholder="Title" value=''>
                </div>
                <input type="hidden" name="csrfSecret" value=<?php $token ?>>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" name="content" class="form-control" placeholder="Content">
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        <?php } else { ?>
            <div class="alert alert-success" role="alert">
                User not found!
            </div>
        <?php } ?>
    </div>
</body>

</html>