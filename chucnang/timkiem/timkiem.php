<script>
	function searchFocus() {
		if (document.sform.stext.value == 'Tìm kiếm sản phẩm...') {
			document.sform.stext.value = '';
		}
	}

	function searchBlur() {
		if (document.sform.stext.value == '') {
			document.sform.stext.value = 'Tìm kiếm sản phẩm...';
		}
	}
</script>
<!-- search -->
<div id="search" class="col-md-12 col-sm-12 col-xs-12">
	<form method="post" name="sform" action="index.php?page_layout=danhsachtimkiem">
		<input type="submit" name="submit" value=""><i class="fas fa-search search-icon"></i>
		<input onfocus="searchFocus();" onblur="searchBlur();" type="text" name="stext" value="Tìm kiếm sản phẩm...">
	</form>
</div>
<!-- end search -->