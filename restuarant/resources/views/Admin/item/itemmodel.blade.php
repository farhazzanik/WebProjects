
<div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Item Information</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('itemupdatesuc')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
             {{ csrf_field() }}

             


              <div class="control-group">
              
                <label class="control-label">Item Name </label>
            
                <div class="controls">
                  <input type="text" placeholder="Item Name English" name="ItemName"
                   id="ItemName" value="{{$data[0]->item_name}}">
                  <input type="hidden"  name="id" id="id" value="{{$data[0]->id}}">
                </div>
              </div>
              
              <div class="control-group">
              
                <label class="control-label">Image </label>
            
                <div class="controls">
                  
                    <input type='file' name='img'></input>
                    </div>
              </div>


            
             
              <div class="form-actions">
                <input type="submit" value="Edit" class="btn btn-success">
              </div>
            </form>
          </div>
</div> 

