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
            <form class="form-horizontal" method="post" action="{{URL::to('expireaccreport')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
              

@if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6" onchange="getroot();">
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


  @else 


      <input type="hidden" name="Brance" id="Brance" value="{{$id->fk_brance_id}}" class="span3">
      @endif

      
             <div class="control-group">
              <label class="control-label">Root</label>
              <div class="controls">
                <select  name ="root"  id="root" class="span6" >
                 <option value="0">Select A Root</option>
                </select>
              
              </div>
            </div>

         <div class="control-group">
              <label class="control-label">Select One </label>
              <div class="controls">
                <select  name ="name"  id="name" class="span6" onchange="showpacks()">
                 <option>Select One</option>
                      <option value="1">Saving</option>
                      <option value="2">Invest</option>
                     
                </select>
              
              </div>
            </div>




        <div class="control-group">
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6" >
                     <option>Select Any One</option> 
                </select>
              
              </div>
            </div>

              
         
         <div class="control-group">
              <label class="control-label">Date</label>
              <div class="controls">
                <select  name ="dmy"  id="dmy" class="span6" onchange="showReport()">
                      <option value="10">Select One</option>
                      <!-- <option value="5">Daily</option>
                      <option value="1">Date TO Date</option> -->
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
                   
                </select>
              
              </div>
            </div>


          
          
      <div class="control-group" id="group">
             
            </div>


      <div class="control-group" id="year">
             
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
            function showReport(){

                            $('#year').html('');
                            $('#group').html('');
                    var type = $('#dmy').val();
                    if(type=='10'){
                          alert('Please Select Type');
                           $('#group').html('');
                    }
                    else{


                        if(type==='5'){

                            $('#year').html('');
                            $('#group').html('');
                              $('#group').append('<label class="control-label">Date</label><div class="controls"><input type="text" name="data" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" placeholder="dd/mm/yyyy" class="datepicker span6"> </div>');
                        }
                        else if(type==='1'){

                            $('#year').html('');
                            $('#group').html('');
                              $('#group').append('<label class="control-label">Date</label><div class="controls"><input type="text" name="firstdate" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" placeholder="dd/mm/yyyy" class="datepicker span6"><br><input type="text" name="seconddate" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" placeholder="dd/mm/yyyy" class="datepicker span6"> </div>');
                        }
                        else if(type==='2'){
                            $('#year').html('');
                            $('#group').html('');
                              $('#group').append('<label class="control-label">Select Month</label> <div class="controls"> <select  name ="month"  id="month" class="span6"><option value="01">January</option><option value="02">February</option><option value="03">March</option> <option value="04">April</option> <option value="05">May</option> <option value="06">June</option> <option value="07">July</option><option value="08">August </option> <option value="09">September </option> <option value="10">October </option> <option value="11">November </option>  <option value="12">December </option></select></div>');

                              $('#year').append('<label class="control-label">Year</label><div class="controls"><input type="text" name="year"  placeholder="2017" class="datepicker span6"> </div>');
                        }else if(type==='3')
                        {
                           $('#year').html('');
                            $('#group').html('');
                            $('#year').append('<label class="control-label">Year</label><div class="controls"><input type="text" name="year"  placeholder="2017" class="datepicker span6"> </div>');

                        }


                        else{

                          $('#year').html('');
                            $('#group').html('');
                        }



                    }

                    

            }


             function showpacks(){

        var brance      = $('#Brance').val();
        var loader      = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Type');
        var type        = $('#name').val();


   

        if(brance != "Select One")
        {


          if(type == '2'){

          batchOption.html('<option value="all">All</option><option value="5">Daily</option><option value="1">Weekly</option><option value="2">Monthly</option><option value="3">Yearly</option><option value="4">General</option>');

         
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

<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
  $('.datepicker').datepicker();
  $('.datepickersss').datepicker();
   $('.datepickersssss').datepicker();
    $('.datepickersssssss').datepicker();
    $('.datepickesr').datepicker();

</script>
     <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
     <script type="text/javascript">
       function getroot() {
      var Brance=$('#Brance').val();
      // alert(Brance);
      if (Brance!=0) {
      $.ajax({
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        url: '{{ url("getroot") }}'+'/'+Brance,
        type: 'POST',
        data: {Brance: Brance},
        success: function(data){
          $('#root').html(data);
        }
      });
  } 
  else {
    $('#root').html('<option value="0">Select A Root</option>');
  }
};
</script>
     </script>
@endsection
