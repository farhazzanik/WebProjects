<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/Dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="#"> <i class="icon-dashboard"></i>  My Dashboard </a> </li>
       
        <li class="bg_ly"> <a href="#"> <i class="icon-user"></i> My Profile</a> </li>
       

       <!--  <li class="bg_lo"> <a href="tables.html"> <i class="icon-th"></i> Tables</a> </li>
        <li class="bg_ls"> <a href="grid.html"> <i class="icon-fullscreen"></i> Full width</a> </li>
        <li class="bg_lo span3"> <a href="form-common.html"> <i class="icon-th-list"></i> Forms</a> </li>
        <li class="bg_ls"> <a href="buttons.html"> <i class="icon-tint"></i> Buttons</a> </li>
        <li class="bg_lb"> <a href="interface.html"> <i class="icon-pencil"></i>Elements</a> </li>
        <li class="bg_lg"> <a href="calendar.html"> <i class="icon-calendar"></i> Calendar</a> </li>
        <li class="bg_lr"> <a href="error404.html"> <i class="icon-info-sign"></i> Error</a> </li>
 -->
      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
          <h5>Site Analytics</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            
            <div class="span6">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totaladmin}}</strong> <small>Total Admin</small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totalemp}}</strong> <small>Total Employee </small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totalactadmin}}</strong> <small>Active Admin</small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totaldecadmin}}</strong> <small>Deactive Admin</small></li>
                <li class="bg_lh"> <strong>{{$totalbrance}}</strong> <small>Total  Brance</small></li>
                <li class="bg_lh"><strong>{{$totalarea}}</strong> <small>Total Area</small></li>
              </ul>
            </div>

     <div class="span6">
              <ul class="site-stats">
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totalmem}}</strong> <small>Total Members</small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totalactmem}}</strong> <small>Active Members </small></li>
                <li class="bg_lh"><i class="icon-user"></i> <strong>{{$totaldeactmem}}</strong> <small>Deactive Members</small></li>

               
              </ul>
            </div>


          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
    <hr/>
   


  </div>