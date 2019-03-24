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
<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

                
                <tr style=" font-weight: bold;">
                      <td align="center"><span style="font-size: 28px; font-family:Nueva Std; ">
                          @if($id->id == '306' or $id->fk_brance_id =='1')
                          <img style="width: 100%;" src="{{URL::to('/')}}/public/imageHeader/14.png">
                          @else
 <img style="width: 1304px; height: 217px;" src="{{URL::to('/')}}/public/imageHeader/{{$brancedata[0]->fk_brance_Id}}.png">

                          @endif
                      </span></td>

                  </tr>   

</table>


<table width="1304" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:30px;" >

                
                <tr style="text-align: center; font-weight: bold;">
                  <TD align='center'><a href="#" style="text-decoration: none; height: 38px; display: block; text-align: center; padding-top:10px; color:#000; border-radius: 5px; font-size: 22px; "> 

                  Collection Sheet<br/>
                  {{$brancedata[0]->name}} - {{$brancedata[0]->area_name}}

                  </a>
              </TD>

                  </tr>   

</table>
<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1304"/>
<table width="1304" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px;position: relative; font-size: 20px;" >

         				
         				 <tr>
                  <th style="height:30px; width:50px;">SL No</th>
                  <th style="width:300px;"> Name</th>
                   <th style="width:250px;">Invest Account No</th>
                  <th style="width:170px;">Invest Ammount</th>
                   <th style="width:200px;">Saving Account No</th>
                   <th style="width:170px;">Saving Ammount</th>
                    <th>Total</th>
                </tr>



                       
              @if(count($brancedata) > 0)
              <?php
                $sl = 0;
              ?>
              @foreach($brancedata as $showData)
              <?php 
                $sl++;
                  $explodeaddod = explode('-', $showData->Addid);
                         
              ?>
               <tr class="gradeX" id="tr">
                  <td align="center" style="height:30px;" ><?php echo $sl;?></td>
                  <td> &nbsp;&nbsp;&nbsp;{{$showData->mem_name}}</td>
                  <td>@if(count($ivestdata) > 0)
                        @foreach($ivestdata as $showinv)
   <?php
                            $explode = explode('-', $showinv->id);
                             $substr =  substr($explode[2], 0,4 );
                            $explodeaddod[2];
                        ?>
                       @if($substr === $explodeaddod[2])

                          &nbsp;&nbsp;&nbsp;  {{$showinv->id}}<br/>
                        @endif
                        @endforeach
                        @endif</td>
                  <td>&nbsp;&nbsp;&nbsp;
                     
                  </td>

                 <td>&nbsp;&nbsp;&nbsp;{{$showData->Addid}}</td>
                   <TD></TD>
                   <TD></TD>
                </tr>
               
                @endforeach
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
