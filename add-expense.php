<?php session_start(); 

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  die();
}
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add-income.php">Add Income</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add-expense.php"> Add Expenses</a>
        </li>
        <li class="nav-item">
          Welcome <?php echo $name; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-info" href="logout.php"> Logout</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
	</header>

  <section class="w-50 border p-5  mx-auto bg-info">
    <?php
    include 'connect.php';
    if (isset($_POST['save'])) {
      $amount = trim($_POST['amount']);
      $date = trim($_POST['date']);
      $remarks = trim($_POST['remarks']);
      $save = mysqli_query($conn, "INSERT INTO `expense` (`uid`, `amount`, `dt`, `remarks`) VALUES ('$user_id', '$amount', '$date', '$remarks');");
      if ($save) {
        echo "<h1> Saved Successfully</h1>";
      }
      else{
        echo "<h1> Error while saving data</h1>";
      }
    }
    ?>
    <h2>Enter your Expense Details:</h2>
    <form method="post">
      <label>Enter Amount</label>
      <input type="number" name="amount" class="form-control"><br>
      <label>Enter Date</label>
      <input type="date" name="date" class="form-control"><br>
      <label>Remarks</label>
      <input type="text" name="remarks" class="form-control"><br>
      <input type="submit" name="save" value="Save Data" class="btn btn-outline-primary">

    </form>
  </section>
	
</body>
</html>