@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


 <div class="container-fluid">
    <hr>

    
    <div class="row-fluid">
      <div class="span8">
@include('error.msg')
 <div class="widget-box">
       
         
           
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Monthly Cash Report</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('showmcasreport')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
              

@if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
                
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


  @else 


      <input type="hidden" name="Brance" id="Brance" value="{{$id->fk_brance_id}}" class="span3">
      @endif

      

              
         
         <div class="control-group">
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6" >
                 	
                      <option value="1">Credit</option>
                      <option value="2">Debit</option>
                     
                </select>
              
              </div>
            </div>



         <div class="control-group">
              <label class="control-label">Select Year</label>
              <div class="controls">
                <select  name ="year"  id="year" class="span6">
                 
                   	@if(count($allyear) >0 )
                   	@foreach($allyear as $showyear)
                   			<option>{{$showyear->date}}</option>
                   	@endforeach
                   	@endif
                </select>
              
              </div>
            </div>


         <div class="control-group">
              <label class="control-label">Select Month</label>
              <div class="controls">
                <select  name ="month"  id="month" class="span6">
                 
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                       <option value="06">June</option>
                       <option value="07">July</option>
                       <option value="08">August </option>
                       <option value="09">September </option>
                       <option value="10">October </option>
                       <option value="11">November </option>
                       <option value="12">December </option>
                  
                </select>
              
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
        
        <script type="text/javascript">
        	
      function  ShowMem(){

      	 var type = $('#Type').val();
        var branceid = $('#Brance').val();
 				
 					
 				

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Name');
          if(type != "Select One")
 				{

          $.ajax({
                url : '{{URL::to("showInvesMem")}}/'+type+'/'+branceid,
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


                  batchOption.append('<option value="'+value.fk_app_id+'and'+value.fk_invest_id+'">'+value.mem_name+'</option>');
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
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection