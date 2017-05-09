<?php
session_start();
$email2=$_SESSION['post-data']['email1'];
mysql_connect('localhost', 'root', '');

mysql_select_db('razorpay');
					if($email2)
					{
					 
					 $checkdata="SELECT email FROM form_element WHERE `email`='$email2' AND `payment_id`= 'NULL' AND `status`= 'failure'";

					 $query1=mysql_query($checkdata);
                     
					 
					 if(mysql_num_rows($query1)>0)
					 {
					  mysql_query("UPDATE `form_element` SET `payment_id`= '".mysql_real_escape_string($_GET['paymentid'])."' , `status`= 'succesfull' WHERE email='$email2' AND `payment_id`= 'NULL'");
					 }
					 else
					 {
					  mysql_query("UPDATE `form_element` SET `payment_id`= '".mysql_real_escape_string($_GET['paymentid'])."' , `status`= 'succesfull' ORDER BY id DESC LIMIT 1");
					 }
					 
					 //mysqli_close($connect);
					 //exit();
					}	
//mysql_query("UPDATE `form_element` SET `payment_id`= '".mysql_real_escape_string($_GET['paymentid'])."' , `status`= 'succesfull' WHERE email='$email2'");
//UPDATE `form_element` SET `payment_id`='jghvjghvbjygbj' WHERE `id`= 274
//UPDATE `form_element` SET `payment_id`= '".mysql_real_escape_string($_GET['paymentid'])."' WHERE `id` = 271;

?>


<!doctype html>
<html>
  <head>
    <title>Invoice</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="user-scalable=no,width=device-width,initial-scale=1,maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css"></link>
    <!--link rel="icon" href="https://razorpay.com/favicon.png" type="image/x-icon" /-->
    
                  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
      body {
        font-family: -apple-system, ubuntu, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
        color: #414141;
        background: #ecf0f1;
      }

      #success path {
        fill: #6DCA00;
      }

      #failure path {
        fill: #e74c3c;
      }

      h3 {
        font-weight: normal;
      }

      .card {
        background: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 9px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin: 30px auto;
        width: 80%;
        max-width: 300px;
        text-align: center;
      }

      #break {
        color: #777;
        font-size: 14px;
        margin: 30px -30px 0;
        padding: 30px 30px 0;
        border-top: 1px dashed #e3e4e6;
        text-align: left;
        line-height: 24px;
      }

      #break span {
        float: right;
      }

      #success {
        display: none;
      }

      .paid #success {
        display: block;
      }

      #button {
        background-color: #4994E6;
        color: #fff;
        border: 0;
        outline: none;
        cursor: pointer;
        font: inherit;
        margin-top: 10px;
        padding: 10px 20px;
        border-radius: 2px;
      }

      #button:active {
        box-shadow: 0 0 0 1px rgba(0,0,0,.15) inset, 0 0 6px rgba(0,0,0,.2) inset;
      }
    </style>
  </head>
  <body>
          <div class=paid>
                  <div id="success" class="card">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z"/></svg>
            <h3>Your Payment has been received</h3>
            <div id='break'>
			<?php
			
                            require('C:\xampp\htdocs\razorpay\sample\razorpay-php-testapp-master_files\config.php');
                            $conn = mysqli_connect($servername, $username, $password, $dbname);
							// Check connection
							if (!$conn) {
								 die("Connection failed: " . mysqli_connect_error());
							}
							if($email2)
					{
					 
					 $checkdata="SELECT email FROM form_element WHERE `email`='$email2' AND `payment_id`= 'NULL' AND `status`= 'failure'";

					 $query1 = mysqli_query($conn, $checkdata);

					 if(mysqli_num_rows($query1)>0)
					 {
					 $sql = mysqli_query($conn, "SELECT * from form_element WHERE email='$email2' AND `payment_id`= 'NULL'");
					 }
					 else
					 {
					  $sql = mysqli_query($conn, "SELECT * from form_element ORDER BY id DESC LIMIT 1");
					 }
					 //mysqli_close($connect);
					 //exit();
					}

							//$sql = "SELECT * from form_element ORDER BY id DESC LIMIT 1;";
							//$result = mysqli_query($conn, $sql);

							if (mysqli_num_rows($sql) > 0) {
								 // output data of each row
								 while($row = mysqli_fetch_assoc($sql)) {
									 echo "Order Id: " . $row["id"]. "<br> Payer Name: " . $row["name"]. "<br> Payer Email: " . $row["email"]. "<br> Payer Contact: " . $row["contact"]. "<br>";
								 }
							} else {
								 echo "0 results";
							}

							 mysqli_close($conn);
							?>
              
			 
              <!--div>Invoice ID<span>inv_7QMVwWBHA2vMpJ</span></div-->
              <div>Payment ID<span id='pay_id'><?php $pid = $_GET['paymentid'];
														echo $pid;?>
							</span>
							</div>
            </div>
          </div>

                        </div>
      </body>
</html>