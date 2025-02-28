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
	<hr>

	<section class="container">
		<h1>Income Details</h1>

		<?php
		include 'connect.php';
		$total_income = $total_expense = 0;
		$fetch_income =mysqli_query($conn, "SELECT * FROM `income` WHERE `income`.`uid` = '$user_id' ORDER BY `id` DESC;");

		$count = mysqli_num_rows($fetch_income);
		if($count ==0){
			echo '<div class= "alert alert-warning">No data for the user</div>';
		}
		else{ ?>
			<table class="table">
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Amount</th>
					<th>Remarks</th>
				</tr>
				<?php
				$i = 1;
				while ($row = mysqli_fetch_assoc($fetch_income)) {?>
					<tr>
						<td><?php echo $i; $i = $i + 1; ?></td>
						<td><?php echo $row['dt']; ?></td>
						<td><?php echo $row['amount'];
						$total_income += $row['amount']; ?></td>
						<td><?php echo $row['remarks']; ?></td>
					</tr>
				<?php } //while ?>
				<tr>
					<th colspan="2">Total Income</th>
					<th colspan="2"><?php echo $total_income;?></th>
				</tr>
			</table>

		<?php } ?>

		<hr>

		<h1>Expense Details</h1>
		<?php
		$fetch_expense =mysqli_query($conn, "SELECT * FROM `expense` WHERE `expense`.`uid` = '$user_id' ORDER BY `id` DESC;");

		$count = mysqli_num_rows($fetch_expense);
		if($count ==0){
			echo '<div class= "alert alert-warning">No data for the user</div>';
		}
		else{ ?>
			<table class="table">
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Amount</th>
					<th>Remarks</th>
				</tr>
				<?php
				$i = 1;
				while ($row = mysqli_fetch_assoc($fetch_expense)) {?>
					<tr>
						<td><?php echo $i; $i = $i + 1; ?></td>
						<td><?php echo $row['dt']; ?></td>
						<td><?php echo $row['amount'];
						$total_expense += $row['amount']; ?></td>
						<td><?php echo $row['remarks']; ?></td>
					</tr>
				<?php } //while ?>
				<tr>
					<th colspan="2">Total expense</th>
					<th colspan="2"><?php echo $total_expense;?></th>
				</tr>
			</table>

		<?php } ?>
		<hr>

		<table class="table table-bordered">
			<tr>
				<th>Total Balance in Account:</th>
				<th><h2><?php $balance = $total_income - $total_expense; echo $balance; ?></h2></th>
			</tr>
		</table>

		<a href="mail.php?income=<?php echo $total_income;?>&expense=<?php echo $total_expense;?>&balance=<?php echo $balance;?>">Send me a mail</a>

	</section>
	
</body>
</html>