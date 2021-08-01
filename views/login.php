<?php  
include __DIR__.'/layout/header.php'; 

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

if($user_id){
  header('Location: ./views/fleet.php');
}

if(isset($_SESSION['validation_time']) && time() - $_SESSION['validation_time'] > 10){
    unset($_SESSION['auth_message']);
    unset($_SESSION['validation_time']);
}
?>

<div class="flex">
    <form method="POST" action="../Controllers/AuthController.php" style="width: 30%;">
        <?php include "./errors/error.php" ?>
        <div class="">
            <label for="">Username</label>
            <input type="text" name="username" required placeholder="Username" class="form-control">
        </div>
        <div class="my-4">
            <label for="">Password</label>
            <input type="password" name="password" required placeholder="********" class="form-control">
        </div>
        <div class="">
            <button class="btn btn-primary btn-block" type="submit" name="form_submission">Login</button>
        </div>
    </form>
</div>

<?php  include 'layout/footer.php'; ?>