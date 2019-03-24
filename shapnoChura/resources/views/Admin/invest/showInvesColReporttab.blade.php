<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
<table width="1300" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 100%;" src="{{URL::to('/')}}/public/imageHeader/{{$invest[0]->fk_brance_id}}.png">

                      </span></td>

                  </tr>   

</table>


<table width="1300" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
         					<TD align='center'><a href="#" style="text-decoration: none;  display: block; text-align: center; padding-top:10px; border-radius: 5px; font-size: 22px; "> 

                   Invest Account Statement


<span  style=" font-size: 18px;">
<br/>

  @if($month ==='01')
                January                @endif
                @if($month ==='02')
   February                  @endif
                @if($month ==='03')
   March


                
                @endif

                @if($month ==='04')
                April                @endif
                @if($month ==='05')
   May
                @endif
                  @if($month ==='06')
June                @endif
                @if($month ==='07')
   July
                @endif
                  @if($month ==='08')
August                @endif
  @if($month ==='09')
September                @endif
                @if($month ==='10')
   (October
                @endif
                  @if($month ==='11')
November                @endif

 @if($month ==='12')
December                @endif
                
                {{$year}}
</span>
         					</a>
						  </TD>

           				</tr>   

</table>
<table width="1200" height='' border="1"  cellpadding="0" cellspacing="0" style="font-size: 24px;margin-left: 90px">
<tr>
  <td style="width: 50%;border-right: 1px solid #999">
    <table class="table" style="font-size: 20px;">
      <tr>
        <td>
            
          Brance Name : {{$invest[0]->name}}<br>
        </td>
      </tr>
    </table>
  </td>
  <td style="width: 50%" >
    <table class="table" style="font-size: 20px;">
      <tr>
        <td align="right">
          Printed By : {{Auth::guard('admin')->user()->name}}<br>
          Print Date : {{date('d-m-Y')}}<br>
          <!--Print Time : {{date('h:i:s')}}-->
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
 @if($allname == '')

<table width="1200" height='' border="1"  cellpadding="0" cellspacing="0" style="font-size: 20px;margin-left: 90px">
  <tr >
    <th colspan="6" style="border: 1px #000 solid;text-align: center;"> Invest Collection Sheet<br>
    @if($investnettcole[0]->type == '5')
    (Daily)
    @elseif($investnettcole[0]->type == '1')
    (Weekly)
    @elseif($investnettcole[0]->type == '2')
    (Monthly)
    @elseif($investnettcole[0]->type == '3')
    (Yearly)
    @elseif($investnettcole[0]->type == '4')
    (General)
    @endif
    </th>
   

  </tr>

  <tr align="center">
      <td>Sl NO</td>
      <td>Date</td>
       <td>Name</td>
       <td>Invest Account</td>
      <td>Invest  Amount</td>
      <td>Profit Amount</td>
     

  </tr>

  @if(count($investnettcole) > 0)
   <?php $sl=0; $totaldep = 0; $totalwit=0;?>
  @foreach($investnettcole as $showdata)
  <?php $sl++; $totaldep = $totaldep+$showdata->tody_inves; $totalwit=$totalwit+$showdata->inves_wise_deven;?>
      <tr align="center">
            <td colspan="">&nbsp;&nbsp;&nbsp;<?= $sl;?></td>
            <td>&nbsp;&nbsp;&nbsp;<?php  $explodes = explode('-', $showdata->date);
     echo  $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];   ?></td>
     <td>&nbsp;&nbsp;&nbsp;{{$showdata->mem_name}}</td>
     <td>&nbsp;&nbsp;&nbsp;{{$showdata->fk_invest_id}}</td>
       
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->tody_inves,2)}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->inves_wise_deven,2)}}</td>
           

        </tr>
  @endforeach
 <TR align="right">
    <Th></Th>
    <Th ></Th>
    <Th></Th>
    <Th >Total :</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totaldep,2)}}</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totalwit,2)}}</Th>
  </TR>
  @endif
<table>


 @else


<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;  margin-top:0px; background:none; position:relative;" >
             
      <tr>
          
            <td><span  style=" font-size: 20px; font-weight: bold; "> 

                                                     

                                                      <br/> Account No. : {{$invest[0]->fk_invest_id}}
                                                       <br/>Name : {{$invest[0]->mem_name}} 
                                                       <br>Address : {{$invest[0]->businessAdd}} 

                                                        <br>Phone No. : {{$invest[0]->con_no}} 
                                                     </span></td>
@php
$explodedate = explode('-',$invest[0]->applicationdate);
$createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
@endphp
              <td align="right"><span  style=" font-size: 20px; font-weight: bold; ">
                <table>
                  <tr>
                    <td>
                        Brance Name. </td> <td>:</td><Td> {{$invest[0]->name}}</Td></tr>
                           <tr><td>Root  Name.</td><td> :</td>
                          <td>@if(isset($inv->area_name))
                             {{$inv->area_name}}
                              @else

                              @endif</td>
                           </tr>
                <tr><td>Opening Date </td> <td>:</td> <td>{{$createdate}}</td></tr>
              <tr><td> Status </td> <td> :</td>  <td>@if($invest[0]->status ==1)

                                Acitve
                                @else 
                                Deactive
                                @endif</td>
                   
                  </tr> 
                  <tr><td> Close Date </td> <td> :</td>  <td>
                    {{$invest[0]->expireDate}}</td>
                   
                  </tr>
                </table>



              </span></td>
      </tr>
</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1300"/>

<table width="1300" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; position: relative; margin-left:5px; font-size: 20px; margin-right: 10px;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
                   <td width="90" rowspan="2">SL</td>
         				  <td width="200" rowspan="2">Date</td>
         				 <td width="220" rowspan="2">Details</td>
         				  <td width="120" rowspan="2">Ammount of Invest </td>
         				  <td width="100" rowspan="2">Profits</td>
         				  <td width="" colspan="3">Collection Money</td>
         				  <td colspan="3">Fixity</td>
         				  
         				  <td width="120" rowspan="2">User Name</td>
         				  <td width="" rowspan="2">Comments</td>
       				  </tr>
         				<tr style="text-align: center; font-weight: bold;">
         					
         						<td width="80">Net</td>
         						<td width="80">Profits</td>
                    <td>Total</td>
         						<td width="100">Net</td>
         						<td width="100">Profits</td>
                    <td>Total</td>
   						</tr>  
                       
                    

                            <tr style=" font-weight: bold;">
                  

                    <td></td>
                    <td width=""></td>
                    <td width="" align="center"></td>
                    <td width="" align="right">{{number_format($invest[0]->total_inv,2)}}&nbsp;</td>
                    <td width="" align="right">{{number_format($invest[0]->divended,2)}}&nbsp;</td>
                    <td width=""></td>
                   <td width="" align="center"></td>
                    <td width="" align="right">&nbsp;</td>
                    <td width="" align="right"> {{number_format($invest[0]->total_inv,2)}}&nbsp;</td>
                    <td width="" align="right"> {{number_format($invest[0]->divended,2)}}&nbsp;</td>
                    <td width="" align="right"> {{number_format(($invest[0]->total_inv)+($invest[0]->divended),2)}}&nbsp;</td>
                    <td width="" style="padding-left: 10px;"></td>
                                <td width="" style="padding-left: 10px;"></td>
                  </tr>  
                  @if(count($invest) > 0)
                  <?php $sl=0; 
                   $netamout = 0;
                   $netprofit = 0;?>
                  @foreach($invest as $showinvest)
                   <?php $sl++?>
                  <tr>  
                    <td width="" align="center"> <?php echo $sl;?></td>  
                    <td width="" align="center">
<?php
                  $explode = explode('-', $showinvest->date);
                  echo $explode[2].'-'.$explode[1].'-'.$explode[0];

                 ?>
                    </td>
                                <td width="" style="padding-left: 10px;">&nbsp;{{$showinvest->details}}</td>
                                <td width="" style="padding-left: 10px;">&nbsp;</td>
                                <td width="" style="padding-left: 10px;">
                                <td style="padding-left: 10px;" align="right">
                                    <?php
                                        $netinv = $showinvest->tody_inves-$showinvest->inves_wise_deven;
                                    ?>
 {{number_format($netinv,2)}}
&nbsp;</td>                                
                                <td style="padding-left: 10px;" align="right">{{number_format($showinvest->inves_wise_deven,2)}}&nbsp;</td>
                                <td width="" style="padding-left: 10px;">{{number_format( $showinvest->tody_inves,2)}}&nbsp;</td>
                                <td width="" style="padding-left: 10px;" align="right">
                                  
                                  <?php
                                  $netamout = $netamout+$netinv;
                                  print $printnetamout = number_format($showinvest->total_inv-$netamout,2) ;
                                  ?>&nbsp;</td>
                               
                                <td width="" align="right" style="padding-left: 10px;">

                                  <?php
                                    $netprofit  = $netprofit+$showinvest->inves_wise_deven;
                                    print $printprofit =  number_format($showinvest->divended-$netprofit,2) ;
                                  ?>&nbsp;</td>
                                <td width="" style="padding-left: 10px;"> <?php  echo $totalfixity =  number_format(($showinvest->divended-$netprofit)+($showinvest->total_inv-$netamout),2);?>&nbsp;  </td>
                                <td width="" style="padding-left: 10px;"> {{$showinvest->adminname}}</td>
                                <td width="" style="padding-left: 10px;">{{$showinvest->comments}}</td>
  </tr>  

                       
                        @endforeach
                          <tr>    
                    <td width="" align="center"></td>
                                <td width="" style="padding-left: 10px;">&nbsp;</td>
                                <td width="" style="padding-left: 10px;">&nbsp;</td>
                                <td width="" style="padding-left: 10px;"></td>
                                <td style="padding-left: 10px;" align="right"><b>Total&nbsp;</b></td>                                
                                <td style="padding-left: 10px;" align="right"><b>{{number_format($netammount,2)}}&nbsp;</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>{{number_format($divenden,2)}}&nbsp;</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>{{number_format($divenden+$netammount,2)}}&nbsp;</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>
                                  <?php print $printnetamout;?>&nbsp;</td>
                                <td width="" style="padding-left: 10px;" align="right"><b>
                                  <?php   print $printprofit;?>&nbsp;</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>
                                  <?php print  $totalfixity; ?>&nbsp;</b></td>
                                <td width="" style="padding-left: 10px;"></td>
                                <td width="" style="padding-left: 10px;"></td>
  </tr>  


                         @endif

                
</table>

    
</div>
 @endif
<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>
</body>
</html>
