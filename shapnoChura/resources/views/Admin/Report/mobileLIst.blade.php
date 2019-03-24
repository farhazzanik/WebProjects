@extends('Admin.index')
@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 <div class="container-fluid">
    <hr>

    
    <div class="row-fluid">
      <div class="span10">

<div class="widget-box">
   <form action="#" method="get" class="form-horizontal">
          <div class="widget-title"> 
            <span class="icon"><i class="icon-th"></i></span>
            <h5>Member Mobile List</h5>

            <a style="float: right;" href="{{URL::to('Mobilelistprint')}}" target="_blank" class="btn btn-success">Print </a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No</th>
                  <th> Name</th>
                   <th>Member No</th>
                  <th>Mobile No</th>
                  <th>Address</th>
                   <th>Comments</th>
                </tr>
              </thead>
              <tbody>
@if($id->id == '306' or $id->fk_brance_id =='1')
              @if(count($data) > 0)
              <?php
                $sl = 0;
              ?>
              @foreach($data as $showData)
              <?php 
                $sl++;
              ?>
               <tr class="gradeX" id="tr">
                  <td><?php echo $sl;?></td>
                  <td>{{$showData->mem_name}}</td>
                  <td>{{$showData->id}}</td>
                  <td>{{$showData->con_no}}</td>
               <td>{{$showData->pre_add}}</td>
                   <TD></TD>
                </tr>
               
                @endforeach
          @endif

          @endif


          @if($id->id != '306' or $id->fk_brance_id !='1')
 @if(count($brancedata) > 0)
              <?php
                $sl = 0;
              ?>
              @foreach($brancedata as $showData)
              <?php 
                $sl++;
              ?>
               <tr class="gradeX" id="tr">
                  <td><?php echo $sl;?></td>
                  <td>{{$showData->mem_name}}</td>
                  <td>{{$showData->id}}</td>
                  <td>{{$showData->con_no}}</td>
               <td>{{$showData->pre_add}}</td>
                   <TD></TD>
                </tr>
               
                @endforeach
          @endif

          @endif
            
           </tbody>
            </table>
          </div>
          </form>
        </div>




        </div>
        </div>
        </div>

        
         <meta name="_token" content="{!! csrf_token() !!}" />
       
        <script src="{{URL::to('/')}}/public/js/matrix.tables.js"></script>
@endsection