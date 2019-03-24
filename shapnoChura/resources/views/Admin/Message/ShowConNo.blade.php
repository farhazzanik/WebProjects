		@if($type=='emp')
		 <label style='background-color:#000; height:25px; color:white; font-size:16px; margin-left:10px; width:95%; text-align: center; margin-top: 10px; padding-top: 5px;'  class='linkname '>
                     <input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; 
                     <span><strong class="text-danger ">Select All</strong></span></label>
		@if(count($data))
		@foreach($data as $showDat)
		@if($showDat->contactNo != "")
			 <label  style="margin-left: 20px;">
                  <input type="checkbox" name="conno[]" value="{{$showDat->contactNo}}" class="check_elmnt2" />
                  {{$showDat->Name}}&nbsp;( {{$showDat->contactNo}})</label>
		@endif
		@endforeach
		@endif
		@endif


		@if($type=='mem')
		 <label style='background-color:#000; height:25px; color:white; font-size:16px; margin-left:10px; width:95%; text-align: center; margin-top: 10px; padding-top: 5px;'  class='linkname '>
                     <input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; 
                     <span><strong class="text-danger ">Select All</strong></span></label>
		@if(count($data))
		@foreach($data as $showDat)
		@if($showDat->con_no != "")
			 <label style="margin-left: 20px;">
                  <input type="checkbox" name="conno[]" value="{{$showDat->con_no}}" class="check_elmnt2" />
                  {{$showDat->mem_name}}&nbsp;( {{$showDat->con_no}})</label>
		@endif
		@endforeach
		@endif
		@endif