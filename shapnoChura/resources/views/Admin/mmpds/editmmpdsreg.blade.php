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
              <li class="active"><a data-toggle="tab" href="#tab1">Edit</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Package Registeration</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('editsuccmmpds')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

       



<input type="hidden" name="autoid" value="{{$allDAta[0]->id}}">


<input type="hidden" name="Brance" value="{{$allDAta[0]->fk_brance_id}}">

                      <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
               


           <div class="control-group">
              <label class="control-label">Today Date
</label>
              <div class="controls">
                <input type="text" name="Todaydate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

              <div class="control-group">
              <label class="control-label">Select Member</label>
              <div class="controls">
 <select  name ="Member"  id="Member" class="span6">
               
                    <option value="{{$allDAta[0]->fk_mem_id}}">{{$allDAta[0]->mem_name}}</option>
           </select>
                
              </div>
            </div>
            

              <div class="control-group">
              <label class="control-label">Select Package</label>
              <div class="controls">


          <select   name ="Package"  id="Package" class="span6" onchange="return showammount()">
                
                   <option value="{{$allDAta[0]->fk_pack_id}}">{{$allDAta[0]->packname}}</option>
                  @if(count($showpack) > 0)
                  @foreach($showpack as $showData)
                  @if($showData->id != $allDAta[0]->fk_pack_id)
                    <option value="{{$showData->id}}">{{$showData->name}}</option>
                        @endif
                    @endforeach
                    @endif
                </select>
              
              
              </div>
            </div>
            
  <input type="hidden" class='span3' placeholder="120000" name="oldammount" id="oldammount">
  <input type="hidden" class='span3' placeholder="120000" name="oldprofit"  id="oldprofit">
 
            

                 <div class="control-group">
              
                <label class="control-label">Saving Ammount </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Ammount" id="Ammount" value="{{$allDAta[0]->ammount}}" onkeyup="return checkammount()">
                </div>
              </div>
            
  <div class="control-group">
              
                <label class="control-label">Profit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Profit" id="Profit" value="{{$allDAta[0]->profit}}" readonly="">
                </div>
              </div>

             
         
    



             
 <div class="control-group">
              <label class="control-label">Reference By</label>
              <div class="controls">
              
              

              <select  name ="Reference"  id="Reference" class="span6" >
                 
                 <option value="{{$allDAta[0]->fk_refer_id}}">{{$allDAta[0]->empname}}</option>
               
               
                </select>

               
              
              </div>
            </div>

               <div class="control-group">
              
                <label class="control-label">Comments </label>
            
                <div class="controls">
                  
                      <textarea class="span6" name="comments" id="comments">{{$allDAta[0]->comment}}</textarea>

                </div>
              </div>
            


              
            
             

            
           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
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
       <script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
        <script type="text/javascript">
 

        $('.datepicker').datepicker();


function checkammount(){

  var oldammount = parseFloat($('#oldammount').val());
  var oldprofit = parseFloat($('#oldprofit').val());
  var Ammount =  parseFloat($('#Ammount').val());
  var Profit =  parseFloat($('#Profit').val());
  var oldammountlen =  $("#oldammount").val().length;
  var checprofit = 0;
   
checprofit = oldprofit/oldammount*Ammount;
$('#Profit').val(checprofit);
  
    
  


}
function showammount(){
  var Package = $('#Package').val();
  //alert(name);
        $.ajax({
          
                url : '{{URL::to("showOldpackamm")}}/'+Package,
                type:'GET',
                dataType:'json',
                success: function(data) {
                 $('#oldammount').val(data.ammount);
                 $('#oldprofit').val(data.profit);
              
            }
       });
          $('#oldammount').val('');
           $('#oldprofit').val('');
          
             
}



function showrefer(){
  
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Reference');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showreferAdd")}}/'+branceid,
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



function  ShowMem(){

       
        var branceid = $('#Brance').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Member');
        if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("memaddshowmem")}}/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'">'+value.mem_name+'</option>');
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





function  selectpack(){

       
        var branceid = $('#Brance').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Package');
        if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showPackageRegis")}}/'+branceid,
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
                  $('#showUpazila').val("");

      }



 function deteDate(getId){
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('mmpdspackregdel')}}/"+getId,
            data: {id:getId},
            dataType: 'json',
            success: function (data) {
               //console.log(data);

                 
if(data.success)
{


   $.gritter.add({
     title:data.status,
     text: 'Data Update Successfully',
      image:  '{{URL::to("/")}}/public/NeddImg/okkk.png',
      sticky: false
       
    });   

    $('#tr-'+getId).hide();



} else if(data.error){

$.gritter.add({
     title: data.error2,
     text:  data.status,
      image:  '{{URL::to("/")}}/public/NeddImg/delete.png',
      sticky: false
       
    });  
 
}

              
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

          }

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection