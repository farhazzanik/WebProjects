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
            <h5>Show Report</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('TypeWisReport')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
              <label class="control-label">Select One </label>
              <div class="controls">
                <select  name ="name"  id="name" class="span6" onchange="showpack()">
                 <option>Select One</option>
                      <option value="1">Saving</option>
                      <option value="2">Invest</option>
                     
                </select>
              
              </div>
            </div>


              
         
         <div class="control-group">
              <label class="control-label">Type</label>
                <div class="controls">
                  <select  name ="Type"  id="Type" class="span6">
                      
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
                     

   batchOption.append('<option>All</option>');
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




        function showpack(){

        var brance      = $('#Brance').val();
        var loader      = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Type');
        var type        = $('#name').val();


   

        if(brance != "Select One")
        {


          if(type == '2'){

          batchOption.html('<option value="5">Daily</option><option value="1">Weekly</option><option value="2">Monthly</option><option value="3">Yearly</option><option value="4">General</option>');

         
          }else{
batchOption.html("");
              $.ajax({
                url : '{{URL::to("showpack")}}',
                type:'GET',
                dataType:'json',
                beforeSend:function(){
                        $("#districloader").html(loader);
                },  
                success:function(data){

                  batchOption.empty();
                    batchOption.append('<option value="" selected disabled>Select One</option>');
                    $.each(data,function(index,value){
                     
                  batchOption.append('<option value="'+value.id+'">'+value.name+'</option>');
              
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });



          }





          




          }
                  $('#Type').val("");

        }


        
        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection