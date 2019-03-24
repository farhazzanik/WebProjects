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
           
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Share Withdraw</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('savesharewithdraw')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             
                <div class="control-group">
              <label class="control-label">Date</label>
              <div class="controls">
                <input type="text" name="date" id="date" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" placeholder="dd/mm/yyyy" class="datepicker span6">
                <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
              </div>
            </div>
 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6"  onchange="return ShowMem()">
                
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
              <label class="control-label">Select Member</label>
              <div class="controls">

              @if($id->fk_brance_id == '1')
                <select  name ="Member"  id="Member" class="span6" onchange="showsharpackage()">
                
                </select>
                @else

          <select  name ="Member"  id="Member" class="span6" onchange="showsharpackage()">
                  @if(count($selectMemnber) > 0)
                  @foreach($selectMemnber as $showData)
                    <option value="{{$showData->id}}">{{$showData->mem_name}}</option>
                    @endforeach
                    @endif
                </select>
                @endif
              
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">package</label>
              <div class="controls">

              
                <select  name ="package"  id="package" class="span6" onchange="showsharammount()">
                
                </select>
              
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Ammount</label>
              <div class="controls">

            <input type="text" name="amnt" id="amnt" class="span6" readonly="" placeholder="00">
              
              </div>
            </div>

                 <div class="control-group">
              <label class="control-label">withdraw</label>
              <div class="controls">

            <input type="text" name="withdraw" id="withdraw" class="span6" onkeyup="result()"  placeholder="00">
              
              </div>
            </div>

              <div class="control-group">
              <label class="control-label">Present Share</label>
              <div class="controls">

            <input type="text" name="presentshare" id="presentshare" class="span6"  readonly=""  placeholder="00">
              
              </div>
            </div>



             <div class="control-group">
                    
                      <div class="controls">
                          <input type="submit" name="submit" id="submit" class="btn btn-success">
                        </div>
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
       


function  ShowMem(){
  var branceid = $('#Brance').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Member');
        if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("sharewimeme")}}/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'">'+value.mem_name+'('+value.id+')'+'</option>');
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









function showsharlist(){


var brance = $('#Brance').val();
var Member = $('#Member').val();



  $("#tbodydata").load("{{URL::to('showssamm')}}"+'/'+brance+'/'+Member);

}


showsharlist();



 $('.datepicker').datepicker();




 function deteDate(getId){
              if(confirm("Are you sure you want to return this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('sharereturn')}}/"+getId,
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

showsharlist();

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

<script type="text/javascript">

       function showsharpackage() {
      var Member=$('#Member').val();
      // alert(Brance);
      if (Member!=0) {
      $.ajax({
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        url: '{{ url("showsharpackage") }}'+'/'+Member,
        type: 'POST',
        data: {Member: Member},
        success: function(data){
          $('#package').html(data);
        }
      });
  } 
  else {
    $('#package').html('<option value="0">Select A Package</option>');
  }
}; 


function showsharammount(){

  var Member = $('#Member').val();
  var package = $('#package').val();

    $.ajax({
    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
    url: '{{ url("showsharammount") }}',
    type: 'POST',
    data: {Member:Member,package:package},
    success:function(data){

      $('#amnt').val(parseFloat(data).toFixed(2));
    
    }
  });

}


function result(){

  var amnt = parseFloat($('#amnt').val());
  var withdraw = parseFloat($('#withdraw').val());
  var total = 0;
  if(withdraw != ""){

    total = amnt-withdraw;
    $('#presentshare').val(total);
  }else{
 $('#withdraw').val(0);
 $('#presentshare').val(amnt);
  }

}
</script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection