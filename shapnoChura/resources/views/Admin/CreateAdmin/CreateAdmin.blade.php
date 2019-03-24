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
             
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Create Admin</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{URL::to('CreateAdmin')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}


              <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                <select  name ="brancename"  id="countryId" class="span6">
                 
         @if($id->id == '306')
              @if(count($branceNam) > 0)
              @foreach($branceNam as $showData)
              <option value="{{$showData->id}}" >{{$showData->name}}</option>
               @endforeach
              @endif      
          @endif

            @if($id->id != '306' && $id->fk_brance_id != '1' )
            @if(count($ADminbranceNam) > 0)
              @foreach($ADminbranceNam as $showData)
                   <option value="{{$showData->id}}" >{{$showData->name}}</option>
               @endforeach
           @endif 
           @endif  

          @if($id->id != '306')
          @if($id->fk_brance_id == '1')

                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                   @if($id->fk_brance_id != $showData->id)
                  <option value="{{$showData->id}}" >{{$showData->name}}</option>
                  @endif
                   @endforeach
                  @endif   
          @endif
          @endif
                </select>
               <span id="loader"></span>
              </div>
            </div>


             <div class="control-group" id="staticParent">
                <label class="control-label">Your Name </label>
                <div class="controls">
                  <input type="text"  class='span6'  value="{{old('Name')}}"
                   placeholder="Your Name"
                    name="Name">
                </div>
              </div>

               <div class="control-group" id="staticParent">
                <label class="control-label">Your Email </label>
                <div class="controls">
                  <input type="email"  class='span6'  value="{{old('email')}}" placeholder="example@mail.com"
                   id="child" name="email">
                </div>
              </div>




              <div class="control-group">
              
                <label class="control-label">Password</label>
            
                <div class="controls">
                  <input type="Password" class='span6' placeholder="Password" name="Password" id="MenuNameEn" value="{{old('Password')}}">
                </div>
              </div>
            
          <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <label>
                  <input type="radio" name="status" value='1' />
                  Active</label>
                <label>
                  <input type="radio" name="status" value='0' />
                  Deactive</label>
               
              </div>
            </div>

             


  <div class="control-group" id="staticParent">
                <label class="control-label">Choose Image </label>
                <div class="controls">
                	<input type='file' name='img' /> 
                 </div>
      </div>

<br/>
        <div class="control-group " id="staticParent" style=''>
              <div style='text-align:center;' class='span12'>
         <label style='background-color:#000; height:30px; color:white; font-size:16px; margin-left:10px; width:95%;'  class='linkname '>
                     <input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />&nbsp; 
                     <span><strong class="text-danger ">Select All</strong></span></label>

              </div>
@if($id->id == '306')
             @if(count($mainMenu) > 0)
             @foreach($mainMenu as $showMainMenu)
            

             <div class='span11 cheeked'>
             <label style='background-color:#ccc;margin-left:10px; width:95%;  height:30px; '  class='linkname '>
 &nbsp;&nbsp; <input type="checkbox" name="linkID[]"  class="check_elmnt" 
  onclick="return chekMain('{{$showMainMenu->id}}')" id='linkID-{{$showMainMenu->id}}' />
                 {{$showMainMenu->Link_Name}}</label></div>


          
             	
             	@if(count($submenu) > 0)
             	@foreach($submenu as $showsubmenu)
             		@if($showMainMenu->id == $showsubmenu->mainmenuId)
            <div class="span3" >  
                   <label style='background-color:#fff;margin-left:10px;  width:95%;   height:30px;'>
  &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="SublinkID[]"  class="check_elmnt2" disabled="disabled"
  id="sublinkID-{{$showMainMenu->id}}" value='{{$showMainMenu->id}}and{{$showsubmenu->id}}'/>
                 {{$showsubmenu->submenuname}}</label></div>
               
                 @endif
                  @endforeach
                  @endif
                  @endforeach
                  @endif
       @endif



 @if(count($adminwiseMain) > 0)
             @foreach($adminwiseMain as $showMainMenu)
            

             <div class='span11 cheeked'>
             <label style='background-color:#ccc;margin-left:10px; width:95%;  height:30px; '  class='linkname '>
 &nbsp;&nbsp; <input type="checkbox" name="linkID[]"  class="check_elmnt" 
  onclick="return chekMain('{{$showMainMenu->id}}')" id='linkID-{{$showMainMenu->id}}' />
                 {{$showMainMenu->Link_Name}}</label></div>


          
              
              @if(count($adminwiseSub) > 0)
              @foreach($adminwiseSub as $showsubmenu)
                @if($showMainMenu->id == $showsubmenu->mainmenuId)
            <div class="span3" >  
                   <label style='background-color:#fff;margin-left:10px;  width:95%;   height:30px;'>
  &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="SublinkID[]"  class="check_elmnt2" disabled="disabled"
  id="sublinkID-{{$showMainMenu->id}}" value='{{$showMainMenu->id}}and{{$showsubmenu->id}}'/>
                 {{$showsubmenu->submenuname}}</label></div>
               
                 @endif
                  @endforeach
                  @endif
                  @endforeach
                  @endif
         

                
      </div>
           

           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
             </div> 
            </div>
           
          </div>
        </div>
        </div>
        </div></div>
       

         <meta name="_token" content="{!! csrf_token() !!}" />
<script>
  
      function check_all()
      {
      
      if($('#chkbx_all').is(':checked')){
        $('input.check_elmnt2').prop('disabled', false);
        $('input.check_elmnt').prop('checked', true);
        $('input.check_elmnt2').prop('checked', true);
      }else{
        $('input.check_elmnt2').prop('disabled', true);
        $('input.check_elmnt').prop('checked', false);
        $('input.check_elmnt2').prop('checked', false);
        }
    } 
    

    function chekMain(getID){
       
          if($('#linkID-'+getID).is(':checked')){
              
            $("input#sublinkID-"+getID).attr('disabled', false);
            $("input#sublinkID-"+getID).attr('checked', true);
          
          }else{
            $("input#sublinkID-"+getID).attr('disabled', true);
            $("input#sublinkID-"+getID).attr('checked', false);
          
          }
      
        }




</script>
        <script type="text/javascript">
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('AdminMainMenuModel')}}"+'/'+id);
        }

       









 function deteDate(getId){
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('adminDeleteData')}}/"+getId,
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

        </script>


@endsection