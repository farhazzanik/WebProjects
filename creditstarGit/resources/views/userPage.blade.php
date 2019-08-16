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
                       <div class="alert alert-warning" style="margin-top: 5px;">
                            <b>Please use actual data type to insert any data...</b>
                          </div>
                        <div class="errorDiv" style="margin-top: 5px;"></div>
                        <form action="" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                            <table  cellpadding="0" cellspacing="0" class="table  user-table" border="0">
                                <tr>
                                    <th colspan="2">User Information</th>
                                </tr>

                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">First Name</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback">

                                        <input type="text" value="{{old('FirstName')}}" name="FirstName" class="form-control FirstName" placeholder="Mahfuzul">
                                        <i class="form-control-feedback fa fa-asterisk"></i>
                                          

                                    </td>
                                </tr>

                                  <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Last Name</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; "  class="has-feedback"><input type="text" value="{{old('LastName')}}" name="LastName" class="form-control LastName" placeholder="Haque">
                                          <i class="form-control-feedback fa fa-asterisk"></i>
                                </td>
                                </tr>

                                  <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">E-mail</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; "  class="has-feedback"><input type="text" value="{{old('Email')}}" name="Email" class="form-control Email" placeholder="mahfuzkhan2125@gmail.com">

                                        <input type="hidden" name="id" class="id">
                                         <i class="form-control-feedback fa fa-asterisk"></i>
                                </td>
                                </tr>

                                  <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Personal Code</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="text" value="{{old('PersonalCode')}}" name="PersonalCode" class="form-control PersonalCode" placeholder="39702120040">
                                         <i class="form-control-feedback fa fa-asterisk"></i>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Phone</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="text"  value="{{old('Phone')}}" name="Phone" class="form-control Phone" placeholder="+372 53631295">
                                         <i class="form-control-feedback fa fa-asterisk"></i>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Status</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback">
                                        <input type="radio" name="status" value="1" style="cursor: pointer;"  class="status" checked> Active

                                         <input type="radio" name="status" value="0" style="cursor: pointer;"  class="status"> Deactive
                                          <i class="form-control-feedback fa fa-asterisk"></i>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Dead</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"><input type="number" value="{{old('Dead')}}" name="Dead" class="form-control Dead" placeholder="EX:1">
                                     <i class="form-control-feedback fa fa-asterisk"></i>
                                </td>
                                </tr>

                                 <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Lang</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback"> <input type="text"  value="{{old('Lang')}}" name="Lang" class="form-control Lang" placeholder="EX:1">
                                     <i class="form-control-feedback fa fa-asterisk"></i>
                                 </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right" style="border-left: 1px #cccccc solid; border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">
                                        <button type="button" id="Submit" class="Submit" ><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Submit</button>
                                        <button type="button" id="reset" class="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>
                                    </td>
                                </tr>
                                   
                        </table>
                    </form>
                    </div>
                    <div class="col-lg-7 tbody" id="tt" >
                          <div class="alert alert-warning" style="margin-top: 5px;">
                            <b>if you want to delete user,Please make sure user don't have any loans in lonstable otherwise user won't delete due to user is foreign key in loans table.</b>
                          </div>
                           @include('userDataPaginate')

                    </div>
            </div>
                


        </div>

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{URL::To('/')}}/public/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
       
        var UIcontroller = (function(){

            var DOMstring = {
                    FirstName : '.FirstName',
                    LastName:'.LastName',
                    Email :'.Email',
                    PersonalCode:'.PersonalCode',
                    Phone:'.Phone',
                    status:'.status',
                    Dead:'.Dead',
                    Lang:'.Lang',
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

                             first_name_value : document.querySelector(DOMstring.FirstName).value,
                             last_name_value:document.querySelector(DOMstring.LastName).value,
                             email_value:document.querySelector(DOMstring.Email).value,
                             personal_code_value : document.querySelector(DOMstring.PersonalCode).value,
                             phone_value:document.querySelector(DOMstring.Phone).value,
                             status_value:document.querySelector(DOMstring.status).value,
                             dead_value:document.querySelector(DOMstring.Dead).value,
                             Lang_value:document.querySelector(DOMstring.Lang).value,
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
                         fields = document.querySelectorAll(DOMstring.FirstName+','+DOMstring.LastName+','+DOMstring.Email+','+DOMstring.PersonalCode+','+DOMstring.Phone+','+DOMstring.Dead+','+DOMstring.Lang);

                         fieldsArr = Array.prototype.slice.call(fields);

                         fieldsArr.forEach(function(cur,index,array){

                                cur.value = "";
                         });

                         fieldsArr[0].focus();
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
                       
                       let name,splitname;
                       name = e.target.parentNode.parentNode.childNodes[1].textContent;
                       splitname = name.split(' ');
                       document.querySelector(DOMstring.FirstName).value =splitname[0];
                       document.querySelector(DOMstring.LastName).value =splitname[1];
                       document.querySelector(DOMstring.Email).value = e.target.parentNode.parentNode.childNodes[3].textContent;
                       document.querySelector(DOMstring.PersonalCode).value = e.target.parentNode.parentNode.childNodes[5].textContent;
                       document.querySelector(DOMstring.Phone).value = e.target.parentNode.parentNode.childNodes[7].textContent;
            
                       document.querySelector(DOMstring.Dead).value = e.target.parentNode.parentNode.childNodes[11].textContent;
                       document.querySelector(DOMstring.Lang).value = e.target.parentNode.parentNode.childNodes[13].textContent;
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
                                <td>${showData[i].first_name}&nbsp; ${showData[i].last_name} </td>
                                <td>${showData[i].email}</td>
                                <td>${showData[i].personal_code}</td>
                                <td>${showData[i].phone}</td>
                                <td>${showData[i].active}</td>
                                <td>${showData[i].dead}</td>
                                <td>${showData[i].lang}</td>
                                <td> <button type="button" id="edit-${showData[i].id}" class="Submit" >Edit&nbsp;</button><button id="del-${showData[i].id}"  class="reset">Del&nbsp;</button></td>
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
              document.querySelector(Dom.PersonalCode).addEventListener('keyup',onlyAcceptAlpha);
              document.querySelector(Dom.tbody).addEventListener('click',deleteUser);
              document.querySelector(Dom.nameTxt).addEventListener('keyup',searchByName);
                            
            };

            //add user  
            var ctrnAddItem = function(){
                    var allInput;
                    allInput = uictrl.getInput();

                    if(allInput.first_name_value !== '' && allInput.last_name_value !=='' && allInput.email_value !== '' && allInput.personal_code_value !=='' && allInput.phone_value !== '' && allInput.status_value !=='' && allInput.dead_value !== "" && allInput.Lang_value !== ""){

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
                                first_name:allInput.first_name_value,
                                last_name:allInput.last_name_value,
                                email:allInput.email_value,
                                personal_code:allInput.personal_code_value,
                                phone:allInput.phone_value,
                                status:allInput.status_value,
                                dead:allInput.dead_value,
                                lang: allInput.Lang_value,
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
                 document.querySelector(Dom.PersonalCode).value = allInput.personal_code_value.replace(/[^0-9]/g, "");  
             
            };



            //delete Item function 
            var deleteUser =  function(e){
                var id,splitID;
                id = e.target.id;
                splitID = id.split('-');
               // console.log(splitID);
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


             //searchUser By Nme

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
            url: 'user?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tt").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }


    </script>
  </body>
</html>