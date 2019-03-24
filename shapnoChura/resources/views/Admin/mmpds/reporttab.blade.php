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


<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                      
                          <img style="width: 100%" src="{{URL::to('/')}}/public/imageHeader/14.png">
                        
                      </span></td>

                  </tr>   

</table>


<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center'><a href="#" style="text-decoration: none;display: block; text-align: center; padding-top:10px; color:#000; border-radius: 5px; font-size: 22px; "> 
@if($type == 2)
                 Today will get profits Members.
                 @else
Total Members of {{$pack}} Months.
                 @endif
<span  style=" font-size: 14px; padding-left: 160px;">
              
</span>
                  </a>
              </TD>

                  </tr>   

</table>
<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1304"/>
<table  width="1304" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px;position: relative; font-size: 20px;" >
@if($type == 2)
         				
         				 <tr>
                  <th style="">SL No</th>
                   <th style="">ID</th>
                    <th style=""> Name</th>

                    <th style="">Opening Date </th>
                    <th style="">Selected Date </th>
                 
                   <th style="">Package Type</th>
                   <th style="">Saving Ammount</th>
                  <th style="">Profit</th>
                  
                  
                   
                </tr>


        @if(count($allDAta)>0)
        <?php

          $sl = 0;
        ?>
        @foreach($allDAta as $showData)
      @if($showData->date != $selecteddate)
        <?php

          $datetime1 = new DateTime($showData->date);
          $datetime2 = new DateTime($selecteddate);
          $interval = $datetime2->diff($datetime1);
         echo $totalmonth= (($interval->format('%y') * 12) + $interval->format('%m'));

          if($totalmonth%$showData->fk_pack_id === 0){
          $sl ++;

        


        ?>

   <tr>
                  <td style=" padding-left: 10px;">
                    <?php echo $sl;?>
                  </td>
                   <td style=" padding-left: 10px;">{{$showData->id}}</td>
                     <td style="padding-left: 10px;"> {{$showData->mem_name}}</td>

                    <td style=" padding-left: 10px;">

<?php

$explodedate = explode('-', $showData->date);
echo $selecteddate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

?>                    </td>
                     <td style=" padding-left: 10px;"> <?php

$explodedate = explode('-', $selecteddate);
echo $selecteddate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

?>   </td>
                
                   <td style=" padding-left: 10px;"> Per {{$showData->fk_pack_id}} Months Wise Payment</td>
                   <td style=" padding-left: 10px;"> {{number_format($showData->ammount,2)}}</td>
                  <td style=" padding-left: 10px;">



                  {{number_format($showData->profit,2)}} </td>
                  
                  
                   
                </tr>
                 <?php } ?>
                  @endif
                @endforeach
                @endif

                @endif


                
                @if($type == 1) 

                 <tr>
                  <th style="">SL No</th>
                  <th style="">ID</th>
                  <th style=""> Name</th>
                  <th style=""> Mobile No</th>
                  <th style=""> Address</th>
                  <th style="">Opening Date </th>
                  <th style="">Saving Ammount</th>
                  <th style="">Profit</th>
                  
                  
                   
                </tr>
                @if(count( $allDAta ) > 0)
                <?php 
                  $sl = 0;
                ?>
                @foreach( $allDAta  as $showdata)
                 <?php 
                  $sl ++;
                ?>
                <tr>
                 <td><?= $sl ?></td>
                <td style=" padding-left: 10px;">{{$showdata->id}}</td>
                     <td style="padding-left: 10px;"> {{$showdata->mem_name}}</td>
                 <td>{{$showdata->con_no }}</td>
                 <td>{{$showdata->pre_add }}</td>
                <td style=" padding-left: 10px;"> <?php

$explodedate = explode('-', $showdata->date);
echo $selecteddate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

?>   </td>
                  <td style=" padding-left: 10px;"> {{number_format($showdata->ammount,2)}}</td>
                  <td style=" padding-left: 10px;"> {{number_format($showdata->profit,2)}} </td>
                   
                </tr>
                @endforeach
                @endif
                @endif

         
                   
                    

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
