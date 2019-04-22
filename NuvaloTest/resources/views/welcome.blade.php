@include('header')
            <!-- Submit Form For Insert Data from json Api link -->
            <section>
                <form method="post"  action="{{URL::to('InsDataFromJsonApi')}}" name="myForm" >
                     {{ csrf_field() }}
                    <div class="col-lg-12 col-sm-12 alert alert-danger" style="border-radius: 0px;">
                        If No Data in Database,Please Submit The Button to insert Data From Json Api link.....!!!
                        <input type="Submit" name="Submit" id="submit" value="Insert Data" class="btn btn-danger" style="float: right;">
                    </div>
                </form>
            </section>
           <!--  end part -->

           <!-- Show Employee,company, Data from Database  -->
            <section>
                <div class="col-lg-12">

                  <!-- searching form -->
                    <div class="col-lg-12 table-bordered" style="padding: 0px; margin: 0px">
                          <br/>
                          <form class="form-inline">
                              
                             <div class="form-group col-lg-3">
                                <label>From Date :</label>
                                <select id="startDate"  class="form-control" style="width: 100%; border-radius: 0px;">
                                  @if(count($allStartDate) > 0)
                                    @foreach($allStartDate as $showData)
                                       <option>{{$showData->date}}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>

                               <div class="form-group col-lg-3">
                                <label>To Date :</label>
                                <select id="endDate"  class="form-control" style="width: 100%; border-radius: 0px;">
                                  @if(count($allEndDate) > 0)
                                    @foreach($allEndDate as $showData)
                                       <option>{{$showData->date}}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>

                           
                              
                              <div class="form-group col-lg-4 col-sm-12">
                                <label>Employee Name : </label>
                               <input type="text" class="form-control" id="EmployeeName" placeholder="Employee Name" autocomplete="off" style="width: 100%; border-radius: 0px;" />
                                <div style="margin: 0px; padding: 0px;" class="col-lg-12 col-sm-12 fstdive">
                                      <ul id="list-gpfrm"></ul>
                                </div>
                              </div>

                              <br/>
                              <button type="submit" id="searchBtn" class="btn btn-primary" style="border-radius: 0px;">Show</button>
                              <a href="{{URL::to('/')}}" class="btn btn-warning" style="border-radius: 0px;">Reload</a>
                            </form>

                            <br/>

                    </div>
                    <!-- End searching form -->


                  <!--   only each one data here -->
                     <div class="col-lg-12" id="each_employe" style="padding: 0px; ">


                     </div>

                   <!--  end part  -->


                   <!--  all employee data -->
                    <div class="col-lg-12" id="all_employee" style="padding: 0px; ">
                      <table class="table table-bordered">
                             
                              <tr>
                                  <td align="center" colspan="10"><b>All Employee Working Hours</b></td>
                              </tr>
                               <tr>
                                          <th>Employee Name</th>
                                          <th>Employee Email</th>
                                          <th>Employee Phone</th>
                                          <th>Employee Address</th>
                                          <th>Company  Name</th>
                                          <th>Company Address</th>
                                          <th>Employee Working start Date and Hours</th>
                                          <th>Employee Working End Date and Hours</th>
                                           <th>Total Working Hours</th>
                              </tr>
                               
                              <tbody id="table_data">
                                @include('paginateTableData')
                              </tbody>
                      </table>
                  </div>
                 <!--  end part of eall employee data here -->


                </div>
            </section>
        <!--     End part -->




        </div>

<script src="{{URL::to('/')}}/resources/js/script.js"></script>
   
</body>
</html>
