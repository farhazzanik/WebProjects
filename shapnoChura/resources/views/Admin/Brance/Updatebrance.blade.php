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
              <li class="active"><a data-toggle="tab" href="#tab1">Update</a></li>
             
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Update Brance</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype="multipart/form-data" method="post"
             action="{{URL::to('UpdateBranceSucc')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             <div class="control-group" id="staticParent">
                <label class="control-label">Branch Name </label>
                <div class="controls">
                  <input type="text"  class='span6'  value="{{$selecValue[0]->name}}"
                   placeholder="Your Name"
                    name="Brance">

                     <input type="text"  class='span6'  value="{{$selecValue[0]->id}}" name="id">


                </div>
              </div>

             <div class="control-group" id="staticParent">
                <label class="control-label">Official NO</label>
                <div class="controls">
                  <input type="text"  class='span6'  value="{{$selecValue[0]->officialNo}}"
                   placeholder="Your Name"
                    name="Official">
                </div>
              </div>

               <div class="control-group" id="staticParent">
                <label class="control-label">Contact No</label>
                <div class="controls">
                  <input type="text"  class='span6'  
                  value="{{$selecValue[0]->mobileNo}}" name="mblNO">
                </div>
              </div>

                <div class="control-group">
              
                <label class="control-label">Email</label>
            
                <div class="controls">
                  <input type="email" class='span6' 
                  name="email" id="email" value="{{$selecValue[0]->email}}">
                </div>
              </div>

              <div class="control-group">
              
                <label class="control-label">Status</label>
            
                <div class="controls">
                <label>
                  <input type="radio" name="status" value='1' 
                    @if($selecValue[0]->status =='1') 
                  checked
                  @endif  />
                  Active</label>
                <label>
                  <input type="radio" name="status" value='0' 

                    @if($selecValue[0]->status =='0') 
                  checked
                  @endif

                   />
                  Deactive</label>

                </div>
              </div>


  <div class="control-group">
              
                <label class="control-label">Brance Address </label>
            
                <div class="controls">
                  <textarea name="BranceAddress" id="editor1">{{$selecValue[0]->branceAdd}}</textarea>
                </div>
              </div>



           




         

             


  <div class="control-group" id="staticParent">
                <label class="control-label">Choose Image </label>
                <div class="controls">
                	<input type='file' name='img' />   &nbsp;&nbsp;&nbsp;

                 <br/> <img src='{{URL::to("/")}}/public/imageHeader/{{$selecValue[0]->id}}.jpg' style='height:100px; width:100px;' />
                 </div>  
      </div>


        

           
             
              <div class="form-actions">
                <input type="submit" value="Update" class="btn btn-success">
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
<script src="{{URL::to('/')}}/public/editor3/ckeditor.js"></script> 
         <script type="text/javascript">
           CKEDITOR.replace('editor1');
           </script>
      

@endsection