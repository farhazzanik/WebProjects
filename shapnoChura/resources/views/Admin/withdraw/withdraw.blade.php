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
            <h5>Withdraw Collection </h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('withdrawsave')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             

 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
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
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6" onchange="return ShowMem()" >
                   	
                   	  <option>Select One</option>
                      <option value="5">Daily</option>
                      <option value="1">Weekly</option>
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
                      <option value="4">General</option>
                </select>
                <span id="districloader"></span>
              
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Name</label>
              <div class="controls">
                <select  name ="Name"  id="Name" class="span6" 
                onchange="return showData(),showpredep(),showINs()">
                   
                </select>
                 <span id="loading"></span>
              
              
              </div>
            </div>

 <div class="control-group">
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="date"
                  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                    <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

              <div class="control-group">
              
                <label class="control-label">Total Deposit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Saving" id="Saving" value="{{old('Saving')}}" readonly="">
                </div>
              </div>
            

             

               <div class="control-group">
              
                <label class="control-label">Previous Withdraw </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Previous" id="Previous" value="{{old('Previous')}}" readonly="">
                </div>
              </div>
            

           

                 <div class="control-group">
              
                <label class="control-label">Today's Withdraw
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="todaytk" id="todaytk" onkeyup="return sumTotaldep()" value="{{old('todaytk')}}">
                </div>
              </div>
            

                <div class="control-group">
              
                <label class="control-label">Total Withdraw </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Total" id="Total" value="{{old('Total')}}" readonly="">
                </div>
              </div>


 
  <div class="control-group">
              
                <label class="control-label">Number Of withdraw </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Installment" id="Installment" value="{{old('Installment')}}" readonly="">
                </div>
              </div>
            
             
         


              <div class="control-group">
              
                <label class="control-label">Comments</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="comments">{{old('comments')}}</textarea>
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
                  <th>Name</th>
                  <th>Type</th>
                  <th>Total Withdraw</th>
                  <th>Today's Withdraw</th>
               
                  <th>Added By </th>
                     <th>Brance Name </th>
                
               
                </tr>
              </thead>
             
              <tbody>
               @if($id->id == '306' or $id->fk_brance_id =='1')
                @if(count($allData) > 0)
                @foreach($allData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->date}}</td>
                  <td>{{$showDAta->mem_name}}</td>
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
                  <td>{{$showDAta->total_withdraw}}</td>
                  <td>{{$showDAta->today_withdraw}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                 
         
            @endforeach
            @endif
               @endif

 @if($id->id != '306' or $id->fk_brance_id !='1')
             @if(count($branWiseData) > 0)
                @foreach($branWiseData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->date}}</td>
                  <td>{{$showDAta->mem_name}}</td>
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
                 <td>{{$showDAta->total_withdraw}}</td>
                  <td>{{$showDAta->today_withdraw}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                  <td class="center">

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

function sumTotaldep(){

		var today = parseFloat($('#todaytk').val());
		var Previous = parseFloat($('#Previous').val());
		var Savingg = parseFloat($('#Saving').val());
		var showtotal = $('#Total').val();
				if(showtotal == null){

					showtotal=0;
				}else{
parseFloat(showtotal);

				}
				//alert(showtotal);
				
		var total = 0;
		var due = 0;
		if(today  != "" && Savingg >= today && Savingg >= showtotal  )
		{
			total = today+Previous;
			
			$('#Total').val(total);
			
		}else{
			$('#todaytk').val('');
			$('#Total').val('');
			
		}
}

function showpredep(){
	var name = $('#Name').val();
 	//alert(name);
 				$.ajax({
		 			
                    url : '{{URL::to("showprewithd")}}/'+name,
               		type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
						
                    		
							
							//var roll = a[1];
							$('#Previous').val(data);
							//$('#roll').val(roll);
							
						}
					
					
                    });
					$('#Previous').val('');	
					$('#todaytk').val('');
			$('#Total').val('');

}

 function showData(){
 	var name = $('#Name').val();
 	//alert(name);
 				$.ajax({
		 			
                    url : '{{URL::to("showTotadep")}}/'+name,
               		type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
						
                    		
							//alert(Saving);
							//var roll = a[1];
							$('#Saving').val(data);
							//$('#roll').val(roll);
							
						}
					
					
                    });
					$('#Saving').val('');	
					$('#todaytk').val('');
			$('#Total').val('');

      }

      function  ShowMem(){

      	 var type = $('#Type').val();
        var branceid = $('#Brance').val();
 				
 					
 				

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Name');
          if(type != "Select One")
 				{

          $.ajax({
                url : '{{URL::to("shownameWithdraw")}}/'+type+'/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'/'+value.Addid+'">'+value.mem_name+'</option>');
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
            url: "{{URL::to('delWithdraw')}}/"+getId,
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

          function showINs(){
  var name = $('#Name').val();
  //alert(name);
        $.ajax({
          
                    url : '{{URL::to("showINswithsraw")}}/'+name,
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


        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection