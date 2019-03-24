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

<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          <img style="width: 1400px;" src="{{URL::to('/')}}/public/imageHeader/{{$data[0]->fk_brance_id}}.png">

                      </span></td>

                  </tr>   

</table>


<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
         					<TD align='center'><a href="#" style="text-decoration: none; height: 38px;   color: black; text-align: center; padding-top:10px;  border-radius: 5px; font-size: 22px; "> 

                        @if($typereq=='1')
                           Saving  
                        @else
                        Invest
                        @endif
                         Register<br/>
                          {{$data[0]->name}}
                         <br/>    @if($area =='All')
  ALL
  @else {{$data[0]->area_name}} @endif

<span  style=" font-size: 14px; "> -


@if($typereq=='1')
 {{$data[0]->packname}}
@else
 @if($data[0]->type ==='5')
                Daily                 @endif
                @if($data[0]->type ==='1')
   Weekly                  @endif
                @if($data[0]->type ==='2')
   Monthly
                
                @endif

                @if($data[0]->type ==='3')
Yearly                @endif
                @if($data[0]->type ==='4')
   General
                @endif

@endif


</span>
         					</a>
																	</TD>

           				</tr>   

</table>


<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1400"/>
<table width="1400" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; font-size: 18px; position: relative;" >
@if($typereq=='1')
         				
         				<tr style="text-align: center; font-weight: bold;">
         					

         						<td >SL NO</td>
         						<td >Name</td>
         						<td >Address</td>
         						<td > Saving   Account No</td>
         						<td > Saving  Opening  date</td>
         						<td > Saving  Amount</td>
         						<td >Total with profits</td>
         						<td >Number of installments</td>
         						<td >Ammount of installments</td>
         						<td >Expiration date</td>
                      <td >Mobile No</td>
         						<td >Closing Date</td>

                    <td >Comments</td>
                    
           				</tr>   

                     @if(count($data)>0)
                    <?php $sl=0;?>
                     @foreach($data as $showData)
                  <?php $sl++;?>
                     <tr style="padding-left: 10px; font-weight: bold;">
                        

                           <td style="padding-left: 10px;"><?php echo $sl; ?></td>
                           <td   width="500"  style="padding-left: 10px;">{{$showData->mem_name}}</td>
                           <td  width="500" style="padding-left: 10px;">{{$showData->perma_add}}</td>
                           <td  width="500" style="padding-left: 10px;"> {{$showData->Addid}}</td>

                           <td   width="300"  style="padding-left: 10px;"> {{$showData->todaydate}}</td>

                           <td  style="padding-left: 10px;" align="right"> 

                            @if($data[0]->packname !='MGDS'){{number_format($showData->amount,2)}}

                            @endif
                           &nbsp;</td>
                           <td  style="padding-left: 10px;" align="right">
                             @if($data[0]->packname !='MGDS') {{number_format($showData->Periodic,2)}} @endif&nbsp;</td>
                           <td   style="padding-left: 10px;"> @if($data[0]->packname !='MGDS'){{$showData->insNumb}}@endif</td>
                           <td   style="padding-left: 10px;" align="right"> @if($data[0]->packname !='MGDS'){{number_format($showData->amount,2)}}@endif&nbsp;</td>
                           <td     width="300" style="padding-left: 10px;"> @if($data[0]->packname !='MGDS'){{$showData->Date}}@endif</td>
                              <td  style="padding-left: 10px;">{{$showData->con_no}}</td>
                           <td   style="padding-left: 10px;"></td>
                     
                           <td width="139" style="padding-left: 10px;">{{$showData->comment}}</td>
                           </tr>   
                     @endforeach
                     @endif

                     @else

<tr style="text-align: center; font-weight: bold;">
                        

                           <td>SL.</td>
                           <td>Name</td>
                           <td>Address</td>
                           <td > Investment  Account No</td>
                           <td> Investment  Opening Date</td>
                           <td> Investment  Amount</td>
                           <td>Total with profits</td>
                           <td >Number of installments</td>
                           <td >Ammount of installments</td>
                           <td>Expiration Date</td>
                            <td >Mobile No</td>
                            <td >Closing Date</td>
                    
                           <td width="139">Comments</td>
                     </tr>   

                     @if(count($data)>0)
                    <?php $sl=0;?>
                     @foreach($data as $showData)
                  <?php $sl++;?>
                     <tr style="padding-left: 10px; font-weight: bold;">
                        

                         <td style="padding-left: 10px;"><?php echo $sl; ?></td>
                           <td width="800"  style="padding-left: 10px;">{{$showData->mem_name}}</td>
                           <td  style="padding-left: 10px;">{{$showData->permanentAdd}}</td>
                           <td  width="950" style="padding-left: 10px;"> <?php echo $showData->invid;?></td>
                           <td  width="300" style="padding-left: 10px;"> {{$showData->appDate}}</td>
                           <td  style="padding-left: 10px;" align="right"> {{number_format($showData->invesQuanT,2)}}</td>
                           <td style="padding-left: 10px;" align="right">{{number_format($showData->profits,2)}}</td>
                           <td  style="padding-left: 10px;">{{$showData->instalNO}}</td>
                           <td  style="padding-left: 10px;" align="right">{{number_format($showData->instalAmm,2)}}</td>
                           <td  width="300" style="padding-left: 10px;">{{$showData->expireDate}}</td>
                           <td  style="padding-left: 10px;">{{$showData->con_no}}</td>
                           <td  style="padding-left: 10px;"></td>
                           <td  style="padding-left: 10px;">{{$showData->comments}}</td>
                           
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
