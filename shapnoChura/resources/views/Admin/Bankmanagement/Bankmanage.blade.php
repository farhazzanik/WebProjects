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
              <li class="active"><a data-toggle="tab" href="#tab1">ADD</a></li>
              <li><a data-toggle="tab" href="#tab2">View</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Bank Management</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('manageAdd')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

            

 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6" onclick="return ShowMem();">
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
              
                <label class="control-label">Date </label>
            
                <div class="controls">
                  <input type="text" class='datepicker span6'    data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}"  name="Date" id="Date" value="{{date('m-d-Y')}}">
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Bank Name </label>
            
                <div class="controls">

                  @if($id->fk_brance_id == '1')
                <select  name ="Bank"  id="Bank" class="span6" 
                 onchange="return showAc(),showcurrent()">
             

    
                  </select>
                @else
              

              <select  name ="Bank"  id="Bank" class="span6"  
              onchange="return showAc(),showcurrent()" >
                    @if(count($bankname) > 0)
                  @foreach($bankname as $showData)
                    <option value="{{$showData->id}}">{{$showData->bank_name}}</option>
                  @endforeach
                  @endif

                  </select>
                @endif


                    
                </div>
              </div>
            

                 <div class="control-group">
              
                <label class="control-label">Ac No </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Ac No English" name="Ac" id="Ac" readonly="" value="{{old('Ac')}}">
                </div>
              </div>
            
             

            <div class="control-group">
              <label class="control-label">Transaction Type </label>
              <div class="controls">
                
 
                <select  name ="Accounttype"  id="Accounttype" class="span6">
                   <option>Saving</option>
                  <option>Withdraw</option>
                   
                  </select>
               </div>
            </div>

                  <div class="control-group">
              
                <label class="control-label">Voucher No </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Voucher No English" name="Voucher" id="Ac" value="{{old('Voucher')}}">
                </div>
              </div>
           

               <div class="control-group">
              
                <label class="control-label">Ammount </label>
            
                <div class="controls">
                  <input type="text"  autocomplete="off"     class='span6' placeholder="12000" name="Ammount" id="Ammount"   onkeyup="sumTotaldep()" value="{{old('Ammount')}}"   >
                </div>
              </div>


                 <div class="control-group">
              
                <label class="control-label">Current Ammount </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" readonly="" name="Current" id="Current" value="{{old('Current')}}">

                   <input type="text" class='span6' placeholder="12000" readonly="" name="hidCurrent" id="hidCurrent" value="{{old('hidCurrent')}}">


                </div>
              </div>



                  <div class="control-group" id="staticParent">
                <label class="control-label">Narration</label>
                <div class="controls">
                          <textarea name="Narration" class="span6">{{old('Narration')}}</textarea>


 <input type="text" name="adminid" value="{{Auth::guard('admin')->user()->id}}">

                 </div>
              </div>
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
             </div>  </p>
            </div>
            <div id="tab2" class="tab-pane">
              <p>
                           <div class="widget-box">
   <form action="#" method="get" class="form-horizontal">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Information</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Bank Name</th>
                   <th>Ac No</th>
                  <th>Transaction  type</th>

                   <th>Voucher No</th>
                  <th>Ammount</th>

                    <th>Details</th>
                  <th>Brance Name</th>
                   <th>Added By</th>

                    <th>Action</th>
                </tr>
              </thead>
              <tbody>

              @if($id->id == '306' or $id->fk_brance_id =='1')
              @if(count($showAllData) > 0)
                @foreach($showAllData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>
                    <?php
                       $explodedate = explode('-', $showDAta->date);
       echo $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];?></td>
                  <td>{{$showDAta->bank_name}}</td>
                  <td>{{$showDAta->ac_no}}</td>
                  <td>{{$showDAta->transaction_type}}</td>
                  <td>{{$showDAta->voucherNo}}</td>
                  <td>{{$showDAta->ammount}}</td>
                    <td>{{$showDAta->naration}}</td>
                  <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="{{URL::to('editbankmanage')}}/{{$showDAta->id}}" class="btn btn-primary btn-mini" >Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
                @endforeach
                       @endif
                        @endif


                         @if($id->id != '306' or $id->fk_brance_id !='1')
              @if(count($adminWiseData) > 0)
                @foreach($adminWiseData as $showDAta)
                <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td> <?php
                       $explodedate = explode('-', $showDAta->date);
       echo $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];?></td>
                  <td>{{$showDAta->bank_name}}</td>
                  <td>{{$showDAta->ac_no}}</td>
                  <td>{{$showDAta->transaction_type}}</td>
                  <td>{{$showDAta->voucherNo}}</td>
                  <td>{{$showDAta->ammount}}</td>
                    <td>{{$showDAta->naration}}</td>
                  <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="{{URL::to('editbankmanage')}}/{{$showDAta->id}}" class="btn btn-primary btn-mini" >Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
         
                @endforeach
                       @endif
                        @endif
            
           </tbody>
            </table>
          </div>
          </form>
        </div>
  
           </p>
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



function showcurrent(){

    var branceid = $('#Brance').val();
   var bank = $('#Bank').val();
        $.ajax({
          
                    url : '{{URL::to("showCurrent")}}/'+branceid+'/'+bank,
                  type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
            
            $('#Current').val(data);
            $('#hidCurrent').val(data);
            
              
            }
          
          
                    });
         $('#Current').val('');
$('#hidCurrent').val('')
$('#Ammount').val('');
            

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

           $('#Current').val('');
$('#hidCurrent').val('')
$('#Ammount').val('');
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

                  $('#Current').val('');
$('#hidCurrent').val('')
$('#Ammount').val('');
$('#Ac').val('');

      }




 function deteDate(getId){
             if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('deleteBankmang')}}/"+getId,
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
    else{
        return false;
    }
          }

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection