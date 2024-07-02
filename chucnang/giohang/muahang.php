<?php
if (isset($_SESSION['giohang'])) {
    $arrid = array();
    foreach ($_SESSION['giohang'] as $id_sp => $sl) {
        $arrid[] = $id_sp;
    }
    $strId = implode(',', $arrid);
    $sql = "SELECT * FROM sanpham WHERE id_sp IN($strId) ORDER BY id_sp DESC";
    $query = mysqli_query($conn, $sql);
}
?>
<div id="checkout">
    <h2 class="h2-bar">xác nhận hóa đơn thanh toán</h2>
    <table class="table table-bordered">
        <tr>
            <thead>
                <th>tên sản phẩm</th>
                <th>giá</th>
                <th>số lượng</th>
                <th>thành tiền</th>
            </thead>
        </tr>

        <?php
        $totalPriceAll = 0;
        while ($row = mysqli_fetch_array($query)) {
            $totalPrice = $row['gia_sp'] * $_SESSION['giohang'][$row['id_sp']];
        ?>
            <tr>
                <td><?php echo $row['ten_sp']; ?></td>
                <td><span><?php echo number_format($row['gia_sp']); ?> đ</span></td>
                <td><?php echo $_SESSION['giohang'][$row['id_sp']]; ?></td>
                <td><span><?php echo number_format($totalPrice); ?> đ</span></td>
            </tr>
        <?php 
             $totalPriceAll += $totalPrice;         
        }
        ?>
        <tr>
            <td>Tổng giá trị hóa đơn:</td>
            <td colspan="2"></td>
            <td><b><span><?php echo number_format($totalPriceAll); ?> đ</span></b></td>
        </tr>
    </table>
</div>
<?php
 if (isset($_POST['submit'])) {
    $ten = $_POST['name'];
    $email1 = $_POST['mail'];
    $sdt = $_POST['phone'];
    $diachi = $_POST['address'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['pass'];
    if (isset($ten) && isset($email) && isset($sdt) && isset($diachi)) {
        if (isset($_SESSION['giohang'])) {
            $arrid = array();
            foreach ($_SESSION['giohang'] as $id_sp => $sl) {
                $arrid[] = $id_sp;               
            $strId = implode(',', $arrid);
            $sql = " SELECT * FROM sanpham  WHERE id_sp IN($strId)   ORDER BY id_sp DESC  ";                
            $query = mysqli_query($conn, $sql); 
            $sql  =   "SELECT * from thanhvien WHERE email='$email' AND mat_khau='$pass'";
            $result2 = $conn->query($sql);
                    while ($row2 = mysqli_fetch_array($result2)) {
                        $id_thanhvien = $row2['id_thanhvien']     ; }        
            while ($row = mysqli_fetch_array($query)) {
                $gia_sp = $row['gia_sp'] * $_SESSION['giohang'][$row['id_sp']];     }                      
                 $sql = "INSERT INTO donhang (id_sp, ten, email, sdt, diachi,ngaydat,soluong,tongcong,id_thanhvien)  VALUES ('$id_sp','$ten', '$email1', '$sdt','$diachi', Now(), '$sl', '$gia_sp','$id_thanhvien')";
                $result = mysqli_query($conn, $sql);  
            }

      } 
      $strBody = "";
      // Thông tin Khách hàng
      $strBody = '<p>
          <b>Khách hàng:</b> ' . $ten . '<br />
          <b>Email:</b> ' . $email . '<br />
          <b>Điện thoại:</b> ' . $sdt . '<br />
          <b>Địa chỉ:</b> ' . $diachi . '
      </p>';
      // Danh sách Sản phẩm đã mua
      $strBody .= '<table border="1px" cellpadding="10px" cellspacing="1px" width="100%">
          <tr>
              <td align="center" bgcolor="#3F3F3F" colspan="4"><font color="white"><b>XÁC NHẬN HÓA ĐƠN THANH TOÁN</b></font></td>
          </tr>
          <tr id="invoice-bar">
              <td width="45%"><b>Tên Sản phẩm</b></td>
              <td width="20%"><b>Giá</b></td>
              <td width="15%"><b>Số lượng</b></td>
              <td width="20%"><b>Thành tiền</b></td>
          </tr>';

      $totalPriceAll = 0;
      while ($row = mysqli_fetch_array($query)) {
          $totalPrice = $row['gia_sp'] * $_SESSION['giohang'][$row['id_sp']];

          $strBody .= '<tr>
              <td class="prd-name">' . $row['ten_sp'] . '</td>
              <td class="prd-price"><font color="#C40000">' . number_format($row['gia_sp']) . ' VNĐ</font></td>
              <td class="prd-number">' . $_SESSION['giohang'][$row['id_sp']] . '</td>
              <td class="prd-total"><font color="#C40000">' . number_format($totalPrice) . ' VNĐ</font></td>
          </tr>';

          $totalPriceAll += $totalPrice;
      }

      $strBody .= '<tr>
              <td class="prd-name">Tổng giá trị hóa đơn là:</td>
              <td colspan="2"></td>
              <td class="prd-total"><b><font color="#C40000">' . number_format($totalPriceAll) . ' VNĐ</font></b></td>
          </tr>
      </table>';

      $strBody .= '<p align="justify">
          <b>Quý khách đã đặt hàng thành công!</b><br />
          • Sản phẩm của quý khách sẽ được chuyển đến địa chỉ có trong phần thông tin Khách hàng của chúng tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br />
          • Nhân viên giao hàng sẽ liên hệ với quý khách qua SĐT trước khi giao hàng 24 tiếng.<br />
          <b><br />Cám ơn quý khách đã mua hàng!</b>
      </p>';
         {          
            /* echo $strBody; */
            header('location: index.php?page_layout=hoanthanh');     
        } 
        unset($_SESSION['giohang']);
   }
} 
?>
<div id="custom-form" class="col-md-6 col-sm-8 col-xs-12">
    <form method="post">
        <div class="form-group">
            <label>Tên khách hàng</label> <span style="color: red;">*</span>
            <input required type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Địa chỉ Email</label> <span style="color: red;">*</span>
            <input required type="text" class="form-control" name="mail">
        </div>
        <div class="form-group">
            <label>Số Điện thoại</label> <span style="color: red;">*</span>
            <input required type="text" class="form-control" name="phone">
        </div>
        <div class="form-group">
            <label>Địa chỉ nhận hàng</label> <span style="color: red;">*</span>
            <input required type="text" class="form-control" name="address">
        </div>
        <button class="btn btn-info" name="submit">Mua hàng</button>
    </form>
</div>