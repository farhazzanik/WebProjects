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
            <h5>Investment report sheet Info
</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype='multipart/form-data' method="post" action="{{URL::to('saveMem')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
              <label class="control-label">  Date
</label>
              <div class="controls">
                <input type="text" name="date"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

            


                





              
            
            <div class="control-group">
              
                <label class="control-label">Name of the  investor</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Name of the investor" name="investor" id="investor" value="{{old('investor')}}">
                </div>
              </div>
       

            
            
             <div class="control-group">
              
                <label class="control-label"> Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Address  ">{{old('Address')}}</textarea>
                </div>
              </div>


            

            
     

             

           



  

   


              <div class="control-group">
              
                <label class="control-label">Investment account no
 </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Investment account no
" name="Invaccno" id="Invaccno" value="{{old('Invaccno')}}">
                </div>
              </div>

               <div class="control-group">
              
                <label class="control-label">Amount of investment</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Amount of investment" name="Amount" id="Amount" value="{{old('Amount')}}">
                  
                </div>
              </div>
       

               <div class="control-group">
              
                <label class="control-label">Installment number</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Installment number" name="number" id="number" value="{{old('number')}}">
                </div>
              </div>



               <div class="control-group">
              
                <label class="control-label">Amount of installment
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Amount of installment" name="ammIns" id="ammIns" value="{{old('ammIns')}}">
               
                </div>
              </div>



                 
            <div class="control-group">
              <label class="control-label">Investment acceptance date 
</label>
              <div class="controls">
                <input type="text" name="acceptance"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

            
            <div class="control-group">
              
                <label class="control-label">Investment period

  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Investment period" name="period" id="period" value="{{old('period')}}">
                   
                </div>
              </div>



            
            <div class="control-group">
              
                <label class="control-label">Arrears at the end of the expiration

  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Arrears at the end of the expiration" name="Arrearsexpdate" id="Arrearsexpdate"   value="{{old('Arrearsexpdate')}}">
                   
                </div>
              </div>

               <div class="control-group">
              <label class="control-label">Full investment payment date

</label>
              <div class="controls">
                <input type="text" name="FullinvPayDate"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{date('d-m-Y')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>


             <div class="control-group">
              
                <label class="control-label"> Comment </label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Comment">{{old('Comment')}}</textarea>
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
                  <th>Name</th>
                  <th>Father Name</th>
                   <th>Contact No</th>
                   <th>Permanent Add.</th>
                   <th>Nominee Name</th>
                   <th>Member Img</th>
                   <th>Brance Name </th>
                   <th>Added By</th>
                   <th>Action</th>
                </tr>
              </thead>
              <tbody>



             
            
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
  $('.datepicker').datepicker();
   $('.datepickerss').datepicker();

</script>

        <script type="text/javascript">
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('AdminMainMenuModel')}}"+'/'+id);
        }

        


 function viewShowImage(e){
    var file = e.files[0];
      var imagefile = file.type;    
      var type = ["image/jpeg","image/png","image/jpg"];
      if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2]){
        var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
      }else{
        alert("Please select a vild image");
      }
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
        //$("#textt").text("Selected Image : ");
                $("#preview").attr('src',e.target.result);
       
            }
      }
      $(":file").filestyle();



function viewShowImagee(e){
    var file = e.files[0];
      var imagefile = file.type;    
      var type = ["image/jpeg","image/png","image/jpg"];
      if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2]){
        var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
      }else{
        alert("Please select a vild image");
      }
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
        //$("#textt").text("Selected Image : ");
                $("#previewe").attr('src',e.target.result);
       
            }
      }
      $(":file").filestyle();





 function deteDate(getId){
             if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('deleteMem')}}/"+getId,
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