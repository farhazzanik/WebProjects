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
              <li class="active"><a data-toggle="tab" href="#tab1">MSG Send</a></li>
            
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Send Message</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('succMsg')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
              <label class="control-label">Select Type</label>
              <div class="controls">
                
 
                <select  name ="type"  id="type" class="span6" onclick="return showData()">
                          <option value="One">Select One</option>
                          <option value="emp">Employee</option>
                          <option value="mem">Member</option>
                         
                  </select>
               </div>
            </div>




   <div class="control-group" id='select'>
             
            </div>


   <div class="control-group">
              <label class="control-label">Select Contact No</label>
              <div class="controls" id="showDAta">
                      
                              
               </div>
            </div>

               <div class="control-group">
              <label class="control-label">Text</label>
              <div class="controls">
                        <textarea name="text" name="text" rows="5" class="span6"></textarea>
                              
               </div>
            </div>

         
              <div class="form-actions">
                <input type="submit" value="Send" class="btn btn-success">
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
        <script type="text/javascript">
          function showData(){
     // alert('ddd');
       var data = $('#type').val();
       var brance = $('#Brance').val();
    //   alert(brance);
        if(data == "emp" || data == "mem" ){

            $("#showDAta").load("{{URL::to('showConNo')}}"+'/'+data+'/'+brance);
        
        }else if(data != "emp" || data != "mem"){

             $("#showDAta").html("");
          
        }
    }


  function check_all()
      {
      
      if($('#chkbx_all').is(':checked')){
        $('input.check_elmnt2').prop('checked', true);
      }else{
       
        $('input.check_elmnt2').prop('checked', false);
        }
    } 
    



 

        </script>
       <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection