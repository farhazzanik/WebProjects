
	
		
		<table class="table table-bordered">

	<tr>
			
				<td>Name</td>
				<td>Account No</td>
				<td>Total Deposit</td>
        <td>Net Deposit</td>
				<td>Deactivated</td>
		</tr>
@if(count($data) > 0)
@foreach($data as $show)

		<tr id="tr-{{$show->mem_add_id}}">
			
				<td>{{$show->mem_name}}</td>
				<td>{{$show->mem_add_id}}</td>
				<td>{{$show->total_dep}}</td>
          <td>{{$show->netdep}}</td>
				<td>  

          <a class="btn btn-danger btn-mini" onclick="Deactivated('{{$show->mem_add_id}}')" >
                      Deactive</a>

          </td>
		</tr>


		@endforeach
	@endif
	</table>



<script type="text/javascript">
	


 function Deactivated(getId){
  if(confirm("Are you sure you want to delete this?")){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

             $.ajax({

            type: "POST",
            url: "{{URL::to('deactivefinishsaving')}}/"+getId,
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