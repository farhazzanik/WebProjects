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


 @if(count($collection) > 0) 
<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 1304px; height: 217px;" src="{{URL::to('/')}}/public/imageHeader/{{$collection[0]->fk_brance_id}}.png">

                      </span></td>

                  </tr>   

</table>
 
<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="float:left; margin-left:10px; margin-bottom:10px;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
         					<TD align='center'><a href="#" style="text-decoration: none; height: 38px; width: 250px; background-color: #000; display: block; text-align: center; padding-top:10px; color:#fff; border-radius: 5px; font-size: 18px; "> 

                   Savings Profit Report <br/>

<span  style=" font-size: 14px; padding-left:10px;">

 FROM {{$frstdate}} TO  {{$sndate}}
                
</span>
         					</a>
						  </TD>

           				</tr>   

</table>

 
<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;  margin-top:0px; background:none; position:relative;" >
             
      <tr>
          
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;">Name : {{$collection[0]->mem_name}} </span></td>

              <td align="right"><span  style=" font-size: 18px; font-weight: bold; ">Account : {{$collection[0]->mem_add_id}}</span></td>
      </tr>
</table>


<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1304"/>
<table width="1304" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; position: relative; " >
 
         				
         				<tr align="center" style="text-align: center; font-weight: bold; text-align: center;">
         					

         						<td width="92">Date</td>
         						<td width="260">Last Ammount</td>
         						<td width="181">Rate</td>
         						<td width="223">Profit</td>
         					
                    <td width="202"> </td>
         					
         						
           				</tr>  
                  <?php 
                  $profitsum = 0;
                  foreach($alldata as $date){ ?>
                  <tr>
                    <td width="92" align="center">

<?php
 $dates = explode('-', $date->date);
                                print $printdate =$dates[2].'-'.$dates[1].'-'.$dates[0];
?>

                    </td>
                    <td width="260" align="center"> {{number_format($date->lastammount,2)}} </td>
                    <td width="181" align="center">{{$date->rate}}</td>
                    <td width="223" align="center">{{number_format($date->profits,2)}}
                      <?php  $profitsum =  $profitsum+$date->profits; ?> </td>
                    <td width="105" align="center"></td>
                   
                  </tr>
                  <?php } ?>


                      
<tr align="center" style="text-align: center; font-weight: bold; text-align: center;">
                  

                    <td width="92"></td>
                    <td width="260"></td>
                    <td width="181">Total &nbsp;-</td>
                    <td width="223"><?php echo  number_format($profitsum,2); ?></td>
                  
                    <td width="202"> </td>
                  
                    
                  </tr>  
                   
                    

</table>

                  @else
  <tr style="text-align: center; font-weight: bold;">
                  

                    <td width="92">Data Not Found..</td>
                
                    
                  </tr>  

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
