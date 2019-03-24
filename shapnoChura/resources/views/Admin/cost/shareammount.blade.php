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
            <h5>Share Ammount</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('saveshare')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             

 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6"  onchange="return showArea(),ShowMem()">
                
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



          <!--<div class="control-group">-->
          <!--    <label class="control-label">Select Root</label>-->
          <!--    <div class="controls">-->

          <!--    @if($id->fk_brance_id == '1')-->
          <!--      <select  name ="Area"  id="Area" class="span6">-->
                
          <!--      </select>-->
          <!--      @else-->

          <!--<select  name ="Area"  id="Area" class="span6">-->
          <!--        @if(count($brancewiseroot) > 0)-->
          <!--        @foreach($brancewiseroot as $showData)-->
          <!--          <option value="{{$showData->id}}">{{$showData->area_name}}</option>-->
          <!--          @endforeach-->
          <!--          @endif-->
          <!--      </select>-->
          <!--      @endif-->
              
          <!--    </div>-->
          <!--  </div>-->



 <div class="control-group">
              <label class="control-label">Date
</label>
              <div class="controls">
                <input type="text" name="date"
                  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

           

               
                <div class="control-group">
              <label class="control-label">Share Number</label>
              <div class="controls">
                 <input type="text" name="sharenumber" class="span6">
               </div>
            </div>


             
          <div class="control-group">
              <label class="control-label">Package</label>
              <div class="controls">
                  
                  <select class="span6" name="package">
                      
                    <option value="1">100 Tk</option>
                    <option value="2">500 Tk</option>
                    
                  </select>
                 
               </div>
            </div>



<div class="control-group">
              <label class="control-label">Ammount
</label>
              <div class="controls">
                  <input type="text" name="ammount" class="span6">
               </div>
            </div>
            
            




              <div class="control-group">
              
                <label class="control-label">Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="Address">{{old('Address')}}</textarea>
                </div>
              </div>
            
             

            
              <div class="control-group">
              
                <label class="control-label">Details</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="Details">{{old('Details')}}</textarea>
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
                  <th>Member Name</th>
                  <th>Share Number</th>
                   <th>Ammount</th>
                   <th>Address</th>
                   <th>Details</th>
                   <th>Added By</th>
                   <th>Brance Name </th>
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
          
                   
@if($id->id == '306' or $id->fk_brance_id =='1')
               @if(count($allData) > 0)
                @foreach($allData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td><?php
 $explode = explode('-', $showDAta->date);
               echo   $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  
                  ?>

                  </td>
                 <td>{{$showDAta->mem_name}}</td>
                 <td>{{$showDAta->sharenumber}}</td>
                  <td>{{$showDAta->ammount}}</td>
                  <td>{{$showDAta->address}}</td>
                  <td>{{$showDAta->details}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    
                 <td>{{$showDAta->brancName}}</td>

                

                  <td class="center">

                    <div class="fr"> 
                 <!--  <a href="editINcome/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>

                      </div></td>
                </tr>
         
                @endforeach
                       @endif
@endif
  @if($id->id != '306' or $id->fk_brance_id !='1')

                         @if(count($adminWiseData) > 0)
                @foreach($adminWiseData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                   <td><?php
 $explode = explode('-', $showDAta->date);
               echo   $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  
                  ?></td>
                 <td>{{$showDAta->mem_name}}</td>
                 <td>{{$showDAta->sharenumber}}</td>
                  <td>{{$showDAta->ammount}}</td>
                  <td>{{$showDAta->address}}</td>
                  <td>{{$showDAta->details}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    
                 <td>{{$showDAta->brancName}}</td>


                  <td class="center">

                    <div class="fr"> 
                <!--   <a href="editINcome/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>

                  

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










      function  showTitle(){

       
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Title');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showincomeTitle")}}/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'">'+value.title+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          }
                  

         
         $('#Title').val(''); 
        

      }


     




 $('.datepicker').datepicker();




 function deteDate(getId){
              if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('shareamoutdel')}}/"+getId,
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