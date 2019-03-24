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
                          <img style="width: 1217px; height: 217px;" src="{{URL::to('/')}}/public/imageHeader/{{$branceid}}.png">

                      </span></td>

                  </tr>   

</table>


<table width="1217" border="0"  cellpadding="0" cellspacing="0" style="margin-top:0px; float:left; margin-left:10px; margin-bottom:10px;" >

         				
         				<tr style="text-align: center; font-weight: bold;">
         					<td align='center'>
                    <a href="#" style="text-decoration: none; height: 38px;   color: black; text-align: center; padding-top:10px;  border-radius: 5px; font-size: 18px;"> 

                        @if($type=='1')
                           All Members
                        @elseif($type=='2')
                        Saving Members
                        @else
                          Invest Members
                         @endif
                         
<span  style=" font-size: 14px;">
  @if($activelist ==='1')
                <br>(Active)                
                @else
                (Inactive)
                @endif

</span>
         					</a>
																	</TD>

           				</tr>   

</table>


<img src="{{URL::to('/')}}/public/imageHeader/background.png"  height="650" width="1217"/>
<table width="1217" border="1"  cellpadding="0" cellspacing="0" style="margin-top:-650px; float:left; margin-left:10px; position: relative;" >
@if($type=='1')
         				
         				<tr style="text-align: center; font-weight: bold;">
         					

         						<td width="54">ID</td>
         						<td width="211">Name</td>
         						<td width="93">Father Name</td>
         						<td width="102">Mother Name</td>
         						<td width="107"> Occupation</td>
                    <td width="139">Contact No</td>
         						<td width="100"> Address</td>
         					
         						
           				</tr>   

                     @if(count($data)>0)
                    <?php $sl=0;?>
                     @foreach($data as $showData)
                  <?php $sl++;?>
                     <tr style="padding-left: 10px; font-weight: bold;">
                        

                           <td width="54" style="padding-left: 10px;">{{$showData->id}}</td>
                           <td width="211" style="padding-left: 10px;">{{$showData->mem_name}}</td>
                           <td width="93" style="padding-left: 10px;">{{$showData->father_name}}</td>
                           <td width="102" style="padding-left: 10px;"> {{$showData->mother_name}}</td>
                           <td width="107" style="padding-left: 10px;"> {{$showData->occupation}}</td>
                          
                           <td width="139" style="padding-left: 10px;">{{$showData->con_no}}</td>
                                  <td width="139" style="padding-left: 10px;">{{$showData->perma_add}}</td>
                     </tr>   
                     @endforeach
                     @endif

                     @elseif($type=='2')


                <tr style="text-align: center; font-weight: bold;">
                  

                    <td width="54">ID</td>
                    <td width="211">Name</td>
                     <td width="102">Package Name</td>
                    <td width="93">Father Name</td>
                    <td width="102">Mother Name</td>
                    <td width="107"> Occupation</td>
                    <td width="139"> Contact No</td>
                    <td width="100"> Address</td>
                  
                    
                  </tr>   

  @if(count($data)>0)
                    <?php $sl=0;?>
                     @foreach($data as $showData)
                  <?php $sl++;?>
                     <tr style="padding-left: 10px; font-weight: bold;">
                        

                           <td width="54" style="padding-left: 10px;">{{$showData->Addid}}</td>
                           <td width="211" style="padding-left: 10px;">{{$showData->mem_name}}</td>
                               <td width="93" style="padding-left: 10px;">{{$showData->packname}}</td>
                           <td width="93" style="padding-left: 10px;">{{$showData->father_name}}</td>
                           <td width="102" style="padding-left: 10px;"> {{$showData->mother_name}}</td>
                           <td width="107" style="padding-left: 10px;"> {{$showData->occupation}}</td>
                           <td width="139" style="padding-left: 10px;">{{$showData->con_no}}</td>
                           <td width="139" style="padding-left: 10px;">{{$showData->perma_add}}</td>
                     </tr>   
                     @endforeach
                     @endif

                     @else


                <tr style="text-align: center; font-weight: bold;">
                  

                    <td width="54">ID</td>
                    <td width="211">Name</td>
       
                    <td width="93">Father Name</td>
                    <td width="102">Mother Name</td>
                    <td width="107"> Occupation</td>
                    <td width="139"> Contact No</td>
                    <td width="100"> Address</td>
                  
                    
                  </tr>   

  @if(count($data)>0)
                    <?php $sl=0;?>
                     @foreach($data as $showData)
                  <?php $sl++;?>
                     <tr style="padding-left: 10px; font-weight: bold;">
                        

                           <td width="54" style="padding-left: 10px;">{{$showData->invid}}</td>
                           <td width="211" style="padding-left: 10px;">{{$showData->mem_name}}</td>
                         
                           <td width="93" style="padding-left: 10px;">{{$showData->father_name}}</td>
                           <td width="102" style="padding-left: 10px;"> {{$showData->mother_name}}</td>
                           <td width="107" style="padding-left: 10px;"> {{$showData->occupation}}</td>
                           <td width="139" style="padding-left: 10px;">{{$showData->con_no}}</td>
                           <td width="139" style="padding-left: 10px;">{{$showData->perma_add}}</td>
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
