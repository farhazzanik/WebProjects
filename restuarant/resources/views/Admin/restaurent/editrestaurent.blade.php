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
            <h5>Restaurant  Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('edisucresinfo')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
             {{ csrf_field() }}

              <div class="control-group">

                 <div class="controls span4" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Restaurent  Name</span>
                     <input type="text" class='span12' placeholder="Restaurent Name" name="RestaurentName" id="RestaurentName" value="{{$alldate[0]->res_name}}">
                  </div>


                                <div class="controls span4" style="margin-left: 10px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Main Location</span>
                         <input type="text" class='span12' placeholder="Main Location" name="MainLocation" id="MainLocation" value="{{$alldate[0]->mail_location}}}">
                         <input type="hidden" class='span6' placeholder="Main Location" name="id" id="id" value="{{$alldate[0]->id}}">

                  </div>

                      <div class="controls span3" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Sub Location</span>
                     <input type="text" class='span12' placeholder="Sub Location" name="SubLocation" id="SubLocation" value="{{$alldate[0]->sub_location}}">
                   
                </div>
               
              </div>

                <div class="control-group">

                 <div class="controls span3" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Contact No </span>
                    <input type="text" class='span8' placeholder="+8801756477771" name="contactno" id="contactno" value="{{$alldate[0]->phone}}">
                   

                  </div>


                                <div class="controls span3" style="margin-left: 10px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Email</span>
                         <input type="email" class='span8' placeholder="mail@mail.com" name="email" id="email" value="{{$alldate[0]->email}}">
                  
                  </div>

                      <div class="controls span5" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Address</span>
                     <textarea name="address" class='span8' rows="4">{{$alldate[0]->address}}</textarea>

                   
             
                  </div>
               
              </div>

 <div class="control-group">

                 <div class="controls span2" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Commission </span>
                    <input type="text" class='span12' placeholder="Commission" name="Commission" id="Commission" value="{{$alldate[0]->commission}}">
                   

                  </div>


                                <div class="controls span3" style="margin-left: 10px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Contact Paper</span>
                        <input type='file' name='Contact'></input>
                  
                  </div>

                      <div class="controls span3" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Logo</span>
                     <input type='file' name='logo'></input>
                   
             
                  </div>

                    <div class="controls span3" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Banner</span>
                     <input type='file' name='Banner'></input>
                   
             
                  </div>
               
              </div>
             

             <div class="control-group">

                 <div class="controls span4" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Google Map </span>
                     <input type="text" class='span12' placeholder="Google Map" name="GoogleMap" id="GoogleMap" value="{{$alldate[0]->google_map}}">
                 

                  </div>


                                <div class="controls span3" style="margin-left: 10px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Referance By</span>
                       <input type="text" class='span12' placeholder="Referance By" name="ReferanceBy" id="ReferanceBy" value="{{$alldate[0]->referanceby}}">
                   
                  </div>

                      <div class="controls span2" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Opening Time</span>
                    <input type="text" class='span12' placeholder="Opening Time" name="OpeningTime" id="OpeningTime" value="{{$alldate[0]->openingtime}}">
                   
             
                  </div>

                    <div class="controls span2" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Closing Time</span>
                       <input type="text" class='span12' placeholder="Opening Time" name="OpeningTime" id="OpeningTime" value="{{$alldate[0]->closingtime}}">
                         <input type="hidden" name="ItemName" id="ItemName" value="1">
             
                  </div>
               
              </div>
             
               <div class="control-group">

                 <div class="controls span3" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Type Of Company </span>
                     <select id="typeofcom" name="typeofcom" class="span12">
                  <option>{{$alldate[0]->type_of_company}}</option>
                   
                   <option>Restaurent Food</option>
                   <option>Home Made Food</option>
                 </select>

                  </div>


                           

                      <div class="controls span2" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Delivery Fee</span>
                    <input type="text" class='span12' placeholder="1500" name="Deliveryfee" id="Deliveryfee" value="{{$alldate[0]->deliveryfee}}">
                   
             
                  </div>

                    <div class="controls span2" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Delivery Time</span>
                       <input type="text" class='span12' placeholder="60 Minutes" name="Deliverytime" id="Deliverytime" value="{{$alldate[0]->deliverytime}}">
             
                  </div>
                  <div class="controls span2" style="margin-left: 20px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Vat</span>
                       <input type="text" class='span12' placeholder="1%" name="Vat" id="Vat" value="{{$alldate[0]->vat}}">
             
                  </div>
                       <div class="controls span2" style="margin-left: 10px" >
                    <span class="help-block blue" style="text-align: left;margin-left: 10px">Service Charge</span>
                      <input type="text" class='span12' placeholder="1%" name="Charge" id="Charge" value="{{$alldate[0]->service}}">
                   
                  </div>
               
              </div>
             

              <div class="control-group">
              
                <label class="control-label">Rating </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="1" name="Rating" id="Rating" value="{{$alldate[0]->rating}}">
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

      








 function deteDate(getId){
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('delrest')}}/"+getId,
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