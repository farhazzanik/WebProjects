
<div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Collection Info</h5>
          </div>
              		


                  <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('editSuccCol')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

           
@if($adminti->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" onchange="return showArea(),showrefer()" class="span3">
                
                <option value="{{$showAllData[0]->fk_brance_id}}">{{$showAllData[0]->branceName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $showAllData[0]->fk_brance_id !=  $showData->id)

                  <option value="{{$showData->id}}" >{{$showData->name}}</option>
                     @endif
                   @endforeach
                  @endif   

    
                  </select>
               </div>
            </div>


  @else 


      <input type="hidden" name="Brance" id="Brance" value="{{$adminti->fk_brance_id}}" class="span3">
      @endif



              <div class="control-group">
              <label class="control-label">Select Employee</label>
              <div class="controls">



@if($adminti->fk_brance_id == '1')
                <select  name ="Employee"  id="Employee" class="span3">
                  
                 <option value="{{$showAllData[0]->fk_emp_id}}">{{$showAllData[0]->empname}}</option>
                    
               
                </select>
                @else
              

              <select  name ="Employee"  id="Employee" class="span3">
                    <option value="{{$showAllData[0]->fk_emp_id}}">{{$showAllData[0]->empname}}</option>
                    
                   @if(count($AllEmployee) > 0)
                   @foreach($AllEmployee as $showData)
                   @if($showAllData[0]->fk_emp_id !=$showData->id)
                   <option value="{{$showData->id}}">{{$showData->Name}}</option>
                  @endif
                  @endforeach
                  @endif

                  </select>
                @endif


                
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                    <input type="hidden" name="colid" value="{{$showAllData[0]->id}}">
               <span id="loader"></span>
              </div>
            </div>


             
         
            <div class="control-group">
              <label class="control-label">Select Area </label>
              <div class="controls">



                 @if($adminti->fk_brance_id == '1')
 <select  name ="Area"  id="Area" class="span3">
<option value="{{$showAllData[0]->fk_area_id}}">{{$showAllData[0]->area_name}}</option>
  </select>
               @else

                <select  name ="Area"  id="Area" class="span3">
                 <option value="{{$showAllData[0]->fk_area_id}}">{{$showAllData[0]->area_name}}</option>

                         @if(count($selectArea) > 0)
                  @foreach($selectArea as $showData)
                     @if($showAllData[0]->fk_area_id !=$showData->id)
                    <option value="{{$showData->id}}">{{$showData->area_name}}</option>
                    @endif
                    @endforeach
                    @endif
               
               
                </select>
              @endif





               <span id="loader"></span>
              </div>
            </div>



              <div class="control-group">
              
                <label class="control-label">Description</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span3" name="description">{{$showAllData[0]->description}}</textarea>
                </div>
              </div>
            
             

            
           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>


</div> 

<script type="text/javascript">
  
function showArea(){
  
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Area');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showColarea")}}/'+branceid,
                type:'GET',
                dataType:'json',
                beforeSend:function(){
                        $("#districloader").html(loader);
                },  
                success:function(data){
         // alert(data);
                  batchOption.empty();
                    batchOption.append('<option value="" selected disabled>Select One</option>');
                    $.each(data,function(index,value){


                  batchOption.append('<option value="'+value.id+'">'+value.area_name+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          }
                  $('#showUpazila').val("");

}



function showrefer(){
  
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Employee');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showempforcol")}}/'+branceid,
                type:'GET',
                dataType:'json',
                beforeSend:function(){
                        $("#districloader").html(loader);
                },  
                success:function(data){
         // alert(data);
                  batchOption.empty();
                    batchOption.append('<option value="" selected disabled>Select One</option>');
                    $.each(data,function(index,value){


                  batchOption.append('<option value="'+value.id+'">'+value.Name+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          }
                  $('#showUpazila').val("");

}


</script>