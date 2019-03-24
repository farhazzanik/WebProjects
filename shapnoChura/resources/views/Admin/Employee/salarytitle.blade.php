
@if(count($data)>0)
@foreach($data  as $showDAta)

  <tr class="gradeX" id="tr-{{$showDAta->id}}">
                  <td>{{$showDAta->Data}}</td>
                  <td>{{$showDAta->Name}}</td>
                  <td>{{$showDAta->year}}</td>
                  <td>

     
                    @if($showDAta->month ==='01')
                (January)                 @endif
                @if($showDAta->month ==='02')
   (February)                  @endif
                @if($showDAta->month ==='03')
   (March)


                
                @endif

                @if($showDAta->month ==='04')
(April)                @endif
                @if($showDAta->month ==='05')
   (May)
                @endif
                  @if($showDAta->month ==='06')
(June)                @endif
                @if($showDAta->month ==='07')
   (July)
                @endif
                  @if($showDAta->month ==='08')
(August)                @endif
  @if($showDAta->month ==='09')
(September)                @endif
                @if($showDAta->month ==='10')
   (October)
                @endif
                  @if($showDAta->month ==='08')
(November)                @endif

 @if($showDAta->month ==='10')
(December)                @endif


                  </td>

                  <td>

	@if(count($salarytitle)>0)
@foreach($salarytitle  as $showsaltitle)
			@if($showsaltitle->id == $showDAta->fk_title_id)

						{{$showsaltitle->titel}}
			@endif

  @endforeach
  @endif


                  		@if($showDAta->fk_title_id =='Salary')
                               {{'Salary'}}
                  		@endif
                  </td>
                  <td>{{$showDAta->ammount}}</td>

              <td class="center">

                    <div class="fr"> 
               
                    <a class="btn btn-danger btn-mini" onclick="delesessiondata('{{$showDAta->id}}'),selectALL()" >
                      Delete</a></div></td>
               
               
   </tr>
   @endforeach

    <tr class="gradeX" id="tr-">
                 
                 
				 <td colspan="5" style="text-align: right;"><strong>Total :</strong> </td>
                 <td colspan="2"><input type="text" name="totalammout" id="totalammout" value="{{$totalammount}}" class="span6" readonly=""></td>
				
               
               
   </tr>
     <tr class="gradeX" id="tr-">
                 
                 
				 <td colspan="5" style="text-align: right;"><strong>Paid Ammount :</strong> </td>
                 <td colspan="2">
                 	

                 	<input type="text" name="paidammount" id="paidammount" class="span6">
                 	<strong style="color: red">Due Not Acceptable</strong>


                 </td>
				
               
               
   </tr>

     <tr class="gradeX" id="tr-">
                 
                 
				
                 <td colspan="7" align="right">
                 	

                 	<input type="submit" name="savedatasalcoll" id="paidammount" value="Submit"  class="btn btn-success">


                 </td>
				
               
               
   </tr>
  @endif

