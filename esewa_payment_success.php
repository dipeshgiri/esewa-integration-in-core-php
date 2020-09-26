<?php 
include 'dbconfig.php';
if(isset($_REQUEST['oid'])&&($_REQUEST['amt'])&&($_REQUEST['refId']))
{
	$oid=$_REQUEST['oid'];
	$sql="SELECT * FROM `orders` WHERE `invoice_no`='$oid';";
	$result=mysqli_query($conn,$sql);
	if($result)
	{
		if(mysqli_num_rows($result)==1)
		{
			$order=mysqli_fetch_assoc($result);
			$url = "https://uat.esewa.com.np/epay/transrec";
			$data =[
    				'amt'=> $order['total'],
				    'rid'=> $_REQUEST['refId'],
				    'pid'=> $order['invoice_no'],
				    'scd'=> 'epay_payment'
				];
		    $curl = curl_init($url);
		    curl_setopt($curl, CURLOPT_POST, true);
		    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    $response = curl_exec($curl);
		    if(strpos($response, "Success") == true)
		    {
		    	$ids=$order['id'];
		    	$sqli="UPDATE `orders` SET status=1 WHERE `id`='$ids';";
		    	mysqli_query($conn,$sqli);
		    	header('Location:success.php');
		    }
		    else{
		    	header('Location:esewa_payment_failed.php');
		    }
		    curl_close($curl);

		}
	}
}
?>