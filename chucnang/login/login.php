<?php
if (isset($_SESSION['email'])) {
?>
    <div id="login" class="col-md-7 col-sm-12 col-xs-4 text-right">
        <div id="login-main">
            <ul>
                <li id="user"><?php echo $_SESSION['email']; ?>
                    <div>
                        <ul id="user-main">
                            <li><a href="./quantri/chucnang/dangxuat/dangxuat.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            <li ><a href="index.php?page_layout=donhang2"><i class="fas fa-wallet"></i> Đơn hàng của bạn</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
<?php
} else {
?>
   <div id="login" class="col-md-7 col-sm-12 col-xs-4 text-right">
<div id="login-main">
    <p><a href="./quantri">Login<i class="fas fa-sign-in"></i></a> <span> / </span> <a href="./chucnang/tao_tk/taotk.php">Sign In</a></p>
</div>
</div>
<?php

}
?> 
