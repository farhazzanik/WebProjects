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
              <li class="active"><a data-toggle="tab" href="#tab1">Member Mobile List</a></li>
            
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Member Mobile List</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('showMember')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

          @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
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

       <script type="text/javascript">
         

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
@endsection