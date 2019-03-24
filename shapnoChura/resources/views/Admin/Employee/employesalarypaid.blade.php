<table width="1145" border="1" cellpadding="0" cellspacing="0" style="margin-left: 10px;">
  <tr>
    <td width="1141" height="174">
 <img style="width: 1145px; height: 217px;" src="{{URL::to('/')}}/public/imageHeader/13.png">    </td>
  </tr>
  <tr>
    <td>
<table width="1146" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td style="text-align: center;">
 <span><h2><br>Salary Sheet</h2></span>   </td>
  </tr>
  <tr>
    <td>	
	
	<table width="1146" border="0" cellpadding="0" cellspacing="0" style="font-size:18px;">
      <tr>
        <td width="105" height="38"><span style="padding-left:10px;"> ID No. </span></td>
        <td width="16" align="center">:</td>
        <td width="434">&nbsp;<span style="padding-left:10px;">{{$employeinfo[0]->id}} </span></td>
        <td width="129"><span style="padding-left:10px;"> Name</span> </td>
        <td width="20" align="center">:</td>
        <td width="428">&nbsp;<span style="padding-left:10px;">{{$employeinfo[0]->Name}} </span></td>
      </tr>
      <tr>
        <td height="46"><span style="padding-left:10px;"> Father Name</span> </td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;">{{$employeinfo[0]->fatherName}} </span></td>
        <td><span style="padding-left:10px;"> Mother Name </span></td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;"> {{$employeinfo[0]->MotherName}}</span></td>
      </tr>
      <tr>
        <td height="32"><span style="padding-left:10px;"> Contact No</span> </td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;"> {{$employeinfo[0]->contactNo}}</span></td>
        <td><span style="padding-left:10px;"> Email </span></td>
        <td align="center">:</td>
        <td>&nbsp;<span style="padding-left:10px;">{{$employeinfo[0]->email}} </span></td>
      </tr>
    </table></td>
	
	
  </tr>
  
  <tr>
    <td>
	
	
	<table width="1149" border="1" cellpadding="0" cellspacing="0" style="font-size:18px;">
    <tr>
        <td width="142" height="38" align="center"><span style="padding-left:10px;"> SL. No. </span></td>
        <td width="631" align="center">Details</td>
        <td width="368" align="center">Taka</td>
  </tr>
    
@if(count($session_emp_title) >0)
<?php $sl = 0; ?>
@foreach($session_emp_title as $showData)
<?php $sl++; ?>
     <tr>
        <td height="46"><span style="padding-left:10px;"> <?= $sl;?> </span> </td>
        <td><span style="padding-left:10px;">
          

  @if(count($salarytitle)>0)
@foreach($salarytitle  as $showsaltitle)
      @if($showsaltitle->id == $showData->fk_title_id)

            {{$showsaltitle->titel}}
      @endif

  @endforeach
  @endif


                      @if($showData->fk_title_id =='Salary')
                               {{'Salary'}}
                      @endif

        </span></td>
        <td>&nbsp;<span style="padding-left:10px;">{{$showData->ammount}}</span></td>
    </tr>
    @endforeach

       <tr>
       
        <td colspan="2" align="right"><span style="padding-left:10px;">
      Total   : &nbsp;&nbsp;&nbsp;</span>
      </td>
       <td colspan="2"><span style="padding-left:10px;">
      {{ $emp_salary_collection[0]->paid_ammount}}  </span>
      </td>
    </tr>

 @endif

     
    
     
    </table></td>
	
	
  </tr></table>
</table>

