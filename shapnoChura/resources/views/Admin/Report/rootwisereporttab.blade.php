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
 @if($package == '1')
<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px;" >

                
                <tr style="text-align: center; font-weight: bold;" align="center">
                  <td align='center' style="text-align: center;"><a href="#" style="text-decoration: none;"> 

                        Root Wise Collection <br> Saving Account Report
<span  style=" font-size: 14px;text-align: center;">@if($Type==='5')
                (Daily)                 @endif
                @if($Type==='1')
   (Date to Date)                  @endif
                @if($Type==='2')
   (Monthly)
                
                @endif

                @if($Type==='3')
(Yearly)                @endif
</span>
       
                  </a>
                                  </td>

                  </tr> 
                  


</table>

<table align="center" width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-left:10px; margin-bottom:10px;" >
             
      <tr align="center">
          @if($date != "")
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;text-align: ">Date :&nbsp;&nbsp;{{$date}} </span></td>
          @endif
          @if($firstdate != "" && $seconddate != "")
            <td align="center"><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;text-align:center;margin-left: 245px">
              @php
                      $dateexplodes = explode('-',$firstdate);
                      $firstdate =$dateexplodes[2].'-'.$dateexplodes[1].'-'.$dateexplodes[0]; 

                      $dateexplode = explode('-',$seconddate);
                      $seconddate =  $dateexplode[2].'-'.$dateexplode[1].'-'.$dateexplode[0]; 
              @endphp 

            Date :&nbsp;&nbsp;{{$firstdate}} TO {{$seconddate}} 
          </span></td>
          @endif

            @if($month != "")
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;">Date :&nbsp;&nbsp;@if($month ==='01')
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
December                @endif </span></td>
            @endif

  @if($year != "")

              <td align="center"><span  style=" font-size: 18px; font-weight: bold; ">Year :&nbsp;&nbsp;{{$year}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                @endif

      </tr>
  
</table>
 <table class="table" style="width: 1304px;border:1px solid #999;margin-bottom: 10px" align="center">
<tr>
  <td style="width: 50%;border-right: 1px solid #999">
    <table class="table" style="font-size: 14px;">
      <tr>
        <td>
          Brance Name : {{$collection[0]->name}}<br>
          Root  Name : {{$collection[0]->area_name}}

        </td>
      </tr>
    </table>
  </td>
  <td style="width: 50%">
    <table class="table" style="font-size: 14px;">
      <tr>
        <td align="right">
          Prepared By : {{Auth::guard('admin')->user()->name}}<br>
          Print Date : {{date('d-m-Y')}}<br>
          <!--Print Time : {{date('h:i:s')}}-->
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1304"/>

<table width="1304" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; font-size: 20px; position: relative; " >

                <tr style="text-align: center; font-weight: bold;">
                  
                      <td width="92">SL.</td>
                    <td width="92">Date</td>
                    <td width="260">Account Name</td>
                    <td width="260">Account Number</td>
                    <td width="110">Type</td>
                    <td width="223">Collection Ammount</td>
                    <td width="223">Withdraw Amount</td>
                    <td width="202"> User Name</td>
                  
                    
                  </tr>  
                        @if(count($collection) > 0)
                          <?php $sl =0;$col =0;$wid =0;?>
                  @foreach($collection as $showData)  
                    <?php 
                    $sl++;
                    $col +=$showData->today_dep;
                    $wid +=$showData->today_withdraw;

                    ?>
                          <tr style=" font-weight: bold;">
                          <td width="92"  style="padding-left: 10px;">
                            
                            <?php echo $sl;?>
                              
                            </td>

                            <td width="92"  style="padding-left: 10px;"><?php
                                $date = explode('-', $showData->date);
                                print $printdate =$date[2].'-'.$date[1].'-'.$date[0];
                            ?></td>
                            <td width="260"  style="padding-left: 10px;">{{$showData->mem_name}}</td>
                            <td width="260"  style="padding-left: 10px;">{{$showData->Addid}}</td>
                            <td width="260"  style="padding-left: 10px;">{{$showData->typename}}</td>
                            <td width="181"  align="right" style="padding-left: 10px;">{{number_format($showData->today_dep,2)}} &nbsp;</td>
                            <td width="223" align="right"  style="padding-left: 10px;">{{number_format($showData->today_withdraw,2)}} &nbsp;</td>
                            <td width="225" style="padding-left: 10px;">{{$showData->adminname}}</td>
                            
                          </tr> 
                        

                   @endforeach
                      <tr style=" font-weight: bold;">
                          

                            <td width="92"  style="padding-left: 10px;"></td>
                            <td width="260"  style="padding-left: 10px;"></td>
                            <td width="181" align="right" style="padding-left: 10px;"> </td>
                            <td width="223" align="right" style="padding-left: 10px;"></td>
                            <td width="105" align="right"><b>Total &nbsp;</b></td>
                            <td width="202"  style="padding-left: 10px;" align="right" ><b>{{number_format($col,2)}} &nbsp;</b></td>
                            <td width="123" align="right" style="padding-left: 10px;"><b>{{number_format($wid,2)}} &nbsp;</b></td>
                            <td width="112" style="padding-left: 10px;"></td>
                            
                          </tr> 
                        

                          <!-- <tr style=" font-weight: bold;">
                          

                            <td width="92" colspan="8" align="right"  style="padding-left: 10px;">
                              
                              Total Saving Installment. : <?php echo count(0); ?> &nbsp;
                              <br/>Total Withdraw Installment. : <?php echo count(0); ?>&nbsp;
                            </td>

                          </tr>  -->
                        
                        @endif

                   
                    

</table>
@endif

@if($package == '2')
<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px;" >

                
                <tr style="text-align: center; font-weight: bold;" align="center">
                  <td align='center' style="text-align: center;"><a href="#" style="text-decoration: none;"> 

                        Root Wise Collection <br>Invest Account Report
<span  style=" font-size: 14px;">@if($Type==='5')
                (Daily)                 @endif
                @if($Type==='1')
   (Date To Date)                  @endif
                @if($Type==='2')
   (Monthly)
                
                @endif

                @if($Type==='3')
(Yearly)                @endif
</span>
       
                  </a>
                                  </td>

                  </tr> 
                  


</table>

<table align="center" width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-left:10px; margin-bottom:10px;" >
             
      <tr align="center">
          @if($date != "")
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;">Date :&nbsp;&nbsp;{{$date}} </span></td>
          @endif

          @if($firstdate != "" && $seconddate != "")
            <td align="center"><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;text-align:center;margin-left: 245px">
              @php
                      $dateexplodes = explode('-',$firstdate);
                      $firstdate =  $dateexplodes[2].'-'.$dateexplodes[1].'-'.$dateexplodes[0]; 

                      $dateexplode = explode('-',$seconddate);
                      $seconddate =  $dateexplode[2].'-'.$dateexplode[1].'-'.$dateexplode[0]; 
              @endphp 

            Date :&nbsp;&nbsp;{{$firstdate}} TO {{$seconddate}} 
          </span></td>
          @endif

            @if($month != "")
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;">Date :&nbsp;&nbsp;@if($month ==='01')
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
December                @endif </span></td>
            @endif

  @if($year != "")

              <td align="center"><span  style=" font-size: 18px; font-weight: bold; ">Year :&nbsp;&nbsp;{{$year}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                @endif

      </tr>
</table>
<table class="table" style="width: 100%;border:1px solid #999;margin-bottom: 10px">
<tr>
  <td style="width: 50%;border-right: 1px solid #999">
    <table class="table" style="font-size: 14px;">
      <tr>
        <td>
          Brance Name : {{$collection[0]->name}}<br>
          Root  Name : {{$collection[0]->area_name}}

        </td>
      </tr>
    </table>
  </td>
  <td style="width: 50%">
    <table class="table" style="font-size: 14px;">
      <tr>
        <td>
          Prepared By : {{$collection[0]->adminname}}<br>
          Print Date : {{date('d-m-Y')}}<br>
          Print Time : {{date('h:i:s')}}
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1304"/>
<table width="1304" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; font-size: 20px; position: relative; " >

                <tr style="text-align: center; font-weight: bold;">
                  
                      <td width="80">SL.</td>
                    <td width="80">Date</td>
                    <td width="350">Account Name</td>
                    <td width="350">Account Number</td>
                    <td width="100">Type</td>
                    <td width="120">Collection Ammount</td>
                    <td width="120">Profit Ammount</td>
                    <td width="100">User Name</td>
                  
                    
                  </tr>  
                        @if(count($collection) > 0)
                          <?php $sl =0;$col =0;$pro =0;?>
                  @foreach($collection as $showData)  
                    <?php 
                    $sl++;
                    $col +=$showData->tody_inves;
                    $pro +=$showData->inves_wise_deven;
                    ?>


                          <tr style=" font-weight: bold;">
                          <td width="80"  style="padding-left: 10px;"><?php echo $sl;?></td>

                            <td width="80"  style="padding-left: 10px;"><?php
                                $date = explode('-', $showData->date);
                                print $printdate =$date[2].'-'.$date[1].'-'.$date[0];
                            ?></td>
                            <td width="350"  style="padding-left: 10px;">{{$showData->mem_name}}</td>
                            <td width="350"  style="padding-left: 10px;">{{$showData->acno}}</td>
                            <td width="100"  style="padding-left: 10px;">
                              @if($showData->type == '1')
                                  Weekly
                              @elseif($showData->type == '2')
                                  Monthly
                              @elseif($showData->type == '3')
                                  Yearly
                              @elseif($showData->type == '4')
                                  General
                              @elseif($showData->type == '5')
                                    Daily
                              @endif


                            </td>
                            <td width="300"  align="right" style="padding-left: 10px;">{{number_format($showData->tody_inves,2)}} &nbsp;</td>
                            <td width="200"  align="right" style="padding-left: 10px;">{{number_format($showData->inves_wise_deven,2)}} &nbsp;</td>
                            <td width="100" style="padding-left: 10px;">{{$showData->adminname}}</td>
                            
                          </tr> 
                        

                   @endforeach
                      <tr style=" font-weight: bold;">
                          

                            <td width="80"  style="padding-left: 10px;"></td>
                            <td width="260"  style="padding-left: 10px;"></td>
                            <td width="181" align="right" style="padding-left: 10px;"></td>
                            <td width="223" align="right" style="padding-left: 10px;"></td>
                            <td width="105" align="right"> <b>Total :&nbsp;</b>   </td>
                            <td width="202"  style="padding-left: 10px;" align="right" ><b>{{number_format($col,2)}} &nbsp;</b></td>
                            <td width="123" style="padding-left: 10px;" align="right"><b>{{number_format($pro,2)}} &nbsp;</b> </td>
                            <td width="122" style="padding-left: 10px;"></td>
                            
                          </tr> 
                        
                        
                        @endif

                   
                    

</table>
@endif
</div>

<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>

</body>
</html>
