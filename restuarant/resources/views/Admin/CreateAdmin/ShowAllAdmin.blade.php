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
              <li class="active"><a data-toggle="tab" href="#tab1">View</a></li>
             
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Show All  Admin</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{URL::to('CreateAdmin')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             
             <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                   <th>Status</th>
                   <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </thead>
              <tbody>
               @if($id->id == '306')
                @if(count($showAdmin) > 0)
                @foreach($showAdmin as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->name}}</td>
                  <td>{{$showDAta->email}}</td>
                  <td>
                    @if($showDAta->Status =='1')
<a href="#"  class="btn btn-success btn-mini"  >Active</a>
                    @else
<a href="#"  class="btn btn-danger btn-mini"  >Deactive</a>
                    @endif
                  </td>

                  <td>  <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/AdminImg')}}/{{$showDAta->id}}.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/AdminImg')}}/{{$showDAta->id}}.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul></td>
                  <td class="center">

                    <div class="fr"> 
                 
 <a href="{{URL::to('UpdateData')}}/{{$showDAta->id}}" class="btn btn-success btn-mini" >
                      Update</a>
                  <a class="btn btn-danger btn-mini" onclick="DeleteAdmin('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
                @endforeach
                       @endif
                        @endif

                @if($id->id != '306')          
               @if($id->fk_brance_id == '1')
                @if(count($showAdmin) > 0)
                @foreach($showAdmin as $showDAta)
                @if($showDAta->id != '306')
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->name}}</td>
                  <td>{{$showDAta->email}}</td>
                  <td>
                    @if($showDAta->Status =='1')
<a href="#"  class="btn btn-success btn-mini"  >Active</a>
                    @else
<a href="#"  class="btn btn-danger btn-mini"  >Deactive</a>
                    @endif
                  </td>

                  <td>  <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/AdminImg')}}/{{$showDAta->id}}.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/AdminImg')}}/{{$showDAta->id}}.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul></td>
                  <td class="center">

                    <div class="fr"> 
                 
 <a href="{{URL::to('UpdateData')}}/{{$showDAta->id}}" class="btn btn-success btn-mini" >
                      Update</a>
                  <a class="btn btn-danger btn-mini" onclick="DeleteAdmin('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
          @endif
                @endforeach
                       @endif
                        @endif
                         @endif


            
           </tbody>
            </table>
          </div>


            </form>
          </div>
             </div> 
            </div>
           
          </div>
        </div>
        </div>
        </div></div>
       
<script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
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

       









 function DeleteAdmin(getId){
           
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('AdminDeleteById')}}/"+getId,
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