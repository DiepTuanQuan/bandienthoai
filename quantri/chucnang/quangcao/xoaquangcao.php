<?php
$id_quangcao = $_GET['id_quangcao'];
include_once '../../ketnoi.php';
$sql = "DELETE FROM quangcao WHERE id_quangcao='$id_quangcao'";
$query = mysqli_query($conn, $sql);
header('location: ../../quantri.php?page_layout=quangcao');
?>