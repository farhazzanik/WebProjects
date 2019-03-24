
<div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Package Info</h5>
          </div>


<div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('packageUpdate')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

            
@if($adminti->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Brance Name</label>
              <div class="controls">
                
 
                <select  name ="Brance"  id="Brance" class="span3">
                
                <option value="{{$data[0]->fk_branc_id}}">{{$data[0]->branceName}}</option>
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



             <div class="control-group" id="staticParent">
                <label class="control-label">Serial No (<strong class="text-danger">Must Be English</strong>)</label>
                <div class="controls">
                  <input type="text"  class='span3'   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   value="{{$data[0]->serialNo}}" placeholder="Serial No"
                   id="child" name="serial">
                      <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                      <input type="hidden" name="id" value="{{$data[0]->id}}">
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Package Short Name  </label>
            
                <div class="controls">
                  <input type="text" class='span3' placeholder="Package Name English" name="Name" id="Name" value="{{$data[0]->name}}">
                </div>
              </div>
             <div class="control-group">
              
                <label class="control-label">Package Long  Name  </label>
            
                <div class="controls">
                  <input type="text" class='span3' placeholder="Long Name English" name="lName" id="lName" value="{{$data[0]->longName}}">
                </div>
              </div>
            


             
         
            <div class="control-group">
              <label class="control-label">Package Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span3">
                 
                 @if($data[0]->type == 1)
                		<option value="1">Savings</option>
                @else
							<option value="2">Invest</option>
                @endif
                 	   <option value="1">Savings</option>
                        <option value="2">Invest</option>
               
                </select>
               <span id="loader"></span>
              </div>
            </div>


              <div class="control-group">
              
                <label class="control-label">Reference Commision  </label>
            
                <div class="controls">
                  <input type="text" class='span3' placeholder="Reference Commision" name="Commision" id="Name" value="{{$data[0]->commision}}">
                </div>
              </div>
            

              <div class="control-group">
              
                <label class="control-label">Description</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 250px;" name="description">{{$data[0]->description}}</textarea>
                </div>
              </div>
            
             

            
           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
          </div>