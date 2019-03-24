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
              <li class="active"><a data-toggle="tab" href="#tab1">ADD</a></li>
              <li><a data-toggle="tab" href="#tab2">View</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Brance Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{URL::to('SaveBranceInfo')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

          

              <div class="control-group">
              
                <label class="control-label">Branch  Name </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Brance Name" 
                  name="Brance" id="Brance" value="{{old('Brance')}}">
                </div>
              </div>

            
             <div class="control-group">
              
                <label class="control-label">Official  No </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="+8801111111111"
                   name="Official" id="Official" value="{{old('Official')}}">
                </div>
              </div>

                 
            



             <div class="control-group">
              
                <label class="control-label">Contact No </label>
            
                <div class="controls">
                  <input type="text" class='span6' 
                  placeholder="+8801111111111,+8802222222222" name="mblNO" id="mblNO" value="{{old('mblNO')}}">
                </div>
              </div>
            
             <div class="control-group">
              
                <label class="control-label">Email</label>
            
                <div class="controls">
                  <input type="email" class='span6' placeholder="example@mail.com" name="email" id="email" value="{{old('email')}}">
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



            <div class="control-group">
              
                <label class="control-label">Brance Address </label>
            
                <div class="controls">
                  <textarea name="BranceAddress" id="editor1">{{old('BranceAddress')}}</textarea>
                </div>
              </div>

                   <div class="control-group">
              
                <label class="control-label">Brance Header Image </label>
            
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
                  <th>Name</th>
                  <th>Mobile No</th>
                   <th>Email</th>
                   <th>Status</th>
                   <th>Official No</th>
                   <th>Brance Add..</th>
                  <th>Action</th>
                </tr>
              </thead>
              
              <tbody>
                @if(count($allData) > 0)
                @foreach($allData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->name}}</td>
                  <td>{{$showDAta->mobileNo}}</td>
                  <td>{{$showDAta->email}}</td>
                  <td>
                    @if($showDAta->status =='1')
<a href="#"  class="btn btn-success btn-mini"  >Active</a>
                    @else
<a href="#"  class="btn btn-danger btn-mini"  >Deactive</a>
                    @endif
                  </td>
      <td>{{$showDAta->officialNo}}</td>
                  <td> <?php
            
           $string1=$showDAta->branceAdd;
    
    $a=array("\r\n", "\n", "\r");
    $replace='<br />';
    $about1=str_replace($a, $replace, $string1);
    print $about1;
            ?>

          </td>
                  <td class="center">

                    <div class="fr"> 
                 
 <a href="{{URL::to('UpdateBrance')}}/{{$showDAta->id}}" class="btn btn-success btn-mini" >
                      Update</a>
                  <a class="btn btn-danger btn-mini" onclick="DeleteAdmin('{{$showDAta->id}}')" >
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
         <script src="{{URL::to('/')}}/public/editor3/ckeditor.js"></script> 
        <script type="text/javascript">


            CKEDITOR.replace('editor1');









 function DeleteAdmin(getId){
             if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('DeleteBrance')}}/"+getId,
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