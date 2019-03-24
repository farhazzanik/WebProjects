@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>



    
    <div class="row-fluid">
      <div class="span12">
        @include('error.msg')
 <div class="widget-box">
       



          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Member Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype='multipart/form-data' method="post" action="{{URL::to('saveMem')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}


<div class="span12">
  
   <div class="span6" style="float: left;clear: right;">
               

             @if($id->fk_brance_id == '1')

          <div>
              <label>Branch Name</label>
              <div >
                
 
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

             </div>

 <div class="span6" style="float: left;clear: right;">
    <div >
              
                <label>Application Date </label>
            
                <div >
                  <input type="text" name="ApplicationD"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{old('ApplicationD')}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span>
                </div>
              </div>

 </div>

</div>
          
  <div class="span12">
        <div class="span4">
<div >
              
                <label >Member  ID </label>
            
                <div>
                  <input type="text" name="memid"   class="span6" />
               </div>
              </div>


            </div>      
         <div class="span4">   <div >
              
                <label>Share Number</label>
            
                <div >
                  <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="Share Number" name="ShareNum" id="ShareNum" value="{{old('Share')}}">
               
                </div>
              </div>
</div>      
          <div class="span4">  <div>
              
                <label>Share Price</label>
            
                <div >
                  <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="Share Price" name="SharePrice" id="SharePrice" value="{{old('SharePrice')}}">
               
                </div>
              </div></div>      

  </div>


 <div class="span12">
        <div class="span4"> 
              <div >
              
                <label >Applicant Name  </label>
            
                <div >
                  <input type="text" class='span6' placeholder="Member Name English" name="Employee" id="Employee" value="{{old('Employee')}}">
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                </div>
              </div></div>
              <div class="span4">
  <div>
              <label>Age</label>
              <div >
                <input type="text" name="AppBirth"  value="{{old('AppBirth')}}"   class=" span6" />
                </div>
            </div> </div>
              <div class="span4">




                    <div >
              
                <label> Date of Birth</label>
            
                <div >
                  <input type="text" name="bd"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{old('bd')}}" class="datepickers span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span>
                </div>
              </div>


          </div>

  </div>



 <div class="span12">
        <div class="span6">  <div >
              
                <label >Father's Name   </label>
            
                <div >
                  <input type="text" class='span6' placeholder="Father Name English" name="Father" id="Father" value="{{old('Father')}}">
                </div>
              </div> </div>
        <div class="span6">

          <div>
              
                <label>Mother's Name  </label>
            
                    <div>
                      <input type="text" class='span6' placeholder="Mother Name English" name="Mother" id="Mother" value="{{old('Mother')}}">
                    </div>
              </div> </div>
       
  </div>
     

 <div class="span12">  <div class="span6"><div>
              
                <label>Husband Name /Wife Name  </label>
            
                    <div>
                      <input type="text" class='span6' placeholder="" name="Husband" id="Husband" value="{{old('Husband')}}">
                    </div>
              </div> </div>
               <div class="span6">
                 
     
 <div>
              
                <label>Occupation</label>
            
                <div>
                  <input type="text" class='span6' placeholder="Occupation" name="Occupation" id="Occupation" value="{{old('Occupation')}}">
                  
                </div>
              </div>
             

               </div>

 </div>

  <div class="span12">  <div class="span4">
 <div>
              
                <label>Admission Fee / Others </label>
            
                <div>
                  <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="Admission Fee" name="Fee" id="Fee" value="{{old('Fee')}}">
               
                </div>
              </div>
  </div>
   <div class="span4"> <div >
              
                <label >NID NO </label>
            
                <div >
                  <input type="text" class='span6' placeholder="NID NO" name="NID" id="NID" value="{{old('NID')}}">
                </div>
              </div></div>
                 <div class="span4"> 
              <div >
              
                <label>Contact NO  </label>
            
                <div>
                  <input type="text" class='span6' placeholder="01756477771" name="Contact" id="Contact" value="{{old('Contact')}}">
                </div>
              </div>
</div>
</div>

             

  <div class="span12">  <div class="span6"> <div>
              
                <label>Present Address</label>
            
                <div>
                
                        <textarea rows="4" style="width: 300px;" name="Present">{{old('Present')}}</textarea>
                </div>
              </div></div>
              <div class="span6"> 
              <div>
              
                <label>Permanent  Address</label>
            
                <div>
                
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{old('Permanent')}}</textarea>
                </div>
              </div></div>
</div>
             

              
<div class="span12">  <div class="span4">
<div>
              <label>Applicant Image : </label>
              <div>
                     <input type="file" name="memiimg" accept="image/*" onChange="viewShowImage(this)" >
              <br/>
              <img id="preview" src="{{URL::to('/')}}/public/NeddImg/nolevel.jpeg"
               class='img-responsive img-thumbnail' height='190' width='190'
                style='margin-top: 5px; margin-left:15px;' />
            </div>
            </div></div>
 <div class="span4">             
           

<div>
              <label>Applicant Sign Image : </label>
              <div>
                     <input type="file" name="Sign" accept="image/*" onChange="viewShowImagesign(this)" >
              <br/>
              <img id="previewsign" src="{{URL::to('/')}}/public/NeddImg/nolevel.jpeg"
               class='img-responsive img-thumbnail' height='190' width='190'
                style='margin-top: 5px; margin-left:15px;' />
            </div>
            </div></div>
  <div class="span4">
           <div>
                   <br/> <label >Status</label>
                    <div>
                      <label>
                        <input type="radio" name="Status" value="1" />
                        Active</label>
                      <label>
                        <input type="radio" name="Status" value="2" />
                        Inactive</label>
                  
                    </div>
            </div>

            <br/>
             <div>
                    <label >Gender</label>
                    <div>
                        <label>
                        <input type="radio" name="Gender" value="Male" />
                        Male
                     </label>   <label>
                        <input type="radio" name="Gender" value="Female" />
                        Female
                      </label>
                  
                    </div>
            </div> 



          </div>

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
        </div>

         <meta name="_token" content="{!! csrf_token() !!}" />

<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
  
  $('.datepicker').datepicker();
  $('.datepickers').datepicker();

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


 function viewShowImagesign(e){
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
                $("#previewsign").attr('src',e.target.result);
       
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