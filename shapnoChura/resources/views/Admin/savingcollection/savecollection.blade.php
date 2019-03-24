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
            <h5>Saving Collection </h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal"  id="form1" method="post" action="{{URL::to('savingcoll')}}" >
             {{ csrf_field() }}

             
 <div class="control-group">
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="date" value="{{date('d-m-Y')}}" class="span6" />
                    <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

                <input type="hidden"  name ="Brance"  id="Brance">
                <input type="hidden" name ="Type"  id="Type">

                <input type="hidden" name ="memid"  id="memid">


            <div class="control-group">
              <label class="control-label">Account No.</label>
              <div class="controls">
               <!--  <select  name ="Name"  id="Name" class="span6" 
                onchange="return showData(),showpredep(),showINs(),showPrewith()">

                </select> -->

                <input type="text" name ="Name"  id="Name" class="span6"    onchange="return showData(),showpredep(),showINs(),showPrewith()">
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
              
                <label class="control-label">Saving Deposit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Saving" id="Saving" value="{{old('Saving')}}" readonly="">
                </div>
              </div>
            
               

            <div class="control-group">
              
                <label class="control-label">Number Of Installment </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Installment" id="Installment" value="{{old('Installment')}}" readonly="">
                </div>
              </div>
            

             

               <div class="control-group">
              
                <label class="control-label">Previous Deposit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Previous" id="Previous" value="{{old('Previous')}}" readonly="">
                </div>
              </div>

                 <div class="control-group">
              
                <label class="control-label">Previous Withdraw </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Previouswith" id="Previouswith" value="{{old('Previouswith')}}" readonly="">
                </div>
              </div>
            
            

           

                 <div class="control-group">
              
                <label class="control-label">Collection Ammount 
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="todaytk" id="todaytk"  onkeyup="return sumTotaldep()" value="{{old('todaytk')}}">
                </div>
              </div>

                  <div class="control-group">
              
                <label class="control-label">Withdraw Ammount 
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="todaywithdraw" id="todaywithdraw" onkeyup="return checkwithdraw()" value="{{old('todaywithdraw')}}">
                </div>
              </div>
            

                <div class="control-group">
              
                <label class="control-label">Total Saving </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Total" id="Total" value="{{old('Total')}}" readonly="">
                </div>
              </div>

               <div class="control-group">
              
                <label class="control-label">Total Withdraw </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Totalwith" id="Totalwith" value="{{old('Totalwith')}}" readonly="">
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
                  <th>Saving Deposit</th>
                  <th>Today's submission</th>
                <th>Today's Withdraw</th>
                  <th>Added By </th>
                     <th>Brance Name </th>
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
               @if($id->id == '306' or $id->fk_brance_id =='1')
                @if(count($allData) > 0)
                @foreach($allData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->mem_add_id}}</td>
                  <td>{{$showDAta->date}}</td>
                  
                  
                  <td>{{$showDAta->mem_name}}</td>
                  <td>{{$showDAta->name}}</td>
                  <td>{{$showDAta->total_dep}}</td>
                  <td>{{$showDAta->today_dep}}</td>
                   <td>{{$showDAta->today_withdraw}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                 <td class="center">

                    <div class="fr"> 
                     
                      <a class="btn btn-danger btn-mini" target="_blank" href="{{URL::To('showreportsaveing')}}/{{$showDAta->id}}" >
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
                <td>{{$showDAta->mem_add_id}}</td>
               
                 
                  <td> {{$showDAta->name}}</td>
                  <td>{{$showDAta->total_dep}}</td>
                  <td>{{$showDAta->today_dep}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                  <td class="center">

                    <div class="fr"> 
                     
                       <a class="btn btn-danger btn-mini" target="_blank" href="{{URL::To('showreportsaveing')}}/{{$showDAta->id}}" >
                   Show Report
                   </a>
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
     
     


  function btn_onclick(){

      var btn=document.getElementById('submit');
       btn.setAttribute('type', 'submit');
      

  }

 $('.datepicker').datepicker();


function showPrewith(){
  var name = $('#Name').val();
  //alert(name);
        $.ajax({
          
                    url : '{{URL::to("showprewithd")}}/'+name,
                  type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
            
                        
              
              //var roll = a[1];
              $('#Previouswith').val(data);
                $('#Totalwith').val(data);
              
            }
          
          
                    });
          $('#Previouswith').val(''); 
         $('#Totalwith').val('');

}


function checkwithdraw(){



    var todaywithdraw = parseFloat($('#todaywithdraw').val());
    var Previouswith = parseFloat($('#Previouswith').val());
    var Total = parseFloat($('#Total').val());
   var Totalwith = $('#Totalwith').val();
    var netwithdraw = Total-100;
        if(Totalwith == null){

          Totalwith=0;
        }else{
parseFloat(Totalwith);

        }
    var Totalwithdrea = 0;

    if(todaywithdraw  != "" && netwithdraw >= todaywithdraw && netwithdraw >= todaywithdraw  )
    {
      Totalwithdrea = todaywithdraw+Previouswith;
      
      $('#Totalwith').val(Totalwithdrea);
      
    }else{
      $('#todaywithdraw').val('');
     $('#Totalwith').val(Previouswith);
      
    }
}


function sumTotaldep(){
  var id  = $('#Name').val();
 

  var variable2 = id.substring(0, 4);

  if(variable2 != "6437"){
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
			$('#Total').val(Previous);
			
		}
  }
}




function showINs(){
  var name = $('#Name').val();
  //alert(name);
        $.ajax({
          
                    url : '{{URL::to("showINs")}}/'+name,
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


function showpredep(){
	var name = $('#Name').val();
 	//alert(name);
 				$.ajax({
		 			
                    url : '{{URL::to("showpre")}}/'+name,
               		type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
						
                    		
							
							
							$('#Previous').val(data);
					 $('#Total').val(data);
							
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
		 			
                    url : '{{URL::to("ss")}}/'+name,
               		type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
						
                    		
							//alert(data.memname);
							//var roll = a[1];
              
              $('#memname').val(data.memname);
							$('#Saving').val(data.ammount);
                $('#Brance').val(data.brance);
                  $('#Type').val(data.type);
                    $('#memid').val(data.memid);
					
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
                url : '{{URL::to("showMem")}}/'+type+'/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'/'+value.Addid+'">'+value.mem_name+'&nbsp;('+value.Addid+')</option>');
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
            url: "{{URL::to('savColl')}}/"+getId,
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