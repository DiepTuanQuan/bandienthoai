
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">THÔNG TIN ĐƠN HÀNG ĐÃ MUA</h1>
    </div>
</div>

<?php echo "Chào bạn " . $_SESSION['email']; 


/* print_r( "Chào bạn " .$row3) ; */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" style="position: relative;">
                <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-sort-name="name" data-sort-order="desc">
                    <thead>
                        <tr>
                            <th data-sortable="true">ID thành viên</th>
                            <th data-sortable="true">Email người nhận</th>
                            <th>ID Đơn hàng</th>    
                            <th>Tên sản phẩm</th>   
                            <th>Ảnh sản phẩm</th>   
                            <th>Số lượng</th>
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Nơi giao</th>
                            <th>Tổng cộng</th>
                            <th>Theo dõi đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 300px;">
                        
                        <?php
include '/xampp/htdocs/181A010180_DiepTuanQuan_TTTN/cauhinh/ketnoi.php';
$email = $_SESSION['email'];
/* $pass = $_GET['pass']; */
$sql3 = "SELECT id_thanhvien FROM thanhvien WHERE email='$email' ";
$query3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($query3);
 $strId = implode(',',$row3); 
/* print_r( $strId); */

       $sql  =   "SELECT * from donhang,sanpham where id_thanhvien='$strId'   AND donhang.id_sp=sanpham.id_sp ";
    /* $sql  =   "SELECT * from donhang where id_thanhvien='45'"; */
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

   
    foreach ($query as $row) :
        
?>
<style>td {text-align: center;}

</style>
                            <td data-checkbox="true"><?php echo $row['id_thanhvien']; ?></td>
                            <td data-checkbox="true"><a href="quantri.php?page_layout=suatv&id_thanhvien=<?php echo $row['id_thanhvien']; ?>"><?php echo $row['email']; ?></a></td>
                            <td><?= $row['id_dh'] ?></td>
                            <td><?= $row['ten_sp'] ?></td>
                            <td><img width="80px" height="80px" src="/181A010180_DiepTuanQuan_TTTN/chucnang/anh/<?php echo $row['anh_sp'] ?>" /></td>
                               <td><?= $row['soluong'] ?></td>
                               <td><b><?= $row['ten'] ?></b><br />(<?= $row['sdt'] ?>) <br>[<?= $row['email'] ?>]  </td>
                               <td><?= $row['ngaydat'] ?></td>
                               <td><?= $row['diachi'] ?></td>
                               <td> <?php echo number_format($row['tongcong']);  ?> VNĐ</td>
                               <td>
                                   <?php if ($row['dh_trangthaithanhtoan'] == 0) : ?>
                                       <span class="badge badge-danger">Chưa xử lý</span>
                                   <?php else : ?>
                                       <span class="badge badge-success">Đã giao hàng</span>
                                   <?php endif; ?>
                               </td>
                            
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--/.row-->