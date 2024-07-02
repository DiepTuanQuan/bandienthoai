<?php

$id_dh = $_GET['id_dh'];
$sql = "SELECT * FROM donhang WHERE id_dh=$id_dh";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
if (isset($_POST['submit'])) {
    $ten = $_POST['ten'];
    $diachi = $_POST['diachi'];
    $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
    if (isset($id_dh) ) {
        $sql = "UPDATE donhang SET ten='$ten',diachi='$diachi',dh_trangthaithanhtoan=$dh_trangthaithanhtoan WHERE id_dh=$id_dh";
        $query = mysqli_query($conn, $sql);
        header('location: quantri.php?page_layout=donhang'); 
    }
}
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#"><svg class="glyph stroked home">
                    <use xlink:href="#stroked-home"></use>
                </svg></a></li>
        <li class="active"></li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sửa đơn hàng</h1>
    </div>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Sửa đơn hàng</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form role="form" method="post">


                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-sortable="true">ID</th>
                                    <th data-sortable="true">Tên KH</th>
                                    <th data-sortable="true">Số lượng</th>
                                    <th data-sortable="true">Địa Chỉ</th>
                                    <th data-sortable="true">Trạng thái thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-checkbox="true"><?php echo $row['id_dh']; ?></td>
                                    <td data-checkbox="true">
                                        <input class="form-control" type="text" name="ten" value="<?php if (isset($_POST['ten'])) {
                                                                                                        echo $_POST['ten'];
                                                                                                    } else {
                                                                                                        echo $row['ten'];
                                                                                                    } ?>" required="">
                                    </td>
                                    <td data-checkbox="true">
                                        <input class="form-control" type="text" disabled  name="soluong"  value="<?php 
                                                                                                                echo $row['soluong'];
                                                                                                             ?>" required="">

                                    </td>
                                    <td data-checkbox="true">
                                        <textarea class="form-control" rows="3" name="diachi"><?php if (isset($_POST['binh_luan'])) {
                                                                                                        echo $_POST['binh_luan'];
                                                                                                    } else {
                                                                                                        echo $row['diachi'];
                                                                                                    }  ?></textarea>
                                    </td>
                                    <td data-checkbox="true">
                                        <input class="form-control" type="number" min="0" max="1" name="dh_trangthaithanhtoan" value="<?php 
                                                                                                        echo $row['dh_trangthaithanhtoan'];
                                                                                                     ?>" required="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <button type="submit" class="btn btn-primary" name="submit">Sửa</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->