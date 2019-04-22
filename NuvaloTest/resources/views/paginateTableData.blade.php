 @if(count($allData) > 0)
     @foreach($allData as $showData)
         <tr>
            <td>{{$showData->first_name}} &nbsp;{{$showData->last_name}}</td>
            <td>{{$showData->emp_email}}</td>
            <td>{{$showData->emp_phone}}</td>
            <td>{{$showData->emp_address}}</td>
            <td>{{$showData->com_name}}</td>
            <td>{{$showData->com_address}}</td>
            <td>{{$showData->start}}</td>
            <td>{{$showData->end}}</td>
            <td>
                @php
                    $explodeFirsDate = explode(' ',$showData->start);
                    $explodeSecondDate = explode(' ',$showData->end);

                   $getCalTime = \App\Http\Controllers\indexCon::checkTotalHours($explodeFirsDate[1], $explodeSecondDate[1]);
                    print $getCalTime[0].' Hours '.$getCalTime[1].' Minutes '.$getCalTime[2].' Seconds ';
                 @endphp
            </td>
        </tr>
      @endforeach
                               
        <tr align="right">
            <td colspan="9">{{$allData->links() }}</td>
        </tr>
 @endif
                          

                          
                            
                            