<?php
include 'dbconfig.php';

if($_SERVER['REQUEST_METHOD']='POST')
{
	$product_id=$_POST['product_id'];
	$sql="SELECT * FROM `products` where `id`='$product_id';";
	$result=mysqli_query($conn,$sql);
	if($result)
	{
		if(mysqli_num_rows($result)==1)
		{
			$products=mysqli_fetch_assoc($result);
			$invoice_no=$products['id'].time();
			$total=$products['amount'];
			$created_at=date('Y-m-d H:i:s');
			$query="INSERT INTO `orders`(`product_id`,`invoice_no`,`total`,`status`,`created_at`) VALUES('$product_id','$invoice_no','$total',0,'$created_at');";
			if(!mysqli_query($conn,$query))
			{
				die("Error Occured");
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Page</title>
			<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="col-md-12">
			<h1 class="text-center text-success">Order Details</h1>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
			<div class="card" style="width: 18rem;">
				<div class="imagecontainer" style="height: 200px;">
	 		 <img class="card-img-top" src="images/<?php echo $products['image']; ?>" alt=".." style=" width:100%; height:100%;">
	 		 </div>
	 		 <div class="card-body">
	   		 <h5 class="card-title"><?php echo $products['title'];?></h5>
	   		 <p class="card-text"><b>NRS. <?php echo $products['amount'];?></b></p>
	   		 <p class="card-text"><?php echo $products['description'];?></p>
	 	 	</div>
			</div>
		</div>
		<div class="col-md-6">
			<h2 class="text-center text-danger">Pay With</h2>
			<ul class="list-group">
				<li class="list-group-item">
					    <form action="https://uat.esewa.com.np/epay/main" method="POST">
					    <input value="<?php echo $total;?>" name="tAmt" type="hidden">
					    <input value="<?php echo $total;?>" name="amt" type="hidden">
					    <input value="0" name="txAmt" type="hidden">
					    <input value="0" name="psc" type="hidden">
					    <input value="0" name="pdc" type="hidden">
					    <input value="epay_payment" name="scd" type="hidden">
					    <input value="<?php echo $invoice_no;?>" name="pid" type="hidden">
					    <input value="http://localhost/esewa/esewa_payment_success.php" type="hidden" name="su">
					    <input value="http://localhost/esewa/esewa_payment_failed.php" type="hidden" name="fu">
					    <input type="image" src="images/esewa.png">
					    </form>
				</li>
				<li class="list-group-item"><input type="image" src="images/khalti.png"></li>
				<li class="list-group-item"><input type="image" src="images/fonepay.png"></li>
			</ul>
		</div>
	</div>
	</div>
</body>
</html>