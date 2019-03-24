@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body" >
          <p>
                  

          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    
    <div class="row-fluid">
      <div class="span10">
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
            <h5>Item Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('saveitem')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
             {{ csrf_field() }}



              <div class="control-group">
              
                <label class="control-label">Item Name </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Item Name English" name="ItemName" id="ItemName" value="{{old('ItemName')}}">
                </div>
              </div>
            

             

                <div class="control-group">
              
                <label class="control-label">Image </label>
            
                <div class="controls">
                  
                    <input type='file' name='img'></input>
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
                  <th>Item Name</th>
                   <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </thead>
              <tbody>
                @if(count($mainMenu) > 0)
                @foreach($mainMenu as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  
                  <td>{{$showDAta->item_name}}</td>
                  <td align="center"> <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/item')}}/{{$showDAta->id}}.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/item')}}/{{$showDAta->id}}.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul></td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="#" onclick="loadModel('{{$showDAta->id}}')"
                      class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" >Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
                @endforeach
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
        <script type="text/javascript">
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('itemmodel')}}"+'/'+id);
        }

      








 function deteDate(getId){
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('deleteitem')}}/"+getId,
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
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection