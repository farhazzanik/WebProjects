  <table  cellpadding="0" cellspacing="0" class="table table-bordered  user-table" >
                                <tr>
                                    <th colspan="10">View User Information</th>
                                </tr>
                                  <tr  class="text-right" style="font-weight: bold;">
                                    <td colspan="10"  >
                                        <div class="col-lg-5" style="float: right;">
                                             <input type="text" name="userName" placeholder="Serach By Name" class="userName form-control">
                                        </div>
                                       
                                    </td>
                                </tr>

                                <tr  class="text-center" style="font-weight: bold;">
                                    <td>User Name</td>
                                    <td>E-mail</td>
                                    <td>Personal Code</td>
                                    <td>Phone</td>
                                    <td>Status</td>
                                    <td>Dead</td>
                                    <td>Lang</td>
                                    <td>Action</td>
                                </tr>

                              
                               <tbody class="tableDAta">
                                @if(count($allData) > 0)
                                 @foreach($allData as $showData)
                                     <tr id="{{$showData->id}}" class="">
                                        <td>{{$showData->first_name}}&nbsp; {{$showData->last_name}} </td>
                                        <td>{{$showData->email}}</td>
                                        <td>{{$showData->personal_code}}</td>
                                        <td>{{$showData->phone}}</td>
                                        <td>{{$showData->active}}</td>
                                        <td>{{$showData->dead}}</td>
                                        <td>{{$showData->lang}}</td>
                                        <td> <button type="button" id="edit-{{$showData->id}}" class="Submit" >Edit&nbsp;</button>
                                        <button id="del-{{$showData->id}}"  class="reset">Del&nbsp;</button></td>
                                    </tr>
                                 @endforeach
                                @endif
                            </tbody>
                       
                                  
                        </table>

                     <div class="col-lg-12 text-right"> {!! $allData->render() !!}</div>