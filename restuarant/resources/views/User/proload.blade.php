  <form  id="uploaddiamond" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" >
<input type="hidden" name="sesionres" id="sesionres" value="{{Session::get('res_id')}}">
@if(count($data) > 0)
@foreach($data as $show)
<div class="col-xs-7" style="padding: 0px">
		<span style="color: black">{{$show->pro_name}}</span>

</div>
<div class="col-xs-5" style="padding: 0px;">
		<span style="color: black">
			 <img onclick="incshoping('{{$show->res_id}}','{{$show->item_id}}','{{$show->pro_id}}')" style="width: 11px; height: 10px; color: red; cursor: pointer;"  src="{{URL::to('/')}}/public/frontend/img/incplus.png" style="cursor: pointer;">
		 &nbsp; {{$show->price - $show->discount}} * {{$show->toalpro}} &nbsp; <!-- <a style="color: red; font-size: 28px; font-weight: 600; cursor: pointer; text-decoration: none;" onclick="deleteshoping('{{$show->id}}')">-</a> -->

		 <img onclick="deleteshoping('{{$show->id}}')" style="width: 13px; height: 20px; color: red; cursor: pointer;"  src="{{URL::to('/')}}/public/frontend/img/min.png" style="cursor: pointer;"> </span>
</div>

@endforeach
@endif

</form>