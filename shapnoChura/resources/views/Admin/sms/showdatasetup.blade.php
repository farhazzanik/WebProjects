@if($type == '1')
	
		
		<table class="table table-bordered">

	<tr>
			
				<td>Name</td>
				<td>Account No</td>
				<td>Status</td>
				<td>Delete</td>
		</tr>
@if(count($data) > 0)
@foreach($data as $show)
		<tr id="tr-{{$show->sav_id}}">
			
				<td>{{$show->mem_name}}</td>
				<td>{{$show->sav_id}}</td>
				<td>
					<?php

						if($show->status =='1'){
							?>
<a class="btn btn-success btn-mini" onclick="active('{{$show->sav_id}}')" >
                      Active</a>
							<?php
						} else{
					?>
<a class="btn btn-danger btn-mini" onclick="deactive('{{$show->sav_id}}')" >
                      Deactive</a>
					<?php }  ?>
				</td>
				<td>  <a class="btn btn-danger btn-mini" onclick="deteDatesaving('{{$show->sav_id}}')" >
                      Delete</a></td>
		</tr>

	
		@endforeach
	@endif
	</table>

@endif


@if($type == '2')
	
		
		<table class="table table-bordered">

			<tr>
			
				<td>Name</td>
				<td>Account No</td>
				<td>Status</td>
				<td>Delete</td>
		</tr>
@if(count($data) > 0)
@foreach($data as $show)
		<tr id="tr-{{$show->sav_id}}">
			
				<td>{{$show->mem_name}}</td>
				<td>{{$show->sav_id}}</td>
				<td>
					<?php

						if($show->status =='1'){
							?>
<a class="btn btn-success btn-mini" onclick="active('{{$show->sav_id}}')" >
                      Active</a>
							<?php
						} else{
					?>
<a class="btn btn-danger btn-mini" onclick="deactive('{{$show->sav_id}}')" >
                      Deactive</a>
					<?php }  ?>
				</td>
				<td>  <a class="btn btn-danger btn-mini" onclick="deteDatesaving('{{$show->sav_id}}')" >
                      Delete</a></td>
		</tr>

	
		@endforeach
	@endif
	</table>

@endif

<script type="text/javascript">
	


 function deteDatesaving(getId){

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('deletesmssetup')}}/"+getId,
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






 function active(getId){

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('activetodec')}}/"+getId,
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

   location.reload();


} else if(data.error){

$.gritter.add({
     title: data.error2,
     text:  data.status,
      image:  '{{URL::to("/")}}/public/NeddImg/delete.png',
      sticky: false
       
    });  

location.reload();
 
}

              
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

          }





 function deactive(getId){

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('dectoac')}}/"+getId,
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

   location.reload();


} else if(data.error){

$.gritter.add({
     title: data.error2,
     text:  data.status,
      image:  '{{URL::to("/")}}/public/NeddImg/delete.png',
      sticky: false
       
    });  

location.reload();
 
}

              
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

          }

</script>