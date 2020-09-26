<?php
include 'dbconfig.php';

$sql="SELECT * FROM `products`";
$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Esewa Payment Gateway Integration</title>
		<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>
<body>
	<h1 class="text-center text-success">Esewa Payment integration</h1>
	<br>
	<div class="container">
		<div class="row">
			<?php while($product=mysqli_fetch_assoc($result)){ ?>
			<div class="col-md-4">
			<div class="card" style="width: 18rem;">
				<div class="imagecontainer" style="height: 200px;">
	 		 <img class="card-img-top" src="images/<?php echo $product['image']; ?>" alt=".." style=" width:100%; height:100%;">
	 		 </div>
	 		 <div class="card-body">
	   		 <h5 class="card-title"><?php echo $product['title'];?></h5>
	   		 <p class="card-text"><b>NRS. <?php echo $product['amount'];?></b></p>
	   		 <p class="card-text"><?php echo $product['description'];?></p>
	   		 <form action="checkout.php" method="POST">
	   		 	<input type="hidden" name="product_id" value="<?php echo $product['id'];?>">
	   		 	<button type="submit" name="submit"  class="btn btn-success">Buy Now</button>
	   		 </form>
	 	 	</div>
			</div>
		</div>
	<?php };?>
	</div>
</div>

</body>
</html>