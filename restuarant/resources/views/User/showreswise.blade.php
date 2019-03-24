
	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom: 2px black solid">
        <p style="font-size: 18px; color: black; text-align: center; font-weight: bold;">{{$itemname[0]->item_name}}</p>
      </div>
        @if(count($itewisepro) > 0)
        @foreach($itewisepro as $showpro)
         
         
         
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-xs-8" id="innerdiv"><li id="midsidelist">{{$showpro->pro_name}}</li>
            <p id="text-{{$showpro->id}}" style="text-align: justify; color: #707070; font-size: 12px;">
{{  $smalltext=substr(strip_tags($showpro->details), 0, 50) }}
       
        @if( strlen(strip_tags($showpro->details)) > 50)
          <a  onclick="showmoretext('{{$showpro->id}}','{{$showpro->details}}','{{$smalltext}}')" style="text-decoration: none; color: green; cursor: pointer;">...Show More</a>

        @endif

            </p></div>
           <div class="col-xs-4" id="innerdiv" style="text-align: right;"><li id="midsidelist"> {{$showpro->price - $showpro->discount}}  Tk  <img  onclick="return addcart('{{$showpro->item_id}}','{{$showpro->id}}','{{$resid}}')" src="{{URL::to('/')}}/public/frontend/img/plus.png" style="cursor: pointer;">  </li></div>
       </div>
      
       @endforeach
       @endif


