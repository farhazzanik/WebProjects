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



<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 1217px; height: 217px;" src="{{URL::to('/')}}/public/imageHeader/{{$data[0]->fk_brance_id}}.png">

                      </span></td>

                  </tr>   

</table>


<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
         					<TD align='center'><a href="#" style="text-decoration: none; height: 38px; width: 250px; background-color: #000; display: block; text-align: center; padding-top:10px; color:#fff; border-radius: 5px; font-size: 18px; "> 

                        @if($Title=='1')
                           Income
                        @else
                        Expense
                        @endif
                         Report
<span  style=" font-size: 14px; padding-left: 190px;">@if($Type==='5')
                (Daily)                 @endif
                @if($Type==='1')
   (Weekly)                  @endif
                @if($Type==='2')
   (Monthly)
                
                @endif

                @if($Type==='3')
(Yearly)                @endif
                @if($Type==='4')
   (General)
                @endif
</span>
       
         					</a>
																	</TD>

           				</tr>   

</table>

<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >
             
      <tr>
          @if($date != "")
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;">Date :&nbsp;&nbsp;{{$date}} </span></td>
          @endif

            @if($month != "")
            <td><span  style=" font-size: 18px; font-weight: bold; padding-left: 50px;">Date :&nbsp;&nbsp;@if($month ==='01')
                (January)                 @endif
                @if($month ==='02')
   (February)                  @endif
                @if($month ==='03')
   (March)


                
                @endif

                @if($month ==='04')
(April)                @endif
                @if($month ==='05')
   (May)
                @endif
                  @if($month ==='06')
(June)                @endif
                @if($month ==='07')
   (July)
                @endif
                  @if($month ==='08')
(August)                @endif
  @if($month ==='09')
(September)                @endif
                @if($month ==='10')
   (October)
                @endif
                  @if($month ==='08')
(November)                @endif

 @if($month ==='10')
(December)                @endif </span></td>
            @endif

  @if($year != "")

              <td align="right"><span  style=" font-size: 18px; font-weight: bold; ">Year :&nbsp;&nbsp;{{$year}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                @endif

      </tr>
</table>
<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1217"/>
<table width="1217" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; position: relative;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
         					

         						<td width="30">Serial NO</td>
         					    <td width="60">Date</td>
                  	<td width="211">Title</td>
         						<td width="93">Ammount</td>
         					
         				
         						<td width="139">Comments</td>
           				</tr>   

               
                    @if(count($data) >0 )
                    <?php
                      $sl = 0;
                      ?>
                    @foreach($data as $showDAta)
          <?php
                      $sl++;
                      ?>
          <tr style="padding-left: 10px; font-weight: bold;">
                        

                           <td width="30" style="padding-left: 10px;"><?php echo $sl;?></td>
                        <td width="60" style="padding-left: 10px;"><?php

                            $daex = explode('-', $showDAta->date);
                            echo $daex[2].'-'.$daex[1].'-'.$daex[0];
                        ?></td>
                           <td width="100" style="padding-left: 10px;">{{$showDAta->title}}</td>
                      
                            <td width="54" style="padding-left: 10px;">
 {{number_format($showDAta->ammount,2)}}
                            </td>
                            <td width="54" style="padding-left: 10px;">{{$showDAta->comments}}</td>
                     </tr>   
                     @endforeach
                 
                     <tr style="padding-left: 10px; font-weight: bold;">
                        

                         <td align="right" colspan="3" >Total :</td>
                          <td colspan="2" style="padding-left: 10px; font-weight: bold;">
                            

                            {{$total}}
                          </td>
                          
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

</body>
</html>
