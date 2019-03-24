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
            <h5>Collection Sheet</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('showcolshet')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
              



          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6" onchange="showArea()">
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
              <label class="control-label">Select Root</label>
              <div class="controls">
              
                <select  name ="Area"  id="Area" class="span6">
                 
                </select>
            
              </div>
            </div>


            
             <div class="control-group">
             
              <div class="controls">
                  <input style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;" type="text" name="from" id="from" class="span3"> &nbsp;&nbsp; <span for="to" class="text-warning"><b>- To Limit No - </b></span> <input  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;" type="text" name="to" id="to" class="span3" onkeyup="return checkDAta()">


              </div>

              <label class="control-label" id="label"></label>


            </div>


              
         
       
          
          
     
          
              <div class="form-actions" style="text-align: center;">
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
          
          function checkDAta(){

            var from = parseFloat($('#from').val());
            var to = parseFloat($('#to').val());
            var total = to-from;
              //alert(total);
            if(total < 36){
                $('#label').html('');
            }else{
  $('#label').html('Less then 35 or equal');
              $('#to').val('');
            }
          }


             function showArea(){

        var brance = $('#Brance').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Area');
       // alert(Reference);
        if(brance != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showarewiseb")}}/'+brance,
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


                  batchOption.append('<option value="'+value.areaid+'">'+value.area_name+'</option>');
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
@endsection