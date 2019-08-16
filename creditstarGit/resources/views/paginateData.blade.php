  <table class="table-content table table-bordered table-hover" cellpadding="0"  cellspacing="0">
                        <tr class="text-center">
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Personal Code</th>
                            <th>Phone Number</th>
                            <th>Ammount</th>
                            <th>Interest</th>
                            <th>Duration</th>
                        </tr>
                    <tbody>
                    @if(count($allData) > 0)
                     @foreach($allData as $showData)
                         <tr>
                            <td>{{$showData->first_name}} &nbsp; {{$showData->last_name}} </td>
                            <td>{{$showData->email}}</td>
                            <td>{{$showData->personal_code}}</td>
                            <td>{{$showData->phone}}</td>
                            <td>{{number_format($showData->amount,2)}}</td>
                            <td>{{number_format($showData->interest,2)}}</td>
                            <td>{{$showData->duration}}</td>
                        </tr>
                     @endforeach
                    @endif
                   </tbody>    
                </table>

                <div class="col-lg-12 text-right"> {!! $allData->render() !!}</div>
               