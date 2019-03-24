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
            <h5>Edit Addmision Information</h5>
          </div>
              <div class="widget-content nopadding">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{URL::to('updateMemSucc')}}" >
             {{ csrf_field() }}

         
@if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" onchange="return showrefer()" class="span6">
                <option value="{{$data[0]->fk_brance_id}}">{{$data[0]->branceName}}</option>
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
              <label class="control-label">Today Date
</label>
              <div class="controls">
                <input type="text" name="Todaydate"  data-date="<?php echo date('Y-m-d')?>" data-date-format="yyyy-mm-dd" value="{{$data[0]->todaydate}}" class="datepickesr span6" />
                <span class="help-block">Date with Formate of  (yy-mm-dd)</span> </div>
            </div>



          <div class="control-group">
              <label class="control-label">Select Member</label>
              <div class="controls">
                <select  name ="Member"  id="Member" class="span6">
                <option value="{{$data[0]->memberName}}">{{$data[0]->mem_name}}</option>
                
                </select>
              
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Scheme Title</label>
              <div class="controls">
                <select  name ="Packge"  id="Packge" class="span6">
                   <option value="{{$data[0]->PackageName}}">{{$data[0]->packname}}</option>
                    
               
                </select>
              
              </div>
            </div>



  

 <div class="control-group">
              
                <label class="control-label">Scheme Duration</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Package Expiration date" name="PackageExdate" id="PackageExdate" value="{{$data[0]->PackageExdate}}">
                  
                </div>
              </div>
      

            <div class="control-group">
              
                <label class="control-label">Amount of installment / Fixed deposit
</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Amount of installment" name="installment" id="installment" value="{{$data[0]->amount}}">
                   <input type="hidden" name="upid" value="{{$data[0]->Addid}}">
                   <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                </div>
              </div>
       

               <div class="control-group">
              
                <label class="control-label">Total Installment </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Installment number" name="number" id="number" value="{{$data[0]->insNumb}}">
                </div>
              </div>
            
       <div class="control-group">
              
                <label class="control-label">Periodic payment</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Periodic payment" name="Periodic" id="Periodic" value="{{$data[0]->Periodic}}">
                  
                </div>
              </div>

                     <div class="control-group">
              
                <label class="control-label">Monthly payment</label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Monthly payment" name="Monthly" id="Monthly" value="{{$data[0]->Monthly}}">
                  
                </div>
              </div>


              
            
            <div class="control-group">
              <label class="control-label">Expiration date
</label>
              <div class="controls">
                <input type="text" name="Expiration"  data-date="<?php echo date('Y-m-d')?>" data-date-format="yyyy-mm-dd" value="{{$data[0]->Date}}" class="datepicker span6" />
                <span class="help-block">Date with Formate of  (yy-mm-dd)</span> </div>
            </div>
            


  <div class="control-group">
              <label class="control-label">Reference By</label>
              <div class="controls">
                <select  name ="Reference"  id="Reference" class="span6" onchange="showArea()">
                   <option value="{{$data[0]->referenceBy}}">{{$data[0]->empname}}</option>
                
               
               
                </select>
              
              </div>
            </div>

               <div class="control-group">
              <label class="control-label">Select Area</label>
              <div class="controls">
               @if($id->fk_brance_id == '1')
 <select  name ="Area"  id="Area" class="span6">
 <option value="{{$data[0]->AreaName}}">{{$data[0]->area_name}}</option>
  </select>
               @else

                <select  name ="Area"  id="Area" class="span6">
                 
                    <option value="{{$data[0]->AreaName}}">{{$data[0]->area_name}}</option>
                  


                         @if(count($selectArea) > 0)
                  @foreach($selectArea as $showData)
                   @if($showData->id != $data[0]->AreaName)
                    <option value="{{$showData->id}}">{{$showData->area_name}}</option>
                      @endif
                    @endforeach
                    @endif
               
               
                </select>
              @endif
              </div>
            </div>






  <div class="control-group">
              <label class="control-label">Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6">
                    @if($data[0]->type ==='5')
                  <option value="{{$data[0]->type}}">Daily</option>
                  @endif
                @if($data[0]->type ==='1')
   <option value="{{$data[0]->type}}">Weekly</option>
                  @endif
                @if($data[0]->type ==='2')
   <option value="{{$data[0]->type}}">Monthly</option>
                
                @endif

                @if($data[0]->type ==='3')
<option value="{{$data[0]->type}}">Yearly</option>
                
                @endif
                @if($data[0]->type ==='4')
   <option value="{{$data[0]->type}}">General</option>
                @endif
                      <option value="5">Daily</option>
                      <option value="1">Weekly</option>
                      <option value="2">Monthly</option>
                      <option value="3">Yearly</option>
                      <option value="4">General</option>
                </select>
              
              </div>
            </div>



 <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                      <label>
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

            
            <div class="control-group">
              <label class="control-label">Comments
</label>
              <div class="controls">
               
                    <textarea name="Comments" id="Comments" style="width: 400px;" rows="4">{{$data[0]->comment}}</textarea>
                </div>
            </div>
            


<div class="control-group">
              <label class="control-label"><b>Nominee information : </b>
</label>
              
            </div>



              <div class="control-group">
              
                <label class="control-label">Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Name" name="owName" id="owName" value="{{$data[0]->name}}">
                </div>
              </div>

                 <div class="control-group">
              
                <label class="control-label">Email  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="exmaple@mail.com " name="Email" id="Email" value="{{$data[0]->email}}">
                </div>
              </div>

                <div class="control-group">
              <label class="control-label">Birth date
</label>
              <div class="controls">
                <input type="text" name="Birth"  data-date="<?php echo date('d-m-Y')?>" value="{{$data[0]->BirthDate}}" class="span6" />
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>



                <div class="control-group">
              <label class="control-label">Father / Husband
</label>
              <div class="controls">
                <input type="text" name="Husband" placeholder="Father / Husband"  value="{{$data[0]->father_husband}}" class="span6" />
                
            </div>
            </div>



                <div class="control-group">
              <label class="control-label">Mother / Wife
</label>
              <div class="controls">
                <input type="text" name="Wife"  placeholder="Mother / Wife"   value="{{$data[0]->mother_wife}}" class="span6" />
                
            </div>
            </div>

              <div class="control-group">
              <label class="control-label">Occupation
</label>
              <div class="controls">
                <input type="text" name="Occupation"   placeholder="Occupation"   value="{{$data[0]->occupation}}" class="span6" />
                
            </div>

  
            </div>


              <div class="control-group">
              <label class="control-label">  Relation with accounting
</label>
              <div class="controls">
                <input type="text" name="Relation"  placeholder="Relation with accounting"  value="{{$data[0]->relation}}" class="span6" />
                
            </div>

  
            </div>


              <div class="control-group">
              <label class="control-label">  Amount of part
</label>
              <div class="controls">
                <input type="text" placeholder="10%" name="Amountpart"  value="{{$data[0]->ammounOfpart}}" class="span6" />
                
            </div>

  
            </div>

                

              



              <div class="control-group">
              
                <label class="control-label">Present Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Present">{{$data[0]->preAdd}}</textarea>
                </div>
              </div>
            
              <div class="control-group">
              
                <label class="control-label">Permanent  Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{$data[0]->permaAdd}}</textarea>
                </div>
              </div>
            

 <div class="control-group">
              
                <label class="control-label">Nominee Image</label>
            
                <div class="controls">
                
                          <input type="file" name="memiimg" accept="image/*">  

                           <br/>
                            <img src="{{URL::asset('public/memberAddmission')}}/{{$data[0]->Addid}}mem.jpg" alt=""  style="height: 80px; width: 80px;" >
                       </div>
              </div>
            

            <div class="control-group">
              
                <label class="control-label">Nominee Sign</label>
            
                <div class="controls">
                
                          <input type="file" name="Sign" accept="image/*">
                            <br/>
                            <img src="{{URL::asset('public/memberAddmission')}}/{{$data[0]->Addid}}sign.jpg" alt=""  style="height: 80px; width: 80px;" >
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

    function showArea(){

        var Reference = $('#Reference').val();
        var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
        var batchOption = $('#Area');
       // alert(Reference);
        if(Reference != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showAreforMemAdd")}}/'+Reference,
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


                  batchOption.append('<option value="'+value.fk_area_id+'">'+value.area_name+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          }
                  $('#showUpazila').val("");

        }


function showrefer(){
  
        var branceid = $('#Brance').val();
        
          
        

           var loader = "<img src='{{URL::to('/')}}/public/img/spinner.gif' />";
           var batchOption = $('#Reference');
          if(branceid != "Select One")
        {

          $.ajax({
                url : '{{URL::to("showreferAdd")}}/'+branceid,
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


                  batchOption.append('<option value="'+value.id+'">'+value.Name+'</option>');
                  });
                   $("#districloader").html("");
                 },
                 error:function(data){

                    alert('error occured ! Please Check');
                      $("#districloader").html("");
                 }





          });
          }
                  $('#showUpazila').val("");

}
</script>

       
 
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection