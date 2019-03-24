

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
              <li class="active"><a data-toggle="tab" href="#tab1">Edit</a></li>
            
             
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
            <form class="form-horizontal" enctype='multipart/form-data' method="post" action="{{URL::to('updateInvestReport')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}


             @if($id->fk_brance_id == '1')

        <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" onchange="return showrefer()" class="span6">
                <option value="{{$data[0]->fk_brance_id}}">{{$data[0]->branceName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $data[0]->fk_brance_id !=  $showData->id)

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
              <label class="control-label">Applicant  date
</label>
              <div class="controls">
                <input type="text" name="Appdate"  value="{{$data[0]->appDate}}" class="span6" />
                 </div>

  <div class="control-group">
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6">
                  
              @if($data[0]->type ==='5')
                  <option value="{{$data[0]->type}}">Daily</option>
                  @endif
                @if($data[0]->type ==='1')
   <option value="{{$data[0]->type}}">Weekly</option>
                  @endif
                @if($data[0]->type ==='2')
   <option value="{{$data[0]->type}}">Monthly</option>
                
                @endif

                @if($data[0]->type ==='3')
<option value="{{$data[0]->type}}">Yearly</option>
                
                @endif
                @if($data[0]->type ==='4')
   <option value="{{$data[0]->type}}">General</option>
                @endif

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
                 

                   

          
                <select  name ="ApplicantN"  id="ApplicantN" class="span6">
                
                      <option value="{{$data[0]->appName}}">{{$data[0]->mem_name}}</option>

                </select>
               




                </div>
              </div>


              
            
            <div class="control-group">
              
                <label class="control-label">Father Name </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Father Name English" name="Father" id="Father" value="{{$data[0]->fathername}}">
                </div>
              </div>
       

               <div class="control-group">
              
                <label class="control-label">Mother Name  </label>
            
                    <div class="controls">
                      <input type="text" class='span6' placeholder="Mother Name English" name="Mother" id="Mother" value="{{$data[0]->mothername}}">
                    </div>
              </div>


               <div class="control-group">
              
                <label class="control-label">Husband/Wife Name  </label>
            
                    <div class="controls">
                      <input type="text" class='span6' placeholder="Husband/Wife Name English" name="soulmate" id="soulmate" value="{{$data[0]->soulmate}}">
                    </div>
              </div>
            
             <div class="control-group">
              
                <label class="control-label">Business Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="businesAdd">{{$data[0]->businessAdd}}</textarea>
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Present Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Present">{{$data[0]->presentAdd}}</textarea>
                </div>
              </div>
            
              <div class="control-group">
              
                <label class="control-label">Permanent  Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{$data[0]->permanentAdd}}</textarea>
                </div>
              </div>
            


            
     

             

           



  

    <div class="control-group">
              
                <label class="control-label">Approval Investment Ammount </label>
            
                <div class="controls">
                  <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="12000" name="investmentqoun" id="investmentqoun" value="{{$data[0]->invesQuanT}}">
               
                </div>
              </div>



              <div class="control-group">
              
                <label class="control-label">Profits  </label>
            
                <div class="controls">
                  <input type="text"  onclick="return showTotal()" onchange="return showTotal()" class='span6' placeholder="Service charge" name="Dividend" id="Dividend" value="{{$data[0]->divendend}}" >
                </div>
              </div>

               <div class="control-group">
              
                <label class="control-label">Service Charge  </label>
            
                <div class="controls">
                  <input type="text"  class='span6' placeholder="Service charge" name="charge" id="charge" value="{{$data[0]->servCharge}}" >
                </div>
              </div>


               <div class="control-group">
              
                <label class="control-label">Amount of installment(Per One)</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Amount of installment" name="installmentamm" id="installmentamm" value="{{$data[0]->instalAmm}}">
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                    <input type="hidden" name="id" value="{{$data[0]->id}}">
                </div>
              </div>

                <div class="control-group">
              
                <label class="control-label">
                Installment wise Profit(Per One)</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="inswisedivendend" id="inswisedivendend" value="{{$data[0]->inswisedivendend}}">
                 
                </div>
              </div>


       

               <div class="control-group">
              
                <label class="control-label">Installment number</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Installment number" name="insnumber" id="insnumber" value="{{$data[0]->instalNO}}">
                </div>
              </div>
                 
            <div class="control-group">
              <label class="control-label">Expiration date
</label>
              <div class="controls">
                <input type="text" name="Expirationdate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$data[0]->expireDate}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

            
            <div class="control-group">
              
                <label class="control-label">Total with profits
  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Total with profits" name="profits" id="profits" value="{{$data[0]->profits}}" readonly="">
                   
                </div>
              </div>



            
            <div class="control-group">
              
                <label class="control-label">Full investment payment date
  </label>
            
                <div class="controls">
                  <input type="text" class='span6 datepickerss' placeholder="Full investment payment date" name="FullpaymentDate" id="FullpaymentDate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$data[0]->fullPayDAte}}">
                   
                </div>
              </div>



           


  

           
 <div class="control-group">
              <label class="control-label">Reference By</label>
              <div class="controls">
               @if($id->fk_brance_id == '1')
                <select  name ="Reference"  id="Reference" class="span6" onchange="showArea()">
                  <option value="{{$data[0]->fk_emp_id}}">{{$data[0]->empname}}</option>
                  
               
               
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
               @if($id->fk_brance_id == '1')
             <select  name ="Area"  id="Area" class="span6">
             <option value="{{$data[0]->fk_area_id}}">{{$data[0]->area_name}}</option>
              </select>
               @else

                <select  name ="Area"  id="Area" class="span6">
                 
                    <option value="{{$data[0]->fk_area_id}}">{{$data[0]->area_name}}</option>
                  


                         @if(count($selectArea) > 0)
                  @foreach($selectArea as $showData)
                   @if($showData->id != $data[0]->fk_area_id)
                    <option value="{{$showData->id}}">{{$showData->area_name}}</option>
                      @endif
                    @endforeach
                    @endif
               
               
                </select>
              @endif
              </div>
            </div>





            
          



          
        

 <div class="control-group">
              
                <label class="control-label">Comments</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Comments">{{$data[0]->comments}}</textarea>
                </div>
              </div>


             
  


            
             


 


 <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <label>
                        <input type="radio" name="Status" value="1"  
                      @if($data[0]->status == '1' )
                            checked
                          @endif
                         /> 
                        Active</label>
                      <label>
                        <input type="radio" name="Status" value="2"  
                       @if($data[0]->status == '2' )
                            checked
                          @endif
                          />
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



         
        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection