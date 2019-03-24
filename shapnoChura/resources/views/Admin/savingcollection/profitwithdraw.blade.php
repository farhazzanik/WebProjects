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
            <h5>Profits Provide </h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal"  id="form1" method="post" action="{{URL::to('profitwithsave')}}" >
             {{ csrf_field() }}

             
 <div class="control-group">
              <label class="control-label"> Date
</label>
              <div class="controls">
                <input type="text" name="date" value="{{date('d-m-Y')}}" class="span6" />
                 
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

                <input type="hidden"  name ="Brance"  id="Brance">
                <input type="hidden" name ="Type"  id="Type">

                <input type="hidden" name ="memid"  id="memid">
              
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">

            <div class="control-group">
              <label class="control-label">Account No.</label>
              <div class="controls">
               <!--  <select  name ="Name"  id="Name" class="span6" 
                onchange="return showData(),showpredep(),showINs(),showPrewith()">

                </select> -->

                <input type="text" name ="Name"  id="Name" class="span6"    onchange="return showData(),showpredep(),showPrewith()">
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
              
                <label class="control-label">Total Deposit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="Previous" id="Previous" value="{{old('Previous')}}" readonly="">
                </div>
              </div>

              

              <div class="control-group">
              
                <label class="control-label">Total Profit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="profit" id="profit" value="{{old('profit')}}" readonly="">
                </div>
              </div>

               
            
              <div class="control-group">
              
                <label class="control-label">Previous profit withdraw </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="pwithdraw" id="pwithdraw" value="{{old('pwithdraw')}}" readonly="">
                </div>
              </div>

           

                 <div class="control-group">
              
                <label class="control-label">Today Withdraw
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="tWithdraw" id="tWithdraw"  onkeyup="return checkwithdraw()" value="{{old('tWithdraw')}}">
                </div>
              </div>

                  <div class="control-group">
              
                <label class="control-label">Nett Withdraw 
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="120000" name="nWithdraw" id="nWithdraw" value="{{old('nWithdraw')}}" readonly="">
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
                  <th>SL No.</th>
                  <th>Date</th>
                 
                  <th>Name</th>
                   <th>ID</th>
                  <th>Package Name</th>
                  <th>Total Deposit</th>
                  <th>Total Profits</th>
                  <th>Profits Withdraw</th>
                  <th>Added By </th>
                 <th>Brance Name </th>
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
               @if($id->id == '306' or $id->fk_brance_id =='1')
                @if(count($allData) > 0)
                <?php $sl=0; ?>
                @foreach($allData as $showDAta)
                 <?php $sl++;?>
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td><?php echo $sl;?></td>
                   <td>{{$showDAta->date}}</td>
                   <td>{{$showDAta->mem_name}}</td>
                  <td>{{$showDAta->accno}}</td>
                  <td>{{$showDAta->name}}</td>
                  <td>{{$showDAta->tdeposit}}</td>
                  <td>{{$showDAta->tprofit}}</td>
                   <td>{{$showDAta->twithdraw}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                 <td class="center">

                    <div class="fr"> 
                     

                       <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
            @endforeach
            @endif
               @endif

 @if($id->id != '306' or $id->fk_brance_id !='1')
             @if(count($branWiseData) > 0)
             <?php $sl=0; ?>
                @foreach($branWiseData as $showDAta)
                 <?php $sl++;?>
               
              <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td><?php echo $sl;?></td>
                   <td>{{$showDAta->date}}</td>
                   <td>{{$showDAta->mem_name}}</td>
                  <td>{{$showDAta->accno}}</td>
                  <td>{{$showDAta->name}}</td>
                  <td>{{$showDAta->tdeposit}}</td>
                  <td>{{$showDAta->tprofit}}</td>
                   <td>{{$showDAta->twithdraw}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    <td>{{$showDAta->brancName}}</td>
                 <td class="center">

                    <div class="fr"> 
                     

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




function checkwithdraw(){



    var profit = parseFloat($('#profit').val());
    var tWithdraw = parseFloat($('#tWithdraw').val());
    var pwithdraw = parseFloat($('#pwithdraw').val());

      if(pwithdraw >0){
parseFloat(pwithdraw);
        
        }else{
  pwithdraw=0;

        }

    var Total = 0;

    if(tWithdraw != ""){

      Total = tWithdraw+pwithdraw;
        if(Total <=  profit ){

            $('#nWithdraw').val(Total);

            }else{
          $('#nWithdraw').val('');
$('#tWithdraw').val('');
            }

           

    }



      
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
		 			
                    url : '{{URL::to("showprofit")}}/'+name,
               		type:'GET',
                    dataType:'json',
                    
                    success: function(data) {
                   
						
                    		
							//alert(data.lsatdate);
							//var roll = a[1];
              
              $('#memname').val(data.memname);
							$('#Saving').val(data.ammount);
              $('#Brance').val(data.brance);
              $('#Type').val(data.type);
              $('#memid').val(data.memid);
              $('#profit').val(data.profit);
               $('#pwithdraw').val(data.prpro);
					
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
            url: "{{URL::to('PWDELETE')}}/"+getId,
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