<?php
$sql = "SELECT * FROM quangcao";
$query = mysqli_query($conn, $sql);
$listImg = "";
while ($row = mysqli_fetch_array($query)) {
	$listImg .= '<img style="position: absolute;" class="img-thumbnail" src="./quantri/anh/' . $row['ten_anh'] . '"/>';
}
?>

<div id="banner-l">
	<h2 class="h2-bar">Sản phẩm hot</h2>
	<div id="simple-slideshow" style="position: relative; height: 350px; width: 300px;">
		<?php
		echo $listImg;
		?>
	</div>
</div>

<script>
	$("#simple-slideshow > img:gt(0)").hide();
	setInterval(function() {
		$('#simple-slideshow > img:first')
			.fadeOut(1000)
			.next()
			.fadeIn(1000)
			.end()
			.appendTo('#simple-slideshow');
	}, 3000);
</script>