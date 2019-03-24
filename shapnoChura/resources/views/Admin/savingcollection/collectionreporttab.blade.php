<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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




<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 100%;" src="{{URL::to('/')}}/public/imageHeader/{{$collection[0]->fk_brance_id}}.png">

                      </span></td>

                  </tr>   

</table>
 
<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="float:left; margin-left:10px; margin-bottom:10px; font-size: 22px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center'><a href="#" style="text-decoration: none;   display: block; text-align: center; padding-top:10px;  border-radius: 5px; font-size: 22px; "> 

                   Savings Account Statement<br/>

          </a>
              </TD>

                  </tr>   

</table>

<table class="table" style="width: 1300px;border:1px solid #999;margin-bottom: 10px; font-size: 20px;margin-left: 10px;">
<tr>
  <td style="width: 50%;border-right: 1px solid #999">
    <table class="table" style="font-size: 20px;">
      <tr>
        <td>

            Period &nbsp;&nbsp;{{$frstdate}} &nbsp;&nbsp;To &nbsp;&nbsp;{{$sndate}}<br>
            @if($name == '')
            Brance Name. : {{$collection[0]->name}}
            @endif
        </td>
      </tr>
    </table>
  </td>
  <td style="width: 50%">
    <table class="table" style="font-size: 20px;">
      <tr align="right">
        <td>
          Printed By : {{Auth::guard('admin')->user()->name}}<br>
          Print Date : {{date('d-m-Y')}}<br>
          <!-- Print Time : {{date('H:i:s')}} -->
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>
 @if ($name == '')
<table width="1200" height='' border="1"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;margin-left: 90px;">
  <tr >
    <th colspan="7" style="border: 1px #000 solid; text-align: center;">Collection/Withdraw Sheet<br>( {{$type->name}})</th>
   

  </tr>

  <tr align="center">
      <td>Sl NO</td>
      <td>Date</td>
       <td>Name</td>
      <td>Saving Account</td>
      <td>Saving Amount</td>
      <td>Withdraw Amount</td>
     

  </tr>

  @if(count($todayrecieveammount) > 0)
  <?php $sl=0; $totaldep = 0; $totalwit=0;?>
  @foreach($todayrecieveammount as $showdata)
  <?php $sl++; $totaldep = $totaldep+$showdata->today_dep; $totalwit=$totalwit+$showdata->today_withdraw;?>
      <tr align="">
            <td>&nbsp;&nbsp;&nbsp;<?= $sl;?></td>
            <td>&nbsp;&nbsp;&nbsp;<?php  $explodes = explode('-', $showdata->date);
     echo  $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];   ?></td>
     <td>&nbsp;&nbsp;&nbsp;{{$showdata->mem_name}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{$showdata->mem_add_id}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->today_dep,2)}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->today_withdraw,2)}}</td>
           

        </tr>
  @endforeach
  <TR align="right">
    <Th colspan="4" >Total :</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totaldep,2)}}</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totalwit,2)}}</th>
  </TR>
  @endif


  <tr style=" font-weight: bold;">
                          

                            <td width="92" colspan="8" align="right"  style="padding-left: 10px;">
                              
                              Total Saving Installment. : <?php echo count($totalsavingno); ?> &nbsp;
                              <br/>Total Withdraw Installment. : <?php echo count($totalwithdrawno); ?>&nbsp;
                            </td>

                          </tr> 
<table>
 
 @else
<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;  margin-top:0px; background:none; position:relative;" >
             
      <tr>
          
            <td><span  style=" font-size: 20px; font-weight: bold; "> 
                                                                            <br/>Account No. : {{$collection[0]->mem_add_id}}
                                                                            <br/>Name : {{$collection[0]->mem_name}} <br>Address : {{$collection[0]->pre_add}}<br/>
                                                                            Phone No. : {{$collection[0]->con_no}} </span></td>

              <td align="right"><span  style=" font-size: 20px; font-weight: bold; ">

                <table>
                  <tr>
                    <td>  Brance Name. : {{$collection[0]->name}}</td>
                  </tr>
                  <tr>
                    <td>  Root  Name. : {{$collection[0]->area_name}}</td>
                  </tr>
                  <tr>
                    <td> Opening Date : {{$collection[0]->todaydate}}</td>
                  </tr>
                  <tr>
                    <td>Status  :  @if($collection[0]->status ==1)

                                Acitve
                                @else 
                                Deactive
                                @endif
</td>
                  </tr>
                  <tr>
                    <td>Close Date  :  {{$collection[0]->PackageExdate}}
                    </td>
                  </tr>
                 
                </table>
              
              
               
                


              </span></td>
      </tr>
</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1304"/>

<table width="1304" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; font-size: 20px; position: relative; " >

                
                <tr style="text-align: center; font-weight: bold;">
                  
                      <td width="92">SL.</td>
                    <td width="92">Date</td>
                    <td width="260">Details</td>
                    <td width="181">Saving Deposit</td>
                    <td width="223">Withdraw Ammount</td>
                    <td width="105">Total Ammount</td>
                     <td width="225">Comments</td>
                    <td width="202"> User Name</td>
                  
                    
                  </tr>  
                        @if(count($collection) > 0)
<tr style=" font-weight: bold;">
                          

                            <td width="92"  style="padding-left: 10px;"></td>
                            <td width="260"  style="padding-left: 10px;"></td>
                            <td width="181" style="padding-left: 10px;">Previous Blance</td>
                            <td width="223" style="padding-left: 10px;"></td>
                            <td width="105" align="center"></td>
                            <td width="202" align="right"  style="padding-left: 10px;" align="center" >{{ number_format($previousSaving, 2  ) }} &nbsp;</td>
                            <td width="225" style="padding-left: 10px;"></td>
                            
                          </tr> 
                          <?php
                           $sl =0;
                           $tp =0;
                           $tw=0;
                           $nt=0;
                          ?>
                  @foreach($collection as $showData)  
                    <?php 
                    $sl++;
                    $tp +=$showData->today_dep;
                           $tw +=$showData->today_withdraw;
                           $nt +=0;

                    ?>
                          <tr style=" font-weight: bold;">
                          <td width="92"  style="padding-left: 10px;"><?php echo $sl;?></td>

                            <td width="92"  style="padding-left: 10px;"><?php
                                $date = explode('-', $showData->date);
                                print $printdate =$date[2].'-'.$date[1].'-'.$date[0];
                            ?></td>
                            <td width="260"  style="padding-left: 10px;">{{$showData->details}}</td>
                            <td width="181"  align="right" style="padding-left: 10px;">{{number_format($showData->today_dep,2)}} &nbsp;</td>
                            <td width="223" align="right"  style="padding-left: 10px;">{{number_format($showData->today_withdraw,2)}} &nbsp;</td>
                            <td width="105" align="right">

                            <?php
                              echo  $nt=$tp - $tw;
                               //echo  $totalsaving = number_format($showData->net_dep,2);
                                
                            ?> &nbsp;
                          </td>
                            <td width="202"  style="padding-left: 10px;" >{{$showData->comments}} </td>
                            <td width="225" style="padding-left: 10px;">{{$showData->adminname}}</td>
                            
                          </tr> 
                        

                   @endforeach
                      <tr style=" font-weight: bold;">
                          

                            <td width="92"  style="padding-left: 10px;"></td>
                            <td width="260"  style="padding-left: 10px;"></td>
                            <td width="181" align="right" style="padding-left: 10px;"><b>Total &nbsp;</b> </td>
                            <td width="223" align="right" style="padding-left: 10px;"><b>{{number_format($monthtotalSaving,2)}} &nbsp;</b></td>
                            <td width="105" align="right"><b>{{number_format($withdrawTotal,2)}} &nbsp;</b>   </td>
                            <td width="202"  style="padding-left: 10px;" align="right" >{{number_format(($monthtotalSaving-$withdrawTotal)+$previousSaving),2}} &nbsp; </td>
                            <td width="225" style="padding-left: 10px;"></td>
                            
                          </tr> 
                        

                          <tr style=" font-weight: bold;">
                          

                            <td width="92" colspan="8" align="right"  style="padding-left: 10px;">
                              
                              Total Saving Installment. : <?php echo count($totalsavingno); ?> &nbsp;
                              <br/>Total Withdraw Installment. : <?php echo count($totalwithdrawno); ?>&nbsp;
                            </td>

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
