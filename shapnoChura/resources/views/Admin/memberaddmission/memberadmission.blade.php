@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>




    
    <div class="row-fluid">
      <div class="span12">
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
            <h5>Member Addmision Information</h5>
          </div>
              <div class="widget-content nopadding">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{URL::to('saveMember')}}" >
             {{ csrf_field() }}


                 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select onchange="return ShowMem(),showrefer()"  name ="Brance"  id="Brance" class="span6">
                
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
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="Todaydate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepickesr span6" />
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
              <label class="control-label">Reg. ID
</label>
              <div class="controls">
                <input type="text" name="Reg"   class="span6" />
                </div>
            </div>


            <div class="control-group">
              <label class="control-label">Scheme Title</label>
              <div class="controls">
                <select  name ="Packge"  id="Packge" class="span6">
                 
                     @if(count($packageType) > 0)
                  @foreach($packageType as $showData)
                    <option value="{{$showData->id}}and{{$showData->commision}}">{{$showData->name}}</option>
                    @endforeach
                    @endif
               
                </select>
              
              </div>
            </div>



 


             <div class="control-group">
              
                <label class="control-label">Scheme Duration</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Package Expiration date" name="PackageExdate" id="PackageExdate" value="{{old('PackageExdate')}}">
                  
                </div>
              </div>
      

   <div class="control-group">
              <label class="control-label">Scheme Expiration date
</label>
              <div class="controls">
                <input type="text" name="Expiration" placeholder="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" class=" span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>


            

            <div class="control-group">
              
                <label class="control-label">Initial deposit</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Amount of installment" name="installment" id="installment" value="{{old('installment')}}">
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                </div>
              </div>
       

               <div class="control-group">
              
                <label class="control-label">Total Installment</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Installment number" name="number" id="number" value="{{old('number')}}">
                </div>
              </div>
            
       <div class="control-group">
              
                <label class="control-label">Periodic payment</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Periodic payment" name="Periodic" id="Periodic" value="{{old('Periodic')}}">
                  
                </div>
              </div>

                     <div class="control-group">
              
                <label class="control-label">Monthly payment</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Monthly payment" name="Monthly" id="Monthly" value="{{old('Monthly')}}">
                  
                </div>
              </div>


              
            
         

            <div class="control-group">
              <label class="control-label">Comments
</label>
              <div class="controls">
               
                    <textarea name="Comments" id="Comments" style="width: 400px;" rows="4">{{old('Comments')}}</textarea>
                </div>
            </div>


 <div class="control-group">
              <label class="control-label">Staff's Name </label>
              <div class="controls">
               @if($id->fk_brance_id == '1')
                <select  name ="Reference"  id="Reference" class="span6" onchange="showArea()">
                  
               
               
                </select>
                @else
              

              <select  name ="Reference"  id="Reference" class="span6" onchange="showArea()">
                    @if(count($referenceBy) > 0)
                  @foreach($referenceBy as $showData)
                    <option value="{{$showData->id}}">{{$showData->Name}}</option>
                  @endforeach
                  @endif
               
               
               
                </select>

                @endif
              
              </div>
            </div>


             <div class="control-group">
              <label class="control-label">Select Area</label>
              <div class="controls">
              
                <select  name ="Area"  id="Area" class="span6">
                 
                </select>
            
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6">
                 
                      <option value="5">Daily</option>
                      <option value="1">Weekly</option>
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
                      <option value="4">General</option>
                </select>
              
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

            


<div class="control-group">
              <label class="control-label"><b>Nominee information : </b>
</label>
              
            </div>



              <div class="control-group">
              
                <label class="control-label">Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Name" name="owName" id="owName" value="{{old('owName')}}">
                </div>
              </div>

                 <div class="control-group">
              
                <label class="control-label">Email  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="exmaple@mail.com " name="Email" id="Email" value="{{old('Email')}}">
                </div>
              </div>

                <div class="control-group">
              <label class="control-label">Birth date
</label>
              <div class="controls">
                <input type="text" name="Birth"  value="{{old('Birth')}}" class="span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>



                <div class="control-group">
              <label class="control-label">Father / Husband
</label>
              <div class="controls">
                <input type="text" name="Husband" placeholder="Father / Husband"  value="{{old('Husband')}}" class="span6" />
                
            </div>
            </div>



                <div class="control-group">
              <label class="control-label">Mother / Wife
</label>
              <div class="controls">
                <input type="text" name="Wife"  placeholder="Mother / Wife"   value="{{old('Wife')}}" class="span6" />
                
            </div>
            </div>

              <div class="control-group">
              <label class="control-label">Occupation
</label>
              <div class="controls">
                <input type="text" name="Occupation"   placeholder="Occupation"   value="{{old('Occupation')}}" class="span6" />
                
            </div>

  
            </div>


              <div class="control-group">
              <label class="control-label">  Relation with accounting
</label>
              <div class="controls">
                <input type="text" name="Relation"  placeholder="Relation with accounting"  value="{{old('Relation')}}" class="span6" />
                
            </div>

  
            </div>


              <div class="control-group">
              <label class="control-label">  Amount of part
</label>
              <div class="controls">
                <input type="text" placeholder="10%" name="Amountpart"  value="{{old('Amountpart')}}" class="span6" />
                
            </div>

  
            </div>

                

              



              <div class="control-group">
              
                <label class="control-label">Present Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Present">{{old('Present')}}</textarea>
                </div>
              </div>
            
              <div class="control-group">
              
                <label class="control-label">Permanent  Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{old('Permanent')}}</textarea>
                </div>
              </div>
            

 <div class="control-group">
              
                <label class="control-label">Nominee Image</label>
            
                <div class="controls">
                
                          <input type="file" name="memiimg" accept="image/*">
                       </div>
              </div>
            

            <div class="control-group">
              
                <label class="control-label">Nominee Sign</label>
            
                <div class="controls">
                
                          <input type="file" name="Sign" accept="image/*">
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
                    <th>SL</th>
                   <th>Saving ID</th>
                  <th>Member Name</th>
                  <th>Package Name</th>
                  <th>Area Name</th>
                  <th>Periodic  Payment</th>
                  <th>Nominee Name</th>
                   <th>Status</th>
                  <th>Brance Name</th>
                  <th>Added By</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
  @if($id->id == '306' or $id->fk_brance_id =='1')
               @if(count($data) > 0)
               <?php $sl=0;?>
                @foreach($data as $showDAta)
                 <?php $sl++;?>
               <tr class="gradeX" id="tr-{{$showDAta->Addid}}">
                <td> <?php echo $sl;?></td>
                 <td>{{$showDAta->Addid}}</td>
                  <td>{{$showDAta->mem_name}}</td>
                 
                  <td>{{$showDAta->packname}}</td>
                  <td>{{$showDAta->area_name}}</td>
                  <td>{{$showDAta->Periodic}}</td>
                  <td>{{$showDAta->name}}</td>
                      <td> @if($showDAta->status == '1')
                      Active
                      @else
                        Inactive
                      @endif</td>
                 <td>{{$showDAta->branceName}}</td>

                 <td>{{$showDAta->adminname}}</td>

                  <td class="center">

                    <div class="fr"> 
                  <a href="editMemAdd/{{$showDAta->Addid}}" 
                      class="btn btn-primary btn-mini">Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->Addid}}')" >
                      Delete</a>

 <a target="_blank" href="showAddreport/{{$showDAta->Addid}}" 
                      class="btn btn-primary btn-mini">Show Report</a>
                      </div></td>
                </tr>
         
                @endforeach
                       @endif
@endif
  @if($id->id != '306' or $id->fk_brance_id !='1')

                         @if(count($adminWiseData) > 0)
                          <?php $sl=0;?>
                @foreach($adminWiseData as $showDAta)
                 <?php $sl++;?>
               <tr class="gradeX" id="tr-{{$showDAta->Addid}}">
                <TD> <?php echo $sl;?></TD>
                  <td>{{$showDAta->mem_name}}</td>
                 
                  <td>{{$showDAta->packname}}</td>
                  <td>{{$showDAta->area_name}}</td>
                  <td>{{$showDAta->Periodic}}</td>
                  <td>{{$showDAta->name}}</td>
                     <td>
                       
                        @if($showDAta->status == '1')
                      Active
                      @else
                        Inactive
                      @endif
                      
                     </td>
                 <td>{{$showDAta->branceName}}</td>

                 <td>{{$showDAta->adminname}}</td>

                  <td class="center">

                    <div class="fr"> 
                  <a href="editMemAdd/{{$showDAta->Addid}}" 
                      class="btn btn-primary btn-mini">Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->Addid}}')" >
                      Delete</a>

                       <a target="_blank" href="showAddreport/{{$showDAta->Addid}}" 
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
  $('.datepicker').datepicker();
  $('.datepickersss').datepicker();
   $('.datepickersssss').datepicker();
    $('.datepickersssssss').datepicker();
    $('.datepickesr').datepicker();

</script>

        <script type="text/javascript">
      

        function showArea(){

        var Reference = $('#Reference').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Area');
       // alert(Reference);
        if(Reference != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showAreforMemAdd")}}/'+Reference,
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


                  batchOption.append('<option value="'+value.fk_area_id+'">'+value.area_name+'</option>');
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


 function deteDate(getId){
             if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('DeleteMemAdd')}}/"+getId,
            data: {id:getId},
            dataType: 'json',
            success: function (data) {
               //console.log(data);

                 
if(data.success)
{


   $.gritter.add({
     title:data.status,
     text: 'Data Delete Successfully',
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