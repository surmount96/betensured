<?php  

include 'layout/header.php'; 
require '../models/fleet_db.php';

$user_id = $_SESSION['user_id'];

if(!$user_id){
  header('Location: ./login.php');
}

$result = fetchAllCars();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $action = $_POST['action'];

  switch($action) {
    case 'delete': 
      deleteCar($_POST['id']);
      break;
    default:
      createCar($_POST);
      break;
  }
}

if(isset($_SESSION['validation_time']) && time() - $_SESSION['validation_time'] > 10){
  unset($_SESSION['auth_message']);
  unset($_SESSION['success']);
  unset($_SESSION['validation_time']);
}
?>

<div class="container">
<div class="space-between">
  <div class="">
    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
      Log a car
    </button>
  </div>
  <form method="post" action="../Controllers/logout.php">
    <button class="btn btn-outline-danger" type="submit">Logout</button>
  </form>
</div>
<?php include "./errors/error.php" ?>
<?php include "./inc/message.php" ?>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Model</th>
        <th>Brand</th>
        <th>Year</th>
        <th>Color</th>
        <th>Speed Limit (mph)</th>
        <th>Seat Number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach($result as $row) :
      ?>
     <tr>
        <td><?php  echo $row['model']; ?></td>
        <td><?php  echo $row['brand'] ?></td>
        <td><?php  echo $row['year'] ?></td>
        <td><?php  echo $row['color']; ?></td>
        <td><?php  echo $row['speed_limit']; ?></td>
        <td><?php  echo $row['seat_no']; ?></td>
        <td class="d-flex">
          <div class="mr-4">
            <button class="btn btn-primary">
              Edit
            </button>
          </div>
          <form method="POST" action="<?= $_SERVER['PHP_SELF']?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="action" value="delete">
            <button type="submit" class="btn btn-danger">
              Delete
            </button>
          </form>
        </td>
      </tr>
  
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Log available cars</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= $_SERVER['PHP_SELF']?>">
          <div class="">
            <label for="">Car Brand</label>
            <input type="text" name="brand" required placeholder="Brand" class="form-control">
          </div>
          <div class="">
            <label for="">Model</label>
            <input type="text" name="model" required placeholder="Model" class="form-control">
          </div>
          <div class="">
            <label for="">Color</label>
            <input type="text" name="color" required placeholder="color" class="form-control">
          </div>
          <div class="">
            <label for="">Speed (mph)</label>
            <input type="text" name="speed_limit" required placeholder="speed" class="form-control">
          </div>
          <div class="">
            <label for="">Seat Number</label>
            <input type="text" name="seat_no" required placeholder="No of seat" class="form-control">
          </div>
          <div class="">
            <label for="">Year</label>
            <input type="text" name="year" required placeholder="year" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php  include 'layout/footer.php'; ?>