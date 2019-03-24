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
            <h5>Package Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('mmpdsPackageAdd')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
             {{ csrf_field() }}

       <!--       

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

 -->











                      <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
               

           
            

                 <div class="control-group">
              
                <label class="control-label">Date </label>
            
                <div class="controls">
                  <input type="text" name="Date"  data-date="<?php echo date('d-m-Y')?>" data-date-format="dd-mm-yyyy" value="{{old('Date')}}" class="datepicker span6" />
                </div>
              </div>
            


             
         
    

<div class="control-group">
              
                <label class="control-label">Number Of month </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="3" name="numbmonth" id="numbmonth" value="{{old('numbmonth')}}">
                </div>
              </div>



              <div class="control-group">
              
                <label class="control-label">Ammount </label>
            
                <div class="controls">
                  <input type="text" class='span6' readonly="" name="Ammount" id="Ammount" value="100000">
                </div>
              </div>

               <div class="control-group">
              
                <label class="control-label">Profit </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="12000" name="Profit" id="Profit" value="{{old('Profit')}}">
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
                     <th>Ammount </th>
                    <th>Profit </th>
                      <th>Number of month </th>
                  <th>Added By</th>
                
                  
                  <th>Action</th>
                </tr>
              </thead>
             
              <tbody>
    
              @if(count($showAllDate) > 0)
                @foreach($showAllDate as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td><?php $explodedate = explode('-', $showDAta->date);
echo $createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
?></td>
                  <td>{{$showDAta->ammount}}</td>
                   <td>{{$showDAta->profit}}</td>
                 <td>{{$showDAta->num_of_month}}</td>
                  <td>{{$showDAta->adminname}}</td>
                    
                  <td class="center">

                    <div class="fr"> 
                <!--   <a href="#" onclick="loadModel('{{$showDAta->id}}')"
                      class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal" >Edit</a> -->
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
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
  $('.datepickers').datepicker();

</script>

        <script type="text/javascript">
        function loadModel(id)
        {
          $(".modal-body").load("{{URL::to('packageModel')}}"+'/'+id);
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
            url: "{{URL::to('mmpdspackageDelete')}}/"+getId,
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
        }); }
    else{
        return false;
    }

          }

        </script>
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection