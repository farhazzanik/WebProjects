@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>
 
    <div class="row-fluid">
      <div class="span10">
        @include('error.msg')
 <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">MMPDS Member Report</a></li>
            
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Show Report</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('showReportmmpds')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

          @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select   onchange=""  name ="Brance"  id="Brance" class="span6">
               <option>Select One</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1')
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
              <label class="control-label">Select Type</label>
              <div class="controls">

      

          <select   name ="type"  id="type" class="span6" onchange="showdate()"> 
                  <option>Select One</option>
                   <option value="1">Total Members</option>
                   <option value="2"> Today will get profits Members</option>
                
                </select>
              
              
              </div>
            </div>


              <div class="control-group">
              <label class="control-label">Select Package</label>
              <div class="controls">

      

          <select   name ="Package"  id="Package" class="span6">
                  <option>Select One</option>
                  @if(count($showpack) > 0)
                  @foreach($showpack as $showData)
                    <option value="{{$showData->num_of_month}}">{{$showData->num_of_month}} Months</option>
                    @endforeach
                    @endif
                </select>
              
              
              </div>
            </div>



             <div class="control-group" id="showfield">

            

            </div>






   


  

             
              <div class="form-actions">
                <input type="submit" formtarget="_blank" value="Show" class="btn btn-success">
              </div>
            </form>
          </div>
             </div>  </p>
            </div>
            
           
          </div>
        </div>
        </div>
        </div></div>
        </div>

         <meta name="_token" content="{!! csrf_token() !!}" />
  
       <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>


<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
  $('.datepicker').datepicker();
  $('.datepickersss').datepicker();
   $('.datepickersssss').datepicker();
    $('.datepickersssssss').datepicker();
    $('.datepickesr').datepicker();

function showdate(){
   $( "#showfield" ).html( " " );
              var type = $('#type').val();

              if(type ==2){
            $( "#showfield" ).append( '<label class="control-label">Date</label><div class="controls"><input type="text" name="Todaydate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date("d-m-Y")}}" class="datepickesr span6" /><span class="help-block">Date with Formate of  (dd-mm-yy)</span></div>');

          }else{
             $( "#showfield" ).html('' );
          }

}

</script>
@endsection