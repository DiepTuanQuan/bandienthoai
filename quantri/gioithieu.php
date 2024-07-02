<?php
include_once './ketnoi.php';
$sql = <<<EOT
    SELECT id_dh, COUNT(*) AS SoLuong
    FROM `donhang` sp
EOT;
$result = mysqli_query($conn, $sql);

//BINH LUAN
$sqlSoLuongBL = "select id_bl, count(*) as SoLuongBL from `blsanpham`";
$result2 = mysqli_query($conn, $sqlSoLuongBL);
//THANH VIEN
$sqlSoLuongTV = "select email, count(*) as SoLuongTV from `thanhvien`";
$result3 = mysqli_query($conn, $sqlSoLuongTV);
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
        <h1 class="page-header">Trang chủ quản trị</h1>
    </div>
</div>
<!--/.row-->

<div class="row">
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-blue panel-widget ">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked bag">
                        <use xlink:href="#stroked-bag"></use>
                    </svg>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <div class="large"><?php 
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $data= array( $row['SoLuong'] );
}
$strId = implode($data);
echo ($strId);
?></div>
                    <div class="text-muted">Đơn hàng</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-orange panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked empty-message">
                        <use xlink:href="#stroked-empty-message"></use>
                    </svg>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <div class="large"><?php
                    while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {
                        $sqlSoLuongBL= array( $row['SoLuongBL'] );
                    }
                    $strId = implode( $sqlSoLuongBL);
                    echo ($strId);
                    ?></div>
                    <div class="text-muted">Bình luận</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-teal panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked male-user">
                        <use xlink:href="#stroked-male-user"></use>
                    </svg>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <div class="large"><?php
                    while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC))
                    {
                        $sqlSoLuongTV= array( $row['SoLuongTV'] );
                    }
                    $strId = implode( $sqlSoLuongTV);
                    echo ($strId);
                    ?></div>
                    <div class="text-muted">Thành viên</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="panel panel-red panel-widget">
            <div class="row no-padding">
                <div class="col-sm-3 col-lg-5 widget-left">
                    <svg class="glyph stroked app-window-with-content">
                        <use xlink:href="#stroked-app-window-with-content"></use>
                    </svg>
                </div>
                <div class="col-sm-9 col-lg-7 widget-right">
                    <div class="large"><?php
                  header("refresh: 5.5");
                    $fp = '../chucnang/thongke/dem.txt';
                    $fo = fopen($fp, 'r');
                    $count = fread($fo, filesize($fp));
                    $count++;
                    $fc = fclose($fo);
                    $fo = fopen($fp, 'w');
                    $fw = fwrite($fo, $count);
                    $fc = fclose($fo);
                    echo $count;
                    
                    ?></div>
                    <div class="text-muted">Người xem</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Thống Kê Chi Tiết</div>
            <div class="panel-body">
                <div class="canvas-wrapper">
                    <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Đơn đặt hàng</h4>
                <div class="easypiechart" id="easypiechart-blue" data-percent="100"><span class="percent">100%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Bình luận</h4>
                <div class="easypiechart" id="easypiechart-orange" data-percent="50"><span class="percent">50%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Khách hàng mới</h4>
                <div class="easypiechart" id="easypiechart-teal" data-percent="79"><span class="percent">79%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel panel-default">
            <div class="panel-body easypiechart-panel">
                <h4>Lượt truy cập</h4>
                <div class="easypiechart" id="easypiechart-red" data-percent="97"><span class="percent">97%</span>
                </div>
            </div>
        </div>
    </div>
</div>