@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>


 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Data</h4>
        </div>
        <div class="modal-body" >
          <p>
                  

          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    
    <div class="row-fluid">
      <div class="span10">
        @include('error.msg')
 <div class="widget-box">
          <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">ADD</a></li>
              <li><a data-toggle="tab" href="#tab2">View</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Sms Price Intialize</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('savesmsprice')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
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
              <label class="control-label">Package Type</label>
              <div class="controls">
                <select  name ="Type"  id="Type" class="span6">
                 
                    <option value="1">Savings</option>
                    <option value="2">Invest</option>
               
                </select>
               <span id="loader"></span>
                 <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
              </div>
            </div>









          

            

                 <div class="control-group">
              
                <label class="control-label">Ammount  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="1200" name="Ammount" id="Ammount" value="{{old('Ammount')}}">
                </div>
              </div>
            


             
       




            
           
             
              <div class="form-actions">
                <input type="submit" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
             </div>  </p>
            </div>
            <div id="tab2" class="tab-pane">
              <p>
                           <div class="widget-box">
   <form action="#" method="get" class="form-horizontal">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Information</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
       
                  <th>Type</th>
                        <th>Ammount</th>
                  <th>Added By</th>
                  <th>Brance Name </th>
             
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
             

              @if($id->id == '306' or $id->fk_brance_id =='1')
              @if(count($showAllDate) > 0)
                @foreach($showAllDate as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>

 @if($showDAta->fk_type_id == 1)
Savings
 @else
Invest

 @endif
                  </td>

                
                  <td>{{$showDAta->ammount}}</td>
                 

                  <td>{{$showDAta->adminname}}</td>
                   <td>{{$showDAta->brancename}}</td>
                  <td class="center">

                    <div class="fr"> 
                <!--   <a href="#" onclick="loadModel('{{$showDAta->id}}')"
                      class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" >Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
                @endforeach
                       @endif
                        @endif

 @if($id->id != '306' or $id->fk_brance_id !='1')
                        @if(count($adminWiseBrance) > 0)
                @foreach($adminWiseBrance as $showDAta)
                <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>

 @if($showDAta->fk_type_id == 1)
Savings
 @else
Invest

 @endif
                  </td>

                
                  <td>{{$showDAta->ammount}}</td>
                 

                  <td>{{$showDAta->adminname}}</td>
                   <td>{{$showDAta->brancename}}</td>
                  <td class="center">

                    <div class="fr"> 
                 <!--  <a href="#" onclick="loadModel('{{$showDAta->id}}')"
                      class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" >Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
                @endforeach
                       @endif

@endif

            
            
           </tbody>
            </table>
          </div>
          </form>
        </div>
  
           </p>
            </div>
           
          </div>
        </div>
        </div>
        </div></div>
        </div>

         <meta name="_token" content="{!! csrf_token() !!}" />
        <script type="text/javascript">
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('editsmsIniti')}}"+'/'+id);
        }

        









 function deteDate(getId){
               if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('deletesmsinitia')}}/"+getId,
            data: {id:getId},
            dataType: 'json',
            success: function (data) {
               //console.log(data);

                 
if(data.success)
{


   $.gritter.add({
     title:data.status,
     text: 'Data Update Successfully',
      image:  '{{URL::to("/")}}/public/NeddImg/okkk.png',
      sticky: false
       
    });   

    $('#tr-'+getId).hide();



} else if(data.error){

$.gritter.add({
     title: data.error2,
     text:  data.status,
      image:  '{{URL::to("/")}}/public/NeddImg/delete.png',
      sticky: false
       
    });  
 
}

              
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
}
    else{
        return false;
    }
          }

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection