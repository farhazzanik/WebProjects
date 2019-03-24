  @extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>

   

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body" >
          <p>
                  

          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    
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
            <h5>Employee Salary Setup</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('salarysetup')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  onchange="return showrefer()" id="Brance" class="span6">
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
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="date"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" class="datepickersss span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>



                <div class="control-group">
              <label class="control-label">Select Employee</label>
              <div class="controls">
                

@if($id->fk_brance_id == '1')
                <select  name ="Employee"  id="Employee" class="span6">
                  
               
               
                </select>
                @else
              

              <select  name ="Employee"  id="Employee" class="span6">
                    @if(count($AllEmployee) > 0)
                  @foreach($AllEmployee as $showData)
                    <option value="{{$showData->id}}">{{$showData->Name}}</option>
                  @endforeach
                  @endif

                  </select>
                @endif
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
               <span id="loader"></span>
              </div>
            </div>

            

             
                <div class="control-group">
              <label class="control-label"> Salary
</label>
              <div class="controls">
                <input type="text" name="ammount"  placeholder="12000" class="span6" />
               </div>
            </div>



 <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <label>
                        <input type="radio" name="Status" value="1" />
                        Active</label>
                      <label>
                        <input type="radio" name="Status" value="2" />
                        Inactive</label>
                  
                    </div>
            </div>


           
             
              <div class="form-actions">
                <input type="submit"  value="Save" class="btn btn-success">
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
                  <th>Employee Name</th>
                  <th>Ammount</th>
                    <th>Status</th>
                   <th>Brance Name</th>
                  <th>Added By </th>
                  <th>Acction </th>
                </tr>
              </thead>
              
              <tbody>
               @if($id->id == '306' or $id->fk_brance_id =='1')
              @if(count($showAllData) > 0)
                @foreach($showAllData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->empname}}</td>
                  <td>{{$showDAta->ammount}}</td>
                    <td>
                        @if($showDAta->status ==='1')
                          Active
                        @else
                          Inactive
                        @endif

                    </td>
                 
                      <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="#" onclick="loadModel('{{$showDAta->id}}')"
                      class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" >Edit</a>
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
                  <td>{{$showDAta->empname}}</td>
                  <td>{{$showDAta->ammount}}</td>
                    <td>
                        @if($showDAta->status ==='1')
                          Active
                        @else
                          Inactive
                        @endif

                    </td>
                
                      <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="#" onclick="loadModel('{{$showDAta->id}}')"
                      class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" >Edit</a>
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
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('salaryedit')}}"+'/'+id);
        }

       


  $('.datepickersss').datepicker();




function showrefer(){
  
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Employee');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showEmpsalarysetu")}}/'+branceid,
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




 function deteDate(getId){
              if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('SalayDelete')}}/"+getId,
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