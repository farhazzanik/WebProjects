<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<head>
	<title>View Information</title>
</head>
<style type="text/css">
        .transition_cul_section{margin-left: 0 !important; margin-right: 0 !important;}
        .filter_info{display: none;}
        .company_header{display: none;}
        .companyFooter{display: none;}
        @media print {
            @page {
                    size: auto;   /* auto is the initial value */
                    margin: 5mm;  /* this affects the margin in the printer settings */
                }
            .filter_info{display: block;}
            .company_header{display: block;}
            .companyFooter{display: block;}
            .invoice_top{display: block;}
            .print_footer{display: block;}
            .panel-heading-btn {display: none;}
            .report_filler {display: none;}
            .panel-title {display: none;}
            .printbtn {display: none;}
            .print_body{padding-bottom: 100px;}
            .col-md-6{width: 50%;float: left;padding: 5px;overflow: hidden;}
            .col-md-12{width:100%;overflow: hidden;}
            .div{width: 100%;overflow: hidden;}
            .print_footer {
              font-size: 9px;
              color: #f00;
              text-align: center;
            }

           
        }
    </style>

<body >
<button class="btn btn-xs btn-info pull-right printbtn" onclick="printPage('print_body')">Print</button>
<div id="print_body">
<table width="942" border="0"  cellpadding="0" cellspacing="0" align="center">

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 100%;" src="{{URL::to('/')}}/public/imageHeader/14.png">

                      </span></td>

                  </tr>   

</table>




        <table width="942" border="1"  cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td height="48" colspan="4" align="center"> <strong>Member Information </strong></td>
    </tr>
  <tr Style="font-size:18px;">
    <td width="245" height="32"  style='padding-left: 15px;'> Brance Name </td>
    <td width="27" align="center"><strong>:</strong></td>
    <td width="405">&nbsp; {{$data[0]->branceName}}</td>
    <td width="255" rowspan="7">
		
        <?php
            $path =  base_path().'/public/memberImg/'.$data[0]->id.'mem.jpg';
              if(file_exists($path)) { ?>
                <img src="{{URL::asset('public/memberImg')}}/{{$data[0]->id}}mem.jpg" style="height: 280px; width: 100%;">
              <?php } else {
                    if($data[0]->gender == 'Male'){

                      ?>

<img src="{{URL::asset('public/NeddImg')}}/male.png" style="height: 280px; width: 100%;">
                      <?php
                    }else{ ?>
              
<img src="{{URL::asset('public/NeddImg')}}/femaleImage.jpg" style="height: 280px; width: 100%;">

              <?php 



                    }


              }
        ?>	</td>

  </tr>


  <tr Style="font-size:18px;">
    <td height="32" style='padding-left: 15px;'>Applicant Date </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$data[0]->appDate}} </td>

    </tr>



  <tr Style="font-size:18px;">
    <td height="32" style='padding-left: 15px;'>Admission Fee </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;  {{$data[0]->add_fee}}</td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="36" style='padding-left: 15px;'>Share Number </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;  {{$data[0]->share_no}}  </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="32" style='padding-left: 15px;'>Share Price </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$data[0]->share_price}}  </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="31" style='padding-left: 15px;'>Applicant Name </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$data[0]->mem_name}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="32" style='padding-left: 15px;'>Father Name/ Husband Name </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$data[0]->father_name}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="39" style='padding-left: 15px;'>Mother Name / Wife Name </td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->mother_name}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="36" style='padding-left: 15px;'>Nid No </td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->nid_no}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="35" style='padding-left: 15px;'>Contact No </td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->con_no}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="37" style='padding-left: 15px;'>Gender</td>
    <td align="center"><strong><br>
    :</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->gender}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="40" style='padding-left: 15px;'>Age</td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->birthdate}} </td>
    </tr>
  <tr Style="font-size:18px;">
    <td height="35" style='padding-left: 15px;'>Present Address </td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->pre_add}} </td>
    </tr>
  <tr> 
    <td height="40" style='padding-left: 15px;'>Permanent Address </td>
    <td align="center"><strong>:</strong></td>
    <td colspan="2">&nbsp; {{$data[0]->perma_add}} </td>
    </tr>

<tr Style="font-size:18px;">
     <td height="48" colspan="4" align="center">
      Applicant  Signature
        <hr>
        <?php
            $path =  base_path().'/public/memberImg/'.$data[0]->id.'Sign.jpg';
              if(file_exists($path)) { ?>
                <img src="{{URL::asset('public/memberImg')}}/{{$data[0]->id}}Sign.jpg" style="height: 120px; width:20%; float: center;">
              <?php } else {
                      ?>

<img src="{{URL::asset('public/NeddImg')}}/sign.jpg" style="height: 100px; width: 20%;">
            <?php  }
        ?>  </td>
    

  </tr>
 <!--  <tr>
    <td height="59" colspan="4" style="padding-left:20px;"><p>&nbsp;</p>
    <p><strong>Nominee Information : </strong></p></td>
    </tr>
  <tr>
    <td height="35" style='padding-left: 15px;'>Name</td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->n_name}} </td>
    <td rowspan="6">&nbsp;
 <?php
            $path =  base_path().'/public/memberImg/'.$data[0]->id.'nom.jpg';
              if(file_exists($path)) { ?>
                <img src="{{URL::asset('public/memberImg')}}/{{$data[0]->id}}nom.jpg" style="height: 280px; width: 100%;">
              <?php }
        ?>


    </td>
  </tr>
  <tr>
    <td height="36" style='padding-left: 15px;'>Age</td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->n_age}} </td>
    </tr>
  <tr>
    <td height="39" style='padding-left: 15px;'>Nid No </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->n_nidNO}} </td>
    </tr>
  <tr>
    <td height="34" style='padding-left: 15px;'>Present Address </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->n_presentAdd}} </td>
    </tr>
  <tr>
    <td height="36" style='padding-left: 15px;'>Permanent Address </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$data[0]->n_permanenAdd}} </td>
    </tr>
  <tr>
    <td height="34" style='padding-left: 15px;'>Relation With Applicant </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;  {{$data[0]->n_relation}} </td>
    </tr> -->
</table>
</div>
<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>

</body>
</html>