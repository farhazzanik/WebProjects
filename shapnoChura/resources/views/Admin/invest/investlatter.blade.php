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
            <h5>Letter of investment approval letter
</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype='multipart/form-data' method="post" action="{{URL::to('saveInslatter')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}


             @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6" onchange="return ShowMem(),showrefer()">
                <option>Select One</option>
                  @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' )

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
              <label class="control-label">Applicant  dates
</label>
              <div class="controls">
                <input type="text" name="Appdate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

  <div class="control-group">
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6" >
             <option value="5">Daily</option>
                      <option value="1">Weekly</option>
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
                      <option value="4">General</option>
                </select>
              
              </div>
            </div>


            


                




    <div class="control-group">
              
                <label class="control-label">Applicant Name </label>
            
                <div class="controls">
                 

                   

                  @if($id->fk_brance_id == '1')
                <select  name ="ApplicantN"  id="ApplicantN" onchange="return showAllvalue(),mds()" class="span6">
                
                </select>
                @else

          <select  name ="ApplicantN"  id="ApplicantN" onchange="return showAllvalue(),mds()"  class="span6">
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
              
                <label class="control-label">ID </label>
            
                <div class="controls">
                  <input type="text" class='span6' name="ID" id="ID" value="{{old('ID')}}">
               
                </div>
              </div>
       
	   
	   
            
            <div class="control-group">
              
                <label class="control-label">Father Name </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Father Name English" name="Father" id="Father" value="{{old('Father')}}">
                </div>
              </div>
       

               <div class="control-group">
              
                <label class="control-label">Mother Name  </label>
            
                    <div class="controls">
                      <input type="text" class='span6' placeholder="Mother Name English" name="Mother" id="Mother" value="{{old('Mother')}}">
                    </div>
              </div>


               <div class="control-group">
              
                <label class="control-label">Husband/Wife Name  </label>
            
                    <div class="controls">
                      <input type="text" class='span6' placeholder="Husband/Wife Name English" name="soulmate" id="soulmate" value="{{old('soulmate')}}">
                    </div>
              </div>
            
             <div class="control-group">
              
                <label class="control-label">Business Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="businesAdd">{{old('businesAdd')}}</textarea>
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Present Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Present" id="Present">{{old('Present')}}</textarea>
                </div>
              </div>
     
              <div class="control-group">
              
                <label class="control-label">Permanent  Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Permanent" id="Permanent">{{old('Permanent')}}</textarea>
                </div>
              </div>
            

            
     

             

           



  

    <div class="control-group">
              
                <label class="control-label">Approval Investment Ammount </label>
            
                <div class="controls">
                  <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="120000" name="investmentqoun" id="investmentqoun" value="{{old('investmentqoun')}}">
               
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Profit  </label>
            
                <div class="controls">
                  <input onkeyup="return showTotal()" onclick="return showTotal()" onchange="return showTotal()" type="text" class='span6' placeholder="12000" name="Dividend" id="Dividend" value="{{old('Dividend')}}" >
                </div>
              </div>



              <div class="control-group">
              
                <label class="control-label">Service Charge  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="charge" id="charge" value="{{old('charge')}}" >
                </div>
              </div>

     <div class="control-group">
              
                <label class="control-label">Installment number</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Installment number" name="insnumber" id="insnumber" onkeyup="return installdive()" value="{{old('insnumber')}}">
                </div>
              </div>
               <div class="control-group">
              
                <label class="control-label">Amount of installment(Per One)</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="installmentamm" id="installmentamm" value="{{old('installmentamm')}}">
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                </div>
              </div>
       


               <div class="control-group">
              
                <label class="control-label">
                Installment wise Profit(Per One)</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="inswisedivendend" id="inswisedivendend" value="{{old('inswisedivendend')}}">
                 
                </div>
              </div>



          
                 
            <div class="control-group">
              <label class="control-label">Duration
</label>
              <div class="controls">
                <input type="text" name="Expirationdate" class=" span6" />
              </div>
            </div>

            
            <div class="control-group">
              
                <label class="control-label">Total with profits
  </label>
            
                <div class="controls">
                  <input type="text" readonly="" class='span6' placeholder="12000" name="profits" id="profits" value="{{old('profits')}}">
                   
                </div>
              </div>



            
            <div class="control-group">
              
                <label class="control-label">Full investment payment date
  </label>
            
                <div class="controls">
                  <input type="text" class='span6 datepickerss' placeholder="Full investment payment date" name="FullpaymentDate" id="FullpaymentDate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}">
                   
                </div>
              </div>

              <div class="control-group">
              <label class="control-label">Reference By</label>
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
              
                <label class="control-label">Comments</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Comments">{{old('Comments')}}</textarea>
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
                   <th>ID</th>
                  <th>Name</th>
                  <th>Father Name</th>
                   <th>Applicant Date </th>
                   <th>Permanent Add.</th>
                   <th>Business Name</th>
                   <th>Brance Name </th>
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
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                <td><?php echo $sl?></td>
                 <td>{{$showDAta->id}}</td>
                  <td>{{$showDAta->mem_name}}</td>
                 
                  <td>{{$showDAta->fathername}}</td>
                  <td>{{$showDAta->appDate}}</td>
                  <td>{{$showDAta->permanentAdd}}</td>
                  <td>{{$showDAta->businessAdd}}</td>
                 <td>{{$showDAta->branceName}}</td>

                 <td>{{$showDAta->adminname}}</td>

                  <td class="center">

                    <div class="fr"> 
                  <a href="editInvestLatter/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>

 <a target="_blank" href="showInvestLatterR/{{$showDAta->id}}" 
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
                  <?php $sl++?>
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                <td>  <?php echo $sl?></td>
                  <td>{{$showDAta->mem_name}}</td>
                 
                  <td>{{$showDAta->fathername}}</td>
                  <td>{{$showDAta->appDate}}</td>
                  <td>{{$showDAta->permanentAdd}}</td>
                  <td>{{$showDAta->businessAdd}}</td>
                 <td>{{$showDAta->branceName}}</td>

                 <td>{{$showDAta->adminname}}</td>

                  <td class="center">

                    <div class="fr"> 
                  <a href="editInvestLatter/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>

                       <a target="_blank" href="showInvestLatterR/{{$showDAta->id}}" 
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
   $('.datepickerss').datepicker();

</script>

        <script type="text/javascript">



function installdive(){

    var Dividend = parseFloat($('#Dividend').val());
    var investmentqoun = parseFloat($('#investmentqoun').val());
    var insnumber = parseFloat($('#insnumber').val());

    var showdata  = Dividend / insnumber;
    var showinst  = investmentqoun / insnumber;

    $('#inswisedivendend').val(showdata);

  $('#installmentamm').val(showinst);


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
           var batchOption = $('#ApplicantN');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showMemberforinvest")}}/'+branceid,
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


                  batchOption.append('<option value="'+value.Addid+'">'+value.mem_name+'('+value.Addid+')'+'</option>');
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




function showTotal(){

  var Dividend = parseFloat($('#Dividend').val());
    var investmentqoun = parseFloat($('#investmentqoun').val());

var total = 0;
if (!isNaN(parseFloat($('#Dividend').val() ) ) ) {
       
      total =investmentqoun+ Dividend;
      $('#profits').val(total);
    
    }else{
$('#profits').val(investmentqoun);
      
    }


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
            url: "{{URL::to('deletInvesLat')}}/"+getId,
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


 function showAllvalue(){

                var apid =  $('#ApplicantN').val();
                  if(apid != ''){



                      $.ajax({
          
                    url : '{{URL::to("showAlldataoforinvest")}}/'+apid,
                    type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
            
                        $('#Father').val(data.father); 
                        $('#Mother').val(data.mother);
                        $('#Present').val(data.pre_add);
                        $('#Permanent').val(data.perma_add);
                        $('#savid').val(data.savid);
    
              
           
             
              
             
              
            }
          
          
                    });
                        $('#Father').val(''); 
                        $('#Mother').val('');
                        $('#Present').val('');
                        $('#Permanent').val('');
    



                  }

          }

          function mds(){


                var apid =  $('#ApplicantN').val();
                  if(apid != ''){



                      $.ajax({
          
                    url : '{{URL::to("savidforinvest")}}/'+apid,
                    type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
            
                       
                      $('#savid').val(data.savid);
    
              
           
             
              
             
              
            }
          
          
                    });
                      $('#savid').val('');



                  }
          }

                  </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection