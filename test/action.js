  



 function loaddata()
        {
       
          $("#tbody").load("loaddata.php");
        }
loaddata();



  $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );


function editData(id,county,country,town,postcode,Description,Address,bedrooms,bathrooms,Price,Type){

 $('#county'+id).html("");
 $('#country'+id).html("");
 $('#town'+id).html("");
 $('#postcode'+id).html("");
 $('#Description'+id).html("");
 $('#Address'+id).html("");
 $('#bedrooms'+id).html("");
 $('#bathrooms'+id).html("");
 $('#Price'+id).html("");
 $('#Type'+id).html("");
 $('#act'+id).html("");
$('#image'+id).html("");
 $('#county'+id).html('<input type="text" class="form-control input-sm" style="border-radius: 0px;" id="count'+id+'" value="'+county+'"/> ');

 $('#country'+id).html('<input type="text" class="form-control input-sm" style="border-radius: 0px;" id="cntr'+id+'" value="'+country+'"/> ');

 $('#town'+id).html('<input type="text" class="form-control input-sm" style="border-radius: 0px;" id="twn'+id+'"  value="'+town+'"/> ');

 $('#postcode'+id).html('<input type="text" class="form-control input-sm" style="border-radius: 0px;" id="pstc'+id+'"  value="'+postcode+'"/> ');

 $('#Description'+id).html('<textarea class="form-control input-sm" style="border-radius: 0px;" id="desc'+id+'" >'+Description+'</textarea> ');




  $('#Address'+id).html('<textarea class="form-control input-sm" style="border-radius: 0px;" id="add'+id+'" >'+Address+'</textarea> ');

 $('#bedrooms'+id).html('<select class="form-control input-sm" style="border-radius: 0px;" id="bdrm'+id+'"><option>'+bedrooms+'</option><option>1</option><option>2</option><option>3</option></select>');


 $('#bathrooms'+id).html('<select class="form-control input-sm" style="border-radius: 0px;" id="bthrm'+id+'"><option>'+bathrooms+'</option><option>1</option><option>2</option><option>3</option></select>');

 $('#Price'+id).html('<input type="text" class="form-control input-sm" style="border-radius: 0px;" id="prc'+id+'"  value="'+Price+'"/> ');


$('#Type'+id).html('<select class="form-control input-sm" style="border-radius: 0px;" id="typ'+id+'"><option>'+Type+'</option><option>House</option><option>Apartment</option><option>Hostel</option></select>');

  $('#act'+id).html("<input type='button' onclick='editDone("+id+")' value='Save' class='btn btn-success btn-sm' style='border-radius: 0px;'> ");
  
  $('#image'+id).html('<input type="file" name="files" id="files'+id+'" accept="image/*">');
}

function editDone(getID){
        var editone  = 10;
        var file = $('#files'+getID)[0].files[0];
     
        var County = $('#count'+getID).val();
        var Country = $('#cntr'+getID).val();
        var Town = $('#twn'+getID).val();
        var Postcode = $('#pstc'+getID).val();
        var Description = $('#desc'+getID).val();
        var Address = $('#add'+getID).val();
        var bedrooms = $('#bdrm'+getID).val();
        var bathrooms = $('#bthrm'+getID).val();
        var Price = $('#prc'+getID).val();
        var Property = $('#typ'+getID).val();
       
        var fromdData = new FormData();
        fromdData.append('file',file);
        fromdData.append('editone',editone);
        fromdData.append('County',County);
        fromdData.append('Country',Country);
        fromdData.append('Town',Town);
        fromdData.append('Postcode',Postcode);
        fromdData.append('Description',Description);
        fromdData.append('Address',Address);
        fromdData.append('bedrooms',bedrooms);
        fromdData.append('bathrooms',bathrooms);
        fromdData.append('Price',Price);
        fromdData.append('Property',Property);
        fromdData.append('getID',getID);
    $.ajax({
          url: 'ajaxSubmit.php',
        type: 'POST',
         data:fromdData,
           contentType: false,
            processData: false,
      success:function(data){
     

 loaddata();
      }
    });

}

function deleteData(deleID){
 if (confirm("Are you sure?")) {
$.ajax({
           type: "POST",
            url: "ajaxSubmit.php",
            data: {deleID:deleID},
           
      success:function(data){
        alert(data);

      loaddata();
      }
    });
}
return false;


}

function DataAdd(){

        var fd = new FormData();
        var County = $('#County').val();
        var Country = $('#Country').val();
        var Town = $('#Town').val();
        var Postcode = $('#Postcode').val();
        var Description = $('#Description').val();
        var Address = $('#Address').val();
        var bedrooms = $('#bedrooms').val();
        var bathrooms = $('#bathrooms').val();
        var Price = $('#Price').val();
        var Property = $('#Property').val();
       
        var files = $('#file')[0].files[0];

      var submit  = 10;
        fd.append('file',files);
         fd.append('County',County);
        fd.append('Country',Country);
        fd.append('Town',Town);
        fd.append('Postcode',Postcode);
        fd.append('Description',Description);
        fd.append('Address',Address);
        fd.append('bedrooms',bedrooms);
        fd.append('bathrooms',bathrooms);
        fd.append('Price',Price);
        fd.append('Property',Property);
        fd.append('submit',submit);

    $.ajax({
          url: 'ajaxSubmit.php',
        type: 'POST',
         data: fd,
            contentType: false,
            processData: false,
      success:function(data){
        alert(data);

loaddata();
      }
    });
   
}


  function isNumberKey(evt,id)
{
  try{
        var charCode = (evt.which) ? evt.which : event.keyCode;
  
        if(charCode==46){
            var txt=document.getElementById(id).value;
            if(!(txt.indexOf(".") > -1)){
  
                return true;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) )
            return false;

        return true;
  }catch(w){
    alert(w);
  }
}

