<?php include_once './ketnoi.php';
                    $sql  =   "select * from donhang, sanpham WHERE donhang.id_sp=sanpham.id_sp";
                    $result = $conn->query($sql);
                   
?>
<table id="tblDanhSach" class="table table-bordered table-hover table-sm table-responsive xl-2">
        <div class="row">
    <ol class="breadcrumb">
        <li><a href="quantri.php"><svg class="glyph stroked home">
                    <use xlink:href="#stroked-home"></use>
                </svg></a></li>
        <li class="active"></li>
    </ol>
        </div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý đơn hàng</h1>
    </div>
</div>
                    <thead class="thead-dark">
                        <tr >
                            <th>ID Đơn hàng</th>
                            <th>ID Sản Phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình Sản Phẩm</th>
                            <th>Số lượng</th>
                            <th>Khách hàng</th>
                            <th>Ngày lập</th>
                            <th>Nơi giao</th>
                            <th>Tổng cộng</th>
                            <th>Theo dõi đơn hàng</th>
                            <th>ID người mua</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                       <?PHP
                       foreach ($result as $dondathang) : ?>           
                           <tr>
                               <td><?= $dondathang['id_dh'] ?></td>
                               <td><?= $dondathang['id_sp'] ?></td>
                               <td><?= $dondathang['ten_sp'] ?></td>
                               <td><img width="80px" height="80px" src="anh/<?php echo $dondathang['anh_sp'] ?>" /></td>
                               <td><?= $dondathang['soluong'] ?></td>
                               <td><b><?= $dondathang['ten'] ?></b><br />(<?= $dondathang['sdt'] ?>) <br>[<?= $dondathang['email'] ?>]  </td>
                               <td><?= $dondathang['ngaydat'] ?></td>
                               <td><?= $dondathang['diachi'] ?></td>
                               <td>  <?php 
                                if ($dondathang['tongcong'] ) : ?>
                                <?php echo number_format($dondathang['tongcong']);  ?> VNĐ</td>
                                <?php endif; ?>
                               <td>
                                   <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                       <span class="badge badge-danger">Chưa xử lý</span>
                                   <?php else : ?>
                                       <span class="badge badge-success">Đã giao hàng</span>
                                   <?php endif; ?>
                               </td>
                               <td><?= $dondathang['id_thanhvien'] ?></td>
                               <td>
                                   <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                   <?php if ($dondathang['dh_trangthaithanhtoan'] ==0) : ?>
                                       <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                                       <a href="quantri.php?page_layout=suadh&id_dh=<?php echo $dondathang['id_dh']; ?>">
                                       <button   type="button" class="btn btn-warning"  > Sửa 
                                       </button> 
                                       </a>
                                       <a onclick="return confirm('BẠN CÓ CHẮC CHẮN MUỐN XÓA ĐƠN HÀNG NÀY?');" href="./chucnang/donhang/xoadh.php?id_dh=<?= $dondathang['id_dh'] ?>">
                                       <button  type="button" class="btn btn-danger btnDelete"  > Xóa
                                       </button> 
                                       
                                       <!-- <span><svg class="glyph stroked cancel" style="width: 20px;height: 20px;">
                                                <use xlink:href="#stroked-cancel" />
                                            </svg></span> -->
                                        </a>  
                                        <?php else : ?>
                                        <a href="./chucnang/donhang/indh.php?id_dh=<?= $dondathang['id_dh'] ?>" class="btn btn-success">
                                         In
                                        </a>          
                                   <?php endif; ?>
                               </td>
                           </tr>
                       <?php endforeach; ?>
                   </tbody>
               </table>
               <!-- End block content -->
           </main>
       </div>
   </div>
