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
            <h5>Expense/Income Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('costsucc')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             

 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
                <option value="{{$data[0]->fk_brance_id}}">{{$data[0]->brancName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)

                  @if($showData->id != '1' && $data[0]->fk_brance_id !=  $showData->id)
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
              <label class="control-label">Date
</label>
              <div class="controls">
                <input type="text" name="date"
                  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$data[0]->date}}" class="datepicker span6" />
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                     <input type="hidden" name="id" value="{{$data[0]->id}}">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>


             


              <div class="control-group">
              
                <label class="control-label">Title </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Title  English" name="Title" id="Title" value="{{$data[0]->title}}">
                </div>
              </div>
            
         <div class="control-group">
              
                <label class="control-label">Short Title </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Title  English" name="sTitle" id="sTitle" value="{{$data[0]->stitle}}">
                </div>
              </div>



                 <div class="control-group">
              <label class="control-label">Credit/Debit</label>
              <div class="controls">
                
 
                <select  name ="inc_exp"  id="inc_exp" class="span6">
            <option value="{{$data[0]->inc_exp}}">
        @if($data[0]->inc_exp == "Income")
        Credit
      @else
Debit
    @endif</option>

                   <option value="Income">Credit</option>
                     <option value="Expense">Debit  </option>
            </select>
               </div>
            </div>


             
         


              <div class="control-group">
              
                <label class="control-label">Comments</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="comments">{{$data[0]->comment}}</textarea>
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
        </div>
        </div>

         <meta name="_token" content="{!! csrf_token() !!}" />

<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
        <script type="text/javascript">
  
 $('.datepicker').datepicker();

    </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection