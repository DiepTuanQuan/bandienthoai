<div id="cart">
    <h2 class="h2-bar">giỏ hàng của bạn</h2>
    <?php
    if (isset($_SESSION['giohang'])) {
        if (isset($_POST['sl'])) {
            foreach ($_POST['sl'] as $id_sp => $sl) {
                if ($sl == 0) {
                    unset($_SESSION['giohang'][$id_sp]);
                } else if ($sl > 0) {
                    $_SESSION['giohang'][$id_sp] = $sl;
                }
            }
        }
        $arrid = array();
        foreach ($_SESSION['giohang'] as $id_sp => $so_luong) {
            $arrid[] = $id_sp;
        }
        $strid = implode(',', $arrid);
        $sql = "SELECT * FROM sanpham WHERE id_sp IN($strid) ORDER BY id_sp DESC";
        $query = mysqli_query($conn, $sql);
    ?>
        <form id="giohang" method="post">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:40%">Sản phẩm</th>
                        <th style="width:10%">Giá</th>
                        <th style="width:10%">Số lượng</th>
                        <th style="width:30%" class="text-center">Tổng tiền</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <!-- Product Item -->
                <?php
                $totalPriceAll = 0;
                if (is_array($query) || is_object($query)) {
                    foreach ($query as $row) {
                        $totalPrice = $row['gia_sp'] * $_SESSION['giohang'][$row['id_sp']];
                ?>
                        <tbody>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-2 hidden-xs"><img src="./quantri/anh/<?php echo $row['anh_sp']; ?>" alt="..." class="img-responsive" /></div>
                                        <div class="col-sm-10">
                                            <h5><?php echo $row['ten_sp']; ?></h5>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price"><?php echo number_format($row['gia_sp']); ?></td>
                                <td data-th="Quantity">
                                    <input name="sl[<?php echo $row['id_sp']; ?>]" type="number" min="0" class="form-control text-center" value="<?php echo $_SESSION['giohang'][$row['id_sp']]; ?>">
                                </td>
                                <td data-th="Subtotal" class="text-center"><span><?php echo number_format($totalPrice); ?> ₫</span></td>
                                <td class="actions" data-th="">
                                    <a href="./chucnang/giohang/xoahang.php?id_sp=<?php echo $row['id_sp']; ?>">Xóa</a>
                                </td>
                            </tr>
                        </tbody>
                <?php
                        $totalPriceAll += $totalPrice;
                    }
                }
                ?>
                <!-- End Product Item -->
                <tfoot>
                    <tr class="visible-xs">
                        <td class="text-center"><strong>Total <span><?php echo number_format($totalPriceAll); ?></span></strong></td>
                    </tr>
                    <tr>
                        <td>
                            <a href="index.php" class="btn btn-warning">Tiếp tục mua hàng</a>
                            <a onclick="document.getElementById('giohang').submit();" href="#" class="btn btn-info">Cập nhật giỏ hàng</a>

                        </td>
                        <td colspan="2" class="hidden-xs">
                            <a class="btn btn-default" href="./chucnang/giohang/xoahang.php?id_sp=0">Xóa hết sản phẩm</a>
                        </td>
                        <td class="hidden-xs text-center"><strong>Tổng tiền giỏ hàng: <span><?php echo number_format($totalPriceAll); ?> VNĐ</span></strong></td>
                        <td><a href="index.php?page_layout=muahang" class="btn btn-success btn-block">Thanh toán</a></td>
                    </tr>
                </tfoot>
            </table>
        </form>
    <?php
    } else {
        echo '<p style="color: red"> Chưa có sản phẩm nào trong giỏ hàng của bạn !! ';
        echo '<a href="./index.php">Tiếp tục mua hàng</a>';
    }
    ?>
</div>