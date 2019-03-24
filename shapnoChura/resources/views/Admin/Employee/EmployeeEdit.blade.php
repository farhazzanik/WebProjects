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
              <li class="active"><a data-toggle="tab" href="#tab1">Edit</a></li>
              
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Employee Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal"  enctype="multipart/form-data" method="post" action="{{URL::to('editSuccessEm')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             
              @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
                
                <option value="{{$data[0]->fk_branc_id}}">{{$data[0]->brancename}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $data[0]->fk_branc_id !=  $showData->id)

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




             <div class="control-group" id="staticParent">
                <label class="control-label">Serial No (<strong class="text-danger">Must Be English</strong>)</label>
                <div class="controls">
                  <input type="text"  class='span6'   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   value="{{$data[0]->serialNo}}" placeholder="Serial No"
                   id="child" name="serial">

 <input type="hidden"  class='span6'    value="{{$data[0]->id}}" name="id">
                
                </div>
              </div>


             






              <div class="control-group">
              
                <label class="control-label">Employee Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Employee Name English" name="Employee" id="Employee" value="{{$data[0]->Name}}">

                    <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                </div>
              </div>
            
           




            <div class="control-group">
              
                <label class="control-label">Father's Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Father Name English" name="Father" id="Father" value="{{$data[0]->fatherName}}">
                </div>
              </div>
            

               <div class="control-group">
              
                <label class="control-label">Mother's Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Mother Name English" name="Mother" id="Mother" value="{{$data[0]->MotherName}}">
                </div>
              </div>
            

              <div class="control-group">
              
                <label class="control-label">Contact No.  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="01756477771" name="Contact" id="Contact" value="{{$data[0]->contactNo}}">
                </div>
              </div>


                <div class="control-group">
              
                <label class="control-label">NID No. </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="NID NO" name="NID" id="NID" value="{{$data[0]->NIDno}}">
                </div>
              </div>
            

                 <div class="control-group">
              
                <label class="control-label">Email  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="exmaple@mail.com " name="Email" id="Email" value="{{$data[0]->email}}">
                </div>
              </div>


                
              <div class="control-group">
              
                <label class="control-label">Present Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Present">{{$data[0]->presentAddress}}</textarea>
                </div>
              </div>
            
              <div class="control-group">
              
                <label class="control-label">Permanent  Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{$data[0]->permanentAddress}}</textarea>
                </div>
              </div>



              <div class="control-group">
              
                <label class="control-label">Image  </label>
            
                <div class="controls">
                
                      <input type="file" name="empimage" accept="image/*">
                       <br/>
                         <br/>
                           <br/>
                            <img src="{{URL::asset('public/employeeImg')}}/{{$data[0]->id}}.jpg" alt=""  style="height: 80px; width: 80px;" >
          
                </div> 

               </div>
            


             

            
           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
             </div>  </p>
            </div>
           
           
          </div>
        </div>
        </div>
        </div></div>
        

@endsection