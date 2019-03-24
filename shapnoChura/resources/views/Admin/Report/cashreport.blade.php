@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
 <div class="container-fluid">
    <hr>

    
    <div class="row-fluid">
      <div class="span8">
@include('error.msg')
 <div class="widget-box">
       
         
           
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Cash Report</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('showcashtab')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
              



          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span8" onchange="showArea()">
                 <option>Select One</option>
                  @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' )

                  <option value="{{$showData->id}}" >{{$showData->name}}</option>
                     @endif
                   @endforeach
                  @endif   

    
                  </select>
               </div>
            </div>



    

      
             <div class="control-group">
              <label class="control-label">Select One </label>
              <div class="controls">
                <select  name ="name"  id="name" class="span8" onchange="showfield()">
                  <option>Select One </option>
                      <option value="1">Debit</option>
                      <option value="2">Credit</option>
                      <option value="3">Both</option>
                      <option value="4">Date wise Cash Report</option>
                       <option value="7"> Cash Close  Report</option>
                      <option value="5">Saving Collection Report</option>
                      <option value="6">Invest Collection Report</option>
                </select>
                  <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
              </div>
            </div>


              
 <div class="control-group">
              <label class="control-label">Date
</label>
              <div class="controls showcont">


        </div>

            </div>


          
          
     
          
              <div class="form-actions">
                <input type="submit"  formtarget="_blank" value="Show Report" class="btn btn-success">
              </div>
            </form>
          </div>
             </div> 
            </div>
            
           
          </div>
          </div>
        
        
         <meta name="_token" content="{!! csrf_token() !!}" />
      
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
        <script type="text/javascript">
         


           function showfield(){

 $( ".showcont" ).html( " " );
              var type = $('#name').val();
              if(type==1 || type ==2 || type ==4){
            $( ".showcont" ).append( "<input type='text' name='date' data-date='<?php echo date('d-m-Y')?>' data-date-format='dd-mm-yyyy' value='{{date('d-m-Y')}}' class='datepicker span8' /> <span class='help-block'>Date with Formate of  (dd-mm-yy)</span> " );

          }else if(type==3 || type ==5 || type ==6 ){
             $( ".showcont" ).append('<input type="text" value="<?php echo date('d-m-Y')?>"  class="datepicker span4" name="ssdate"/>&nbsp;&nbsp;<input type="text" value="<?php echo date('d-m-Y')?>"  class="datepicker span4" name="snddate"/>' );
          }


           }
             $('.datepicker').datepicker();
        </script>
@endsection