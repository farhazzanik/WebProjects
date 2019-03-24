<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
<table width="1145" border="1" cellpadding="0" cellspacing="0" style="margin-left: 10px;">
  <tr>
    <td width="1141" height="174">
 <img style="width: 1145px; height: 217px;" src="{{URL::to('/')}}/public/imageHeader/13.png">    </td>
  </tr>
  <tr>
    <td>
  <table width="1146" border="1" cellpadding="0" cellspacing="0" >
  <tr>
    <td style="text-align: center;">
 <span ><h5>Daily Transaction Report<br>(Member Wise)</h5></span>    </td>
  </tr>
  <tr>
    <td>
  
  <table width="1146" border="0" cellpadding="0" cellspacing="0" style="font-size:18px;">
      <tr>
        <td width="105" height="38"><span style="padding-left:10px;"> Account No.</span></td>
        <td width="16" align="center">:</td>
        <td width="434">&nbsp;<span style="padding-left:10px;">{{$invest[0]->mem_add_id}} </span></td>
        <td width="129"><span style="padding-left:10px;"> Name</span> </td>
        <td width="20" align="center">:</td>
        <td width="428">&nbsp;<span style="padding-left:10px;">{{$invest[0]->mem_name}} </span></td>
      </tr>
      <tr>
        <td height="46"><span style="padding-left:10px;"> Father's  Name</span> </td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;">{{$invest[0]->father_name}} </span></td>
        <td><span style="padding-left:10px;"> Mother's Name </span></td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;"> {{$invest[0]->mother_name}}</span></td>
      </tr>
      <tr>
        <td height="32"><span style="padding-left:10px;"> Contact No.</span> </td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;"> {{$invest[0]->con_no}}</span></td>
       
      </tr>
    </table></td>
  
  
  </tr>
  
  <tr>
    <td>
  
  
  <table width="1149" border="1" cellpadding="0" cellspacing="0" style="font-size:18px;">
      <tr>
        <td width="142" height="38" align="center"><span style="padding-left:10px;"> SL. NO </span></td>
        <td width="631" align="center">Details</td>
        <td width="368" align="center">Taka</td>
        </tr>
      <tr>
        <td height="46"><span style="padding-left:10px;"> 1 </span> </td>
        <td><span style="padding-left:10px;">Collection Ammount </span></td>
        <td>&nbsp;<span style="padding-left:10px;">{{$invest[0]->today_dep}}</span></td>
    </tr>
    <tr>
        <td height="46"><span style="padding-left:10px;"> 2</span> </td>
        <td><span style="padding-left:10px;">Withdraw Ammount   </span></td>
        <td>&nbsp;<span style="padding-left:10px;">@if($invest[0]->today_withdraw > 0)
                                            {{$invest[0]->today_withdraw}}
                                            @else
                                              0
                                            @endif
          </span></td>
    </tr>
      <!--   <tr>
        <td height="32" colspan="2"  align="right">Total &nbsp;&nbsp;</td>
        <td>&nbsp;<span style="padding-left:10px;">
          {{$invest[0]->today_dep-$invest[0]->today_withdraw}}

        </span></td>
      </tr> -->
    
    </table></td>
  
  
  </tr>
</table>
</table>
<table width="1146" border="0"  cellpadding="0" cellspacing="0" style=" font-size: 20px;margin-left: 20px;">
  <tr style="height: 30px;">
    <td width="700"></td>
    <td></td>
    <td width="100"></td>
   
  </tr>
    <tr style="height: 80px;">
    <td width="500">----------------<br/>Prepared By</td>
    <td width="300">-------------------------<br/>Executive  Officer</td>
    <td width="500" align="right" >-----------------------<br/>Chairman/MD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   
  </tr>
</table>
</div>
<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>