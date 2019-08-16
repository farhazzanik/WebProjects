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
                  

                    
                    <div class="col-lg-5 col-md-offset-3">
                      
                        <div class="errorDiv alert alert-danger" style="margin-top: 5px; color: black; font-weight: bold;"></div>
                        <form action="" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                            <table  cellpadding="0" cellspacing="0" class="table  user-table" border="0">
                                <tr>
                                    <th colspan="2">Check Age by Estonian Personal ID Code...</th>
                                </tr>

                                <tr>
                                    <td class="text-center" style="border-left: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">Estonian ID Code</td>
                                    <td style="border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; " class="has-feedback">

                                        <input type="text" value="{{old('idcode')}}" name="idcode" class="form-control idcode" placeholder="3970120040">
                                        <i class="form-control-feedback fa fa-asterisk"></i>
                                          

                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-right" style="border-left: 1px #cccccc solid; border-right: 1px #cccccc solid; border-bottom:1px #cccccc solid; ">
                                        <button type="button" id="Submit" class="Submit" onclick="return ageCAl()"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;Submit</button>
                                        <button onclick="window.location.reload()" type="button" id="reset" class="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset</button>
                                    </td>
                                </tr>
                                   
                        </table>
                    </form>
                    </div>
            </div>
                


        </div>

    <meta name="_token" content="{!! csrf_token() !!}" />
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{URL::To('/')}}/public/js/bootstrap.min.js" ></script>

    <script type="text/javascript">
         function ageCAl(){
           let idcode,substr,gender,subyear,madeYear,dataFormatBB,subMonth,subDay,age;
           idcode = document.querySelector('.idcode').value;
           
           if(idcode != ""){
              substr = idcode.substr(0,1);
              subyear = idcode.substr(1,2);
              subMonth = idcode.substr(3,2);
              subDay = idcode.substr(5,2);
              if(substr ==1 || substr==2){

                  if(subyear == "00"){
                    madeYear= 19+subyear;
                  }else{
                     madeYear= 18+subyear;
                  }
                  
                 age = calculate_age(new Date(madeYear,subMonth,subDay));
                 eligableForloans(age,substr);
              }else if(substr==3 || substr==4){
                 if(subyear == "00"){
                    madeYear= 20+subyear;
                  }else{
                     madeYear= 19+subyear;
                  }
                 
                age =  calculate_age(new Date(madeYear,subMonth,subDay));
                 eligableForloans(age,substr);
              }else if(substr==5 || substr==6){
                if(subyear == "00"){
                    madeYear= 21+subyear;
                  }else{
                     madeYear= 20+subyear;
                  }
                  
                  age =  calculate_age(new Date(madeYear,subMonth,subDay));
                   eligableForloans(age,substr);
              }else{
                alert("this century is not availabel...")
              }
           }else{
             alert('Write your ID code....');
           }
         }

        function calculate_age(dob) { 
            var diff_ms = Date.now() - dob.getTime();
            var age_dt = new Date(diff_ms); 
          
            return Math.abs(age_dt.getUTCFullYear() - 1970);
        }

        function eligableForloans(age,substr){
          let gender,sms;
            if(substr%2 ==0){
               gender = "Female"
            }else{
               gender = "Male"
            }
            if(age >= 18){
              sms = " Congratulations !!, You are eligible for take loans."
            }else{
              sms = " Sorry !!, you are under 18, You are not eligible for take loans."
            }
            document.querySelector('.errorDiv').innerHTML = `** Your are ${gender} ** <br/>  ** Your age  ${age} ** <br/> ${sms}`;
        }
    </script>
  </body>
</html>