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
            <h5>MMPDS Profit Withdraw </h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('mmpdsammwith')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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


  <input type="hidden" name="memberid" id="memberid" value="{{old('memberid')}}">



                



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
                <select  name ="Member"  id="Member" class="span6" onchange="showData()">
                
                </select>
                @else

          <select  name ="Member"  id="Member" class="span6" onchange="showData()">
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
              
                <label class="control-label">Total Nett </label>
            
                <div class="controls">


                
 <input type="text" class='span6' name="famount"  id="famount" value="{{old('famount')}}" readonly="">



                </div>
              </div>
            
            

            <div class="control-group">
              
                <label class="control-label">Total Profit </label>
            
                <div class="controls">


                  <input type="text" class='span6' placeholder="120000" name="tProfit"  id="tProfit" value="{{old('tProfit')}}" readonly="">
                  


                </div>
              </div>
            
            

            


              
              <div class="control-group">
                    <label class="control-label">Withdraw Type</label>
                    <div class="controls">
                        <select id="Status" name="Status" class="span6">
                          <option value="1">Nett</option>
                          <option value="2">Profit</option>

                        </select>
                  
                    </div>
            </div>


            <div class="control-group">
              
                <label class="control-label">Withdraw</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="pwith"  id="pwith" value="{{old('pwith')}}" onkeyup="checkammount()">
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
                  <th>Nett Withdraw </th>
                  <th>Profit Withdraw </th>
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
                   <td>
                     @if($showDAta->status ==1)
                     {{$showDAta->withdraw}}
                     @endif


                   </td>

                   <td>    @if($showDAta->status ==2)
                     {{$showDAta->withdraw}}
                     @endif</td>
                  
                
                  <td>{{$showDAta->adminname}}</td>
                   <td>{{$showDAta->brancename}}</td>
                    
                  <td class="center">

                    <div class="fr"> 
            <!--    <a href="{{URL::to('mmpdsregedit')}}/{{$showDAta->id}}/{{$showDAta->fk_brance_id}}" class="btn btn-primary btn-mini">Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>
<!--   <a target="_blank" href="mmpdsReportShow/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Show Report</a> -->
                    </div></td>
                </tr>
         
                @endforeach
                       @endif
                        @endif

 @if($id->id != '306' or $id->fk_brance_id !='1')
                        @if(count($adminWiseBrance) > 0)
                @foreach($adminWiseBrance as $showDAta)
                <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>
                    <?php $explodedate = explode('-', $showDAta->date);
echo $createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0]; ?></td>
                  <td>{{$showDAta->mem_name}}</td>
                   <td>
                     @if($showDAta->status ==1)
                     {{$showDAta->withdraw}}
                     @endif


                   </td>

                   <td>    @if($showDAta->status ==2)
                     {{$showDAta->withdraw}}
                     @endif</td>
                  
                
                  <td>{{$showDAta->adminname}}</td>
                   <td>{{$showDAta->brancename}}</td>
                    
                  <td class="center">

                    <div class="fr"> 
            <!--    <a href="{{URL::to('mmpdsregedit')}}/{{$showDAta->id}}/{{$showDAta->fk_brance_id}}" class="btn btn-primary btn-mini">Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>
<!--   <a target="_blank" href="mmpdsReportShow/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Show Report</a> -->
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

  var famount = parseFloat($('#famount').val());
  var tProfit = parseFloat($('#tProfit').val());
  var status = $('#Status').val();

  if(status == 1){
      
    var ammount =     parseFloat($('#pwith').val());
      if(ammount <= famount){

      }else{
        $('#pwith').val('');
      }

  }else if(status == 2){
     var ammount =     parseFloat($('#pwith').val());
      if(ammount <= tProfit){

      }else{
        $('#pwith').val('');
      }
  }else{

    alert('Click Withdraw Type');
  }

  
    
  


}


function showData(){
  
  var memid = $('#Member').val();
  var date1 = $('#Todaydate').val();
  var totalnet = 0;
  var totalprofit = 0;
  //alert(name);
        $.ajax({
          
                url : '{{URL::to("mmpdsshowdd")}}/'+memid+'/'+date1,
                type:'GET',
                dataType:'json',
                success: function(data) {
totalnet =  data.ammount-data.oldnet;
totalprofit = data.profit-data.oldprofit;
               
                $('#tProfit').val(totalprofit);
                $('#memberid').val(data.memid);
               $('#famount').val(totalnet);
                
              
            }
       });
$('#tProfit').val('');
         $('#memberid').val('');
                 $('#famount').val('');
                
}


function  ShowMem(){

       
        var branceid = $('#Brance').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Member');
        if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("mmpdsprwithmem")}}/'+branceid,
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





 function deteDate(getId){
             if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('mmpdswithdel')}}/"+getId,
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