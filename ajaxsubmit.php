					<?php
					session_start();
                    $_SESSION['post-data'] = $_POST;


					if($_POST){
						$name2=$_POST['name1'];
					$email2=$_POST['email1'];
					$amount2=$_POST['amount1'];
					//$password2=$_POST['password1'];
					$contact2=$_POST['contact1'];
					$address2=$_POST['useraddress1'];

					//send email
						mail("gauravmehra9024@gmail.com", "51 Deep comment from" .$name2, $email2, $contact2, $address2);
					}
					$connection = mysql_connect("localhost", "root", ""); // Establishing Connection with Server..
					$db = mysql_select_db("razorpay", $connection); // Selecting Database

					//Fetching Values from URL
					$name2=$_POST['name1'];
					$email2=$_POST['email1'];
					$amount2=$_POST['amount1'];
					//$password2=$_POST['password1'];
					$contact2=$_POST['contact1'];
					$address2=$_POST['useraddress1'];
					//$email2 = $_POST['email1'];
					
				if(isset($_POST['email1']))
     {
      $email3=$_POST['email1'];
      
                     
      $checkdata="SELECT email FROM form_element WHERE `email`='$email3' AND `payment_id`= 'NULL' AND `status`= 'failure'";

      $query1=mysql_query($checkdata);
                     
      
      if(mysql_num_rows($query1)>0)
      {
       $query = mysql_query("UPDATE `form_element` SET `name`= '$name2', `contact`= '$contact2', `time_date`= now() WHERE email='$email3' AND `payment_id`= 'NULL'");
      }
      else
      {
       $query = mysql_query("insert into form_element(name, email, amount, payment_id, status, contact,address) values ('$name2', '$email3', '$amount2', 'NULL', 'failure', '$contact2', '".$address2."')");
      }
      
      exit();
     }
					
					
					
					//Insert query
					


					echo "Please click on paynow button for payment";
					mysql_close($connection); // Connection Closed
					?>