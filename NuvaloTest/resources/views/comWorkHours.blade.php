@include('header')

	
           <!-- Show Employee,company, Data from Database  -->
            <section>
                <div class="col-lg-12" style="margin-top: 20px;">

                  <!-- searching form -->
                    <div class="col-lg-12 table-bordered"  style="padding: 0px; margin: 0px">
                          <br/>
                          <form class="form-inline">
                              
                           

                               <div class="form-group col-lg-3">
                                <label>Sorted By :</label>
                                <select id="shortBy"  class="form-control" style="width: 100%; border-radius: 0px; cursor: pointer;">
                                 
                                   <option value="select">Select One</option>
                                   <option value="DESC">Working Hourse Descending</option>
                                   <option value="ASC">Working Hourse Ascending</option>
                                    
                                </select>
                              </div>

                           
                              

                              <br/>
                              <button type="submit" id="searchBtn_for_gw" class="btn btn-primary" style="border-radius: 0px;">Show</button>
                              <button type="submit" id="reset_button" class="btn btn-warning" style="border-radius: 0px;">Reset</button>
                              
                            </form>

                            <br/>

                    </div>
                    <!-- End searching form -->


                    <!-- group working hours div show -->

                    <div class="col-lg-12" id="defualt_div" style="padding: 0px; margin: 0px;">
                    		
						<table class="table table-bordered">
						                             
						    <tr>
						        <td align="center" colspan="2"> <b> Group Working Hours  order by Descending</b></td>
						    </tr>
						    <tr>
						        <th>Company Name</th>
						        <th>Working Hours</th>
						       
						    </tr>

						    <tbody id="table_data">
						        @if(count($descComWorkHours) > 0)

						          @foreach($descComWorkHours as $showData)
						            <tr>
						                <td>{{$showData->com_name}}</td>
						                <td>{{$showData->totalworks}} </td>
						               
						            </tr>
						          @endforeach
						        @endif
						    </tbody>

						</table>
                    </div>
                    <!-- end this part -->



                  <!--   groupWorks   data show here -->
                     <div class="col-lg-12" id="comworks_shorted" style="padding: 0px; ">


                     </div>

                   <!--  end part  -->

<script src="{{URL::to('/')}}/resources/js/comWorks.js"></script>
   
</body>
</html>