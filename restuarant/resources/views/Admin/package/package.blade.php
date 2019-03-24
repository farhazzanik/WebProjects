@extends('Admin.index')
@section('body')
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
 <div class="container-fluid">
    <hr>

    <div class="row-fluid">
      <div class="span12">
        @include('error.msg')
    

<div style="display: none;" id="alert" class="alert alert-success"> <br/></div>


 <div class="widget-box">
     
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Package  Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form  id="uploaddiamond" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" >
             {{ csrf_field() }}


              <div class="control-group">

                 <div class="controls span4" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Select Restaurant</span>
                      <select id="Restaurant" name="Restaurant" class="span12" required="" onchange="show_current_purchase_product()">
                        <option>Select One</option>
                     @if(count($rest) > 0)
                    @foreach($rest as $showitem)
                      <option value="{{$showitem->id}}">{{$showitem->res_name}}</option>
                    @endforeach
                    @endif
                 </select>
                  </div>


                                <div class="controls span4" style="margin-left: 10px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Item Name</span>
                      <select id="ItemName" name="ItemName" class="span12" required="" onchange="show_current_purchase_product()">
                 <option>Select One</option>
                    @if(count($mainMenu) > 0)
                    @foreach($mainMenu as $showitem)
                      <option value="{{$showitem->id}}">{{$showitem->item_name}}</option>
                    @endforeach
                    @endif
                 </select>
                  </div>

                      <div class="controls span3" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Product Type</span>
                     <select id="Product" name="Product" class="span12">
                   <option>Main Item</option>
                    <option>Sub Item</option>
                     <option>Choose Item</option>
                 </select>
                 <input type="hidden" name="Category" id="Category" value="asdf">
                  </div>
               
              </div>




              
              
               <div class="control-group">
                
                  <div class="controls span4" style="margin-left: 05px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Food  Name  </span>
                     <input type="text" class='span12' placeholder="Food Name" name="Food" id="Food" value="{{old('Food')}}" required="">
                  </div>

                    <div class="controls span4" style="margin-left: 05px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Food  Price  </span>
                     <input type="text" class='span12' placeholder="12000" name="Price" id="Price" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  value="{{old('Price')}}" required="">
                  </div>

                  <div class="controls span4" style="margin-left: 05px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Discount  </span>
                     <input type="text" class='span12' placeholder="12000" name="Discount" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  id="Discount" value="{{old('Discount')}}">

                      <input type="hidden" class='span12' placeholder="12000" name="packid" id="packid" value="{{$autid}}">
                  </div>


                
              </div>


               <div class="control-group">
              
             
                  <div class="controls span6" style="margin-left: 05px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Details </span>
                   <textarea id="Details" name="Details" class='span12' rows="4">{{old('Details')}}</textarea>
                  </div>

                 


                  <div class="controls span3" style="margin-left: 05px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Image </span>
                  <input type='file' id="img" name='img'></input>
                  </div>

                   <div class="controls span3" style="margin-left: 05px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">. </span>
                  
                    <input type="button" value="Save" class="btn btn-info" onclick="add_current_data()">
                  </div>

            </div>
              

              
          </div>
          </form>
          <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                  <h5>Show Save Products</h5>
              </div>

              <div class="widget-content nopadding" style="overflow: scroll;">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                       
                        <th style="width:150px;">Restaurant Name</th>
                        <th style="width:180px;">Item Name</th>
                        <th style="width:200px;">Food Name</th>
                        <th style="width:270px;">Details</th>
                        <th style="width:50px;">Price</th>
                        <th style="width:50px;">Discount</th>
                        <th style="width:50px;">Net Price</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="show_current_purchase">
                        
                    </tbody>
                    <tr style="width: 100%;" align="right">
                            <td colspan="9" > <input type="button" value="Submit" class="btn btn-success" onclick="submit()"> </td>
                        </tr>
                  </table>
                </div>
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
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('catmodel')}}"+'/'+id);
        }
       



function submit(){
   var packid = $('#packid').val();
var resid = $('#Restaurant').val();
if( resid!= "")
{
    $.ajax({
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      url: '{{ url("subpacksuc") }}',
      type: 'POST',
    data: {packid:packid,resid:resid},
      success:function(data){
         location.reload();
      }
    });
    }else{

  alert('Please Fill Out All Fields');
}
}

function add_current_data(){

       
 var packid = $('#packid').val();
var resid = $('#Restaurant').val();
   var img = document.getElementById('img');
   var form_data = new FormData();
  form_data.append('file', img.files[0]);
  form_data.append('_token', '{{csrf_token()}}');
  form_data.append('packid', $('#packid').val());
  form_data.append('ItemName', $('#ItemName').val());
  form_data.append('Restaurant', $('#Restaurant').val());
  form_data.append('Category', $('#Category').val());
  form_data.append('Product', $('#Product').val());
  form_data.append('Food', $('#Food').val());
  form_data.append('Price', $('#Price').val());
  form_data.append('Discount', $('#Discount').val());
  form_data.append('Details', $('#Details').val());


  

          $.ajax({
            url: "{{url('savepack')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                show_current_purchase_product();
            },
            error: function (xhr, status, error) {
              alert('Something went wrong ..!!');
            }
        });
       show_current_purchase_product();

}


function show_current_purchase_product(){

  var packid = $('#Restaurant').val();
  var ItemName =  $('#ItemName').val();
   $.ajax({
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      url: '{{ url("ShowCurrentproduct") }}',
      type: 'POST',
      data: {packid:packid,ItemName:ItemName},
      success:function(data){
        $('#show_current_purchase').html(data);
       
      }
    });

}

function edit(id,proname,details,price,discount){
  
      $('#pro-'+id).html('');
       $('#pro-'+id).html('<input type="text" name="pro" id="proname-'+id+'" value="'+proname+'" />');
             $('#price-'+id).html('');
       $('#price-'+id).html('<input style="width:70px;" type="text" name="price" id="priced-'+id+'" value="'+price+'"/>');

            $('#det-'+id).html('');
       $('#det-'+id).html('<textarea rows="4"  name="details" id="details-'+id+'">'+details+'</textarea>');

            $('#dis-'+id).html('');
       $('#dis-'+id).html('<input style="width:70px;" type="text" name="pro" id="discount-'+id+'" value="'+discount+'"  />');
           $('#ac-'+id).html('');
       $('#ac-'+id).html('<a class="btn btn-success btn-mini" onclick="savesuck('+id+')">save</a>');
}

function savesuck(id){
  
  var form_data = new FormData();
  form_data.append('file',  img.files[0]);
  form_data.append('_token', '{{csrf_token()}}');
  form_data.append('id', id);
 form_data.append('pro', $('#proname-'+id).val());
  form_data.append('price', $('#priced-'+id).val());
  form_data.append('det', $('#details-'+id).val());
  form_data.append('dis', $('#discount-'+id).val());

   $.ajax({
            url: "{{url('editpacksuc')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                show_current_purchase_product();
            },
            error: function (xhr, status, error) {
              alert('Something went wrong ..!!');
            }
        });
     
 

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
show_current_purchase_product();

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