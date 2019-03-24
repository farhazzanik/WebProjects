 <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>SL Name</th>
                  <th>Member  Name</th>
                   <th>Share Ammount</th>
                 
                    <th>Retrurn </th>
                </tr>
              </thead>
              

              <tbody id="tbodydata">
            @if(count($data) > 0)
            <?php $sl = 0 ;?>
            @foreach($data as $showdata)
            <?php $sl++;?>
                <tr>
                  <td> <?php echo $sl++;?></td>
                  <td>{{$showdata->mem_name}}</td>
                  <td>{{number_format($showdata->ammount,2)}} </td>
                  <td>  <a class="btn btn-danger btn-mini" onclick="deteDate('{{$showdata->id}}')" >
                      Return</a></td>
                </tr>
                @endforeach
                @endif
           </tbody>
            </table>
          </div>