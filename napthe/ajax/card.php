<?php
session_start();
include("../api/config.php");
$content = md5(time() . rand(0, 999999));
$seri = $_POST['serial']; // string
$pin = $_POST['pin']; // string
$loaithe = $_POST['card_type']; // string
$menhgia = $_POST['card_amount']; // string
$username = $_POST['username']; // string
if($_POST["captcha"]==$_SESSION["captcha_code"]){
	echo '<script type="text/javascript">swal("Thất Bại", "Xác nhận captcha không đúng !", "error");</script>';
	exit();
}
       $data = "https://thesieutoc.net/chargingws/v2?APIkey=".$apikey."&mathe=".$pin."&seri=".$seri."&type=".$loaithe."&menhgia=".$menhgia."&content=".$content;
	    $curl = curl_init($data); 
	    curl_setopt($curl, CURLOPT_FAILONERROR, true); 
  	    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
  	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	     $result = curl_exec($curl); 
         $obj = json_decode($result);
	    if (isset($obj->status)){                          
			if ($obj->status == '00' || $obj->status == 'thanhcong'){
				//Gửi thẻ thành công, đợi duyệt.
				$conn->query("Insert into trans_log (name,trans_id,amount,pin,seri,type) values ('".$username."','".$content."',".$menhgia.",'".$pin."','".$seri."','".$loaithe."')");
				echo '<script type="text/javascript">swal("Thành Công", "'.$obj->msg.'", "success");</script>';							
            } else if ($obj->status != '00' && $obj->status != 'thanhcong'){
				// thất bại ở đây
		       echo '<script type="text/javascript">swal("Thất Bại", "'.$obj->msg.'", "error");</script>';
		    }
		}


?>