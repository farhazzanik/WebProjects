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
              <li class="active"><a data-toggle="tab" href="#tab1">Share Member's List</a></li>
            
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Share Member's List</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('showsharelist')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

          @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6">
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1')
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
              <label class="control-label">Select Package </label>
              <div class="controls">
               <select class="span6" name="package">
                    <option>Select One </option>
                    <option value="1">100 Tk</option>
                    <option value="2">500 Tk</option>
                    
                  </select>
              </div>
            </div>


                <div class="control-group">
              <label class="control-label">Date</label>
              <div class="controls">
                <input type="text" name="firstdate" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" placeholder="dd/mm/yyyy" class="datepicker span3">
                <input type="text" name="seconddate" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y')?>" placeholder="dd/mm/yyyy" class="datepicker span3">
              </div>
            </div>
         





   


  

             
              <div class="form-actions">
                <input type="submit" formtarget="_blank" value="Show" class="btn btn-success">
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
  
       <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>

      
@endsection