 
@if($type == '1')
 <label style='background-color:#000; height:25px; color:white; font-size:16px; margin-left:10px; width:95%; text-align: center; margin-top: 10px; padding-top: 5px;'  class='linkname '>
                     <input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; 
                     <span><strong class="text-danger ">Select All</strong></span></label>

		@if(count($data))
		@foreach($data as $showDat)
		@if($showDat->con_no != "")
			 <label  style="margin-left: 20px;">
                  <input type="checkbox" name="conno[]"  value="{{$showDat->Addid}}and{{$showDat->memberName}}" class="check_elmnt2"  	

       @if(count($vale))
		@foreach($vale as $showvalue)
				@if($showvalue->sav_id == $showDat->Addid)
						checked disabled
				@endif	
			@endforeach
		@endif />
                  {{$showDat->mem_name}}&nbsp;( {{$showDat->con_no}})</label>
		@endif
		@endforeach
		@endif
	@endif 


@if($type == '2')
 <label style='background-color:#000; height:25px; color:white; font-size:16px; margin-left:10px; width:95%; text-align: center; margin-top: 10px; padding-top: 5px;'  class='linkname '>
                     <input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; 
                     <span><strong class="text-danger ">Select All</strong></span></label>
		@if(count($data))
		@foreach($data as $showDat)
		@if($showDat->con_no != "")
			 <label  style="margin-left: 20px;">
                  <input type="checkbox" name="conno[]"  value="{{$showDat->id}}and{{$showDat->appName}}" class="check_elmnt2"  	

       @if(count($vale))
		@foreach($vale as $showvalue)
				@if($showvalue->sav_id == $showDat->id)
						checked disabled
				@endif	
			@endforeach
		@endif />
                  {{$showDat->mem_name}}&nbsp;( {{$showDat->con_no}})</label>
		@endif
		@endforeach
		@endif
	@endif

