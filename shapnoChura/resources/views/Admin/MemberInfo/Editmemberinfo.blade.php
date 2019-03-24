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
              <li class="active"><a data-toggle="tab" href="#tab1">Edit</a></li>
              
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Member Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" enctype='multipart/form-data' method="post" action="{{URL::to('edotSuccMem')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}


             <div class="span12">
                  <div class="span6">   



                    @if($id->fk_brance_id == '1')

          <div>
              <label">Branch Name</label>
              <div>     
 
                <select  name ="Brance"  id="Brance" class="span6">
                
                <option value="{{$data[0]->fk_brance_Id}}">{{$data[0]->branceName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $data[0]->fk_brance_Id !=  $showData->id)

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
                   <div class="span6">   <div>
              
                <label>Application Date </label>
            
                <div>              <input type="text" name="ApplicationD"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$data[0]->appDate}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span>
                </div>
              </div>
</div>
             </div>











  <div class="span12">
        <div class="span4"><div >
              
                <label >Member  ID </label>
            
                <div>
                       <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                     <input type="text" name="id" value="{{$data[0]->id}}" readonly="">
               </div>
              </div></div>
          <div class="span4">    <div>
              
                <label>Share Number</label>
            
                <div >              <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="Share Number" name="ShareNum" id="ShareNum" value="{{$data[0]->share_no}}">
               
                </div>
              </div></div>
            <div class="span4"> <div>
              
                <label>Share Price</label>
            
                <div  >             <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="Share Price" name="SharePrice" id="SharePrice" value="{{$data[0]->share_price}}">
               
                </div>
              </div>
</div>
  </div>
          
  <div class="span12">
          <div class="span4"> 


              <div>
              
                <label>Applicant Name  </label>
            
                <div>               <input type="text" class='span6' placeholder="Member Name English" name="Employee" id="Employee" value="{{$data[0]->mem_name}}">
             
                </div>
              </div></div>
           <div class="span4">  <div >
              <label >Age</label>
              <div >
                <input type="text" name="AppBirth"  value="{{$data[0]->birthdate}}"   class=" span6" />
                </div>
            </div>
            </div>
            <div class="span4">

           

                    <div >
              
                <label> Date of Birth</label>
            
                <div >
                  <input type="text" name="bd"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$data[0]->bd}}" class="datepickers span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span>
                </div>
              </div>

          </div>

  </div>
          
   <div class="span12">
     <div class="span6">    <div>
              
                <label>Father's Name </label>
            
                <div>               <input type="text" class='span6' placeholder="Father Name English" name="Father" id="Father" value="{{$data[0]->father_name}}">
                </div>
              </div></div>
      <div class="span6"> 
               <div>
              
                <label>Mother's Name    </label>
            
                <div >              <input type="text" class='span6' placeholder="Mother Name English" name="Mother" id="Mother" value="{{$data[0]->mother_name}}">
                </div>
              </div></div>
   </div>  


    <div class="span12">  <div class="span6"><div>
              
                <label>Husband Name /Wife Name  </label>
            
                    <div>
                      <input type="text" class='span6' placeholder="" name="Husband" id="Husband" value="{{$data[0]->husname}}">
                    </div>
              </div> </div>
               <div class="span6">
                 

 <div>
              
                <label>Occupation</label>
            
                <div>               <input type="text" class='span6' placeholder="Occupation" name="Occupation" id="Occupation" value="{{$data[0]->occupation}}">
                  
                </div>
              </div>
             

               </div>

 </div>


     <div class="span12">  <div class="span4">              
       <div>
              
                <label>Admission Fee / Others </label>
            
                <div>               <input type="text"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class='span6' placeholder="Admission Fee" name="Fee" id="Fee" value="{{$data[0]->add_fee}}">
               
                </div>
              </div></div>
                           <div class="span4">     <div>
              
                <label>NID NO. </label>
            
                <div>               <input type="text" class='span6' placeholder="NID NO" name="NID" id="NID" value="{{$data[0]->nid_no}}">
                </div>
              </div></div>
     
      <div class="span4"> <div>
              
                <label>Contact NO.  </label>
            
                <div>               <input type="text" class='span6' placeholder="+8801756477771" name="Contact" id="Contact" value="{{$data[0]->con_no}}">
                </div>
              </div>
</div>
     

     </div>


             <div class="span12">  <div class="span6"> <div>
              
                <label>Present Address</label>
            
                <div >            
                        <textarea rows="4" style="width: 300px;" name="Present">{{$data[0]->pre_add}}</textarea>
                </div>
              </div> </div>
              <div class="span6">  <div>
              
                <label>Permanent  Address</label>
            
                <div >            
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{$data[0]->perma_add}}</textarea>
                </div>
              </div> </div>
             </div> 

              <div class="span12">  <div class="span4">      <div>
              
                <label>Applicant Image</label>
                
                       <div >            
                          <input type="file" name="memiimg" accept="image/*">
                           <br/>
                            <img src="{{URL::asset('public/memberImg')}}/{{$data[0]->id}}mem.jpg" alt=""  style="height: 100px; width: 100px;" >
                       </div>
                       
              </div></div>
              <div class="span4">     <div>
              
                <label>Applicant Sign Image</label>
                
                       <div   >          
                          <input type="file" name="Sign" accept="Sign/*">
                           <br/>
                            <img src="{{URL::asset('public/memberImg')}}/{{$data[0]->id}}Sign.jpg" alt=""  style="height: 100px; width: 100px;" >
                       </div>
                       
              </div></div>
              <div class="span4">
             <div>
                    <label>Status</label>
                    <div>                   <label>
                        <input type="radio" name="Status" value="1"  
                        @if($data[0]->status == '1' )
                            checked
                          @endif
                         /> 
                        Active</label>
                      <label>
                        <input type="radio" name="Status" value="2"  
                        @if($data[0]->status == '2' )
                            checked
                          @endif />
                        Inactive</label>
                  
                    </div>
            </div>
<br/>
              <div>
                    <label >Gender</label>
                    <div >                   <label>
                        <input type="radio" name="Gender" value="Male"
                          @if($data[0]->gender == 'Male' )
                            checked
                          @endif
                         />
                        Male</label>
                      <label>
                        <input type="radio" name="Gender" value="Female"
                         @if($data[0]->gender == 'Female' )
                            checked
                          @endif
                           />
                        Female</label>
                  
                    </div>
            </div>



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
        </div>

         <meta name="_token" content="{!! csrf_token() !!}" />

<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
  $('.datepicker').datepicker();
 $('.datepickers').datepicker();
</script>

       
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection