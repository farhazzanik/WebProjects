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
                          <img style="width: 100%;" src="{{URL::to('/')}}/public/imageHeader/{{$data[0]->fk_brance_id}}.png">

                      </span></td>

                  </tr>   

</table>






<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center'><a href="#" style="text-decoration: none; height: 38px;   color: black; text-align: center; padding-top:10px;  border-radius: 5px; font-size: 18px; "> 

                  @if($type == '1') Saving @else Invest @endif      Member's Mobile  List - @if($type == '1') {{$data[0]->name}} @else

                        @if($data[0]->name ==='5')
                Daily                 @endif
                @if($data[0]->name ==='1')
   Weekly                  @endif
                @if($data[0]->name ==='2')
   Monthly
                
                @endif

                @if($data[0]->name ==='3')
Yearly                @endif
                @if($data[0]->name ==='4')
   General
                @endif
                @endif

                      <br/>{{$data[0]->bbane}}
</span>
                  </a>
                                  </TD>

                  </tr>   

</table>

<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1101"/>

<table width="1101" border="1" cellpadding="0" cellspacing="0" style="font-size:20px;margin-top:-650px; position: relative; float:left; margin-left:10px; margin-bottom:10px; ">
  <tr>
    <td width="53" height="38" align="center">Sl. No </td>
    <td width="240" align="center">Name</td>
    <td width="217" align="center">Account No</td>
    <td width="248" align="center">Mobile No</td>
    <td width="331" align="center">Address </td>
  </tr>



@if($type == '1')
  @if(count($data) > 0)
  <?php
$sl = 0;

  ?>
  @foreach($data  as $showData)
  <?php
    $sl++;
  ?>
  <tr>
    <td>&nbsp;<?php echo $sl;?>   </td>
    <td>&nbsp;{{$showData->mem_name}}</td>
    <td>&nbsp;{{$showData->Addid}}</td>
    <td>&nbsp;{{$showData->con_no}}</td>
    <td>&nbsp;{{$showData->perma_add}}</td>
  </tr>
 
 @endforeach
 @endif

 @else
  @if(count($data) > 0)
  <?php
$sl = 0;

  ?>
  @foreach($data  as $showData)
  <?php
    $sl++;
  ?>
  <tr>
    <td>&nbsp;<?php echo $sl;?>   </td>
    <td>&nbsp;{{$showData->mem_name}}</td>
    <td>&nbsp;{{$showData->invid}}</td>
    <td>&nbsp;{{$showData->con_no}}</td>
    <td>&nbsp;{{$showData->perma_add}}</td>
  </tr>
 
 @endforeach
 @endif

 @endif
 
</table>
</div>
</div>
<script src="{{asset('public/custom_js/printThis.js')}}"></script>
<script type="text/javascript">
    function printPage(id){
        $('#'+id).printThis();
    }
</script>