<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Report</title>
</head>

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

<table width="1200" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          @if($id->id == '306' or $id->fk_brance_id =='1')
                          
                          <img style="width: 100%; " src="{{URL::to('/')}}/public/imageHeader/14.png">

                          @else

                        <img style="width: 100%; " src="{{URL::to('/')}}/public/imageHeader/{{$brancedata[0]->fk_brance_Id}}.png">

                          @endif
                      </span></td>

                  </tr>   

</table>


<table width="1200" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center' colspan='2'>

  @if($type=='1' or $type=='2')  
                    <a href="#" style="text-decoration: none;  border: 1px #000 solid; padding: 10px; display: block; width: 250px; color: black; font-size: 24px; "> 

                  Top Sheet (@if($type=='1') Debit @elseif($type=='2') Credit @endif)
<span  style=" font-size: 14px;">
              
</span>

                  </a>



<b style="font-size: 20px;">{{$brancename[0]->name}}</b>
        @elseif($type=='3')
              <b style="font-size: 20px;">From {{$date1}} To {{$date2}} Debit Credit Estimate of {{$brancename[0]->name}} </b>
               @elseif($type=='5')
                   <b style="font-size: 20px;">From {{$date1}} To {{$date2}} Saving Collection Report<br/>{{$brancename[0]->name}} </b>
           
              
              @elseif($type=='6')
                   <b style="font-size: 20px;">From {{$date1}} To {{$date2}} Invest Collection Report<br/>{{$brancename[0]->name}} </b>
            @elseif($type=='7')
                   <b style="font-size: 20px;">All Cash Close Sheets <br/>{{$brancename[0]->name}} </b>
              @else
               <b style="font-size: 20px;"> Cash Close Sheet - <?php   $explode = explode('-', $renewdate);
      echo $ee =  $explode[2].'-'.$explode[1].'-'.$explode[0];   ?> <br/> {{$brancename[0]->name}} </b>

        @endif


              </TD>

                  </tr> 
                  @if($type=='1' or $type=='2')  
                  <tr>
                    <td align="left"><b>Serial No. : </b></td>
                    <td align="right"><b>Date : {{$daterpit}}</b></td>
                  </tr>
                  @endif
        <tr style="font-size: 14px;">
          <td>
          Prepared By : {{Auth::guard('admin')->user()->name}}<br>
          Print Date : {{date('d-m-Y')}}<br>
          Print Time : {{date('h:i:s')}}
        </td>
      </tr>

</table>

@if($type=='1')

<table width="1200" border="0"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  <tr >
    <th style="border: 1px #000 solid;">No.</th>
    <th   style="border: 1px #000 solid;" align="left"> &nbsp;&nbsp;Title</th>
    <th width="120px;" style="border: 1px #000 solid;">Taka</th>

  </tr>
  <?php
    $tdaytotal = 0;
    $packtotal =0;
    $othertoal = 0;
  ?>

  <tr>
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;">&nbsp;1</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;" >&nbsp;Saving Recieve :<br/>
           @if(count($todayrecieveammount)>0)
           @foreach($todayrecieveammount as $key)

             <span style="padding-left: 30px;"> {{$key->name}}</span><br/>
           @endforeach
           @endif
              <span style="padding-left: 30px;">MMPDS</span><br/>

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;"  align="right">
      <br/>

  @if(count($todayrecieveammount)>0)
           @foreach($todayrecieveammount as $key)
           <?php
            $packtotal = $packtotal+$key->total;
           ?>

             <span style="padding-left: 30px;"> {{number_format($key->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;"> {{number_format($mmpdsrcv[0]->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
</td>
   
  </tr>


  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Nett Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($ttnet=$investnettcole[0]->totaltodyinv-$investnettcole[0]->netpro,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;3</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Profits Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> {{number_format($investnettcole[0]->netpro,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

     <tr>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;4</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Share  Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> {{number_format($todaysare[0]->totalshare,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;5</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Bank Withdraw</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">{{number_format($bankwithdraw[0]->withdrwa,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>


@if(count($otherincome) > 0)
<?php $sl=5; ?>
@foreach($otherincome as $showdate)
<?php  $othertoal   =  $othertoal  +$showdate->ammount;?>
<?php $sl++; ?>
  <tr style="height: 30px;">
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid;">&nbsp; <?php echo $sl;?></td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;" >&nbsp;{{$showdate->title}}
       

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;"  align="right">
     {{number_format($showdate->ammount,2)}}&nbsp;&nbsp;&nbsp;</td>
   
  </tr>

@endforeach

@endif
  <tr >
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;" >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;"  align="right">&nbsp;</td>
 
  </tr>
<?php
     $tdaytotal =  $othertoal+$bankwithdraw[0]->withdrwa+$todaysare[0]->totalshare+$investnettcole[0]->netpro+$ttnet+ $packtotal+$mmpdsrcv[0]->total;
?>
<tr>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " colspan="3"></td>
</tr>

<tr  style="height: 35px">

  <TD colspan="3">
    <TABLE width="1200" border="0" style="border-bottom:1px #000 solid;border-right:1px #000 solid;border-left:1px #000 solid;margin-top: -12px;" cellpadding="0" cellspacing="0">
      <TR>
        <td>Taka(Words) : <?php echo Terbilang::make($tdaytotal);?> taka </td>

  <td align="right" style="border-right:1px #000 solid; width: 555px;">Total -</td>
  <td align="right" > {{number_format($tdaytotal,2)}} &nbsp;</td>
      </TR>
    </TABLE>
  </TD>
  
</tr>

</table>




@elseif($type=='2')


<table width="1200" border="0"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  <tr >
    <th style="border: 1px #000 solid;">No.</th>
    <th   style="border: 1px #000 solid;" align="left"> &nbsp;&nbsp;Title</th>
    <th width="120px;" style="border: 1px #000 solid;">Taka</th>

  </tr>
  <?php
    $costtotal = 0;
    $cspactotal =0;
    $othercostotal = 0;
  ?>

  <tr>
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;">&nbsp;1</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;" >&nbsp;Saving Return :<br/>
           @if(count($todaywitdrwaam)>0)
           @foreach($todaywitdrwaam as $key)

             <span style="padding-left: 30px;"> {{$key->name}}</span><br/>
           @endforeach
           @endif
             <span style="padding-left: 30px;"> MMPDS</span><br/>

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;"  align="right">
      <br/>

  @if(count($todaywitdrwaam)>0)
           @foreach($todaywitdrwaam as $key)
           <?php
            $cspactotal = $cspactotal+$key->total;
           ?>

             <span style="padding-left: 30px;"> {{number_format($key->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
           @endforeach
           @endif
             <span style="padding-left: 30px;"> {{number_format($mmpdreturn[0]->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
</td>
   
  </tr>



  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  MMPDS Profits  Provide</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($mmpdsprofit[0]->total,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>


  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Provide</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($invprovide,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;3</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Saving Profit  Provide </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($totpwithdraw,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>



   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 4</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Employee Salary Provide </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($employsalary,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   

  
   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 5</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Bank Deposit</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($bankdeposit,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>



   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 6 </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Share  Withdraw</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($sharewithdraw[0]->totalshare,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>


@if(count($othercost) > 0)
<?php $sl=5; ?>
@foreach($othercost as $showdate)
<?php  $othercostotal   =  $othercostotal  +$showdate->ammount;?>
<?php $sl++; ?>
  <tr style="height: 30px;">
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid;">&nbsp; <?php echo $sl;?></td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;" >&nbsp;{{$showdate->title}}
       

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;"  align="right">
     {{number_format($showdate->ammount,2)}}&nbsp;&nbsp;&nbsp;</td>
   
  </tr>

@endforeach

@endif
  <tr >
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;" >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;"  align="right">&nbsp;</td>
 
  </tr>
<?php
     $costtotal =  $othercostotal+$invprovide+ $cspactotal+$totpwithdraw+$employsalary+$bankdeposit+$mmpdreturn[0]->total+$mmpdsprofit[0]->total;
?>


<tr  style="height: 35px">

  <TD colspan="3">
    <TABLE width="1200" border="0" style="border-bottom:1px #000 solid;border-right:1px #000 solid;border-left:1px #000 solid;margin-top: -12px;" cellpadding="0" cellspacing="0">
      <TR>
        <td>Taka(Words) : <?php echo Terbilang::make($costtotal);?> taka </td>

  <td align="right" style="border-right:1px #000 solid; width: 555px;">Total -</td>
  <td align="right" > {{number_format($costtotal,2)}} &nbsp;</td>
      </TR>
    </TABLE>
  </TD>
  
</tr>

</table>
@elseif($type=='5')

<table width="1200" height='' border="1"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  <tr >
    <th colspan="7" style="border: 1px #000 solid; text-align: center;">Collection/Withdraw Sheet</th>
   

  </tr>

  <tr align="center">
      <td>Sl NO</td>
      <td>Date</td>
       <td>Name</td>
      <td>Saving Type</td>
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
            <td>&nbsp;&nbsp;&nbsp;{{$showdata->name}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{$showdata->mem_add_id}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->today_dep,2)}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->today_withdraw,2)}}</td>
           

        </tr>
  @endforeach
  <TR>
    <Th colspan="5" align='right'>Total</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totaldep,2)}}</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totalwit,2)}}</th>
  </TR>
  @endif
<table>
  @elseif($type=='6')

<table width="1200" height='' border="1"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  <tr >
    <th colspan="6" style="border: 1px #000 solid;"> Invest Collection Sheet</th>
   

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
      <tr align="">
            <td colspan="">&nbsp;&nbsp;&nbsp;<?= $sl;?></td>
            <td>&nbsp;&nbsp;&nbsp;<?php  $explodes = explode('-', $showdata->date);
     echo  $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];   ?></td>
     <td>&nbsp;&nbsp;&nbsp;{{$showdata->mem_name}}</td>
     <td>&nbsp;&nbsp;&nbsp;{{$showdata->fk_invest_id}}</td>
       
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->tody_inves,2)}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->inves_wise_deven,2)}}</td>
           

        </tr>
  @endforeach
 <TR>
    <Th colspan="4" align='right'>Total</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totaldep,2)}}</Th>
    <Th>&nbsp;&nbsp;&nbsp;{{number_format($totalwit,2)}}</Th>
  </TR>
  @endif
<table>
@elseif($type=='7')
<table width="1200" height='' border="1"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">

  <tr align="center">
      <td>Sl NO</td>
      <td>Date</td>
      <td>Debit  Amount</td>
      <td>Credit Amount</td>
     
      <td>Today Cash</td>
      <td>Closed By</td>
     

  </tr>

  @if(count($cashcloasesheets) > 0)
  <?php $sl=0; $previous = 0;?>
  @foreach($cashcloasesheets as $showdata)
  <?php $sl++;?>
      <tr align="">
            <td>&nbsp;&nbsp;&nbsp;<?= $sl;?></td>
            <td>&nbsp;&nbsp;&nbsp;<?php  $explodes = explode('-', $showdata->date);
     echo  $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];   ?></td>

       
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->credit,2)}}</td>
            <td>&nbsp;&nbsp;&nbsp;{{number_format($showdata->debit,2)}}</td>
          
            <td>&nbsp;&nbsp;&nbsp; <?php  $total =  $showdata->credit - $showdata->debit; ?> {{number_format($total,2)}}</td>
           
   <td>&nbsp;&nbsp;&nbsp;{{$showdata->name}}</td>
        </tr>
  @endforeach
  @endif
<table>

@elseif($type=='3')


<table width="600" height='' border="0"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  <tr >
    <th colspan="3" style="border: 1px #000 solid;">Debit</th>
   

  </tr>
<tr>

    


  <tr >
    <th style="border: 1px #000 solid;">No.</th>
    <th   style="border: 1px #000 solid;" align="left"> &nbsp;&nbsp;Title</th>
    <th width="120px;" style="border: 1px #000 solid;">Taka</th>

  </tr>
  <?php
    $tdaytotal = 0;
    $packtotal =0;
    $othertoal = 0;
  ?>

  <tr>


    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;">&nbsp;1</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;" >&nbsp;Saving Recieve :<br/>
           @if(count($todayrecieveammount)>0)
           @foreach($todayrecieveammount as $key)

             <span style="padding-left: 30px;"> {{$key->name}}</span><br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;">MMPDS</span>

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;"  align="right">
      <br/>

  @if(count($todayrecieveammount)>0)
           @foreach($todayrecieveammount as $key)
           <?php
            $packtotal = $packtotal+$key->total;
           ?>

             <span style="padding-left: 30px;"> {{number_format($key->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;"> {{number_format($mmpdsrcv[0]->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
</td>
   
  </tr>


  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Nett Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($totalinvcol=$investnettcole[0]->totaltodyinv-$investnettcole[0]->netpro,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;3</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Profits Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> {{number_format($investnettcole[0]->netpro,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

     <tr>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;4</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Share  Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> {{number_format($todaysare[0]->totalshare,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;5</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Bank Withdraw</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">{{number_format($bankwithdraw[0]->withdrwa,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>


@if(count($otherincome) > 0)
<?php $sl=5; ?>
@foreach($otherincome as $showdate)
<?php  $othertoal   =  $othertoal  +$showdate->ammount;?>
<?php $sl++; ?>
  <tr style="height: 30px;">
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid;">&nbsp; <?php echo $sl;?></td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;" >&nbsp;{{$showdate->title}}
       

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;"  align="right">
     {{number_format($showdate->ammount,2)}}&nbsp;&nbsp;&nbsp;</td>
   
  </tr>

@endforeach

@endif
  <tr >
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;" >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;"  align="right">&nbsp;</td>
 
  </tr>
<?php
     $tdaytotal =  $othertoal+$bankwithdraw[0]->withdrwa+$todaysare[0]->totalshare+$investnettcole[0]->netpro+$totalinvcol+ $packtotal+$mmpdsrcv[0]->total;
?>
<tr>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " colspan="3"></td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">{{number_format($tdaytotal,2)}}&nbsp;</td>
</tr>
<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Previous Cash   -&nbsp;  </td>
  <td style="border-left: 1px #000 solid;border-right: 1px #00  0 solid; border-bottom: 1px #000 solid; "  align="right"><?php  $precash = $lastcashcloseamnt[0]->credit - $lastcashcloseamnt[0]->debit; ?> {{number_format($precash,2)}} </td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right"><?php  $totaldebit = $precash+$tdaytotal; ?> {{number_format($totaldebit,2)}} </td>
</tr>
</table>




<table width="600" border="0" class="bd"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  
  <tr >
    <th style="border: 1px #000 solid;" colspan="3">Credit</th>
   

  </tr>
 
  <tr>
  <tr >
    <th style="border: 1px #000 solid;">No.</th>
    <th   style="border: 1px #000 solid;">Title</th>
    <th width="120px;" style="border: 1px #000 solid;">Taka</th>

  </tr>
  <?php
    $costtotal = 0;
    $cspactotal =0;
    $othercostotal = 0;
  ?>

  <tr>
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;">&nbsp;1</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;" >&nbsp;Saving Return :<br/>
           @if(count($todaywitdrwaam)>0)
           @foreach($todaywitdrwaam as $key)

             <span style="padding-left: 30px;"> {{$key->name}}</span><br/>
           @endforeach
           @endif
 <span style="padding-left: 30px;">MMPDS</span>
    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;"  align="right">
      <br/>

  @if(count($todaywitdrwaam)>0)
           @foreach($todaywitdrwaam as $key)
           <?php
            $cspactotal = $cspactotal+$key->total;
           ?>

             <span style="padding-left: 30px;"> {{number_format($key->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;"> {{number_format($mmpdreturn[0]->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
</td>
   
  </tr>

  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  MMPDS Profits  Provide</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($mmpdsprofit[0]->total,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>
  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;3</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Provide</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($invprovide,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;4</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Saving Profit  Provide </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($totpwithdraw,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>
 <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 5</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Employee Salary Provide </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($employsalary,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   

  
   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 6</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Bank Deposit</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($bankdeposit,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>
   

    <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 7</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Share Withdraw</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($shareWithdrawss[0]->totalshare,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>


@if(count($othercost) > 0)
<?php $sl=7; ?>
@foreach($othercost as $showdate)
<?php  $othercostotal   =  $othercostotal  +$showdate->ammount;?>
<?php $sl++; ?>
  <tr style="height: 30px;">
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid;">&nbsp; <?php echo $sl;?></td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;" >&nbsp;{{$showdate->title}}
       

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;"  align="right">
     {{number_format($showdate->ammount,2)}}&nbsp;&nbsp;&nbsp;</td>
   
  </tr>

@endforeach

@endif
  <tr >
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;" >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;"  align="right">&nbsp;</td>
 
  </tr>
<?php
     $costtotal =  $othercostotal+$invprovide+ $cspactotal+$totpwithdraw+$employsalary+$bankdeposit+$mmpdreturn[0]->total+$mmpdsprofit[0]->total+$shareWithdrawss[0]->totalshare;
?>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">{{number_format($costtotal,2)}}&nbsp;</td>
</tr>



<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Hand In Cash  - &nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">&nbsp;  <?php  $totalcredit = $totaldebit - $costtotal ; ?> {{number_format($totalcredit,2)}} </td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">&nbsp;  <?php  $fixedcash = $totalcredit + $costtotal ; ?> {{number_format($fixedcash,2)}}</td>
</tr>

</table>
@else


<table width="600" height='' border="0"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  <tr >
    <th colspan="3" style="border: 1px #000 solid;">Debit</th>
   

  </tr>
<tr>

    


  <tr >
    <th style="border: 1px #000 solid;">No.</th>
    <th   style="border: 1px #000 solid;" align="left"> &nbsp;&nbsp;Title</th>
    <th width="120px;" style="border: 1px #000 solid;">Taka</th>

  </tr>
  <?php
    $tdaytotal = 0;
    $packtotal =0;
    $othertoal = 0;
  ?>

  <tr>


    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;">&nbsp;1</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;" >&nbsp;Saving Recieve :<br/>
           @if(count($todayrecieveammount)>0)
           @foreach($todayrecieveammount as $key)

             <span style="padding-left: 30px;"> {{$key->name}}</span><br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;">MMPDS</span>

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;"  align="right">
      <br/>

  @if(count($todayrecieveammount)>0)
           @foreach($todayrecieveammount as $key)
           <?php
            $packtotal = $packtotal+$key->total;
           ?>

             <span style="padding-left: 30px;"> {{number_format($key->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;"> {{number_format($mmpdsrcv[0]->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
</td>
   
  </tr>


  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Nett Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($investnettcole[0]->totaltodyinv-$investnettcole[0]->netpro,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;3</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Profits Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> {{number_format($investnettcole[0]->netpro,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

     <tr>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;4</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Share  Collection</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> {{number_format($todaysare[0]->totalshare,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;5</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Bank Withdraw</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">{{number_format($bankwithdraw[0]->withdrwa,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>


@if(count($otherincome) > 0)
<?php $sl=5; ?>
@foreach($otherincome as $showdate)
<?php  $othertoal   =  $othertoal  +$showdate->ammount;?>
<?php $sl++; ?>
  <tr style="height: 30px;">
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid;">&nbsp; <?php echo $sl;?></td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;" >&nbsp;{{$showdate->title}}
       

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;"  align="right">
     {{number_format($showdate->ammount,2)}}&nbsp;&nbsp;&nbsp;</td>
   
  </tr>

@endforeach

@endif
  <tr >
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;" >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;"  align="right">&nbsp;</td>
 
  </tr>
<?php
     $tdaytotal =  $othertoal+$bankwithdraw[0]->withdrwa+$todaysare[0]->totalshare+$investnettcole[0]->totaltodyinv+ $packtotal+$mmpdsrcv[0]->total;
?>
<tr>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " colspan="3"></td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">{{number_format($tdaytotal,2)}}&nbsp;</td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Previous Cash   -&nbsp;  </td>
  <td style="border-left: 1px #000 solid;border-right: 1px #00  0 solid; border-bottom: 1px #000 solid; "  align="right"><?php  $precash = $lastcashcloseamnt[0]->credit - $lastcashcloseamnt[0]->debit; ?> {{number_format($precash,2)}} </td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right"><?php  $totaldebit = $precash+$tdaytotal; ?> {{number_format($totaldebit,2)}} </td>
</tr>
</table>

<table width="600" border="0" class="bd"  cellpadding="0" cellspacing="0" style="float: left; font-size: 20px;">
  
  <tr >
    <th style="border: 1px #000 solid;" colspan="3">Credit</th>
   

  </tr>
 
  <tr>
  <tr >
    <th style="border: 1px #000 solid;">No.</th>
    <th   style="border: 1px #000 solid;">Title</th>
    <th width="120px;" style="border: 1px #000 solid;">Taka</th>

  </tr>
  <?php
    $costtotal = 0;
    $cspactotal =0;
    $othercostotal = 0;
  ?>

  <tr>
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;">&nbsp;1</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;" >&nbsp;Saving Return :<br/>
           @if(count($todaywitdrwaam)>0)
           @foreach($todaywitdrwaam as $key)

             <span style="padding-left: 30px;"> {{$key->name}}</span><br/>
           @endforeach
           @endif
 <span style="padding-left: 30px;">MMPDS</span>
    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-top: 1px #000 solid;"  align="right">
      <br/>

  @if(count($todaywitdrwaam)>0)
           @foreach($todaywitdrwaam as $key)
           <?php
            $cspactotal = $cspactotal+$key->total;
           ?>

             <span style="padding-left: 30px;"> {{number_format($key->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
           @endforeach
           @endif
            <span style="padding-left: 30px;"> {{number_format($mmpdreturn[0]->total,2)}}</span>&nbsp;&nbsp;&nbsp;<br/>
</td>
   
  </tr>

  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;2</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  MMPDS Profits  Provide</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($mmpdsprofit[0]->total,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>
  <tr style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;3</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Invest  Provide</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right">  {{number_format($invprovide,2)}}&nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp;4</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Saving Profit  Provide </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($totpwithdraw,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>
 <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 5</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Employee Salary Provide </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($employsalary,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>

   

  
   <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 6</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Bank Deposit</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($bankdeposit,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>
   

    <tr  style="height: 30px;">
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;  " >&nbsp; 7</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; " >&nbsp;  Share Withdraw</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; "  align="right"> <?php echo number_format($shareWithdrawss[0]->totalshare,2); ?> &nbsp;&nbsp;&nbsp;</td>
 
  </tr>


@if(count($othercost) > 0)
<?php $sl=7; ?>
@foreach($othercost as $showdate)
<?php  $othercostotal   =  $othercostotal  +$showdate->ammount;?>
<?php $sl++; ?>
  <tr style="height: 30px;">
    <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid;">&nbsp; <?php echo $sl;?></td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;" >&nbsp;{{$showdate->title}}
       

    </td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid;"  align="right">
     {{number_format($showdate->ammount,2)}}&nbsp;&nbsp;&nbsp;</td>
   
  </tr>

@endforeach

@endif
  <tr >
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;" >&nbsp;</td>
    <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid;"  align="right">&nbsp;</td>
 
  </tr>
<?php
     $costtotal =  $othercostotal+$invprovide+ $cspactotal+$totpwithdraw+$employsalary+$bankdeposit+$mmpdreturn[0]->total+$mmpdsprofit[0]->total;
?>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total   -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">{{number_format($costtotal,2)}}&nbsp;</td>
</tr>


<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Hand In Cash  - &nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">&nbsp;  <?php  $totalcredit = $totaldebit - $costtotal ; ?> {{number_format($totalcredit,2)}} </td>
</tr>

<tr  style="height: 35px">
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "></td>
  <td  style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; " align="right">Total  -&nbsp;</td>
  <td style="border-left: 1px #000 solid;border-right: 1px #000 solid; border-bottom: 1px #000 solid; "  align="right">&nbsp;  <?php  $fixedcash = $totalcredit + $costtotal ; ?> {{number_format($fixedcash,2)}}</td>
</tr>


</table>


@endif

<table width="1200" border="0"  cellpadding="0" cellspacing="0" style=" font-size: 20px;">
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
<style type="text/css">
  
  body {
    background-image: url("{{URL::to('/')}}/public/imageHeader/background.png");
    background-repeat: no-repeat;
    width: 1300px;
    

}

</style>


</body>
</html>
