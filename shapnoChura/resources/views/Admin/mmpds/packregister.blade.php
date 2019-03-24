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
            <h5>Package Registeration</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('packregmmpds')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             

 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  
                onchange="return ShowMem()" name ="Brance"  id="Brance" class="span6">

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













                      <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">



                <div class="control-group">
              <label class="control-label">Account No
</label>
              <div class="controls">
                <input type="text" name="accno" id="accno"  class="span6" />
                    </div>
                  </div>


           <div class="control-group">
              <label class="control-label">Today Date
</label>
              <div class="controls">
                <input type="text" name="Todaydate" id="Todaydate" data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

              <div class="control-group">
              <label class="control-label">Select Member</label>
              <div class="controls">

              @if($id->fk_brance_id == '1')
                <select  name ="Member"  id="Member" class="span6">
                
                </select>
                @else

          <select  name ="Member"  id="Member" class="span6">
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
              <label class="control-label">Select Package</label>
              <div class="controls">


          <select   name ="Package"  id="Package" class="span6" onchange="return showammount()">
                  <option>Select One</option>
                  @if(count($showpack) > 0)
                  @foreach($showpack as $showData)
                    <option value="{{$showData->num_of_month}}">{{$showData->num_of_month}} Month</option>
                    @endforeach
                    @endif
                </select>
           
              
              </div>
            </div>
            
  <input type="hidden" class='span3' placeholder="120000" name="oldammount" id="oldammount">
  <input type="hidden" class='span3' placeholder="120000" name="oldprofit" id="oldprofit">
 
            

                 <div class="control-group">
              
                <label class="control-label">Saving Ammount </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Ammount"  id="Ammount" value="{{old('Ammount')}}" onkeyup="return checkammount()">
                </div>
              </div>
            
  <div class="control-group">
              
                <label class="control-label">Profit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Profit" id="Profit" value="{{old('Profit')}}" readonly="">
                </div>
              </div>

             
         
    



             
 <div class="control-group">
              <label class="control-label">Reference By</label>
              <div class="controls">
              <input type="text" name="Reference" class="span6">
              
              </div>
            </div>

               <div class="control-group">
              
                <label class="control-label">Comments </label>
            
                <div class="controls">
                  
                      <textarea class="span6" name="comments" id="comments">{{old('comments')}}</textarea>

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
                  <th>Member Name </th>
                  <th>Number Of month </th>
                  <th>Ammount </th>
                  <th>Profit </th>
                  <th>Added By</th>
                  <th>Brance Name </th>
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
          @if($id->id == '306' or $id->fk_brance_id =='1')
              @if(count($showAllDate) > 0)
                @foreach($showAllDate as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>
                    <?php $explodedate = explode('-', $showDAta->date);
echo $createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0]; ?></td>
                  <td>{{$showDAta->mem_name}}</td>
                   <td>{{$showDAta->fk_pack_id}} Months</td>

                   <td>{{$showDAta->ammount}}</td>
                   <td>{{$showDAta->profit}}</td>

                
                  <td>{{$showDAta->adminname}}</td>
                   <td>{{$showDAta->brancename}}</td>
                    
                  <td class="center">

                    <div class="fr"> 
            <!--    <a href="{{URL::to('mmpdsregedit')}}/{{$showDAta->id}}/{{$showDAta->fk_brance_id}}" class="btn btn-primary btn-mini">Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>
  <a target="_blank" href="mmpdsReportShow/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Show Report</a>
                    </div></td>
                </tr>
         
                @endforeach
                       @endif
                        @endif

 @if($id->id != '306' or $id->fk_brance_id !='1')
                        @if(count($adminWiseBrance) > 0)
                @foreach($adminWiseBrance as $showDAta)
                <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td> <?php $explodedate = explode('-', $showDAta->date);
 echo $createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0]; ?></td>
                  <td>{{$showDAta->mem_name}}</td>
                   <td>{{$showDAta->fk_pack_id}}Months</td>

                   <td>{{$showDAta->ammount}}</td>
                   <td>{{$showDAta->profit}}</td>

                
                  <td>{{$showDAta->adminname}}</td>
                   <td>{{$showDAta->brancename}}</td>
                    
                  <td class="center">

                    <div class="fr"> 
               <!--     <a href="{{URL::to('mmpdsregedit')}}/{{$showDAta->id}}/{{$showDAta->fk_brance_id}}" class="btn btn-primary btn-mini">Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>
<a target="_blank" href="mmpdsReportShow/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Show Report</a>
                    </div></td>
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
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('packageModel')}}"+'/'+id);
        }

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
  var date = $('#Todaydate').val();
  //alert(name);
        $.ajax({
          
                url : '{{URL::to("showOldpackamm")}}/'+Package+'/'+date,
                type:'GET',
                dataType:'json',
                success: function(data) {
                 $('#oldammount').val(data.ammount);
                 $('#oldprofit').val(data.profit);
              
            }
       });
          $('#oldammount').val('');
           $('#oldprofit').val('');
           $('#Profit').val('');
              $('#Ammount').val('');
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
             if(confirm("Are you sure you want to delete this?")){
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
    else{
        return false;
    }
          }

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection