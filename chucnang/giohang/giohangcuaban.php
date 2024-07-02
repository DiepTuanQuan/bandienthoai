<div class="header-cart">
    <i class="fas fa-shopping-cart header-cart-icon"></i>
    <div class="header-cart__view">
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
            <div class="header-cart-header">
                <span class="header-cart-title">Sản phẩm mới thêm</sp>
            </div>
            <ul class="header-cart-list">
                <?php
                if (is_array($query) || is_object($query)) {
                    foreach ($query as $row) {
                ?>
                        <li class="header-cart-item">
                            <img src="./quantri/anh/<?php echo $row['anh_sp']; ?>" alt="product photo" class="header-cart-item__img">
                            <h5 class="header-cart-item__title"><?php echo $row['ten_sp']; ?></h5>
                            <span class="header-car-item__price"><?php echo number_format($row['gia_sp']); ?> đ</span>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
            <div class="header-cart-footer">
                <span class="header-cart-count-item">
                    Có <span><?php echo count($_SESSION['giohang']); ?></span> sản phẩm trong giỏ hàng
                </span>
                <div class="btn btn-primary underline ">
                    <div class=" cart-btn">
                        <a href="index.php?page_layout=giohang">Chi tiết giỏ hàng</a>
                    </div>
                </div>
            </div>
    </div>
<?php } else { ?>
    <img class="cart-empty--img" src="./images/empty-cart.png" alt="giỏ hàng trống">
<?php } ?>


</div>