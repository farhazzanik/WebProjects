@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>



    
   
        
                           <div class="widget-box">
   <form action="#" method="get" class="form-horizontal">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Information</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                   <th>SL</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Father Name</th>
                   <th>Contact No</th>
                   <th>Permanent Add.</th>
                   <th>Status</th>
                  
                   <th>Member Img</th>
                   <th>Brance Name </th>
                   <th>Added By</th>
                   <th>Action</th>
                </tr>
              </thead>
              <tbody>

 @if($id->id == '306' or $id->fk_brance_id =='1')
         
               @if(count($showAllData) > 0)
                 <?php $sl=0;?>
                @foreach($showAllData as $showDAta)
                  <?php $sl++;?>
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                 <td><?php echo $sl;?></td>
                 <td>{{$showDAta->id}}</td>
                  <td>{{$showDAta->mem_name}}</td>
                  <td>{{$showDAta->father_name}}</td>
                  <td>{{$showDAta->con_no}}</td>
                 
                  <td>{{$showDAta->perma_add}}</td>
                   <td>
                      @if($showDAta->status == '1')
                      Active
                      @else
                        Inactive
                      @endif
                 </td>


                
                   <td>  <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/memberImg')}}/{{$showDAta->id}}mem.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/memberImg')}}/{{$showDAta->id}}mem.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul> </td>
               <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->AdminName}}</td>

                  <td class="center">

                    <div class="fr"> 
                  <a href="editMemberInfo/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini" >Edit</a>
                       <a href="viewMem/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini"  target="_blank">Report</a>
                  

                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>



                       <a href="Send/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Send Message</a>

                      </div></td>
                </tr>
         
                @endforeach
                       @endif
               @endif
            
 @if($id->id != '306' or $id->fk_brance_id !='1')
              @if(count($adminDataWise) > 0)
              <?php $sl=0;?>
                @foreach($adminDataWise as $showDAta)
                <?php $sl++?>
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                <td><?php echo $sl;?></td>
                  <td>{{$showDAta->mem_name}}</td>
                  <td>{{$showDAta->father_name}}</td>
                  <td>{{$showDAta->con_no}}</td>
                  <td>{{$showDAta->perma_add}}</td>
                  <td>
                      @if($showDAta->status == '1')
                      Active
                      @else
                        Inactive
                      @endif
                 </td>

              
                   <td>  <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/memberImg')}}/{{$showDAta->id}}mem.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/memberImg')}}/{{$showDAta->id}}mem.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul> </td>
               <td>{{$showDAta->branceName}}</td>
                  <td>{{$showDAta->AdminName}}</td>

                  <td class="center">

                    <div class="fr"> 
                  <a href="editMemberInfo/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Edit</a>
                       <a href="viewMem/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini" target="_blank">Report</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>
 


                       


                       <a href="Send/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Send Message</a>
                      </div></td>
                </tr>
         
                @endforeach
                       @endif
            
@endif

             
            
           </tbody>
            </table>
          </div>
          </form>
        </div>
  
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