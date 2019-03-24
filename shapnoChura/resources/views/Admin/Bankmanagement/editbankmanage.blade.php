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
            <h5>Edit Bank Management</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('editsuccmangae')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
  


 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
                  <option value="{{$alldata[0]->fk_brance_id}}">{{$alldata[0]->branceName}}</option>
            
    
                  </select>
               </div>
            </div>


  @else 


      <input type="hidden" name="Brance" id="Brance" value="{{$id->fk_brance_id}}" class="span3">
      @endif
           
           
              <div class="control-group">
              
                <label class="control-label">Date </label>
              <?php
                       $explodedate = explode('-', $alldata[0]->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];?>
                <div class="controls">
                  <input type="text" class='datepicker span6'   data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy"  name="Date" id="Date" value="{{$renewdate}}">
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Bank Name </label>
            
                <div class="controls">

                  @if($id->fk_brance_id == '1')
                <select  name ="Bank"  id="Bank" class="span6">
             

          <option value="{{$alldata[0]->fk_bank_id}}">{{$alldata[0]->bank_name}}</option>
                  </select>
                @else
              

              <select  name ="Bank"  id="Bank" class="span6">

                 <option value="{{$alldata[0]->bank_name}}">{{$alldata[0]->fk_bank_id}}</option>
                   

                  </select>
                @endif


                    
                </div>
              </div>
            

                 <div class="control-group">
              
                <label class="control-label">Ac No </label>
            
                <div class="controls">
                  <input type="text"  readonly="" class='span6' placeholder="Ac No English" name="Ac" id="Ac" value="{{$alldata[0]->ac_no}}">
                </div>
              </div>
            
             

            <div class="control-group">
              <label class="control-label">Transaction Type </label>
              <div class="controls">
                
 
                <select  name ="Accounttype"  id="Accounttype" class="span6">
                    <option>{{$alldata[0]->transaction_type}}</option>
                   
                  </select>
               </div>
            </div>

                  <div class="control-group">
              
                <label class="control-label">Voucher No </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Voucher No English" name="Voucher" id="Ac" value="{{$alldata[0]->voucherNo}}">
                </div>
              </div>
           

               <div class="control-group">
              
                <label class="control-label">Ammount </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Ammount" id="Ammount" value="{{$alldata[0]->ammount}}" onkeyup="return sumTotaldep()">
                </div>
              </div>
<!-- 
                  <div class="control-group">
              
                <label class="control-label">Current Ammount </label>
            
                <div class="controls"> -->
                  <input type="hidden" class='span6' placeholder="12000" readonly="" name="Current" id="Current" value="{{$total}}">

                   <input type="hidden" class='span6' placeholder="12000" readonly="" name="hidCurrent" id="hidCurrent" value="{{$total}}">

<!-- 
                </div>
              </div> -->


                  <div class="control-group" id="staticParent">
                <label class="control-label">Narration</label>
                <div class="controls">
                          <textarea name="Narration" class="span6">{{$alldata[0]->naration}}</textarea>


 <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
<input type="hidden" name="upid" value="{{$alldata[0]->id}}">

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
        

         <meta name="_token" content="{!! csrf_token() !!}" />
         <script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
  $('.datepicker').datepicker();
  $('.datepickersss').datepicker();
   $('.datepickersssss').datepicker();
    $('.datepickersssssss').datepicker();
    $('.datepickesr').datepicker();

</script>
       <script type="text/javascript">  



function sumTotaldep()
{

  var type = $('#Accounttype').val();

    var Ammount = parseFloat($('#Ammount').val());
    var Current = parseFloat($('#Current').val());
      var hidCurrent = parseFloat($('#hidCurrent').val());

  var length = $("#Ammount").val().length;

var total = 0;
var totalsaving = 0;
if(type === "Saving" ){
 if (!isNaN(parseFloat($('#hidCurrent').val()))   && length != 0) {
       
    total = hidCurrent+Ammount;
     
      $('#Current').val(total);
    }else{

       $('#Current').val(hidCurrent);
    }
} 


if(type === "Withdraw" ){
 if (!isNaN(parseFloat($('#hidCurrent').val())) ) {
      

      if(hidCurrent >= Ammount && length != 0)  {
    total = hidCurrent-Ammount;
     
      $('#Current').val(total);
    }else{

       $('#Current').val(hidCurrent);
       $('#Ammount').val('');
    }

  }


} 

  

}




function showAc(){
   var branceid = $('#Brance').val();
   var bank = $('#Bank').val();
        $.ajax({
          
                    url : '{{URL::to("showAcNo")}}/'+branceid+'/'+bank,
                  type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
            
            $('#Ac').val(data);
              
            }
          
          
                    });
           $('#Ac').val('');
}



 function  ShowMem(){

  
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Bank');
        
          $.ajax({
                url : '{{URL::to("showMembank")}}/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'">'+value.bank_name+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          
                  $('#showUpazila').val("");

      }




        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection