  @if(count($discountpro) >0 )
      @foreach($discountpro as $show)
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 10px;">

      <div class="imga">
  <img src="{{URL::to('/')}}/public/pro/{{$show->id}}.jpg"  class="images" style="height: 180px;">
  <div class="overlay">
    <div class="text"><a href="{{URL::To('restuarantview')}}/{{$show->res_id}}" style="text-decoration: none; background: orange; padding: 4px; font-family: times; font-size:14px; color: #fff; font-weight: bold;"> {{$show->pro_name	}}  {{$show->discount	}}% discount</a></div>
  </div>
</div>


</div>
@endforeach
  <center>{{$discountpro->links() }}</center>
@endif