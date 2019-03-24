
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
              <li class="active"><a data-toggle="tab" href="#tab1">Cash Close</a></li>
            
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Cash Close</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('donecash')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
              <label class="control-label">Last Cash Close Date </label>
              <div class="controls">
                @if(!empty($lastdate[0]->date))
                 <input type="text" name="ssdate" class="span6" value="{{$lastdate[0]->date}}" >
                 @else
                  <input type="text" name="ssdate" class="span6" value="<?= date('Y-m-d')?>" >
               
                 @endif
                <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
              </div>
            </div>


              
         
         <div class="control-group">
              <label class="control-label">Today Date</label>
                <div class="controls">
                 <input type="text" name="snddate" class="span6" value="<?= date('Y-m-d')?>" >
                </div>
       </div>
 
            
             <div class="form-actions">
                <input type="submit"  value="Submit" class="btn btn-success">
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