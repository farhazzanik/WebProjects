<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report</title>
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
    

<table width="601" border="1"  cellpadding="1" cellspacing="1" style="margin-top:0px; float:left; margin-left:10px;" >


  <tr>
    <td height="42" colspan="3" align="center"><strong style="font-size:28px; font-family:'Source Sans Pro'">Investment report sheet
</strong>
</td>

  </tr>
  
<?php
      $explodedate = explode('-', $data[0]->appDate);
      $new=$explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
     ?>
  <tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Invest Opening Date
<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$new}}</td>
  </tr>

  
   <tr style="font-size: 18px; ">
    <td height="50" style="padding-left: 10px;">Invest Account No <br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->id}}</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td width="255" height="55" style="padding-left: 10px;">Name of the investor
<br /></td>
    <td width="22" align="center"><strong>:</strong></td>
    <td width="316">&nbsp;  {{$data[0]->mem_name}}</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="45" style="padding-left: 10px;">Address<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;  {{$data[0]->permanentAdd}}</td>
  </tr>
 
  <tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Ammount of invest<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; {{$data[0]->invesQuanT}}</td>
  </tr>

   <tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Ammount of installment<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->instalAmm}}</td>
  </tr>



   <tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Investment period<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;      </td>
  </tr>

     <tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Investment expiration date
<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->expireDate}}</td>
  </tr>

     <tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Arrears at the end of the expiration
<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp; </td>
  </tr>
<tr style="font-size: 18px; ">
    <td height="44" style="padding-left: 10px;">Full investment payment date
<br /></td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;{{$data[0]->fullPayDAte}}</td>
  </tr>




  <tr style="font-size: 18px; ">
    <td height="62"style="padding-left: 10px;">Comments (if any) </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;</td>
  </tr>
 <!--  <tr style="font-size: 18px;  ">
        <td colspan="3">
          <table>
              <tr>
               <td width="212" height="116" align="center" style="padding-left: 10px; border-right: 2px #FFFFFF solid;">Accounting officer  
        <br />
    Signed with seal with name
    
    </td>
    <td width="378" colspan="2" align="center">Approval Officer<br />
    Signed with seal with name</td>
              </tr>
          </table>
      </td>
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
