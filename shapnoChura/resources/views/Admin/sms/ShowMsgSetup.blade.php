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
              <li class="active"><a data-toggle="tab" href="#tab1">Show</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Show Members</h5>
          </div>
                     <div class="widget-content nopadding">
             <form class="form-horizontal" method="POST" action="{{URL::To('savesmssetup')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
              <label class="control-label">Package Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6">
                 
                    <option value="1">Savings</option>
                    <option value="2">Invest</option>
               
                </select>
               <span id="loader"></span>
                 <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
              </div>
            </div>



 <div class="control-group">
              
              
                <div class="controls">
                 <input type="text"  name="from" id="from"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:22px;  text-align:center;">
-
<span for="to" class="text-warning"><b>To Limit No - </b></span>
<input type="text" name="to" id="to"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:22px;  text-align:center;"/> 


<input type="button" onclick="showData()" value="Show Data" class="btn btn-success">



                </div>
              </div>
            

               <div class="control-group showdata">

               </div>
             
       


            
           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            
          </div>
             </div>  </p>
            </div>
          
           </form>
          </div>
        </div>
        </div>
        </div></div>
        </div>

         <meta name="_token" content="{!! csrf_token() !!}" />
        <script type="text/javascript">
        

        
  function check_all()
      {
      
      if($('#chkbx_all').is(':checked')){
        $('input.check_elmnt2').prop('checked', true);
      }else{
       
        $('input.check_elmnt2').prop('checked', false);
        }
    } 
    






        function showData(){

              var branceid = $('#Brance').val();
              var Type = $('#Type').val();
              var fromid = $('#from').val();
              var toid = $('#to').val();

                if(fromid != "" && toid!=""){
                  $(".showdata").load("{{URL::to('smssetupdata')}}"+'/'+branceid+'/'+fromid+'/'+toid+'/'+Type);
                }else if(fromid == "" &&  toid == ""){

             $(".showdata").html("");
          
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
            url: "{{URL::to('deletesmsinitia')}}/"+getId,
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
        
@endsection