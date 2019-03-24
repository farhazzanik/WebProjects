

	@if(count($data) >0 )
	@foreach($data as $showdata)
	<div style="float: left; clear: right; margin-left: 20px; margin-top: 10px; height: 30px; text-align: center;">
<?php

echo DNS1D::getBarcodeHTML("$showdata->barid", "C128");
		echo "<span style='font-size:18px;'>$showdata->barid</span>";


?>

	</div>
	@endforeach
@endif
