@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


 <div class="container-fluid">
    <hr>

    
    <div class="row-fluid">
      <div class="span10">
@include('error.msg')
 <div class="widget-box">
       

           
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Finished Invest Members</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
              

@if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
                
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
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6">
                 		<option>Select One</option>
                      <option value="5">Daily</option>
                      <option value="1">Weekly</option>
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
                      <option value="4">General</option>
                </select>
              
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
                <input type="submit"  formtarget="_blank" value="Show Report" class="btn btn-success">
              </div>
            </form>
          </div>
             </div> 
            </div>
            
           
          </div>
          </div>
        
        
         <meta name="_token" content="{!! csrf_token() !!}" />
        
        <script type="text/javascript">
        	
      
        function showData(){

              var branceid = $('#Brance').val();
              var Type = $('#Type').val();
              var fromid = $('#from').val();
              var toid = $('#to').val();

                if(fromid != "" && toid!=""){
                  $(".showdata").load("{{URL::to('showfinishinvestdata')}}"+'/'+branceid+'/'+fromid+'/'+toid+'/'+Type);
                }else if(fromid == "" &&  toid == ""){

             $(".showdata").html("");
          
        }
          
        }

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection