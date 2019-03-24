<title>Report</title>
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


<button class="btn btn-xs btn-info pull-right printbtn" onclick="printPage('print_body')">Print</button>
<div id="print_body">
<table width="1101" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:0px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 100%;" src="{{URL::to('/')}}/public/imageHeader/14.png">

                      </span></td>

                  </tr>   

</table>






<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center'><a href="#" style="text-decoration: none; height: 38px;   color: black; text-align: center; padding-top:10px;  border-radius: 5px; font-size: 18px; "> 

                    @if($deposit_type == '1')
                    Saving
                    @endif
                    @if($deposit_type == '2')
                    Invert
                    @endif Account's   Statement -
                   @if($deposit_type == '1')
                    {{$pcktype->name}}
                    @endif
                   @if($deposit_type == '2')
                  @if($type == '5')
                    Daily
                  @elseif($type == '1')
                  Weekly
                  @elseif($type == '2')
                  Monthly
                  @elseif($type == '3')
                  Yearly
                  @elseif($type == '4')
                  General
                  @endif
                  @endif

                      <br/>  
</span>
                  </a>
                                  </TD>

                  </tr>   

</table>
<table class="table" style="width: 1300px;border:1px solid #999;margin-bottom: 10px;margin-left: 10px;">
<tr>
  <td style="width: 50%;border-right: 1px solid #999">
    <table class="table" style="font-size: 20px;">
      <tr>
        <td>
          @if($calender == '2')
         <b> Month: @if($month ==='01')
                January                 @endif
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
   October
                @endif
                  @if($month ==='08')
November                @endif

 @if($month ==='10')
December                @endif<br>
          Year: {{$year}}</b><br>
          @endif
          @if($calender == '3')
          <b>year: {{$year}}</b><br>
          @endif
          Brance Name : {{$data[0]->name}}<br>
          Root  Name : {{$data[0]->area_name}}<br>

          

        </td>
      </tr>
    </table>
  </td>
  <td style="width: 50%">
    <table class="table" style="font-size: 20px;">
      <tr align="right">
        <td>
          Prepared By : {{Auth::guard('admin')->user()->name}}<br>
          Print Date : {{date('d-m-Y')}}<br>
          <!--Print Time : {{date('h:i:s')}}-->
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1101"/>

  @if($deposit_type == '2')

<table width="1300" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; position: relative; margin-left:5px; font-size: 18px; margin-right: 10px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                   <td width="90" rowspan="2">SL</td>
                  <td width="400" rowspan="2">Account Name</td>
                 <td width="500" rowspan="2">Account No</td>
                  <td width="120" rowspan="2">Ammount of Invest </td>
                  <td width="100" rowspan="2">Profits</td>
                  <td width="" colspan="3">Collection Money</td>
                  <td colspan="3">Fixity</td>
                  
                </tr>
                <tr style="text-align: center; font-weight: bold;">
                  
                    <td width="80">Net</td>
                    <td width="80">Profits</td>
                    <td>Total</td>
                    <td width="100">Net</td>
                    <td width="100">Profits</td>
                    <td>Total</td>
              </tr>  

                       
                    

                       
@if(count($data) > 0)
  <?php
$sl = 0;
$total = 0;
$totalp = 0;
$totals = 0;
$totalsd = 0;
$tprofit = 0;
$totalamount = 0;
$totalamountz = 0;
$tcol = 0;
  ?>
  @foreach($data  as $showData)
  <?php
    $sl++;

  ?>
   <!--<tr style=" font-weight: bold;">-->
                  

   <!--                 <td></td>-->
   <!--                 <td width=""></td>-->
   <!--                 <td width="" align="center"></td>-->
   <!--                 <td width="" align="right">{{number_format($showData->totalammount,2)}}&nbsp;</td>-->
   <!--                 <td width="" align="right">{{number_format($showData->totalp,2)}}&nbsp;</td>-->
   <!--                 <td width=""></td>-->
   <!--                <td width="" align="center"></td>-->
   <!--                 <td width="" align="right">&nbsp;</td>-->
   <!--                 <td width="" align="right"> {{number_format($showData->totalammount,2)}}&nbsp;</td>-->
   <!--                 <td width="" align="right"> {{number_format($showData->totalp,2)}}&nbsp;</td>-->
   <!--                 <td width="" align="right"> {{number_format(($showData->totalammount)+($showData->totalp),2)}}&nbsp;</td>-->

   <!--               </tr> -->

                  <tr>  
                    <td width="" align="center"> <?php echo $sl;?></td>  
                    <td width="" align="center">{{$showData->mem_name}}
                    </td>
                                <td width="" style="padding-left: 10px;font-size: 16px;">&nbsp;{{$showData->AcID}}</td>
                                <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalammount,2)}}
      <?php
  $total = $total+$showData->totalammount;
      ?>
    </td>

    <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalp,2)}}
      <?php
$totalp = $totalp+$showData->totalp;
      ?>
    </td>

 

    <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalpaid - $showData->tinves_wise_deven,2)}}
      <?php
$totals = $totals+$showData->totalpaid - $showData->tinves_wise_deven;
      ?>
    </td>
    <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->tinves_wise_deven,2)}}
      <?php
$tprofit = $tprofit+$showData->tinves_wise_deven;
      ?>
    </td>
    <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalpaid,2)}}
      <?php
$tcol = $tcol+$showData->totalpaid;
      ?>
    </td>
    <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalammount-($showData->totalpaid - $showData->tinves_wise_deven),2)}}
      <?php
  $totalsd += $showData->totalammount-($showData->totalpaid - $showData->tinves_wise_deven);
      ?>
    </td>
       <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalp - $showData->tinves_wise_deven,2)}}
      <?php
$totalamount = $totalamount+$showData->totalp - $showData->tinves_wise_deven;
      ?>
    </td>
       <td width="" style="padding-left: 10px;">&nbsp;{{number_format($showData->totalammounts-$showData->totalpaid,2)}}
      <?php
$totalamountz = $totalamountz+$showData->totalammounts-$showData->totalpaid;
      ?>
    </td>
  </tr>  

                       
                        @endforeach
                          <tr>    
                            
                    <td width="" align="center"></td>
                                <td width="" style="padding-left: 10px;">&nbsp;</td>
                                <td style="padding-left: 10px;" align="right"><b>Total&nbsp;</b></td>                                
                                <td width="" style="padding-left: 10px;">&nbsp;{{number_format($total,2)}}</td>
                                <td width="" style="padding-left: 10px;">{{number_format($totalp,2)}}</td>
                                <td width="" style="padding-left: 10px;" align="right"><b>&nbsp;{{number_format($totals,2)}}</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>&nbsp;{{number_format($tprofit,2)}}</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>&nbsp;{{number_format($tcol,2)}}</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b>&nbsp;{{number_format($totalsd,2)}}</b></td>
                                <td style="padding-left: 10px;" align="right"><b>&nbsp;{{number_format($totalamount,2)}}</b></td>
                                <td width="" style="padding-left: 10px;" align="right"><b> &nbsp;{{number_format($totalamountz,2)}}</b></td>
  </tr>  


 @endif

                
</table>
 @endif

 @if($deposit_type == '1')
 <table width="1300" border="1" cellpadding="0" cellspacing="0" style="font-size:19px;margin-top:-650px; position: relative; float:left; margin-left:10px; margin-bottom:10px; ">
 <tr>
    <td width="" height="40" align="center">Sl. No </td>
    <td width="400" align="center">Name</td>
    <td width="330" align="center">Account No</td>
    <td width="" align="center">Account Opening Date</td>
    <td width="" align="center">Amount of installment</td>
    <td width="" align="center">Total Collection</td>
    <td width="" align="center">Total Withdraw</td>
    <td width="" align="center">Grand Total</td>
  </tr>

  @if(count($data) > 0)
  <?php
$sl = 0;
$total = 0;
$totals = 0;
$totalsd = 0;
$tprofit = 0;
$gtotal = 0;
  ?>
  @foreach($data  as $showData)
  <?php
    $sl++;

    // $explodes= explode('-',$showData->appDate);
    // $ApliDate = $explodes[2].'-'.$explodes[1].'-'.$explodes[0];
  ?>
  <tr>
    <td>&nbsp;<?php echo $sl;?>   </td>
    <td width="330">{{$showData->mem_name}}</td>
    <td width="330" >{{$showData->Addid}}</td>

    <td align="center" width="330">{{$showData->todaydate}}</td>
    <td width="330" align="right">{{number_format($showData->amount,2)}}
      <?php
$total = $total+$showData->amount;
      ?>
    </td>
    <td width="330" align="right">{{number_format($showData->totalcol,2)}}
      <?php
$totals = $totals+$showData->totalcol;
      ?>
    </td>
    <td width="330" align="right">{{number_format($showData->totalwithdraw,2)}}
      <?php
$tprofit = $tprofit+$showData->totalwithdraw;
      ?>
    </td>
    <td width="330" align="right">{{number_format($showData->totalcol-$showData->totalwithdraw,2)}}
      <?php
$gtotal = $gtotal+($showData->totalcol-$showData->totalwithdraw);
      ?>
    </td>
    
  </tr>
 
 @endforeach
 @endif

  <tr align="right">
   
    <th  colspan="4">&nbsp; Total :&nbsp;&nbsp;</th>
    <th>   {{number_format($total,2)}}</th>
    <th>   {{number_format($totals,2)}}</th>
    <th>   {{number_format($tprofit,2)}}</th>
    <th>   {{number_format($gtotal,2)}}</th>
  </tr>
 @endif
</table>
</div>
<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>