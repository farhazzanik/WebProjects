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
            <h5>Edit Credit Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('updateSuccexpen')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             

 @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span6"  onchange="return showTitle()">
                
                  <option value="{{$data[0]->fk_brance_id}}">{{$data[0]->brancName}}</option>
                @if(count($branceNam) > 0)
                  @foreach($branceNam as $showData)
                 @if($showData->id != '1' && $showData->id  != $data[0]->fk_brance_id)
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
                <?php 


$explodedate = explode('-', $data[0]->date);
         $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];?>
                <input type="text" name="date"
                  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{$renewdate}}" class="datepicker span6" />
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>

           

               


             
          <div class="control-group">
              <label class="control-label">Title</label>
              <div class="controls">
                
 
              

                    @if($id->fk_brance_id == '1')
                 <select  name ="Title"  id="Title" class="span6">
            
                    <option value="{{$data[0]->fk_title_id}}">{{$data[0]->title}}</option>
                </select>
                @else

          <select  name ="Title"  id="Title" class="span6">

          <option value="{{$data[0]->fk_title_id}}">{{$data[0]->title}}</option>
                  @if(count($brancewiseexpTitle) > 0)
                  @foreach($brancewiseexpTitle as $showData)
                  @if($data[0]->fk_title_id != $showData->id)
                    <option value="{{$showData->id}}">{{$showData->title}}</option>
                   @endif
                    @endforeach
                    @endif
                </select>
                @endif


               </div>
            </div>



<div class="control-group">
              <label class="control-label">Ammount
</label>
              <div class="controls">
                <input type="text" placeholder="120000" name="ammount"
                value="{{$data[0]->ammount}}" class="span6" />
                 <input type="HIDDEN" placeholder="120000" name="upid"
                value="{{$data[0]->id}}" class="span6" />
               </div>
            </div>



              <div class="control-group">
              
                <label class="control-label">Comments</label>
            
                <div class="controls">
                
                        <textarea rows="4" class="span6" name="comments">{{$data[0]->comments}}</textarea>
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
       















      function  showTitle(){

       
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Title');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showExpenseTitle")}}/'+branceid,
                type:'GET',
                dataType:'json',
                beforeSend:function(){
                        $("#districloader").html(loader);
                },  
                success:function(data){
         // alert(data);
                  batchOption.empty();
                    batchOption.append('<option value="" selected disabled>Select One</option>');
                    $.each(data,function(index,value){


                  batchOption.append('<option value="'+value.id+'">'+value.title+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          }
                  

         
         $('#Title').val(''); 
        

      }


     




 $('.datepicker').datepicker();



        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection