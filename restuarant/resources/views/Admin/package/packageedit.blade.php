@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>

    <div class="row-fluid">
      <div class="span10">
        @include('error.msg')
 <div class="widget-box">
         
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Package </h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('editpacksuc')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
             {{ csrf_field() }}


              <div class="control-group">

                <div class="span6"> <label class="control-label">Item Name </label>
            
                <div class="controls">
                 <select id="ItemName"  onchange="showcat(),showres()" name="ItemName" class="span12">
                  <option value="{{$alldate[0]->item_id}}">{{$alldate[0]->item_name}}</option>
                    @if(count($mainMenu) > 0)
                    @foreach($mainMenu as $showitem)
                    @if($alldate[0]->item_id != $showitem->id)
                      <option value="{{$showitem->id}}">{{$showitem->item_name}}</option>
                      @endif
                    @endforeach
                    @endif
                 </select>
                </div></div>
                <div class="span6">
                <label class="control-label">Select Restaurant</label>
            
                <div class="controls">
                 <select id="Restaurant" name="Restaurant" class="span12">
                    <option value="{{$alldate[0]->res_id}}">{{$alldate[0]->res_name}}</option>
                 </select>
                </div></div>
              
               
              </div>

               <div class="control-group">

                <div class="span6"> <label class="control-label">Category Name </label>
            
                <div class="controls">
                 <select id="Category" name="Category" class="span12">
                      <option value="{{$alldate[0]->cat_id}}">{{$alldate[0]->category_name_eng}}</option>
                 </select>
                </div></div>
                <div class="span6">
                <label class="control-label">Product Type</label>
            
                <div class="controls">
                 <select id="Product" name="Product" class="span12">
                  <option>{{$alldate[0]->pro_type}}</option>
                   <option>Main Item</option>
                    <option>Sub Item</option>
                     <option>Choose Item</option>
                 </select>
                </div></div>
              
               
              </div>

             

               <div class="control-group">
              
                <label class="control-label">Food  Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Food Name" name="Food" id="Food" value="{{$alldate[0]->pro_name}}">
                   
<input type="hidden" class='span6' placeholder="Food Name" name="id" id="id" value="{{$alldate[0]->id}}">
                   

                </div>
              </div>


               <div class="control-group">
              
                <label class="control-label">Food  Price  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Price" id="Price" value="{{$alldate[0]->price}}">
                   

                </div>
              </div>

               <div class="control-group">
              
                <label class="control-label">Discount  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Discount" id="Discount" value="{{$alldate[0]->discount}}">
                   

                </div>
              </div>

              

              
              
              <div class="control-group">
              
                <label class="control-label">Details</label>
            
                <div class="controls">
                 <textarea name="Details" class='span6' rows="4">{{$alldate[0]->details}}</textarea>

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
                  <th>Restaurant Name</th>
                   <th>Category Name</th>
                  <th>Package Type</th>
                  <th>Package Name</th>
                  <th>Price</th>
                  <th>Discount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </thead>
              <tbody>
                @if(count($alldate) > 0)
                @foreach($alldate as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->item_name}}</td>
                   <td>{{$showDAta->category_name_eng}}</td>
                  <td>{{$showDAta->res_name}}</td>
                  <td>{{$showDAta->pro_type}}</td>
                  <td>{{$showDAta->pro_name}}</td>
                  <td>{{$showDAta->price}}</td>
                  <td>{{$showDAta->discount}}</td>
                
                  <td align="center"> <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/pack')}}/{{$showDAta->id}}.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/pack')}}/{{$showDAta->id}}.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul></td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="{{URL::to('editpack')}}/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini"  >Edit</a>
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
          $(".modal-body").load("{{URL::to('catmodel')}}"+'/'+id);
        }

        function showres(){


        var Brance = $('#ItemName').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Restaurant');
     
        if(Brance != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showrespack")}}/'+Brance,
                type:'GET',
                dataType:'json',
                beforeSend:function(){
                        $("#districloader").html(loader);
                              $('#batch').val("");
                },  
                success:function(data){
         // alert(data);
                  batchOption.empty();
                    batchOption.append('<option value="" selected disabled>Select One</option>');
                    $.each(data,function(index,value){


                  batchOption.append('<option value="'+value.id+'">'
                    +value.res_name+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                          
                 }





          });
          }


        }
        function showcat(){

        var Brance = $('#ItemName').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Category');
     
        if(Brance != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showcatpack")}}/'+Brance,
                type:'GET',
                dataType:'json',
                beforeSend:function(){
                        $("#districloader").html(loader);
                              $('#batch').val("");
                },  
                success:function(data){
         // alert(data);
                  batchOption.empty();
                    batchOption.append('<option value="" selected disabled>Select One</option>');
                    $.each(data,function(index,value){


                  batchOption.append('<option value="'+value.id+'">'
                    +value.category_name_eng+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                          
                 }





          });
          }
        }
      








 function deteDate(getId){
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('delpack')}}/"+getId,
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