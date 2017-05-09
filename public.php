
<?php

session_start();

if (isset($_POST['submit'])) {
    $_SESSION['post-data'] = $_POST;
}
?>

<!DOCTYPE html>
<!-- saved from url=(0043)https://api.razorpay.com/v1/checkout/public -->
<html dir="ltr"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Razorpay Checkout</title>
    <link rel="icon" href="data:;base64,=">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="user-scalable=no,width=device-width,initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="http://localhost/razorpay/sample/razorpay-php-testapp-master_files/jquery.min.js"></script>
		
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	
		
						<script>
						$(function() {
								  var regExp = /[0-9\.\,]/;
								  $('#contact').on('keydown keyup', function(e) {
								  if(this.value.length > 8)  $('#phoneclass').removeClass('invalid');
								  //alert(this.value.length);
									var value = String.fromCharCode(e.which) || e.key;
									console.log(e);
									// Only numbers, dots and commas
									if (!regExp.test(value)
									  //&& e.which != 188 // ,
									  //&& e.which != 190 // .
									  && e.which != 8   // backspace
									  && e.which != 46  // delete
									  && (e.which < 37  // arrow keys
										|| e.which > 40)) {
										  e.preventDefault();
										   $('#modal-inner').addClass('shake');
										   $('#phoneclass').addClass('focused');
										   $('#phoneclass').addClass('invalid');
										  
										  return false;
									}
									
									
								  });
								});
								
								
						</script>
	
						
						<!--script>
						$(document).on('click', '#modal-close', function() {
						
								 $('#razorpay-container').remove();
								 
							  });
						</script-->
<script>

$(document).ready(function(){

  var changePrice = function changePrice(amt, state){
        var curPrice = $('.price').text();
        curPrice = curPrice.substring(1, curPrice.length);
        if(state==true){
            curPrice = parseInt(curPrice) + parseInt(amt);
        }else{
            curPrice = parseInt(curPrice) - parseInt(amt);
        }
		//alert(curPrice);
		window.curAmount = curPrice;
        curPrice = '₹' + curPrice;
        $('.price').text(curPrice);
		
		//alert(curAmount);
		
    }
	 
    $(function() {
	
        $('#check-0').on('change', function(){
		$(".helping").css("display", "none");
            var itemPrice = $('label[for="check-0"]').text();
            itemPrice = itemPrice.substring(1, itemPrice.length);
        changePrice(itemPrice, $('#check-0').is(':checked'));
        });
		$('#check-1').on('change', function(){
		$(".helping").css("display", "none");
            var itemPrice = $('label[for="check-1"]').text();
            itemPrice = itemPrice.substring(1, itemPrice.length);
        changePrice(itemPrice, $('#check-1').is(':checked'));
		//alert(itemPrice);
        });
	
		
		
    });
$("#btn").click(function(e){
//alert(curAmount);
//curAmount="";
var name = $("#name").val();
var email = $("#email").val();
//var password = $("#password").val();
var contact = $("#contact").val();
var useraddress = $("#useraddress").val();
//checkbox validation
if (
	form.save.checked == false &&
	form.save1.checked == false) 
	{
		//alert ('You didn\'t choose any of the checkboxes!');
		$(".helping").css("display", "block");
		$('#modal-inner').addClass('shake');
		return false;
	};
	//validation end
var Amount = curAmount;


// Returns successful data submission message when the entered information is stored in database.
var dataString = 'name1='+ name + '&email1='+ email + '&contact1='+ contact + '&useraddress1='+ useraddress + '&amount1='+ Amount;

//email validation
var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        //alert("Not a valid e-mail address");
		$('#modal-inner').addClass('shake');
       $('#emailclass').addClass('focused');
	    $('#emailclass').addClass('invalid');
        return false;
    }
	//checkbox validation
/*if (
	form.save.checked == false &&
	form.save1.checked == false) 
	{
		alert ('You didn\'t choose any of the checkboxes!');
		return false;
	} else { 	
		return true;
	}*/

	 
//address field
if((useraddress.length < 15) || (useraddress.length > 100)) { 
   //alert("Please enter 10 digit phone number");
   $('#modal-inner').addClass('shake');
   $('#addressclass').addClass('focused');
   $('#addressclass').addClass('invalid');
   return false;
}
    
	//phone validation
	phone = contact.replace(/[^0-9]/g, '');
if(phone.length != 10) { 
   //alert("Please enter 10 digit phone number");
   $('#modal-inner').addClass('shake');
   $('#phoneclass').addClass('focused');
   $('#phoneclass').addClass('invalid');
   return false;
}
	
	//form field blank validate
if(name==''||email==''||contact=='')
{
//alert("Please Fill All Fields");
$('#modal-inner').addClass('shake');
$('#nameclass').addClass('focused');
$('#nameclass').addClass('invalid');
         			
}
else
{

// AJAX Code To Submit Form.
						$.ajax({
						type: "POST",
						url: "ajaxsubmit.php",
						data: $(form).serialize(),
						data: dataString,
						cache: false,
						success: function(result){
						//alert(result);
						}
						});
						

var options = 'name1='+ name + '&email1='+ email + '&contact1='+ contact + '&useraddress1='+ useraddress + '&amount1='+ Amount;
//alert(contact);
options = {

    "key": "rzp_test_dAcjUDUyXXheb3",
	//rzp_live_Z3kIG4GPCGmS4M LIVE KEY
    "amount": Amount * 100, // 2000 paise = INR 20
    "name": "HandaKaFunda",
    //"description": "Purchase Description",
    "image": "https://v2assets.zopim.io/10i0H4KWRmrTeS5o1FW7rvQuB1QK8bgS-concierge?1424670080434",
    "handler": function (response){
        //alert(response.razorpay_payment_id);
		//alert(response.razorpay_signature);
		window.location = "http://localhost/razorpay/sample/razorpay-php-testapp-master_files/thankyou.php?paymentid=" + response.razorpay_payment_id;
    },
    "prefill": {
       "name": name,
        "email": email,
		"contact": contact
    },
    "theme": {
        "color": "#d01c68"
    },
	"modal": {
        "ondismiss": function(){}
    }
};

var rzp1 = new Razorpay(options);
 rzp1.open();
    e.preventDefault();	
						
}
//$('#container').remove();
$('#modal-inner').removeClass('shake');
return false;
});


	

});
</script>
<style>
.buttonpay {
    border: 1px solid #fff;
    font-family: 'Fauna One',serif;
    font-weight: 700;
    font-size: 18px;
    background-color: #d01c68;
    color: #fff;
    border-color: #d01c68;
    border-radius: 2px;
    border-width: 2px;
    text-transform: uppercase;
    height: 50px;
}
</style>
<script type="text/javascript">

   $(document).ready(function ()
   {
      $("#btnShowSimple").click(function (e)
      {
         ShowDialog(false);
         e.preventDefault();
      });

    

      $("#modal-close").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });

      
   });

   function ShowDialog(modal)
   {
      $("#razorpay-container").show();
      $("#razorpay-backdrop").fadeIn(300);

      if (modal)
      {
         $("#razorpay-container").unbind("click");
      }
      else
      {
         $("#backdrop").click(function (e)
         {
            HideDialog();
         });
      }
   }

   function HideDialog()
   {
      $("#razorpay-container").hide();
      $("#razorpay-backdrop").fadeOut(300);
   } 
        
</script>


  </head>
  
  
  
  
  <body>
  
   <!--popup new started body-->

	 
	  <!--popup new end body-->	
		
			   
    <input class="buttonpay" type="button" id="btnShowSimple" value="Pay Now">
<!--div id="overlay" class="web_dialog_overlay" style="display: block;"></div-->
    <div style="font-family:&#39;lato&#39;;visibility:hidden;position:absolute;">.</div>
  
      <style>@font-face{font-family:'lato';src:url("https://cdn.razorpay.com/lato.eot?#iefix") format('embedded-opentype'),url("https://cdn.razorpay.com/lato.woff2") format('woff2'),url("https://cdn.razorpay.com/lato.woff") format('woff'),url("https://cdn.razorpay.com/lato.ttf") format('truetype'),url("https://cdn.razorpay.com/lato.svg#lato") format('svg');font-weight:normal;font-style:normal}</style>
    <link rel="stylesheet" href="http://localhost/co-ma-sy/razorpay/sample/razorpay-php-testapp-master_files/checkout.css">
	<!--amount part -->
	
 <!--amount part end -->

   
		  
	
	  
    <!--script src="./checkout-frame.js" crossorigin="" onerror="appendScript(this)"></script-->
   <div id="razorpay-container" class="razorpay-container" style="z-index: 1000000000; position: fixed; top: 0px; display: none; left: 0px; height: 100%; width: 100%; backface-visibility: hidden; overflow-y: visible;">
   <style>@keyframes rzp-rot{to{transform: rotate(360deg);}}@-webkit-keyframes rzp-rot{to{-webkit-transform: rotate(360deg);}}</style>
   <div class="razorpay-backdrop" style="min-height: 100%; transition: 0.3s ease-out; position: fixed; top: 0px; left: 0px; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6);">
 <span style="text-decoration: none; background: rgb(214, 68, 68); border: 1px dashed white; padding: 3px; opacity: 1; transform: rotate(45deg); transition: opacity 0.3s ease-in; font-family: lato, ubuntu, helvetica, sans-serif; color: white; position: absolute; width: 200px; text-align: center; right: -50px; top: 50px;">HandaKaFunda</span>
 </div>
 
<div id="container" class="mfix animations test drishy font-loaded" tabindex="0"> <div id="backdrop"></div> <i id="powered-by"><a id="powered-link" href="https://razorpay.com/?ref=org-in-chk" target="_blank"></a></i> <div id="modal" class="mchild"> <div id="modal-inner"> <div id="overlay" class="showable"></div> <div id="emi-wrap" class="showable mfix"></div> <div id="error-message" class="showable"> <div id="fd-t"></div> <div class="spin"><div></div></div> <div class="spin spin2"><div></div></div> <span class="link"></span> <button id="fd-hide" class="btn">Retry</button> <div id="cancel_upi"> <p>Please give us a reason before we cancel the payment</p> <label for="upi-1"><input id="upi-1" type="radio" name="_[reason]" value="collect_not_received"> Did not receive collect request </label> <label for="upi-2"><input id="upi-2" type="radio" name="_[reason]" value="failed_in_app"> Payment failed in UPI app </label> <label for="upi-3"><input id="upi-3" type="radio" name="_[reason]" value="money_deducted"> Money got deducted but payment is still processing </label> <label for="upi-4"><input id="upi-4" type="radio" name="_[reason]" value="other"> Other </label> <div class="buttons"> <button class="back-btn">Back</button> <button class="btn">Submit</button> </div> </div> </div> <div id="content"> <div id="header"> <div id="modal-close" class="close">×</div>  <div id="logo"> <img src="./2017-03-06.jpg"> </div>  <div id="merchant">  <div id="merchant-name">HandaKaFunda</div>  <div id="merchant-desc">IBPS PO 2017 Coaching Course</div> <div class="price" id="amount">₹0</div> </div>  </div> <div id="body"> <div id="topbar"> <div id="top-right"> <div id="user"></div> <div id="profile"><li>Log out</li><li>Log out from all devices</li></div> </div> <div id="top-left"> <i class="back"></i> <div id="tab-title"></div> </div> </div> <form id="form" method="POST" novalidate="" autocomplete="off" onsubmit="return false"> <div id="form-fields"> <div id="form-common" class="showable drishy screen"> 

<!--script type="text/javascript">
					$(function(){

        $('#contact').hover(function(){

            $('#phoneclass').addClass('focused');
        }, function(){
            $('#phoneclass').removeClass('focused');
        });
		
		  $('#name').hover(function(){

            $('#nameclass').addClass('focused');
        }, function(){
            $('#nameclass').removeClass('focused');
        });
		
		  $('#email').hover(function(){

            $('#emailclass').addClass('focused');
        }, function(){
            $('#emailclass').removeClass('focused');
        });
		
    });
</script-->
<script type="text/javascript">



/*$(document).on('click', '#contact', function() {
   $('#phoneclass').removeClass('focused');
   $('#phoneclass').removeClass('invalid');
   $('#phoneclass').addClass('filled');
  
});*/            
 /*var $inputs = $(document).on('focus', '#btn', function() {
				 
					$('#modal-inner').addClass('shake');
					}).on('blur', '#contact', function() {
					$('#modal-inner').removeClass('shake');
					});*/
 
				   var $inputs = $(document).on('focus', '#contact', function() {
				 
					$(this).parent().addClass('focused');
					}).on('blur', '#contact', function() {
					$(this).parent().removeClass('focused');
					if ($(this)[0].value == ''){
						$(this).parent().addClass('invalid');
						$(this).parent().removeClass('filled');
						//$(this).parent().removeClass('invalid');
						//$(this).parent().addClass('filled');
						}
						else{
						$(this).parent().removeClass('invalid');
						$(this).parent().addClass('filled');
						}
					});
					
					var $inputs = $(document).on('focus', '#name', function() {
				 
					$(this).parent().addClass('focused');
					}).on('blur', '#name', function() {
						$(this).parent().removeClass('focused');
						if ($(this)[0].value == ''){
						$(this).parent().addClass('invalid');
						$(this).parent().removeClass('filled');
						//$(this).parent().removeClass('invalid');
						//$(this).parent().addClass('filled');
						}
						else{
						$(this).parent().removeClass('invalid');
						$(this).parent().addClass('filled');
						}
					});
					
					var $inputs = $(document).on('focus', '#useraddress', function() {
				 
					$(this).parent().addClass('focused');
					}).on('blur', '#useraddress', function() {
						$(this).parent().removeClass('focused');
						if ($(this)[0].value == ''){
						$(this).parent().addClass('invalid');
						$(this).parent().removeClass('filled');
						//$(this).parent().removeClass('invalid');
						//$(this).parent().addClass('filled');
						}
						else{
						$(this).parent().removeClass('invalid');
						$(this).parent().addClass('filled');
						}
					});
					
					var $inputs = $(document).on('focus', '#email', function() {
				 
					$(this).parent().addClass('focused');
					}).on('blur', '#email', function() {
						$(this).parent().removeClass('focused');
						if ($(this)[0].value == ''){
						$(this).parent().addClass('invalid');
						$(this).parent().removeClass('filled');
						//$(this).parent().removeClass('invalid');
						//$(this).parent().addClass('filled');
						}
						else{
						$(this).parent().removeClass('invalid');
						$(this).parent().addClass('filled');
						}
					});
					
					
					

/*$(document).on('click', '#name', function() {
   $('#nameclass').removeClass('focused');
   $('#nameclass').removeClass('invalid');
   $('#nameclass').addClass('filled');
});*/

/*$(document).on('click', '#email', function() {
   $('#emailclass').removeClass('focused');
   $('#emailclass').removeClass('invalid');
   $('#emailclass').addClass('filled');
});*/
				
</script>
<style>
#some-element {
  border: 1px solid #ccc;
  display: none;
  font-size: 10px;
  margin-top: -48px;
  padding: 5px;
  text-transform: uppercase;
  position: absolute;
  background: white;
}
#some-element:after {
	 border-color: grey transparent transparent;
    border-style: solid;
    border-width: 9px 8px 0;
    content: "";
    display: block;
    height: 0;
    margin-top: 15px;
    position: absolute;
    right: 72%;
    top: 36%;
    width: 0;
}

#some-div:hover #some-element {
  display: block;
}

#somed-element {
  border: 1px solid #ccc;
  display: none;
  font-size: 10px;
  margin-top: -48px;
  padding: 5px;
  text-transform: uppercase;
  position: absolute;
  background: white;
}
#somed-element:after {
	 border-color: grey transparent transparent;
    border-style: solid;
    border-width: 9px 8px 0;
    content: "";
    display: block;
    height: 0;
    margin-top: 15px;
    position: absolute;
    right: 57%;
    top: 36%;
    width: 0;
}

#somed-div:hover #somed-element {
  display: block;
}
.helping {
    color: red;
    display: block;
    font-size: 10px;
    position: absolute;
	display: none;
}
</style>


<div class="cell" style="margin-left: 23px; margin-top: -10px;">
    <div class="check">
        <label id="some-div" class="firstoo" for="check-0"><input id="check-0" name="save" type="checkbox" /><span id="checkbox" class="checkbox"></span>₹1999(IBPS PO 2017 Online Coaching Course)<span id="some-element">IBPS PO 2017 Online Coaching Course</span></label>
		<label id="somed-div" class="first1" for="check-1"><input id="check-1" name="save1" type="checkbox" /><span id="checkbox" class="checkbox"></span>₹2499(IBPS PO 2017 Online Coaching Course + 30 Mock Tests)<span id="somed-element">IBPS PO 2017 Online Coaching Course + 30 Mock Tests</span></label>
        <div class="mask"></div>
		<div id="helping" class="helping">Please select any one box</div>
    </div>
</div>

<div style="display: none;" class="pad" id="pad-common"> 
 <div class="elem-wrap"><div id="nameclass" class="elem elem-user invalid mature"> <i class="fa fa-user-o errspan" aria-hidden="true"></i> <div class="help">Please enter your full name</div> <label>Name</label> <input class="input" id="name" name="contact" type="text" value="" required=""> </div></div>


<div class="elem-wrap"><div id="phoneclass" class="elem elem-contact invalid mature"> <i></i> <div class="help">Please enter your valid contact number<br>(10 digit number)</div> <label>Phone</label> <input class="input" id="contact" name="contact" type="text" value="" required="" pattern="^\+?[0-9]{8,15}$" maxlength="10"> </div></div> 

<div class="elem-wrap" id="elem-wrap-email"><div id="emailclass" class="elem elem-email invalid mature"> <i></i> <div class="help">Please enter your valid email. Example:<br> you@example.com</div> <label>Email</label> <input class="input" name="email" type="email" id="email" value="" required="" pattern="^[^@\s]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$"> </div></div>
 
<div class="elem-wrap"><div id="addressclass" class="elem elem-user invalid mature"> <i class="fa fa-map-marker errspan" aria-hidden="true"></i> <div class="help">Please enter your full address,pincode,landmark</div> <label>Address</label> <input class="input" id="useraddress" name="useraddress" type="text" value="" required=""> </div></div>

 

 </div> 
  


 <div> <div class="legend"> <div class="buttons">  <button class="btn" id="btn">Proceed</button> </div></div> <div class="clear"></div> </div> 

 
 
 </div>   <div class="tab-content showable screen" id="form-netbanking">  <div id="netb-banks" class="clear grid count-3">  <div class="netb-bank item radio-item"> <input class="bank-radio" id="bank-radio-SBIN" type="radio" name="bank" value="SBIN"> <label for="bank-radio-SBIN" class="radio-label mfix"> <div class="mchild l-1 item-inner"> <img src="data:image/png;base64,R0lGODlhKAAoAMQQAPD2/EGI2sTa86fI7m2k4l6b3+Lt+dPk9nyt5SR21Hut5cXb9Jm/61CS3f///xVt0f///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAABAALAAAAAAoACgAAAXyICSO5GgMRPCsbEAMRinPslCweL4WAu2PgoZumGv0fiUAgsjMIQBIEUDVrK4C0N8hYe0+EgcfgOvtJrJJarmLlS3XZURJAIcfRcJ6uQHU20U3fmUFEAaCcCeHayiKZSlwCgsLCnBqXgcOmQ4HjUwKmpqUnToLoJkLo6SmDqipOJ+moq4smJqca5ZdDJkMlQRwDZl5jgPAwnAwxg7DXjGBXsHLa4QQdHvHZXfMVdHbTXx90NhddyJvVt1ecmld6VZtMmPo40xnPlvc9ENgSFPf+jng9Tunw92QJ1FIBBliEIeRhDNsFNHHA+KPE4/SuYCRMAQAOw=="> <div>SBI</div> </div> </label> </div>  <div class="netb-bank item radio-item"> <input class="bank-radio" id="bank-radio-HDFC" type="radio" name="bank" value="HDFC"> <label for="bank-radio-HDFC" class="radio-label mfix"> <div class="mchild l-2 item-inner"> <img src="data:image/png;base64,R0lGODlhKAAoAKIAAL/S4+4xN/WDh+/0+PJaXwBMj////+0jKiH5BAAAAAAALAAAAAAoACgAAAOqeLrca9C4SauL0uqtMP+VB46MSJLmCaZqh71wHBGcbNv0du9vrvFAg88S5A1DxduRklTWYIWodBoFwJaTGHVbsPaeLy7Vi8FeoGIpeXbmpdXN27sat827ddl9jSP4/1pzfAYCf39ZaG+DZg2BildgGHuQOjAAl5iZlwOUP3lflZ9soaJCkaKMJaUQqQ+rphuGsn5ls4YBLaoQuSsRvB8sv0y+wp67xUTEIwkAOw=="> <div>HDFC</div> </div> </label> </div>  <div class="netb-bank item radio-item"> <input class="bank-radio" id="bank-radio-ICIC" type="radio" name="bank" value="ICIC"> <label for="bank-radio-ICIC" class="radio-label mfix"> <div class="mchild l-3 item-inner"> <img src="data:image/png;base64,R0lGODlhKAAoAOZGAP/58evKy/ry8vzOk/qpQsRfZMJHLvqvUP7t1uGvsbUxL79SV9iVmPmjNbpFSueAKbU3PctVLfCPKPvCeP7z5PDX2PzIhvSWKNVkLOa8vsltcfu2Xc56frk4L850cNeUl/Xk5f3myd5yKtOHi+uHKfzUoMdOLf3arr5MSf/58r5ALv3gu9+EU9yipLo/PPXe1/rs5eCjlvTYytybl+qxle/FsMRZVvu8a+J5Kuq9sNlrK/7nyeOAN+Wee/3gvNyWifWcNeGopOuONvmdJ////7AqMP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAEYALAAAAAAoACgAAAf/gEaCg4SFhoICCR4oRY1FLh45h5OUgwEejpmZNi+VnoIBBZqjjhAVn5MwmJkQDAJEAgujKACohTUumgsVRL1EGaQztoIAPQqaECC+vcCjDsMALKQJy70cpEWnnwg8pBDVRCDYRUHbQsejBdWx4x+eCEDoowvLILLtlQANBuNFDAEBGEDoV8TdJAAHMBBcmMngoQkS+hVoESCDBoYxJpUYwo+UgwDVLhKUcYhCgwfYRryqxoCggVqGNnB0BhIckWv9WBw6MQSlpgIrwQkg2MGCIX1DTGjiYNNXAoIiEBgaMOSCJmpNe4nE1oHA0QZDRGQakbXX0H4PThjaOCRCpgAC+xg4KEKvWot+JhrAJERgyJAO/XgtE8X1wgBDCPwOIVjTbD8SXg1Z8EuCYLWn2EQMWXGob0/Ly7ZqwjBkQ0nFPrGpWzZwVIQhDSgcCqE44jimvgKQer15ElXF8kZh7dVSkw6/Eyj99qsUmzJfhBspwOH3QKXlnz1Wy6SCRPW9h7DPHEXWVwXppP0SAB9esd8LKkZlWKY7ggTFBKR6Yuv+gltHDlRDw32KHcDeJIm5VxsGBhjwQzXYbXAgJZ4p6B4F1figmFHDGMGThYrdYNMEE4TQ4SAHgOjXDlmdOAgFFbpnQVMuFgKATO4dkAI4NU4SwgQHEDDAjsv0OEggADs="> <div>ICICI</div> </div> </label> </div>  <div class="netb-bank item radio-item"> <input class="bank-radio" id="bank-radio-UTIB" type="radio" name="bank" value="UTIB"> <label for="bank-radio-UTIB" class="radio-label mfix"> <div class="mchild l-2 item-inner"> <img src="data:image/png;base64,R0lGODlhKAAoAMQQAOvJ1vry9bM1Z7hDcfXk68JehtaTrvDX4eGuwsdrkNKGpMx5mr1Qe+a8zNuhuK4oXf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAABAALAAAAAAoACgAAAXdICSOZGmeaKqubIsGgSunyjLf5PE8B44Xu4Jv1tjtEMNWYGB8DGJJlaG5M0RTBAF1R7ieEttdwlsChI0A8ohx3g3UEEfb2PMGtPMxWTHnknV9VmRAcwJQVwh9D0h2THNvZFN9aV4EikJkYH1dXmZ9CmqObQJ4bZArknMOqW0OK3d9kKJnhioLipRFnymeeSSEc3UmwG2cIpZ9mCWJgSZ8fYwjsI+H0qVnTySsZ9HLioIQyHPKJ2yFnMRnwie9bWO6czYrt5OzYbUrWX0MAP3+//3WqTgAsCAlOAivhAAAOw=="> <div>Axis</div> </div> </label> </div>  <div class="netb-bank item radio-item"> <input class="bank-radio" id="bank-radio-KKBK" type="radio" name="bank" value="KKBK"> <label for="bank-radio-KKBK" class="radio-label mfix"> <div class="mchild l-3 item-inner"> <img src="data:image/png;base64,R0lGODlhKAAoANUtAL/N3O/z9s/a5d/m7kBqlyBRhTBdjjsxYFB2oI+owoCcup+0y3cqTK/B1HCPsVB2n2CDqPvGyB41avRxdkovW+4qMmgsUfBHTf7x8fm4u4tviw82b+idpNy8xf3j5PNjaI2Mp7dqfPaOkntjg5QnQsEhM4hFYks9ad4eKRBEfe0cJP///wA4dP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAC0ALAAAAAAoACgAAAb/wJZwSCwaj8ikcslsFgOAqDTgdA4SiBRry92mEIlB9bggdM9oFmExFgIK6fi5AHAGEPKuZCNHUJUCBnksEhYlKgd5BgJJAlp5FiqSiIMpjEaOgywMk5SVl0MBgmgFcFyck4maBn9CDmcEDSuzKwtwqJIHKQoDtAMKj1wOQwBnELTIKwq4KhoBybMDo1x1LXhcBNDIHJMT2rQBplsILQNnvd8rEZIX6bTFXVddD8lQyOsVGO60ZlwJ/VsWRIMQrAAEAOsiaGvg4EGCZysadCEQjEWvTGlMiIAWqIulFQE8npklDs0IjhW9EACYZoW5OCkg+kqpiYtLOQCgTat55tlOui4Ck72CqUBByYqyBByVlSwDCJoBZwVLwdLBrAALHjiUSctDBZBG5wmINjGBR67fMFxQgWxAlGRm/b3komDfig+SOuwrKYYli7HpJkw6AVibgi7kWsDjkiIntAAhOukqjGzBmWothnaBwHSFAGDMVPGi1cDvsFA/44SuyaoIxjyrPx15rVqybCQd5XBCQYLCoEVL7sg54FuTHydveJLCXKWMcjVs2hC5kgUmGDHSk0CREqVV9u/gwy8JAgA7"> <div>Kotak</div> </div> </label> </div>  <div class="netb-bank item radio-item"> <input class="bank-radio" id="bank-radio-YESB" type="radio" name="bank" value="YESB"> <label for="bank-radio-YESB" class="radio-label mfix"> <div class="mchild l-4 item-inner"> <img src="data:image/png;base64,R0lGODlhKAAoANUxAMg0KRBcmfTW1NNcVNdqY8tBOOmtqfvx8c9PRjBypyBnoPjk4sJ9gKGTpL9EP8ptajxvn9WVlFl3nuGSjfDJxrSruY16j2yQtK5la6qCj8dfXFyFrdp4cbCdq2mCpZSWq52FlixkmaZ1gHiNrL5wcqu7zrWAh3ybu1VqkXR/npGIncNRTc56eEB9rb/T5MQmGwBRkv///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAADEALAAAAAAoACgAAAb/wJhwSCwaj0bDAslsNgUTp3QaOyAO1CySYNB6iQbEdywAUMZeKwHt5byWR5d8Tq/b74YX6y6H+f+AgYKCKAAAEIOJioswIQ4vIoySkgEYLwUJk5qJFi8vFpuhgBIALysKoqIJjy8pqaGVng8Br5sgngAStZoepS8Mu5MJA54FiMGLAQyeLxnIjA3MCKjPiRe+LyrVicPMGrTbgcrMLyPhgtHMJODnftfMABvtfy0E5CbzfgER5AUt+TAqkHvRAeCJAuQGUGtXb+CHfPsGztrVoqLFiwLJAShxsaPHj0UOEBhAEpunKGyOlBlYDEtKlSY9dXmJZCWzATSfYDuTk8nKBzU9n7zpGQQAOw=="> <div>Yes</div> </div> </label> </div>  </div> <div class="elem-wrap pad"><div id="nb-elem" class="elem select invalid"> <i class="select-arrow"></i> <div class="help">Please select a bank</div> <select id="bank-select" name="bank" required="" class="input" pattern="[\w]+"> <option selected="selected" value="">Select a different Bank</option>  <option value="ALLA">Allahabad Bank</option>  <option value="ANDB">Andhra Bank</option>  <option value="UTIB">Axis Bank</option>  <option value="BBKM">Bank of Bahrein and Kuwait</option>  <option value="BARB_C">Bank of Baroda - Corporate Banking</option>  <option value="BARB_R">Bank of Baroda - Retail Banking</option>  <option value="BKID">Bank of India</option>  <option value="MAHB">Bank of Maharashtra</option>  <option value="CNRB">Canara Bank</option>  <option value="CSBK">Catholic Syrian Bank</option>  <option value="CBIN">Central Bank of India</option>  <option value="CIUB">City Union Bank Ltd</option>  <option value="CORP">Corporation Bank</option>  <option value="DCBL">DCB Bank Ltd</option>  <option value="BKDN">Dena Bank</option>  <option value="DEUT">Deutsche Bank</option>  <option value="DBSS">Development Bank of Singapore DBS</option>  <option value="DLXB">Dhanlaxmi Bank Ltd</option>  <option value="FDRL">Federal Bank Ltd</option>  <option value="HDFC">HDFC Bank Ltd</option>  <option value="ICIC">ICICI Bank Ltd</option>  <option value="IBKL">IDBI Ltd</option>  <option value="IDFB">IDFC Bank Ltd</option>  <option value="IDIB">Indian Bank</option>  <option value="IOBA">Indian Overseas Bank</option>  <option value="INDB">Indusind Bank Ltd</option>  <option value="JAKA">Jammu and Kashmir Bank</option>  <option value="JSBP">Janata Sahakari Bank Ltd (Pune)</option>  <option value="KARB">Karnataka Bank Ltd</option>  <option value="KVBL">Karur Vysya Bank</option>  <option value="KKBK">Kotak Mahindra Bank</option>  <option value="LAVB_C">Lakshmi Vilas Bank - Corporate Banking</option>  <option value="LAVB_R">Lakshmi Vilas Bank - Retail Banking</option>  <option value="NKGS">NKGSB Cooperative Bank Ltd</option>  <option value="ORBC">Oriental Bank of Commerce</option>  <option value="PUNB_C">Punjab National Bank - Corporate Banking</option>  <option value="PUNB_R">Punjab National Bank - Retail Banking</option>  <option value="PMCB">Punjab and Maharashtra Cooperative Bank Ltd</option>  <option value="PSIB">Punjab and Sind Bank</option>  <option value="RATN">RBL Bank Limited</option>  <option value="SRCB">Saraswat Cooperative Bank Ltd</option>  <option value="SIBL">South Indian Bank</option>  <option value="SCBL">Standard Chartered Bank</option>  <option value="SBBJ">State Bank of Bikaner and Jaipur</option>  <option value="SBHY">State Bank of Hyderabad</option>  <option value="SBIN">State Bank of India</option>  <option value="SBMY">State Bank of Mysore</option>  <option value="STBP">State Bank of Patiala</option>  <option value="SBTR">State Bank of Travancore</option>  <option value="SYNB">Syndicate Bank</option>  <option value="TMBL">Tamilnadu Mercantile Bank</option>  <option value="COSB">The Cosmos Cooperative Bank Ltd</option>  <option value="SVCB">The Shamrao Vithal Cooperative Bank Ltd</option>  <option value="TNSC">The Tamilnadu State Apex Cooperative Bank</option>  <option value="UCBA">UCO Bank</option>  <option value="UBIN">Union Bank of India</option>  <option value="UTBI">United Bank of India</option>  <option value="VIJB">Vijaya Bank</option>  <option value="YESB">Yes Bank Ltd</option>  </select> </div></div> </div>   <div class="tab-content showable screen" id="form-wallet">   <div id="wallets" class="grid count-6">  <div class="wallet item radio-item"> <input type="radio" name="wallet" value="freecharge" id="wallet-radio-freecharge"> <label for="wallet-radio-freecharge" class="radio-label mfix"> <img class="wallet-button colored mchild item-inner l-1" style="height:18px" src="./freecharge.png">  </label> </div>  <div class="wallet item radio-item"> <input type="radio" name="wallet" value="airtelmoney" id="wallet-radio-airtelmoney"> <label for="wallet-radio-airtelmoney" class="radio-label mfix"> <img class="wallet-button colored mchild item-inner l-2" style="height:32px" src="./airtelmoney.png">  </label> </div>  <div class="wallet item radio-item"> <input type="radio" name="wallet" value="olamoney" id="wallet-radio-olamoney"> <label for="wallet-radio-olamoney" class="radio-label mfix"> <img class="wallet-button colored mchild item-inner l-3" style="height:22px" src="./olamoney.png">  </label> </div>  <div class="wallet item radio-item"> <input type="radio" name="wallet" value="payumoney" id="wallet-radio-payumoney"> <label for="wallet-radio-payumoney" class="radio-label mfix"> <img class="wallet-button colored mchild item-inner l-2" style="height:18px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAI0AAAAgCAMAAAAYAgunAAAAMFBMVEXT46mRuSr7/PeGsxakxk/I3JXz9+fr8ti30nTj7sqyzmqcwD+sy17d6b2+1oL///+7L4YrAAAAEHRSTlP///////////////////8A4CNdGQAAA+xJREFUeNrNV4tuIyEMNAbMw0D+/29vbEi2Fylt79RInSgrwMaeHWykpdv/gXMY5fbT+F82smL6PWyYtM42C/8KNkDTCH1+C5v5W9iwwdiMn2fDhm9QuIYyMxGt3rP8LBuW1or9yqeMuMBN9lBKTgG62I6fBZWujjTyZw3SBlyyO3BOqY/wlg7vMQYHXna+9ssRSC5OGVFXTm9hE6Jmw4L4/bU462LTjM16F5t+CqNHbSwFEGEs4GHw0ZM2oa6kXY7VN1wDB5/ZY+phr4iwupH54yLY1DOhEGZbfaAqcmMmPLal5Mx/s4lBFxU386xjjDVZch+jnk3csi0/nBqMsJLstHPdfTlj68m/8gc2DWxIQ0oaopL0MMo21KjyxCaGvGNIDdEQ1ogOJRgka9wYlotzONPeMPM9AX/NImon4mGR9YlNI5pz0kBR5BDOe2ocH7Vpnvf0l9VdXVWNUF81Wav5ahh72V6pJRh9GhY7N105d/hO7jGQhyJw/cAmgw0zu/oYTo10J51vL7RhhCQRbLC8IhN56SZIUZuIEPJDnIwkhWF1rmWY9MxlBUSBbcnpE7IqFkOhD13SNM6SYpVDeprvxebSRpDdF7FGNs/gaVqk5mRXgCPXGPbUG6XpCTQVGYxAMRsiNFe6A8NlBOM2J1YDSQ3J3VZUeaUN2KgPKmK5wIhyg0Kn5vzNuTtlAKEmm0I0gawgUhDBSl1AxKgdBF2F0VMJADPaJ4cECM23F3XzTTbhsKmHTdCEn0awuRdOwcTrzbWpawoShaB3NlOR8pTND2sTNdgvaBZzybBSRJpTN/uiYtRVna3Z+RHLgGmXzWGjnnDqxabc2fR/0kYzZTIUturpgo0W4OopwPIXT2L9BG6W3svG/IAOqtQxtM55rU17NIRVsXD9WxuNQ3hj50qNecDnmc1poxYCMWyWM8V+jgcweX3Qy2s2cMZToLU1/PSeurSBnqYsrCJWvlztIBoU4ovNvQOpiLRqnWjbOk+c57nmLsCNX7PBc99+y28/D1se2tgtAOtaq6Yxd+SUu1cnhv1iY7dVGkNBUZx1GHruCiF9JgOIHjYDItzZ4D323Y9HmmxsQrm04dJNZWCfd0mYRa9OSsbpojNcAmv2x/Eob9us6sag1n4bslJ1M+kQdxr+viUPS5ZqYzO60x6UyxrSKr4nYbarsyHyBS6TcqYmvGe0Lu1YmhtncetZK7JplXK2+MK+Re+e7nQGvHch1MMMXxztwJiYn78GBP/HjGKkZyN//7viU+uVxnvv6y+Yoqbgu+H1Kl+wYVoJ0vCbuRTqGtHZX7CRgVLLb5eGUvSL4EttKri8HS3pmOzDP+UnwTXbEK2hAAAAAElFTkSuQmCC">  </label> </div>  <div class="wallet item radio-item"> <input type="radio" name="wallet" value="payzapp" id="wallet-radio-payzapp"> <label for="wallet-radio-payzapp" class="radio-label mfix"> <img class="wallet-button colored mchild item-inner l-3" style="height:24px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHAAAAAlCAMAAACtfZ09AAAAY1BMVEXuQEGBmb/+7+9BZZ/AzN/839/2n6DrICLpEBLxYGH7z9DsMDHvUFH4r7Dv8vf1j5Df5e/ycHHQ2edhf68iTI+gss8SP4dxjLcxWZewv9eQpcdRcqf5v8DzgIEDM3/oAQP///+4CVglAAAAIXRSTlP//////////////////////////////////////////wCfwdAhAAADRUlEQVR4Ab2Ue3PiOBDEZflh/DAG8whhpXV//095jKYlqyp1x20C239ESE755+6ZkcELZacaz/QyYN907Trg7wCdN7tV5N4PrJvjsEYZvBfo5rFdc9XvA9rJmzWJ6vAeYD93ubGknX0LsJ49RaUSelDv7VK7I6+1/x8YP3JGTKcHDoXqfoDoIr8vqGQBsJd1AeBXqgEmcdxwUlSNBVBzM9cKtCvVu5WyQPE7SgCH8KvU0wNweiznPVBHgwPNcjbGVNkGaNaoYwAmTPrcFsCv30kL8EFgJUul/E8A3Uo5miWwzXvpuCY5w1Q0jEYWNvh5AxbYXwncK/AUNkCdZp4GCbRrxkglE448NtsdwXfM4JuXjwCUJK+3wBDyfWGwm8Fag2v5qhAaplGB8nfqjwm4k2yTJikm8CnvBBCAYvBUBmAp+/AnL0anKY5GOAxt4HPn2BUR2AsfKEUXSOA7aM/cwJrdpZAC1POSHQOT6qQGpwiUtWO32FmsM/7G6GnNNrwwYHXyger2WK44C1xO6Jwdkwx6NdgiAqWcDZwsJnTsiHoIdAPUzjngEvvxsauhtaIKeXYhcNGzMp/f1ircE6hmKJc6Vv8DlPY9opaNdxKD1z2B0MMDsvFqGGJNIJ/wWdaxI2BgtStLfrcEDjFMnS/4DNQILIPpfNYGpjsiAtPgDS4LvvUQ4KRTy4GTwAcaLquqWog4FcWZwNgxyYajwdH7VsrEnmFttGMfmx4iE/bY1GqPx8YHG5XihXDKb23zpWjgIlL6EWn3Zey1JLERyY7a64Vwz29tsdHlQLh4jNSxGZDunbXy1+vYV/p28Nq+FoVGWnEwM4NdNOgfagOQgyfis34D9rLnfKp2AO5SKASdGCHKQLoz2WOaeRocY3xu2yKWGkkmYoYUy0jKLxrU8YxAXtupaB50O23AgecAv8xkwIjpUpd7dkaRDN6wAW/hBkKXzTw8IyTQfukZnwF7p6rhKAugekhLuDx+HdKvPaqw7/OZR5+avk/NgCh9eZLBt2RSon+i6dtAt/6ZBuN9GvwfGXwmM/omBfp94PQUtDOdn5wF9VNg+1/hHRke9Qpg8y/hzSm81wJt+zy8lwL98/BeCxwZ3vf0D5XUzxaJRoO1AAAAAElFTkSuQmCC">  </label> </div>  <div class="wallet item radio-item"> <input type="radio" name="wallet" value="mobikwik" id="wallet-radio-mobikwik"> <label for="wallet-radio-mobikwik" class="radio-label mfix"> <img class="wallet-button colored mchild item-inner l-4" style="height:19px" src="data:image/gif;base64,R0lGODlhbAAfAKIHAJvl5ODt7UPS0L/w73/h4P///wDDwf///yH5BAEAAAcALAAAAABsAB8AAAP/eBfczgPIR4O6OOvNu/9gqBBFaWnDQAiCMYhwLM/cUJpHurZG77u0oHCYAdwKgJ9y2TsRn9CMjnUsEJjMQI8Q7QanPB/peFWulocW18sWlbFV609wC/cO27bek8QajFVvLjcDc3gGa3uKGIJLcXI9dISGPQCLlyN+gIE+NpM+AoWDKkaYbY0/j5CSn1uikXmmXqiVR5tlnq2IfQahSQKys0ysVmNyxCWvLm8ABIXAwVG0uQWIN1cBccoqPwAtlhm4HGVczQROB8XOMOSi0OFLxFfGK4/KAXaRG+L7eTwvF8IUYOdKnwZUubRYK3HO3o80cwAe7CGxCAtL/y68qQjC/5sAAO76zTnCwxg1kw8jVcwGDwiIjAd4cYwRcuKPbCbE2GP1ClgsfD9IZFr2A+CAixCBvLK0Q2KLdwo/skhhMKkAQcTCGDvSq5VPpcMGlsn3J4c/igp7KegDrRrFtVtw1XwTQBDOAsq2lvjlVZQNUM1AHRAkIZUoLv94vHNrAG6sf3L1yRwMimTQOJFaOWsy9sIrbm/T+QB5Vgk4BTwshIHmg7ILd0uHGjiibOENtpr7JK1IrvMFtoeTKnFSxtLwkJF7jda4xfJlrpmTdSpzqDEGd/wUwC6t5N12RJWKu6aqRGIZ2ku28uI5XW1rDGyzm+0VPAz5sgrE9HDLYv/42rL+UbYVEwNWtlcnT+2GQUniMUdfaeBshJohdkCTnHKxXGELHAx1F8FDari2WHv7lVAdaYgoOKFa81XSYor/+YCXDxYQUOAw3vgxRx5phXJUa2/4GEYA9YXWIheMGWBBkgAlB41igxnDi45UFuXYEi/Q4mKRLsn2QhgBvRcji2kFFgFZVer4zou9nIDLlOBwyRGUfSRSp4PkvfOGlmlisWYGRA6ADqApRANCAWj2mYWhmCQAADs=">  </label> </div>   <div class="clear"></div> <span class="help">Please select one of the wallets</span> </div>     </div>    <div id="form-otp" class="tab-content showable screen"> <div id="otp-prompt"></div> <div id="add-funds" class="add-funds"> <div id="add-funds-action" class="btn">Add Funds</div> <div class="text-center" style="margin-top: 20px;"> <a id="choose-payment-method" class="link">Try different payment method</a> </div> </div> <div id="otp-section"> <div id="otp-action" class="btn">Retry</div> <div id="otp-elem" class="invalid"> <div class="help">Please enter the OTP</div> <input type="tel" class="input" name="otp" id="otp" maxlength="6" autocomplete="off" required=""> </div> </div> <div class="spin"><div></div></div> <div class="spin spin2"><div></div></div> <div id="otp-sec-outer"> <a id="otp-resend" class="link">Resend OTP</a> <a id="otp-sec" class="link">Skip Saved Cards</a> </div> </div> </div> <button id="footer" type="submit" class="button"> <span class="pay-btn">PAY &nbsp;₹20</span> <span class="otp-btn">Verify</span> </button> 
<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
						
							<input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
 </form> </div> </div> </div> </div><style type="text/css">.button, .btn, .offer{ background: #d01c68;}.offer{ border-left: 1px solid #d01c68;}.offer:before { border-bottom-color: #d01c68; border-right: 8px solid #d01c68;}.spin div, .link{ border-color: #d01c68!important;}#payment-options i,.text-btn,#cancel_upi .back-btn,.offer-info li:first-child,.ecod .item i{ color: #d01c68;}#header{ background: #d01c68;}.option.active,.checked .checkbox,input[type=checkbox]:checked + .checkbox{ color: #fff; background: #d01c68; border-color: #d01c68;}.theme { color: #d01c68;}.grid :checked+label { border-bottom: 2px solid #d01c68;}</style></div></div></body></html>