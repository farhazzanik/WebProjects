@include('header')

	
           <!-- Show Employee,company, Data from Database  -->
            <section>
                <div class="col-lg-12" style="margin-top: 20px;">

                  <!-- searching form -->
                    <div class="col-lg-12 table-bordered" style="padding: 0px; margin: 0px">
                          <br/>
                          <form class="form-inline">
                              
                             <div class="form-group col-lg-3">
                                <label>From Month :</label>
                                <select id="startMonth"  class="form-control" style="width: 100%; border-radius: 0px;">
                                  @if(count($onlyMonth) > 0)
                                    @foreach($onlyMonth as $showData)
                                    
                                       <option value="{{$showData->month}}">
	                                      @php 	 
	                                        echo  $convertMonth =  \App\Http\Controllers\indexCon::monthNoConvertTofull($showData->month);
	                                      @endphp
                                       </option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>

                               <div class="form-group col-lg-3">
                                <label>To Month :</label>
                                <select id="endMonth"  class="form-control" style="width: 100%; border-radius: 0px;">
                                   @if(count($onlyMonth) > 0)
                                    @foreach($onlyMonth as $showData)
                                    
                                       <option value="{{$showData->month}}">
	                                      @php 	 
	                                        echo  $convertMonth =  \App\Http\Controllers\indexCon::monthNoConvertTofull($showData->month);
	                                      @endphp
                                       </option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>

                           
                              

                              <br/>
                              <button type="submit" id="searchBtn_for_gw" class="btn btn-primary" style="border-radius: 0px;">Show</button>
                              <button type="submit" id="reset_button" class="btn btn-warning" style="border-radius: 0px;">Reset</button>
                              
                            </form>

                            <br/>

                    </div>
                    <!-- End searching form -->



                  <!--   groupWorks   data show here -->
                     <div class="col-lg-12" id="groupWorks_hours" style="padding: 0px; ">


                     </div>

                   <!--  end part  -->

<script src="{{URL::to('/')}}/resources/js/gpscript.js"></script>
   
</body>
</html>