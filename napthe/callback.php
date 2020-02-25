<?php
	require_once('./api/config.php'); //gọi đến file config.php để chèn vào code.
	$validate = $_POST;
	
	if(isset($_POST)) { //Nếu xác thực callback đúng thì chạy vào đây.
		$status = $validate['status']; //Trạng thái thẻ nạp, thẻ thành công = thanhcong , Thẻ sai, thẻ sai mệnh giá = thatbai
		$serial = $validate['serial']; //Số serial của thẻ.
		$pin = $validate['pin']; //Mã pin của thẻ.
		$card_type = $validate['card_type']; //Loại thẻ. vd: Viettel, Mobifone, Vinaphone.
		$amount = $validate['amount']; //Mệnh giá của thẻ. nếu bạn sài thêm hàm sai mệnh giá vui lòng sử dụng thêm hàm này tự cập nhật mệnh giá thật kèm theo desc là mệnh giá củ
		$real_amount = $validate['real_amount']; // thực nhận đã trừ chiết khấu
		$content = $validate['content']; // id transaction 
		$desc = $validate['noidung']; // Ghi Chú thẻ lổi hoặc sai mệnh giá.
		
		if($status == 'thanhcong') {
			//Xử lý nạp thẻ thành công tại đây.
          mysqli_query($conn, "UPDATE trans_log SET status = 1 WHERE status = 0 AND trans_id = '".$content."'"); // chuyển cho kết quả thành công      
		} else {
			//Xử lý nạp thẻ thất bại tại đây.
           mysqli_query($conn, "UPDATE trans_log SET status = 2 WHERE status = 0 AND trans_id = '".$content."'"); // thất bại   
		}
	}