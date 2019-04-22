
<table class="table table-bordered">
	<tr>
		<td>
			Employee ID  :  {{$employeeInfo[0]->emp_id}}<br/><br/>
			Employee Name:    {{$employeeInfo[0]->first_name}}&nbsp; {{$employeeInfo[0]->last_name}}<br/><br/>
			Employee Mobile No :   {{$employeeInfo[0]->emp_phone}}<br/><br/>
			Employee E-mail:   {{$employeeInfo[0]->emp_email}}<br/><br/>
		</td>
		<td>
			Company Name:  {{$employeeInfo[0]->com_name}}<br/><br/>
			Company Mobile No:  {{$employeeInfo[0]->com_phone}}<br/><br/>
			Company E-mail:  {{$employeeInfo[0]->com_email}}<br/><br/>
			Company Address:  {{$employeeInfo[0]->com_email}}<br/><br/>
		</td>
	</tr>
</table>

<table class="table table-bordered">
		<tr>
			<td align="center" colspan="4"> <b>Working Hours Between {{$startDate}} To {{$endDate}}</b></td>
		</tr>
		<tr>
				<th>Date</th>
				<th>Start Work Time</th>
				<th>End  Work Time</th>
				<th>Total Hours</th>
		</tr>
		
		<tbody>
			@if(count($totalWHbyEach) > 0)
				@php
					$totalHours = 0;
					$totalMinutes = 0;
					$TotalSeconds = 0;
				@endphp
				@foreach($totalWHbyEach as $showData)
					<tr>
						<td>{{$showData->date}}</td>
						<td>{{$showData->startDate}}</td>
						<td>{{$showData->endDate}}</td>
						<td>

							@php
 								 $getCalTime =  \App\Http\Controllers\indexCon::checkTotalHours($showData->startDate,$showData->endDate);

 							  print $getCalTime[0].' Hours '.$getCalTime[1].' Minutes '.$getCalTime[2].' Seconds ';
 							  $totalHours = $totalHours+$getCalTime[0];
                              $totalMinutes = $totalMinutes+$getCalTime[1];
 							  $TotalSeconds = $TotalSeconds+$getCalTime[2];
							@endphp
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
		<TFOOT>
			<tr>
				<td colspan="3" align="right"><b>Total Working Hours</b></td>
				<td>

					@php

						
						if($TotalSeconds > 60){
						   $getMfromS = $TotalSeconds / 60;
						   $explodeSecond = explode('.',$getMfromS);
						    $IncMinute = $totalMinutes+$explodeSecond[0];
						   $exectSecond = $explodeSecond[1];
						}else{
						   $exectSecond = $TotalSeconds ;
						    $IncMinute = $totalMinutes;
						}

						if($IncMinute > 60){
						    $getHfromM = $IncMinute / 60;
						   $exmplodeM = explode('.',$getHfromM);
						   $IncHours = $totalHours+$exmplodeM[0];
						    $exectMinutes = $exmplodeM[1];
						}else{
						   $exectMinutes = $IncMinute ;
						   $IncHours  = $totalHours;
						}
					@endphp

					<b>{{$IncHours}} Hours {{substr($exectMinutes,0,2)}} Minutes {{substr($exectSecond,0,2)}} Seconds</b>

				</td>
			</tr>
		</TFOOT>
</table>