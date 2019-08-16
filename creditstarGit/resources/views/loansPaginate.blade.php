  <table  cellpadding="0" cellspacing="0" class="table table-bordered  user-table" >
                                <tr>
                                    <th colspan="10">View Loans Information</th>
                                </tr>
                                 <tr  class="text-right" style="font-weight: bold;">
                                    <td colspan="10"  >
                                        <div class="col-lg-5" style="float: right;">
                                             <input type="text" name="userName" placeholder="Serach By Name" class="userName form-control">
                                        </div>
                                       
                                    </td>
                                </tr>

                                <tr style="font-weight: bold;" class="text-center">
                                    <td>User Name</td>
                                    <td>Amm.</td>
                                    <td>Int.</td>
                                    <td>Dur.</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td width="10">Camp.</td>
                                    <td width="10">Sta.</td>
                                    <td>Act.</td>
                                </tr>



                                <tbody class="tableDAta">
                                @if(count($allData) > 0)
                                 @foreach($allData as $showData)
                                     <tr id="{{$showData->id}}" class="">
                                        <td id="{{$showData->fk_user_id}}">{{$showData->first_name}}&nbsp;  {{$showData->last_name}}</td>
                                        <td>{{number_format($showData->amount,2)}}</td>
                                        <td>{{number_format($showData->interest,2)}}</td>
                                        <td>{{$showData->duration}}</td>
                                        <td>{{$showData->start_date}}</td>
                                        <td>{{$showData->end_date}}</td>
                                        <td width="10">{{$showData->campaign}}</td>
                                        <td width="10">{{$showData->status}}</td>
                                        <td> <button type="button" id="edit-{{$showData->id}}" class="Submit" >Edit&nbsp;</button>
                                        <button id="del-{{$showData->id}}"  class="reset">Del&nbsp;</button></td>
                                    </tr>
                                 @endforeach
                                @endif
                            </tbody>
                       
                                  
                        </table>

                     <div class="col-lg-12 text-right"> {!! $allData->render() !!}</div>