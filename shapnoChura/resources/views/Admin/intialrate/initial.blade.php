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
              <li class="active"><a data-toggle="tab" href="#tab1">ADD</a></li>
              <li><a data-toggle="tab" href="#tab2">View</a></li>
             
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
            <form class="form-horizontal" method="post" action="{{URL::to('saveintialrate')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

 <div class="control-group">
              <label class="control-label">Date
</label>
              <div class="controls">
                <input type="text" name="date"
                   value="{{date('d-m-Y')}}" class="span6" />
                   <input type="text" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                <span class="help-block">Date with Formate of  (yy-mm-dd)</span> </div>
            </div>

           

               


             
          <div class="control-group">
              <label class="control-label">Select Schema</label>
              <div class="controls">
                
         <select  name ="Schema"  id="Schema" class="span6">
                  @if(count($packa) > 0)
                  @foreach($packa as $showData)
                    <option value="{{$showData->id}}">{{$showData->name}}</option>
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
                value="{{old('percent')}}" class="span6" />
                 
               </div>
            </div>



            
             


<div class="control-group">
              <label class="control-label">Interest Rate
</label>
              <div class="controls">
                <input type="text" placeholder="0.01" name="Rate"
                value="{{old('Rate')}}" class="span6" />
                 
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
                  <th>Date</th>
                  <th>Schema Name</th>
                  <th>Interest Percentage</th>
                    <th>Interest Rate</th>
                  <th>Added By</th>
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
          
                   

               @if(count($allData) > 0)
                @foreach($allData as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->date}}</td>
                 <td>{{$showDAta->schemaname}}</td>
                  <td>{{$showDAta->interestrate}}</td>
                   <td>{{$showDAta->Rate}}</td>
                 <td>{{$showDAta->adminname}}</td>
                    
                

                  <td class="center">

                    <div class="fr"> 
                  <a href="editintialrate/{{$showDAta->id}}" 
                      class="btn btn-primary btn-mini">Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a>

                      </div></td>
                </tr>
         
                @endforeach
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

<script src="{{URL::to('/')}}/public/js/bootstrap-datepicker.js"></script> 
        <script type="text/javascript">
       


















 $('.datepicker').datepicker();




 function deteDate(getId){
              if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('intialratedel')}}/"+getId,
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