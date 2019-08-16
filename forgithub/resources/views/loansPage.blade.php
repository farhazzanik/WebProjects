<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <link rel="stylesheet" href="{{URL::To('/')}}/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::To('/')}}/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  </head>
  <body>
        <div class="container col-lg-12 col-sm-12 ">
            <div class="header top-header col-lg-12">
                    <div class="col-lg-6 col-sm-12 text-center h-left-divs">
                            <span>Klienditeendus</span>
                          &nbsp;&nbsp;  <span><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;+372 53631295</span>&nbsp;&nbsp;
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;E-P 9:30-10:20</span>
                    </div>
                    <div class="col-lg-6 col-sm-12 text-center h-left-div">
                            <span>Hi,Mahfuzul Haque</span>
                           &nbsp;&nbsp; <a href="" style="background-color: orange;color: white; padding: 2px 20px;text-align: center;text-decoration: none;display: inline-block; border-radius: 20%; border: 1px white solid;"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Log Out</a>
                    </div>
            </div>
            <div class="header middle-header col-lg-12 text-center">
                    <ul>
                            <li>Add <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Here <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Random <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Link to our Page <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    </ul>
            </div>


             <div class="header bottom-header col-lg-12 text-left">
                  <ul class="col-lg-offset-2">
                            <li><a href="{{URL::to('jsonFile')}}">Import Data From Json Files..</a></li>
                            <li><a href="{{URL::to('user')}}">Users</a></li>
                            <li><a href="{{URL::to('loans')}}">Loans</a> </li>
                            <li><a href="{{URL::to('checkAge')}}">Check Age</a> </li>
                    </ul>
            </div>

            <div class="midcontent  col-lg-12 " id="tag_container">
                
                    
                    <div class="col-lg-5">
                          
                        <div class="errorDiv" style="margin-top: 5px;"></div>

                        <form action="" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                        <table  cellpadding="0" cellspacing="0" class="table  user-table" border="0">
                                <tr>
                                    <th colspan="2">Loans Information</th>
                                </tr>

                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; "> Select User </td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback">
                                        <select class="form-control userId" >
                                           @if(count($onlyUser) > 0)
                                            @foreach($onlyUser as $show)
                                                <option value="{{ $show->id}}">{{ $show->first_name}} {{ $show->last_name}} </option>
                                            @endforeach
                                          @endif
                                        </select>
                                         <i class="form-control-feedback fa fa-asterisk"></i>
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Ammount</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="text" name="Ammount" class="form-control Ammount" placeholder="Ex: 3000">
                                         <i class="form-control-feedback fa fa-asterisk"></i>
                                        <input type="hidden" name="id" class="form-control id">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Interest</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="text" name="Interest" class="form-control Interest" placeholder="Ex: 3000"> <i class="form-control-feedback fa fa-asterisk"></i></td>
                                </tr>

                                
                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Duration</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="number" name="Duration" class="form-control Duration" placeholder="Ex: 3"> <i class="form-control-feedback fa fa-asterisk"></i></td>
                                </tr>

                                
                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Start Date</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="text" name="StartDate" class="form-control StartDate" placeholder="Ex: 12-02-1997"> <i class="form-control-feedback fa fa-asterisk"></i></td>
                                </tr>

                                
                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">End Date</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="text" name="EndDate" class="form-control EndDate" placeholder="Ex: 12-02-1997"> <i class="form-control-feedback fa fa-asterisk"></i></td>
                                </tr>

                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Campaign</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="number" name="Campaign" class="form-control Campaign" placeholder="Ex: 1"> <i class="form-control-feedback fa fa-asterisk"></i></td>
                                </tr>

                              
                              
                                 <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Status</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback">
                                        <input type="number" name="status"  class="form-control status">  <i class="form-control-feedback fa fa-asterisk"></i>

                                         
                                    </td>
                                </tr>

                                <tr>
                                     <td colspan="2" class="text-right" style="border-left: 1px #cccccc solid; border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">
                                        <button  type="button" id="Submit"  class="Submit"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Submit</button>
                                        <button  type="button" id="reset" class="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>
                                    </td>
                                </tr>
                                   
                        </table>
                    </form>
                    </div>
                    <div class="col-lg-7 tbody" id="loansPaginateDiv">
                                  @include('loansPaginate');
                    </div>
            </div>
                


        </div>

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="{{URL::To('/')}}/public/js/jquery-1.12.4.min.js"></script>
    <script src="{{URL::To('/')}}/public/js/bootstrap.min.js" ></script>

    <script type="text/javascript">
         var UIcontroller = (function(){

            var DOMstring = {
                    userID : '.userId',
                    Ammount:'.Ammount',
                    Interest :'.Interest',
                    Duration:'.Duration',
                    StartDate:'.StartDate',
                    EndDate:'.EndDate',
                    Campaign:'.Campaign',
                    status:'.status',
                    Submit:'.Submit',
                    reset:'.reset',
                    erro_container: '.errorDiv',
                    tbody : '.tbody',
                    id : '.id',
                    nameTxt : '.userName',
                    tableDAta:'.tableDAta'
                
                };

                return {

                        getDomString : function(){
                            return DOMstring;
                        },

                        getInput : function(){
                           return{

                             userID : document.querySelector(DOMstring.userID).value,
                             Ammount:document.querySelector(DOMstring.Ammount).value,
                             Interest:document.querySelector(DOMstring.Interest).value,
                             Duration : document.querySelector(DOMstring.Duration).value,
                             StartDate:document.querySelector(DOMstring.StartDate).value,
                             EndDate:document.querySelector(DOMstring.EndDate).value,
                             Campaign:document.querySelector(DOMstring.Campaign).value,
                             status:document.querySelector(DOMstring.status).value,
                             id:document.querySelector(DOMstring.id).value,

                             
                           }
                        },

                        showMsg:function(sms){

                            if(sms.includes('Successfully')){

                                document.querySelector(DOMstring.erro_container).classList.add('alert');
                                document.querySelector(DOMstring.erro_container).classList.add('alert-success');
                                document.querySelector(DOMstring.erro_container).classList.remove('alert-danger');
                                document.querySelector(DOMstring.erro_container).textContent = sms;
                                
                            }else if(sms.includes('not')){
                                document.querySelector(DOMstring.erro_container).classList.add('alert');
                                document.querySelector(DOMstring.erro_container).classList.remove('alert-success');
                                document.querySelector(DOMstring.erro_container).classList.add('alert-danger');
                                document.querySelector(DOMstring.erro_container).textContent = sms;

                            }else if(sms.includes('Unsuccessfully') || sms.includes('required') ){
                                document.querySelector(DOMstring.erro_container).classList.add('alert');
                                document.querySelector(DOMstring.erro_container).classList.remove('alert-success');
                                document.querySelector(DOMstring.erro_container).classList.add('alert-danger');
                                document.querySelector(DOMstring.erro_container).textContent = sms;

                            }

                    },

                    clearFields:function(){
                         var fields,fieldsArr;
                         fields = document.querySelectorAll(DOMstring.userID+','+DOMstring.Ammount+','+DOMstring.Interest+','+DOMstring.Duration+','+DOMstring.StartDate+','+DOMstring.EndDate+','+DOMstring.Campaign);

                         fieldsArr = Array.prototype.slice.call(fields);

                         fieldsArr.forEach(function(cur,index,array){

                                cur.value = "";
                         });

                        //fieldsArr[0].focus();
                    },

                     deleteItem : function(id){
                    

                        var  self;
                        self = this;
                        

                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                        });
                        
                        $.ajax({
                            type:'post',
                            cache:false,
                            url:window.location.href+'/delete',
                            data:{id:id},
                            dataType: 'json',
                            success:function(result){
                               self.showMsg(result.sms);

                            }
                         });
                       
                    },

                    deleteTr : function(id){
                        var tr;
                        tr = document.getElementById(id);
                        tr.parentNode.removeChild(tr);
                    },

                    displaydataintextfields : function(e,id){
                       //console.log(e);
                       let userID,userName;
                       userName = e.target.parentNode.parentNode.childNodes[1].textContent;
                       userID = e.target.parentNode.parentNode.childNodes[1].id;
                       document.querySelector(DOMstring.userID).insertAdjacentHTML('afterbegin',`<option value="${userID}" selected>${userName}</option>`);
                       document.querySelector(DOMstring.Ammount).value = e.target.parentNode.parentNode.childNodes[3].textContent;
                       document.querySelector(DOMstring.Interest).value = e.target.parentNode.parentNode.childNodes[5].textContent;
                       document.querySelector(DOMstring.Duration).value = e.target.parentNode.parentNode.childNodes[7].textContent;
                       document.querySelector(DOMstring.StartDate).value = e.target.parentNode.parentNode.childNodes[9].textContent;
                       document.querySelector(DOMstring.EndDate).value = e.target.parentNode.parentNode.childNodes[11].textContent;
            
                       document.querySelector(DOMstring.Campaign).value = e.target.parentNode.parentNode.childNodes[13].textContent;
                       document.querySelector(DOMstring.status).value = e.target.parentNode.parentNode.childNodes[15].textContent;
                       document.querySelector(DOMstring.id).value =id;
                       
                    },

                    searchDatabyName : function(value){
                        //console.log(value);
                        var  self;
                        self = this;
                         
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                        });
                        
                        $.ajax({
                            type:'post',
                            cache:false,
                            url:window.location.href+'/serchbyName',
                            data:{value:value},
                            dataType: 'json',
                            success:function(result){
                               self.showDataOntboyd(result);

                            }
                         });
                    }, 
 

                    showDataOntboyd : function(resut){
                      
                          for (i = 0; i< resut.length; i++) {
                            var  showData =  resut[i];
                            for (var i in showData) {
                              document.querySelector(DOMstring.tableDAta).innerHTML=
                              `<tr id="${showData[i].id}" class="">
                                        <td id="${showData[i].fk_user_id}">
                                        ${showData[i].first_name}&nbsp;  
                                        ${showData[i].last_name}</td>
                                        <td>${showData[i].amount}</td>
                                        <td>${showData[i].interest}</td>
                                        <td>${showData[i].duration}</td>
                                        <td>${showData[i].start_date}</td>
                                        <td>${showData[i].end_date}</td>
                                        <td width="10">${showData[i].campaign}</td>
                                        <td width="10">${showData[i].status}</td>
                                        <td> <button type="button" id="edit-${showData[i].id}" class="Submit" >Edit&nbsp;</button>
                                        <button id="del-${showData[i].id}"  class="reset">Del&nbsp;</button></td>
                                    </tr>`;
                                      
                            }
                        }       
                      
                    },
                      
                    

                };  

        })();


        var controller = (function(uictrl){

            var Dom;
            Dom = uictrl.getDomString();

            var setEventListener = function(){
              document.querySelector(Dom.Submit).addEventListener('click',ctrnAddItem);
              document.querySelector(Dom.Ammount).addEventListener('keyup',onlyAcceptAlpha);
              document.querySelector(Dom.Interest).addEventListener('keyup',onlyAcceptnumber);
              document.querySelector(Dom.tbody).addEventListener('click',deleteUser);
              document.querySelector(Dom.nameTxt).addEventListener('keyup',searchByName);
                            
            };

            //add user  
            var ctrnAddItem = function(){
                    var allInput;
                    allInput = uictrl.getInput();

                    if(allInput.userID !== '' && allInput.Ammount !=='' && allInput.Interest !== '' && allInput.Duration !=='' && allInput.StartDate !== '' && allInput.EndDate !=='' && allInput.Campaign !== "" && allInput.status !== ""){

                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                    });
                    
                    $.ajax({
                        type:'POST',
                        cache:false,
                        url:window.location.href+'/add',
                        data:{
                                userID:allInput.userID,
                                Ammount:allInput.Ammount,
                                Interest:allInput.Interest,
                                Duration:allInput.Duration,
                                StartDate:allInput.StartDate,
                                EndDate:allInput.EndDate,
                                Campaign:allInput.Campaign,
                                status: allInput.status,
                                id:allInput.id
                            },
                        dataType: 'json',
                        success:function(result){
                          uictrl.showMsg(result.sms);
                          uictrl.clearFields(); 
                          window.location.reload();
                          
                        }


                    });

                   
                   
                }else{
                    uictrl.showMsg('Please Fill up  required fields..!');
                }   

            };

             //input text only accept alphabet
             var onlyAcceptAlpha = function(event){
                 var allInput;
                 allInput = uictrl.getInput();
                 document.querySelector(Dom.Ammount).value = allInput.Ammount.replace(/[^0-9]/g, "");  
             
            };

            var onlyAcceptnumber = function(event){
                 var allInput;
                 allInput = uictrl.getInput();
                 document.querySelector(Dom.Interest).value = allInput.Interest.replace(/[^0-9]/g, "");  
             
            };


            


            //delete Item function 
            var deleteUser =  function(e){
                var id,splitID;
                id = e.target.id;
                splitID = id.split('-');
                //console.log(splitID);
                if(splitID[0] === 'del'){
                   
                   if(confirm("Are you sure you want to delete this?")){
                          //delete date from database
                            uictrl.deleteItem(splitID[1]);
                            //delete tr from table
                            uictrl.deleteTr(splitID[1]);   
                    }else{
                        return false;
                    }
                  
                }else if(splitID[0] === 'edit'){
                    uictrl.displaydataintextfields(e,splitID[1]);
                }
             };

             //serach by name
             var searchByName = function(e){
              let value;
              value = e.target.value;
              if (value !== ""){
                document.querySelector(Dom.tableDAta).innerHTML="";
                uictrl.searchDatabyName(value);
              }else {
                window.location.reload();


              }
              
             };


            return {
                iniIT : function(){
                    setEventListener();
                    
                },
             }


        })(UIcontroller);

        controller.iniIT();




 $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: 'loans?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#loansPaginateDiv").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }



    </script>
  </body>   
</html>