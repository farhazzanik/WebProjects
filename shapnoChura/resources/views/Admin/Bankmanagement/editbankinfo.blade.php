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
            <h5>Edit Bank Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('editsuccbankinfo')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}
   @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">

      <option  value="{{$alldata[0]->fk_brance_id}}">{{$alldata[0]->branceName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $showData->id != $alldata[0]->fk_brance_id)
                  <option value="{{$showData->id}}" >{{$showData->name}}</option>
                     @endif
                   @endforeach
                  @endif   

    
                  </select>
               </div>
            </div>


  @else 


      <input type="hidden" name="Brance"  id="Brance" value="{{$id->fk_brance_id}}" class="span3">
      @endif
           
           
              <div class="control-group">
              
                <label class="control-label">Date </label>
            
                <div class="controls">
                  <input type="text" class='datepicker span6' data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy"   name="Date" id="Date" value="{{$alldata[0]->date}}">

                    <input type="text" class='span6'  name="upid" id="upid" value="{{$alldata[0]->id}}">
                </div>
              </div>
            

             
              <div class="control-group">
              
                <label class="control-label">Bank Name </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Bank Name English" name="Bank" id="Bank" value="{{$alldata[0]->bank_name}}">
                </div>
              </div>
            

                 <div class="control-group">
              
                <label class="control-label">Ac No </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Ac No English" name="Ac" id="Ac" value="{{$alldata[0]->ac_no}}">
                </div>
              </div>
            

             
               <div class="control-group">
              <label class="control-label">Account Type </label>
              <div class="controls">
                
 
                <select  name ="Accounttype"  id="Accounttype" class="span6">
              		<option>{{$alldata[0]->type}}</option>
                  <option>Saving Account</option>
                    <option>Current Account</option>
    
                  </select>
               </div>
            </div>




               <div class="control-group" id="staticParent">
                <label class="control-label">Address</label>
                <div class="controls">
                          <textarea name="Address" class="span6">{{$alldata[0]->add}}</textarea>
                </div>
              </div>

               <div class="control-group" id="staticParent">
                <label class="control-label">Mobile No</label>
                <div class="controls">
                      <input type="text" class="span6" name="mblno" id="mblno" placeholder="+8801756477771" value="{{$alldata[0]->mbl_no}}">
                        <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
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
        

         <meta name="_token" content="{!! csrf_token() !!}" />
         <script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
  $('.datepicker').datepicker();
  $('.datepickersss').datepicker();
   $('.datepickersssss').datepicker();
    $('.datepickersssssss').datepicker();
    $('.datepickesr').datepicker();

</script>
       
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection