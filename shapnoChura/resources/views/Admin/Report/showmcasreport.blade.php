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

<table width="1400" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" align="center">

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                        
                          @if($type=='1')  
                          <img style="width:1400px; <?php echo 160*count($otherincome)?>px" src="{{URL::to('/')}}/public/imageHeader/14.png">
                          @else
<img style="width:1400px; <?php echo 420*count($otherincome)?>px" src="{{URL::to('/')}}/public/imageHeader/14.png">
                          @endif

                 

                      </span></td>

                  </tr>   

</table>


<table width="1400" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px; font-size: 22px;" align="center">

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center' colspan='2'>


                    <a href="#" style="text-decoration: none;  border: 1px #000 solid; padding: 10px; color: black; font-size: 24px; "> 

                @if($type=='1') Credit @elseif($type=='2') Debit  @endif Report of @if($month ==='01')
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
-{{$year}}

    </a>

    <br/> <br/>{{$brancename[0]->name}}


              </TD>

                 

</table>

  @if($type=='1') 


<table width='1400'"<?php echo 160*count($otherincome)?>px" border="1"  cellpadding="0"  cellspacing="0" style="font-size: 20px;"align="center">
<?php
     $countpack = count($savingcollpack);

?>
      <tr>
      <th rowspan="2" width="80">Date</th>
      <th colspan="<?php echo $countpack+1;?>">Saving Recieve</th>
      <th rowspan="2">Invest Nett Collection</th>
      <th rowspan="2">Invest Profits Collection</th>
      <th rowspan="2">Share Collection</th>
     
      <th rowspan="2">Bank Withdraw</th>


@if(count($otherincome) > 0)
@foreach($otherincome as $showincome)
     <th rowspan="2">{{$showincome->title}}</th>
     @endforeach
     @endif




      <th rowspan="2">Total</th>
     
    </tr>

    <tr>
      @foreach($savingcollpack as $showpack)
      <td  align="center">{{$showpack->name}}</td>
      @endforeach
      <td  align="center">MMPDS</td>
    </tr>


<?php

      $substr = substr($month, 1,1);
      $number = cal_days_in_month(CAL_GREGORIAN, $substr, $year); 
      $ttamount = 0;
     for($x = 1; $x<=$number;$x++){
      $xz=strlen($x);
      $a=0;
      if($xz==1){

$a = '0'.$x;
    }else{

    $a = $x;
  }

       $renewdate =$year.'-'.$month.'-'.$a;
?>

    <tr>
        <td align="center">{{$a}}-{{$month}}-{{$year}}</td>
          

          <?php $tpackammount  = 0;?>
          @foreach($savingcollpack as $showpack)
        <td  align="right" >    
         
            @foreach($packdate as $packamount)
            @if($packamount->date === $renewdate and $packamount->rate ===  $showpack->type)
           <?php 
 $tpackammount = $tpackammount+ $packamount->lastammount;
           ?>
              {{number_format($packamount->lastammount,2)}}
            @endif

            @endforeach


        &nbsp;</td>
        @endforeach



       
        <td align="right">
          <?php

            $totalsavmmpds = 0;
          ?>
          @foreach($mmpdssav as $showmmpds)
            @if($showmmpds->date === $renewdate)
 <?php


            $totalsavmmpds =  $totalsavmmpds+ $showmmpds->total;
          ?>
              {{number_format($showmmpds->total,2)}}
            @endif

            @endforeach&nbsp;</td>
        <td align="right">
          <?php

            $totalnetcol = 0;
          ?>
  @foreach($investnettcole as $innetcol)
            @if($innetcol->date === $renewdate)
             <?php
 
            $totalnetcol =  $totalnetcol+ $innetcol->totaltodyinv;
          ?>
              {{number_format($innetcol->totaltodyinv,2)}}
            @endif

            @endforeach
          &nbsp;</td>
        <td align="right"> 
  <?php

            $totalnetcoll = 0;
          ?>
         @foreach($investnettcole as $innetcol)
            @if($innetcol->date === $renewdate)
            <?php
            $totalnetcoll =  $totalnetcoll+ $innetcol->netpro;
          ?>
              {{number_format($innetcol->netpro,2)}}
            @endif

            @endforeach&nbsp;</td>
        <td align="right">
  <?php

            $totalshares = 0;
          ?>
          @foreach($todaysare as $sharcol)
            @if($sharcol->date === $renewdate)
 <?php


            $totalshares =  $totalshares+ $sharcol->totalshare;
          ?>
              {{number_format($sharcol->totalshare,2)}}
            @endif

            @endforeach&nbsp;</td>



        <td align="right">
 <?php

            $totalbankwith = 0;
          ?>
          @foreach($bankwithdraw as $bankwith)
            @if($bankwith->date === $renewdate)
             <?php
            $totalbankwith = $totalbankwith + $bankwith->withdrwa ;
          ?>
              {{number_format($bankwith->withdrwa,2)}}
            @endif

            @endforeach &nbsp;</td>


<?php

            $totaotherincom = 0;
          ?>
@if(count($otherincome) > 0)
@foreach($otherincome as $showincome)
<td align="right"> 
@foreach($alldata as $showcosdata)

 @if($showcosdata->date === $renewdate and $showcosdata->fk_title_id === $showincome->fk_title_id)
  <?php


            $totaotherincom = $totaotherincom + $showcosdata->ammount ;
          ?>

  {{number_format($showcosdata->ammount,2)}}
 @endif
@endforeach &nbsp;
  
</td>
 @endforeach 
  @endif


        <td align="right">
            <?php

               $total = $tpackammount +  $totalnetcol + $totalnetcoll + $totalshares +$totalbankwith + $totaotherincom+$totalsavmmpds;
                $ttamount =  $ttamount +$total;
            ?>
            {{number_format($total,2)}}
        &nbsp;</td>

    </tr>
<?php } ?>

 <tr>
        <td align="right">Total&nbsp; -</td>
         @foreach($savingcollpack as $showpack)
        <td  align="right" >{{number_format($showpack->totals,2)}}&nbsp;</td>
        @endforeach
        <td align="right">{{number_format($totalmmpdssav[0]->total,2)}}&nbsp;</td>
       


        <td  align="right" >{{number_format($totalinvestcol[0]->totaltodyinv,2)}}&nbsp;</td>
        <td  align="right" >{{number_format($totalinvestcol[0]->netpro,2)}}&nbsp;</td>
           <td  align="right" >{{number_format($totalshare[0]->totalshare,2)}}&nbsp;</td>
         <td  align="right" >{{number_format($totalbankwithdraw[0]->withdrwa,2)}}&nbsp;</td>

@if(count($otherincome) > 0)
@foreach($otherincome as $showincome)


        <td align="right"> {{number_format($showincome->ammount,2)}}&nbsp;</td>

 @endforeach 
  @endif

        <td align="right">{{number_format($ttamount,2)}}&nbsp;</td>

    </tr>

  
</table>


@else

<table width="<?php echo 160*count($otherincome)?>px" border="1"  cellpadding="0" cellspacing="0" style="font-size: 20px;">
<?php
     $countpack = count($savingcollpack);
     $counpw = count($profitwithdraw);
      $cnsalary = count($slaryfetch);
?>
      <tr>
          <th rowspan="2" width="80">Date</th>
          <th colspan="<?php  echo $countpack+1;?>">Saving Return</th>
          <th colspan="<?php  echo $counpw+1;?>">Saving Profits Provides </th>
          <th colspan="<?php  echo $cnsalary+1;?>">Allowance Provides </th>
          <th rowspan="2">Invest Provides</th>
          <th rowspan="2">Bank Deposit </th>
              <th rowspan="2">Saving  Withdraw </th>

@if(count($otherincome) > 0)
@foreach($otherincome as $showincome)
     <th rowspan="2">{{$showincome->title}}</th>
     @endforeach
     @endif

         <th rowspan="2">Total</th>
     
    </tr>

    <tr>
        @foreach($savingcollpack as $showpack)
      <td  align="center">{{$showpack->name}}</td>
      @endforeach
        
        <td  align="center" >MMPDS</td>

              @foreach($profitwithdraw as $showpack)
      <td  align="center">{{$showpack->name}}</td>
      @endforeach
        <td  align="center" >MMPDS</td>

        <td align="center"  >Salary</td>

          @foreach($slaryfetch as $showpack)
      <td  align="center" >{{$showpack->titel}}</td>
      @endforeach

       
    </tr>


<?php

    $fulltoal = 0;
    $totalbankdeposit = 0;
    $totalinvprob = 0;
    $totalsalary = 0;
    $totalmmps = 0;
    $totalmmp = 0;
      $substr = substr($month, 1,1);
      $number = cal_days_in_month(CAL_GREGORIAN, $substr, $year); 
     for($x = 1; $x<=$number;$x++){
      $xz=strlen($x);
      $a=0;
      if($xz==1){

$a = '0'.$x;
    }else{

    $a = $x;
  }

       $renewdate =$year.'-'.$month.'-'.$a;
?>

    <tr>
        <td align="center">{{$a}}-{{$month}}-{{$year}}</td>
         
       <?php $tpackammount  = 0;
              $pkwith = 0;
       ?>
          @foreach($savingcollpack as $showpack)
        <td  align="right" >    
         
            @foreach($packdate as $packamount)
            @if($packamount->date === $renewdate and $packamount->rate ===  $showpack->type)
           <?php 
 $tpackammount = $tpackammount+ $packamount->lastammount;
           ?>
              {{number_format($packamount->lastammount,2)}}
            @endif

            @endforeach


        &nbsp;</td>
        @endforeach

       

        <td align="right"><?php

            $totalsavmmpds = 0;
          ?>
          @foreach($mmpdssav as $showmmpds)
            @if($showmmpds->date === $renewdate)
 <?php

            $totalmmps = $totalmmps + $showmmpds->total;
            $totalsavmmpds =  $totalsavmmpds+ $showmmpds->total;
          ?>
              {{number_format($showmmpds->total,2)}}
            @endif

            @endforeach &nbsp;</td>
    
                 @foreach($profitwithdraw as $showpack)
        <td  align="right" >    
  

     @foreach($seleprofitwitd as $packamount)
            @if($packamount->date === $renewdate and $packamount->packid ===  $showpack->fk_pack_id)
           <?php 
 $pkwith = $pkwith+ $packamount->total;

           ?>
              {{number_format($packamount->total,2)}}
            @endif

            @endforeach


        &nbsp;</td>
        @endforeach

        <td align="right"><?php

            $totalmmprof = 0;
          ?>
          @foreach($mmpdsprof as $showmmprof)
            @if($showmmprof->date === $renewdate)
 <?php

            $totalmmp = $totalmmp+ $showmmprof->total;
            $totalmmprof =  $totalmmprof+ $showmmprof->total;
          ?>
              {{number_format($showmmprof->total,2)}}
            @endif

            @endforeach&nbsp;</td>
       
         <td align="right"> 
<?php
    $tsalaryamount = 0;
?>
     @foreach($onlysalary as $showsalary)
     <?php
      $explodedate = explode('-', $showsalary->Data);
      $new=$explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
     ?>
            @if($new === $renewdate)
         <?php

          $tsalaryamount =  $tsalaryamount+ $showsalary->totalsal;
 $totalsalary  =  $totalsalary + $tsalaryamount;
         ?>
              {{number_format($showsalary->totalsal,2)}}
            @endif

            @endforeach
         &nbsp; </td> 

         <?php
          $othersalary = 0;
         ?>
          @foreach($slaryfetch as $showpack)
        <td align="right">
 @foreach($salaryall as $showsalaryall)
 <?php
      $explodedate = explode('-', $showsalaryall->date);
      $new=$explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
     ?>

            @if($new === $renewdate and $showsalaryall->fk_title_id ===  $showpack->fk_title_id)
           <?php 
 $othersalary =  $othersalary+ $showsalaryall->ammount;


           ?>
              {{number_format($showsalaryall->ammount,2)}}
            @endif

            @endforeach

          &nbsp;

        </td>

      @endforeach
      <td align="right">
        <?php
          $tinvprov =0;
        ?>
     @foreach($invprovide as $showinvprovide)
            @if($showinvprovide->appDate === $renewdate)
           <?php 
$tinvprov =$tinvprov  + $showinvprovide->total;
$totalinvprob  = $totalinvprob +$tinvprov ;
           ?>
              {{number_format($showinvprovide->total,2)}}
            @endif

            @endforeach


        </td>
        <td align="right">
          <?php
              $tbankdep = 0;
          ?>
         @foreach($bankdeposit as $showbankdeposit)
            @if($showbankdeposit->date === $renewdate)
           <?php 
 $tbankdep = $tbankdep + $showbankdeposit->totaldiposit;

$totalbankdeposit = $totalbankdeposit +  $tbankdep;

           ?>
              {{number_format($showbankdeposit->totaldiposit,2)}}
            @endif

            @endforeach
&nbsp;</td>
        <td align="right">
        <?php

            $totalshares = 0;
          ?>
          @foreach($todaysare as $sharcol)
            @if($sharcol->withdraw_date === $renewdate)

 <?php


            $totalshares =  $totalshares+ $sharcol->totalshare;
          ?>
              {{number_format($sharcol->totalshare,2)}}
            @endif

            @endforeach
&nbsp;</td>
      

 
<?php

            $totaotherincom = 0;
          ?>
@if(count($otherincome) > 0)
@foreach($otherincome as $showincome)
<td align="right"> 
@foreach($alldata as $showcosdata)

 @if($showcosdata->date === $renewdate and $showcosdata->fk_title_id === $showincome->fk_title_id)
  <?php


            $totaotherincom = $totaotherincom + $showcosdata->ammount ;


          ?>

  {{number_format($showcosdata->ammount,2)}}
 @endif
@endforeach &nbsp;
  
</td>
 @endforeach 
  @endif
        <td align="right">
            <?php
               $horizantaltotal = $tpackammount+ $pkwith +$tsalaryamount +$othersalary +$tinvprov + $tbankdep + $totaotherincom+$totalshares+$totalsavmmpds+$totalmmprof;

                $fulltoal =  $fulltoal+$horizantaltotal;
            ?>
              {{number_format($horizantaltotal,2)}}&nbsp;
            </td> 

    </tr>
<?php   } ?>

 <tr>
        <td align="right">Total&nbsp; -</td>
           @foreach($savingcollpack as $showpack)
        <td  align="right" >{{number_format($showpack->totals,2)}}&nbsp;</td>
        @endforeach

     
        <td align="right">{{number_format($totalmmps,2)}}&nbsp;</td>

            @foreach($profitwithdraw as $showpack)
        <td  align="right" >{{number_format($showpack->totals,2)}}&nbsp;</td>
        @endforeach

        <td  align="right" >{{number_format($totalmmp,2)}}&nbsp;</td>
     

        <td  align="right" > {{number_format($totalsalary,2)}}    &nbsp;</td>

            @foreach($slaryfetch as $showpack)
        <td align="right"> {{number_format($showpack->taotal,2)}} &nbsp;</td>
        @endforeach

         <td align="right"> {{number_format($totalinvprob,2)}}  </td> 
        <td align="right">  {{number_format($totalbankdeposit,2)}}&nbsp;</td>

  <td align="right">
         {{number_format($totalshare[0]->totalshare,2)}}
&nbsp;</td>
  

       @if(count($otherincome) > 0)
@foreach($otherincome as $showincome)


        <td align="right"> {{number_format($showincome->ammount,2)}}&nbsp;</td>

 @endforeach 
  @endif


        <td align="right">{{number_format($fulltoal ,2)}}&nbsp;</td>

    </tr>

  
</table>


@endif




<table style="width: 100%" border="0"  cellpadding="0" cellspacing="0" style="">
  <tr style="height: 30px;">
    <td width="700"></td>
    <td></td>
    <td width="100"></td>
   
  </tr>
    <tr style="height: 80px;">
    <td width="500">------------<br/>Creater</td>
    <td width="300">-------------------------<br/>Managing Derector</td>
    <td width="500" align="right" >------------------<br/>Chairman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   
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
