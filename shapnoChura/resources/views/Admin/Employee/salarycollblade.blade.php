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
            <h5>Employee Salary Collection</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::To('saveSalaryColl')}}"  name="basic_validate" id="basic_validate" id="formID" novalidate="novalidate">
             {{ csrf_field() }}

             @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  onchange="return showrefer()" id="Brance" class="span6">
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
                <input type="text" name="date" id="date"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" class="datepickersss span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>



                <div class="control-group">
              <label class="control-label">Select Employee</label>
              <div class="controls">
                

@if($id->fk_brance_id == '1')
                <select  name ="Employee"  id="Employee" class="span6"
                 onchange="return showCon()">
                  
               
               
                </select>
                @else
              

              <select  name ="Employee"  id="Employee" class="span6" onchange="return showCon()">
                    @if(count($AllEmployee) > 0)
                  @foreach($AllEmployee as $showData)
                    <option value="{{$showData->id}}">{{$showData->Name}}</option>
                  @endforeach
                  @endif

                  </select>
                @endif
                   <input type="hidden" id="adminid" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
               <span id="loader"></span>
              </div>
            </div>

            

             
                <div class="control-group">
              <label class="control-label"> Contact No
</label>
              <div class="controls">
                <input type="text" name="Contact" id="Contact"  placeholder="+8801756477771" readonly="" class="span6" />
               </div>
            </div>




         <div class="control-group">
              <label class="control-label">Select Month</label>
              <div class="controls">
                <select  name ="month"  id="month" class="span6">
                 
                      <option value="01">January</option>
                      <option value="02">February</option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August </option>
                      <option value="09">September </option>
                      <option value="10">October </option>
                      <option value="11">November </option>
                      <option value="12">December </option>
                  
                </select>
              
              </div>
            </div>

            
         <div class="control-group">
              <label class="control-label">Select Year</label>
              <div class="controls">
                <select  name ="Year"  id="Year" class="span6">
                 
                     <?php 
                $y=date('Y');
                $previous=$y-10;
                for($year = $y; $year >= $previous;  $year--)
                {
              ?>
              <option><?php print $year;?></option>
              <?php  } ?>
                  
                </select>
              
              </div>
            </div>



 <div class="control-group">
              <label class="control-label">Select Title</label>
              <div class="controls">
      

              <select  name ="Title"  id="Title" class="span6" onchange="return salary()">
                    <option>Select One</option>
                    <option>Salary</option>

                    @if(count($salarytitle) > 0)
                    @foreach($salarytitle as $showTitle)
                        <option value="{{$showTitle->id}}">{{$showTitle->titel}}</option>
                    @endforeach
                    @endif
                </select>
             
              </div>
            </div>



           
 <div class="control-group">
              <label class="control-label">Ammount</label>
              <div class="controls">
                          <input type="text" name="ammount" id="ammount" class="span6" placeholder="120000" required="">
              </div>
            </div>
 


           
             
              <div class="form-actions">
                <input type="button" onclick="return selectALL(),saveSessionTitle()"  value="Save" class="btn btn-success">
              </div>
          

            <div class="widget-box">
   
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Total</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Employee Name</th>
                  
                  <th>Year </th>
                  <th>Month </th>
                
                  <th>Title</th>
                  <th>Ammount</th>
                    <th>Action</th>
                </tr>
              </thead>
              

              <tbody id="tbodydata">
            
               
           </tbody>
            </table>
          </div>
     
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
                  <th>Employee Name</th>
                  <th>Contact No</th>
                  <th>Year </th>
                  <th>Month </th>
                  <th>Salary</th>
                 
                  <th>Total</th>
                  <th>Paid</th>
                  <th>Added By</th>
                  <th>Brance Name</th>
                  <th>Acction </th>
                </tr>
              </thead>
              
              <tbody>
            
              @if($id->id == '306' or $id->fk_brance_id =='1')
              @if(count($showAllData) > 0)
                @foreach($showAllData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->date}}</td>
                  <td>{{$showDAta->empname}}</td>
                    <td>{{$showDAta->contactNo}}</td>
                      <td>{{$showDAta->year}}</td>
                  <td>
                    
                    @if($showDAta->month ==='01')
                (January)                 @endif
                @if($showDAta->month ==='02')
   (February)                  @endif
                @if($showDAta->month ==='03')
   (March)


                
                @endif

                @if($showDAta->month ==='04')
(April)                @endif
                @if($showDAta->month ==='05')
   (May)
                @endif
                  @if($showDAta->month ==='06')
(June)                @endif
                @if($showDAta->month ==='07')
   (July)
                @endif
                  @if($showDAta->month ==='08')
(August)                @endif
  @if($showDAta->month ==='09')
(September)                @endif
                @if($showDAta->month ==='10')
   (October)
                @endif
                  @if($showDAta->month ==='08')
(November)                @endif

 @if($showDAta->month ==='10')
(December)                @endif



                  </td>
                  <td>{{$showDAta->ammount}}</td>
                 
                  <td>{{$showDAta->paid_ammount}}</td>
                    <td>{{$showDAta->paid_ammount}}</td>
                  <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a target="_blank" class="btn btn-success btn-mini" href="{{URL::to('showSalaryPaidpayemt')}}/{{$showDAta->adminid}}/{{$showDAta->month}}/{{$showDAta->year}}" >
                      Show Report</a>
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
                  <td>{{$showDAta->date}}</td>
                  <td>{{$showDAta->empname}}</td>
                    <td>{{$showDAta->contactNo}}</td>
                      <td>{{$showDAta->year}}</td>
                  <td>
                    
                    @if($showDAta->month ==='01')
                (January)                 @endif
                @if($showDAta->month ==='02')
   (February)                  @endif
                @if($showDAta->month ==='03')
   (March)


                
                @endif

                @if($showDAta->month ==='04')
(April)                @endif
                @if($showDAta->month ==='05')
   (May)
                @endif
                  @if($showDAta->month ==='06')
(June)                @endif
                @if($showDAta->month ==='07')
   (July)
                @endif
                  @if($showDAta->month ==='08')
(August)                @endif
  @if($showDAta->month ==='09')
(September)                @endif
                @if($showDAta->month ==='10')
   (October)
                @endif
                  @if($showDAta->month ==='08')
(November)                @endif

 @if($showDAta->month ==='10')
(December)                @endif



                  </td>
                  <td>{{$showDAta->ammount}}</td>
                  <td>{{$showDAta->bouns}}</td>
                  <td>{{$showDAta->paid_ammount}}</td>
                    <td>{{$showDAta->paid_ammount}}</td>
                  <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
              
               <a target="_blank class="btn btn-success btn-mini" href="{{URL::to('showSalaryPaidpayemt')}}/{{$showDAta->adminid}}/{{$showDAta->month}}/{{$showDAta->year}}  " >
                      Show Report</a>
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
       
       


  $('.datepickersss').datepicker();


function selectALL(){


var brance = $('#Brance').val();
var emp = $('#Employee').val();
var month = $('#month').val();
var Year = $('#Year').val();


  $("#tbodydata").load("{{URL::to('showDatasalttit')}}"+'/'+brance+'/'+emp+'/'+month+'/'+Year);

}


 selectALL();


function saveSessionTitle(){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

var brance = $('#Brance').val();
var date = $('#date').val();
var emp = $('#Employee').val();
var month = $('#month').val();
var Year = $('#Year').val();
var ammount = $('#ammount').val();
var adminid = $('#adminid').val();
var Title = $('#Title').val();

 
                $.ajax({
                    type: "POST",
                    url: '{{URL::to("salaryPaidEmp")}}',
                    dataType: "json",
                data: {
                  brance: brance,
                  date: date,
                  emp:emp,
                  month:month,
                  Year:Year,
                  ammount:ammount,
                  adminid:adminid,
                  Title:Title
               },
                    success: function(data) {
                      selectALL();
                    }
                });



 selectALL();
}





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





 function showCon(){
  var Employee = $('#Employee').val();
  //alert(name);
  $('#Salary').val('');
  $('#Due').val('');
  $('#Bouns').val('');
  $('#Total').val('');
  $('#Paid').val('');


        $.ajax({
          
                    url : '{{URL::to("showEmplContNo")}}/'+Employee,
                  type:'GET',
                    dataType:'json',
                    
                  success: function (result) {
            $('#Contact').val(result.contact);

           
        }
          
                    });
        $('#Contact').val('');
        

      }


 function salary(){
  var Employee = $('#Employee').val();
    var title = $('#Title').val();
  //alert(name);
  if(title == 'Salary'){
        $.ajax({
          
                    url : '{{URL::to("showSalaryemp")}}/'+Employee,
                  type:'GET',
                    dataType:'json',
                    
                  success: function (result) {

                    //alert(result);
            $('#ammount').val(result);
         
           
        }
          
                    });
        $('#ammount').val('');
        


          }
            $('#ammount').val('');

      }


function delesessiondata(getId){


  //alert(getId);
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('sessiosaltitledelete')}}/"+getId,
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

        selectALL();     
}

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection