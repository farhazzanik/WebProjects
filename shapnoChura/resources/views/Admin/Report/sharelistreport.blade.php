
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

                  Share     Member's - @if($type=='1') 100 TK Package @else 500Tk Package @endif

                      <br/>  
</span>
                  </a>
                                  </TD>

                  </tr>   

</table>
 <table class="table" style="width:1300;margin-left: 10px; border:1px solid #999;margin-bottom: 10px">
<tr>
  <td style="width: 50%;border-right: 1px solid #999">
    <table class="table" style="font-size: 20px;">
      <tr>
        <td>
          Period : {{$first}} To {{$seconddate}}<br>
          Brance Name : {{$data[0]->bbane}}<br>

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
          <!-- Print Time : {{date('h:i:s')}} -->
        </td>
      </tr>
    </table>
  </td>
</tr>
</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1101"/>

<table width="1300" border="1" cellpadding="0" cellspacing="0" style="font-size:18px;margin-top:-650px; position: relative; float:left; margin-left:10px; margin-bottom:10px; ">
  <tr>
    <td width="" height="38" align="center">Sl. No </td>
    <td width="" align="center">Date</td>
    <td width="" align="center">Name</td>
    <td width="" align="center">Member ID</td>
    <td width="" align="center">Package</td>
    <td width="" align="center">Share No</td>
    <td width="" align="center">Mobile No</td>
    <td width="" align="center">Share Ammount </td>
    <td width="" align="center">Share Withdraw </td>
    <td width="" align="center">Grand Total</td>
    <td width="" align="center">Details</td>
  </tr>



  @if(count($data) > 0)
  <?php
$sl = 1;
$total = 0;
$with = 0;
$gndtotal = 0;
   
  ?>
  @foreach($data  as $showData)
  @php
   $explode = explode('-', $showData->date);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];
  @endphp
  @if(count($showData->ammount) > 0)
  <tr>
    <td>&nbsp;<?php echo $sl++;?>   </td>
    <td>&nbsp;{{$renewdate}}</td>
    <td>&nbsp;{{$showData->mem_name}}</td>
    <td>&nbsp;{{$showData->fk_mem_id}}</td>
    @if($showData->package == '1')
    <td>
      &nbsp;100 TK
    </td>
    @else
    <td>
      &nbsp;500 Tk
    </td>
    @endif
    <td>&nbsp;{{$showData->sharenumber}}</td>
    <td>&nbsp;{{$showData->con_no}}</td>
    
    <td>&nbsp;{{number_format($showData->tammount ,2)}}
      <?php
$total = $total+$showData->tammount;
      ?>
    </td>

    <td>
      <?php 
      $d = 0;
      ?>
@foreach($withs as $w)
    @if($w->fk_mem_id == $showData->fk_mem_id)
&nbsp;{{number_format($w->tsharewithdraw,2)}}
<?php
$with = $with+$w->tsharewithdraw;
$d = $w->tsharewithdraw;
      ?>

    @endif
    @endforeach
    </td>

   <td>


    &nbsp;{{number_format($showData->tammount - $d,2)}}

      <?php
      $gndtotal = $gndtotal+$showData->tammount - $d;
            ?>
    </td> 



    <td>&nbsp;{{$showData->details}}</td>
  </tr>
 @endif
 @endforeach
 @endif

  <tr>
   
    <td  align="right" colspan="7">&nbsp;<b> Total- </b>&nbsp;&nbsp;&nbsp;</td>
    <th>&nbsp;&nbsp; {{number_format($total,2)}}</th>
    <th>&nbsp;&nbsp; {{number_format($with,2)}}</th>
    <th>&nbsp;&nbsp; {{number_format($gndtotal,2)}}</th>
    <th>&nbsp;&nbsp; </th>
  </tr>
 
</table>
</div>
<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>