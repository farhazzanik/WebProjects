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
            <h5>Invest Collection </h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('invescollec')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" >
             {{ csrf_field() }}
 <div class="control-group">
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="date"
                  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                    <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>
             
                <input type="hidden"  name ="Brance"  id="Brance">
                <input type="hidden" name ="Type"  id="Type">

                <input type="hidden" name ="memid"  id="memid">

            <div class="control-group">
              <label class="control-label">Account No.</label>
              <div class="controls">
              <!--   <select  name ="Name"  id="Name" class="span6" 
                onchange="return showData(),showINs()">
                   
                </select> -->


                <input type="text" name ="Name"  id="Name"  class="span6" 
                onchange ="return showData(),showINs()">

                 <span id="loading"></span>
              
              
              </div>
            </div>



               <div class="control-group">
              
                <label class="control-label">Name </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="" name="memname" id="memname" value="{{old('memname')}}" readonly="">
                </div>
              </div>

              <div class="control-group">
              
                <label class="control-label">Total Invest </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="totalinvest" id="totalinvest" value="{{old('totalinvest')}}" readonly="">
                </div>
              </div>
 

              <div class="control-group">
              
                <label class="control-label">Total Profit  </label>
            
                <div class="controls">
                  <input  type="text" class='span6' placeholder="12000" name="Dividend" id="Dividend" value="{{old('Dividend')}}" readonly="" >
                </div>
              </div>





             

            <div class="control-group">
              
                <label class="control-label">Number Of Installment </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Installment" id="Installment" value="{{old('Installment')}}" readonly="">
                </div>
              </div>
            

             

            

         

                 <div class="control-group">
              
                <label class="control-label">Collection Ammount
</label>
            
                <div class="controls">
                  <input type="text" class='span6' onkeyup="showprofit()" placeholder="120000" name="todaytk" id="todaytk" value="{{old('todaytk')}}">
                </div>
              </div>
            
              <div class="control-group">
              
                <label class="control-label"> Profit
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="todaydivend" id="todaydivend" value="{{old('todaydivend')}}"  readonly="">
                </div>
              </div>
            



 
             
         <div class="control-group">
              
                <label class="control-label">Details</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="Details">{{old('Details')}}</textarea>
                </div>
              </div>
            


              <div class="control-group">
              
                <label class="control-label">Comments</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="comments">{{old('comments')}}</textarea>
                </div>
              </div>
            
             

            
           
             
              <div class="form-actions">
              <input type = "button"  class="btn btn-success" value="submit" id="submit" name = "submit" onclick="return btn_onclick()" />
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
                  <th>ID</th>
                
                  <th>Name</th>
                  <th>Type</th>
                  <th>Total Invest</th>
                  <th>Divended</th>
                  <th>Today's submission</th>
                   <th>Invest wise Divended(per day)</th>
                  <th>Added By </th>
                  <th>Brance Name </th>
                  <th>Action</th>
                </tr>
              </thead>
               @if($id->id == '306' or $id->fk_brance_id =='1')
                @if(count($allData) > 0)
                @foreach($allData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                 <td><?php
                  $explode = explode('-', $showDAta->date);
                  echo $explode[2].'-'.$explode[1].'-'.$explode[0];

                 ?></td>
                 <td>{{$showDAta->mem_name}}</td>
                <td>{{$showDAta->fk_invest_id}}</td>
                  <td> @if($showDAta->type ==='5')
                Daily
                  @endif
                @if($showDAta->type ==='1')
   Weekly
                  @endif
                @if($showDAta->type ==='2')
   Monthly
                
                @endif

                @if($showDAta->type ==='3')
Yearly
                
                @endif
                @if($showDAta->type ==='4')
   General
                @endif</td>
                  <td>{{$showDAta->total_inv}}</td>
                  <td>{{$showDAta->divended}}</td>
                  <td>{{$showDAta->tody_inves}}</td>
                  <td>{{$showDAta->inves_wise_deven}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                  <td class="center">

                    <div class="fr"> 
                    <a class="btn btn-danger btn-mini" target="_blank" href="{{URL::To('showReportinv')}}/{{$showDAta->id}}" >
                   Show Report
                   </a>

                       <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
            @endforeach
            @endif
               @endif

 @if($id->id != '306' or $id->fk_brance_id !='1')
             @if(count($branWiseData) > 0)
                @foreach($branWiseData as $showDAta)
              <tr class="gradeX" id="tr-{{$showDAta->id}}">
                 <td>{{$showDAta->date}}</td>
<td>{{$showDAta->mem_name}}</td>
                 <td>{{$showDAta->fk_invest_id}}</td>
                
                  
                  <td> @if($showDAta->type ==='5')
                Daily
                  @endif
                @if($showDAta->type ==='1')
   Weekly
                  @endif
                @if($showDAta->type ==='2')
   Monthly
                
                @endif

                @if($showDAta->type ==='3')
Yearly
                
                @endif
                @if($showDAta->type ==='4')
   General
                @endif</td>
                   <td>{{$showDAta->total_inv}}</td>
                  <td>{{$showDAta->divended}}</td>
                  <td>{{$showDAta->tody_inves}}</td>
                  <td>{{$showDAta->inves_wise_deven}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                  <td class="center">

                    <div class="fr"> 
                     <a class="btn btn-danger btn-mini" target="_blank" href="{{URL::To('showReportinv')}}/{{$showDAta->id}}" >
                   Show Report
                   </a>
                       <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
            @endforeach
            @endif
@endif
              <tbody>
              
            
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
     
        
  function btn_onclick(){

      var btn=document.getElementById('submit');
       btn.setAttribute('type', 'submit');
      

  }


  function showprofit(){

  var invest = parseFloat($('#totalinvest').val());
  var profit = parseFloat($('#Dividend').val());
 var total = 0;
 var todaytk = parseFloat($('#todaytk').val()); 

      

 if (!isNaN(parseFloat($('#todaytk').val() ) ) ) {
       
      total =((profit / (invest+profit)) * todaytk);
     
      $('#todaydivend').val(total);
    
    }else{
$('#todaydivend').val(total);
      
    }

  }

 $('.datepicker').datepicker();

function sumTotaldep(){

		var today = parseFloat($('#todaytk').val());
   
		var Previous = parseFloat($('#Previous').val());
		var totalinvest = parseFloat($('#totalinvest').val());
		var showtotal = $('#Totaltotalinvest').val();
				if(showtotal == null){

					showtotal=0;
				}else{
parseFloat(showtotal);

				}
				//alert(showtotal);
				
		var total = 0;
		var due = 0;
		if(today  != "" && totalinvest >= today && totalinvest >= showtotal  )
		{
			total = today+Previous;
			
			$('#Totaltotalinvest').val(total);
			
		}else{
			$('#todaytk').val('');
			$('#Totaltotalinvest').val('');
			
		}
}




function showINs(){
  var name = $('#Name').val();
  //alert(name);
        $.ajax({
          
                    url : '{{URL::to("showINsinvest")}}/'+name,
                  type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
            
                        
              
              //var roll = a[1];
              $('#Installment').val(data);
              //$('#roll').val(roll);
              
            }
          
          
                    });
          $('#Installment').val(''); 
          $('#todaytk').val('');
      $('#Total').val('');

}



 function showData(){
 	var name = $('#Name').val();
 	//alert(name);
 				$.ajax({
		 			
                  url : '{{URL::to("showTotalInves")}}/'+name,
               		type:'GET',
                  dataType:'json',
                    
                    success: function(data) {
                   
				//	Dividend	todaytk  todaydivend Dividend  totalinvest
             $('#memname').val(data.memname);
						
							$('#totalinvest').val(data.totalinvest);
              $('#Dividend').val(data.Dividend);
           

               $('#Brance').val(data.brance);
                  $('#Type').val(data.Type);
                    $('#memid').val(data.memid);
          
              
							
							
						}
					
					
                    });
					$('#totalinvest').val('');	
					$('#Dividend').val('');
			$('#todaytk').val('');
        $('#todaydivend').val('');

      }

      function  ShowMem(){

      	 var type = $('#Type').val();
        var branceid = $('#Brance').val();
 				
 					
 				

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Name');
          if(type != "Select One")
 				{

          $.ajax({
                url : '{{URL::to("showAppliInvest")}}/'+type+'/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'/'+value.appName+'">'+value.mem_name+'&nbsp;('+value.id+')</option>');
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
                    $('#totalinvest').val('');  
          $('#todaytk').val('');
      $('#Total').val('');
      $('#Previous').val(''); 
         
         $('#Installment').val(''); 
        

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
            url: "{{URL::to('deleInvColl')}}/"+getId,
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