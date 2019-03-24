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
		<table width="390" height="535" border="1" cellpadding="0" cellspacing="0" style="font-size: 18px; ">
  <tr>
    <td height="73" colspan="4">&nbsp;</td>
    </tr>
  <tr>
    <td width="169" height="42"  style="padding-left: 10px;">Date</td>
    <td width="31" align="center"><strong>:</strong></td>
    <td width="323" style="padding-left: 10px;">&nbsp; {{date('d/m/Y')}}</td>
    <td width="202" rowspan="5" >

    <?php
            $path =  base_path().'/public/memberImg/'.$obj[0]->id.'mem.jpg';
              if(file_exists($path)) { ?>
                <img src="{{URL::asset('public/memberImg')}}/{{$obj[0]->id}}mem.jpg" style="height: 210px; width: 100%;">
              <?php } else {
                    if($obj[0]->gender == 'Male'){

                      ?>

<img src="{{URL::asset('public/NeddImg')}}/male.png" style="height: 210px; width: 100%;">
                      <?php
                    }else{ ?>
              
<img src="{{URL::asset('public/NeddImg')}}/femaleImage.jpg" style="height: 210px; width: 100%;">

              <?php 



                    }


              }
        ?>


    </td>
  </tr>
  <tr>
    <td height="43" style="padding-left: 10px;">Name</td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp;{{$obj[0]->mem_name}}</td>
    </tr>
  <tr>
    <td height="44" style="padding-left: 10px;">Address</td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp; {{$obj[0]->perma_add}}</td>
    </tr>
  <tr>
    <td height="44" style="padding-left: 10px;">Mobile No </td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp; {{$obj[0]->con_no}}</td>
    </tr>
  <tr>
    <td height="32" style="padding-left: 10px;">Account no<br /></td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp;  {{$obj[0]->Addid}}</td>
    </tr>
  <tr>
    <td height="66" colspan="4" align="center"><table width="731" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="307" height="33" align="center">Name </td>
        <td width="418" align="center">Sign</td>
        </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>

      <tr>
        <td height="31">&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
    </table>   </td>
    </tr>
	
	<tr>
			<td colspan="4">  <p>Note:</p>
     <p>&nbsp;</p></td>
	</tr>
	<tr>
			<td colspan="4"><table width="730" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td width="195" height="75" align="center"><p>&nbsp;</p>
                <p>The manufacturer</p></td>
                <td width="193" align="center"><p>&nbsp;</p>
                <p>Officer</p></td>
                <td width="334" align="center"><p>&nbsp;</p>
                <p>Chairman / Managing Director</p></td>
              </tr>

            </table></td>
	</tr>
</table>

<table width="601" border="1" cellpadding="0" cellspacing="0" style="margin-top:0px; margin-left:10px; margin-top: 10px;" >
  <tr>
    <td height="42" colspan="3" align="center"><strong style="font-size:28px; font-family:'Source Sans Pro'">Use for  only office</strong></td>
  </tr>
  <tr style="font-size: 18px; ">
    <td width="255" height="55" style="padding-left: 10px;">Account name<br /></td>
    <td width="22" align="center"><strong>:</strong></td>
    <td width="316"  style="padding-left: 10px;">&nbsp; {{$obj[0]->packname}}</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="45"style="padding-left: 10px;">Accounting type<br /></td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp;
          @if($obj[0]->memtype ==='5')
                  Daily
                  @endif
                @if($obj[0]->memtype ==='1')
  Weekly
                  @endif
                @if($obj[0]->memtype ==='2')
  Monthly
                
                @endif

                @if($obj[0]->memtype ==='3')
Yearly
                @endif
                @if($obj[0]->memtype ==='4')
   General
                @endif
    </td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="50"style="padding-left: 10px;">Account No <br /></td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp;{{$obj[0]->Addid}}</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="44"style="padding-left: 10px;">Accounting Officer's name<br /></td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp; {{$obj[0]->adminname}}</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="86"style="padding-left: 10px;">What is the source of funds? How the fund's source has been confirmed ? (conditions apply ?) </td>
    <td align="center"><strong>:</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="43"style="padding-left: 10px;">What does the customer do ?</td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp;{{$obj[0]->occupation}}</td>
  </tr>
  <tr style="font-size: 18px; ">
    <td height="62"style="padding-left: 10px;">Comments (if any) </td>
    <td align="center"><strong>:</strong></td>
    <td style="padding-left: 10px;">&nbsp; {{$obj[0]->comment}}</td>
  </tr>
  <tr style="font-size: 18px;  ">
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
  </tr>
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
