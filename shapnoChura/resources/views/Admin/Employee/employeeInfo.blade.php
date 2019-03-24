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
              <li class="active"><a data-toggle="tab" href="#tab1">ADD</a></li>
              <li><a data-toggle="tab" href="#tab2">View</a></li>
             
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <p>
    <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Employee Information</h5>
          </div>
                     <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{URL::to('saveEmployee')}}"  enctype="multipart/form-data">
             {{ csrf_field() }}

            

             @if($id->fk_brance_id == '1')

          <div class="control-group">
              <label class="control-label">Branch Name</label>
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



             <div class="control-group" id="staticParent">
                <label class="control-label">Serial No (<strong class="text-danger">Must Be English</strong>)</label>
                <div class="controls">
                  <input type="text"  class='span6'   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"   value="{{old('serial')}}" placeholder="Serial No"
                   id="child" name="serial">


                
                </div>
              </div>


              <div class="control-group">
              
                <label class="control-label">Employee Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Employee Name English" name="Employee" id="Employee" value="{{old('Employee')}}">

                    <input type="hidden" name="adminid" value="{{Auth::guard('admin')->user()->id}}">
                </div>
              </div>
            
            <div class="control-group">
              
                <label class="control-label">Father's Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Father Name English" name="Father" id="Father" value="{{old('Father')}}">
                </div>
              </div>
            

               <div class="control-group">
              
                <label class="control-label">Mother's Name  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="Mother Name English" name="Mother" id="Mother" value="{{old('Mother')}}">
                </div>
              </div>
            

              <div class="control-group">
              
                <label class="control-label">Contact No.  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="01756477771" name="Contact" id="Contact" value="{{old('Contact')}}">
                </div>
              </div>


                <div class="control-group">
              
                <label class="control-label">NID No. </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="NID NO" name="NID" id="NID" value="{{old('NID')}}">
                </div>
              </div>
            

                 <div class="control-group">
              
                <label class="control-label">Email  </label>
            
                <div class="controls">
                  <input type="text" class='span6' placeholder="exmaple@mail.com " name="Email" id="Email" value="{{old('Email')}}">
                </div>
              </div>


                
              <div class="control-group">
              
                <label class="control-label">Present Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Present">{{old('Present')}}</textarea>
                </div>
              </div>
            
              <div class="control-group">
              
                <label class="control-label">Permanent  Address</label>
            
                <div class="controls">
                
                        <textarea rows="4" style="width: 300px;" name="Permanent">{{old('Permanent')}}</textarea>
                </div>
              </div>
            
 
              <div class="control-group">
              
                <label class="control-label">Image</label>
            
                <div class="controls">
                
                       <input type="file" name="empimgae" accept="image/*">
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
                  <th>Name </th>
                  <th>Father  Name</th>
                   <th>Mother Name</th>
                    <th>Contact</th>
                     <th>Email</th>
                     <th>Image</th>
                        <th>Brance Name </th>
                        <th>Added By</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if($id->id == '306' or $id->fk_brance_id =='1')
                        @if(count($showDatab) > 0)
                @foreach($showDatab as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->Name}}</td>
                <td>{{$showDAta->fatherName}}</td>
                 <td>{{$showDAta->MotherName}}</td>
                  <td>{{$showDAta->contactNo}}</td>
                  <td>{{$showDAta->email}}</td>
             
                     <td> <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/employeeImg')}}/{{$showDAta->id}}.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/employeeImg')}}/{{$showDAta->id}}.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul></td>
               <td>{{$showDAta->branceName}}</td>
             
                   <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="{{URL::to('EditEmpInfo')}}/{{$showDAta->id}}"  class="btn btn-primary btn-mini"  >Edit</a>
                    <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showDAta->id}}')" >
                      Delete</a></div></td>
                </tr>
         
                @endforeach
                       @endif
@endif
 @if($id->id != '306' or $id->fk_brance_id !='1')
 

 @if(count($adminwiseDat) > 0)
                @foreach($adminwiseDat as $showDAta)
               <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->Name}}</td>
                <td>{{$showDAta->fatherName}}</td>
                 <td>{{$showDAta->MotherName}}</td>
                  <td>{{$showDAta->contactNo}}</td>
                  <td>{{$showDAta->email}}</td>
             
                     <td> <ul class="thumbnails" >
                        
<li class="span2"  style="width: 80px; display: block;" > <a> <img src="{{URL::asset('public/employeeImg')}}/{{$showDAta->id}}.jpg" alt=""  > </a>
                <div class="actions"> <a title="" href="#"><i class="icon-pencil"></i></a> <a class="lightbox_trigger" href="{{URL::asset('public/employeeImg')}}/{{$showDAta->id}}.jpg"><i class="icon-search"></i></a> </div>
              </li>

              </ul></td>
               <td>{{$showDAta->branceName}}</td>
             
                   <td>{{$showDAta->adminname}}</td>
                  <td class="center">

                    <div class="fr"> 
                  <a href="{{URL::to('EditEmpInfo')}}/{{$showDAta->id}}"  class="btn btn-primary btn-mini"  >Edit</a>
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
       

        









 function deteDate(getId){
              if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('DeleteEmp')}}/"+getId,
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