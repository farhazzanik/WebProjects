
<div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Category Information</h5>
          </div>
              			 <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('catupdatesuc')}}" name="basic_validate" id="basic_validate" novalidate="novalidate" enctype="multipart/form-data">
             {{ csrf_field() }}

             


              <div class="control-group">
              
                <label class="control-label">Item Name </label>
            
                <div class="controls">
                 <select id="ItemName" name="ItemName" style="width: 300px;">
                  <option value="{{$data[0]->item_id}}">{{$data[0]->item_name}}</option>
                    @if(count($mainMenu) > 0)
                    @foreach($mainMenu as $showitem)
                    @if($showitem->id != $data[0]->item_id)
                      <option value="{{$showitem->id}}">{{$showitem->item_name}}</option>
                      @endif
                    @endforeach
                    @endif
                 </select>
                </div>
              </div>
              
            <div class="control-group">
              
                <label class="control-label">Category  Name English </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Category Name English" name="CategoryNameEng" id="CategoryNameEng" value="{{$data[0]->category_name_eng}}"  style="width: 300px;">

                  <input type="hidden" class='span6' placeholder="Category Name English" name="id" id="id" value="{{$data[0]->id}}">

                </div>
              </div>

              <div class="control-group">
              
                <label class="control-label">Category  Name Bangla </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Category Name Bangla" name="CategoryNameBn" id="CategoryNameBn" value="{{$data[0]->category_name_ban}}"  style="width: 300px;">
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

