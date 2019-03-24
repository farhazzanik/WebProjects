
<div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Area Info</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('areaeditSucc')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

             
 @if($adminti->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span3">
                
                <option value="{{$data[0]->fk_branc_id}}">{{$data[0]->brname}}</option>
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


      <input type="hidden" name="Brance" id="Brance" value="{{$adminti->fk_brance_id}}" class="span3">
      @endif

              <div class="control-group">
              
                <label class="control-label">Area Name  </label>
            
                <div class="controls">
                  <input type="text" class='span3' placeholder="Area Name English" name="Area" id="Area" value="{{$data[0]->area_name}}">
                  <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                   <input type="hidden" name="id" value="{{$data[0]->id}}">
                </div>
              </div>
           

       <div class="control-group">
              
                <label class="control-label">Description</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="description">{{$data[0]->description}}</textarea>
                </div>
              </div>
            
             

            
            
             
              <div class="form-actions">
                <input type="submit" value="Edit" class="btn btn-success">
              </div>
            </form>
          </div>
</div> 

