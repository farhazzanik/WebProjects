
 <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">ADD</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Employee Salary Setup</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('savesuccsalry')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  onchange="return showrefer()" id="Brance" class="span3">

                	<option value="{{$showAllData[0]->fk_brance_id}}">{{$showAllData[0]->branceName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $showData->id != $showAllData[0]->fk_brance_id )
                  <option value="{{$showData->id}}" >{{$showData->name}}</option>
                     @endif
                   @endforeach
                  @endif   

    
                  </select>
               </div>
            </div>


  @else 


      <input type="hidden" name="Brance" id="Brance" value="{{$id->fk_brance_id}}" class="span3">
      @endif
        

                <div class="control-group">
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="date"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$showAllData[0]->date}}" class="datepickersss span3" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>



                <div class="control-group">
              <label class="control-label">Select Employee</label>
              <div class="controls">
                

@if($id->fk_brance_id == '1')
                <select  name ="Employee"  id="Employee" class="span3">
                  
               <option value="{{$showAllData[0]->fk_emp_id}}">{{$showAllData[0]->empname}}</option>
               
                </select>
                @else
              

              <select  name ="Employee"  id="Employee" class="span3">

              	  <option value="{{$showAllData[0]->fk_emp_id}}">{{$showAllData[0]->empname}}</option>

                    @if(count($AllEmployee) > 0)
                  @foreach($AllEmployee as $showData)
                  @if( $showData->id != $showAllData[0]->fk_emp_id)
                    <option value="{{$showData->id}}">{{$showData->Name}}</option>
                    @endif
                  @endforeach
                  @endif

                  </select>
                @endif
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">

                    <input type="hidden" name="id" value="{{$showAllData[0]->id}}">
               <span id="loader"></span>
              </div>
            </div>

            

             
                <div class="control-group">
              <label class="control-label"> Salary
</label>
              <div class="controls">
                <input type="text" name="ammount" value="{{$showAllData[0]->ammount}}"  placeholder="12000" class="span3" />
               </div>
            </div>



 <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <label>
                        <input type="radio" name="Status" value="1"
                        		@if($showAllData[0]->status ==='1')
                        			checked
                        		
                        		@endif
                         />
                        Active</label>
                      <label>
                        <input type="radio" name="Status" value="2" 
                        @if($showAllData[0]->status ==='2')
                        			checked
                        		
                        		@endif   />
                        Inactive</label>
                  
                    </div>
            </div>


           
             
              <div class="form-actions">
                <input type="submit"  value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
             </div>  </p>
            </div>
            <div id="tab2" class="tab-pane">
              
            </div>
           
          </div>
        </div>
        