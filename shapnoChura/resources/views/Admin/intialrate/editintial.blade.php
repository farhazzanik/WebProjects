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
            <h5>Initial Interest Rate</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('editsuccrate')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

 <div class="control-group">
              <label class="control-label">Date
</label>
              <div class="controls">
                <?php
                $explodedate = explode('-', $allData[0]->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

                ?>
                <input type="text" name="date"
                  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$renewdate}}" class="datepicker span6" />
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
 <input type="hidden" name="upid" value="{{$allData[0]->id}}">


                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

           

               


             
          <div class="control-group">
              <label class="control-label">Select Schema</label>
              <div class="controls">
                
         <select  name ="Schema"  id="Schema" class="span6">
            <option value="{{$allData[0]->schema}}">{{$allData[0]->schemaname}}</option>
                  @if(count($packa) > 0)
                  @foreach($packa as $showData)
                  @if($allData[0]->schema != $showData->id)
                    <option value="{{$showData->id}}">{{$showData->name}}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
               


               </div>
            </div>



<div class="control-group">
              <label class="control-label">Interest Percentage
</label>
              <div class="controls">
                <input type="text" placeholder="10%" name="percent"
                value="{{$allData[0]->interestrate }}" class="span6" />
                 
               </div>
            </div>


<div class="control-group">
              <label class="control-label">Interest Rate
</label>
              <div class="controls">
                <input type="text" placeholder="0.01" name="Rate"
                value="{{$allData[0]->Rate }}" class="span6" />
                 
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

       </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection