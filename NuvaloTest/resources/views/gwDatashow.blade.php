@php   
   $startMonth =  \App\Http\Controllers\indexCon::monthNoConvertTofull($startMonth);
   $endMonth =  \App\Http\Controllers\indexCon::monthNoConvertTofull($endMonth);
 @endphp 


<table class="table table-bordered">
                             
    <tr>
        <td align="center" colspan="5"> <b>Group Working Hours From  {{$startMonth}}   To  {{$endMonth}}</b></td>
    </tr>
    <tr>
        <th>SL. No.</th>
        <th>Employee Name</th>
        <th>Employee Email</th>
        <th>Company Name</th>
        <th>Total Working Hours</th>
    </tr>

    <tbody id="table_data">
        @if(count($allData) > 0)
          @foreach($allData as $showData)
            <tr>
                <td>{{$showData->emp_id}}</td>
                <td>{{$showData->first_name}} {{$showData->last_name}}</td>
                <td>{{$showData->emp_email}}</td>
                <td>{{$showData->com_name}}</td>
                <td>
                    @if(count($TitmeDiffer) > 0)
                     @foreach($TitmeDiffer as $showWorkHours)
                      @if($showWorkHours->fk_emp_id === $showData->emp_id)
                        {{$showWorkHours->totalworks}}
                      @endif
                     @endforeach
                    @endif
                </td>
            </tr>
          @endforeach
        @endif
    </tbody>

</table>