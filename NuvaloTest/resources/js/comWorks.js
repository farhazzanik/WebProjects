
var UIcontroller = (function(){
      //all class and ID name get from here
      var  DOMstring = {
                    shortBy : "#shortBy",
                    searchBtn_for_gw : "#searchBtn_for_gw",
                    reset_button : "#reset_button",
                    my_form : ".form-inline",
                    comworks_shorted : "#comworks_shorted",
                    defualt_div : "#defualt_div"
              };

      return {
          getInput : function(){
              return {
                shortBy : document.querySelector(DOMstring.shortBy).value,
              };
          },

          getDOMstring :function(){
            return DOMstring;

          }
      }

 })();



 var Controller = (function(Uictrl){
       var allInput,dom;
       dom = Uictrl.getDOMstring();
      

    var  setEventListener = function(){
      
       document.querySelector(dom.searchBtn_for_gw).addEventListener('click',function(e){
            e.preventDefault();   
            showComWorksByShoroted();
        });

    

       document.querySelector(dom.reset_button).addEventListener('click',function(e){
            e.preventDefault();   
            resetPage();
        });

         document.querySelector(dom.shortBy).addEventListener('change',showComWorksByShoroted);
        

        document.addEventListener('keypress',function(e){
            if(e.keyCode === 13 || e.which === 13){
                   showComWorksByShoroted();
            }
        });

    };


    //reset page 
    var resetPage = function(){
         document.querySelector(dom.my_form).reset();
         document.querySelector(dom.comworks_shorted).innerHTML = '';
         document.querySelector(dom.defualt_div).style.display = 'block';

    };

    //show woriking hour for each
    var showComWorksByShoroted = function(){
        allInput = Uictrl.getInput();
        var comworks_shorted,defualt_div,html='',shortType=allInput.shortBy;
        comworks_shorted = document.querySelector(dom.comworks_shorted);
        defualt_div = document.querySelector(dom.defualt_div);

       

        if(shortType !== 'select'){
            if(shortType === 'DESC'){
                shortType = "Descending";
            }else{
                shortType = "Ascending";
            }

          $.ajax({
      
          url:window.location.href+"/shortedComWorks/"+allInput.shortBy,
           success:function(data)
             {  
              html = '<table class="table table-bordered"><tr><td align="center" colspan="2"><b>Group Working Hours  order by '+shortType+'</b></td> <tr><th>Company Name</th><th>Working Hours</th></tr></tr>';
               for (var i = 0; i < data.length; i++) {
                  html+= '<tr><td>'+data[i].com_name+'</td><td>'+data[i].totalworks+'</td></tr>';
                  
               }
               html+='</table>';

               comworks_shorted.innerHTML=html;
               defualt_div.style.display = "none";
             }
          });
          

        }else{
          alert('Shorted Type Fields are required ...!!');
        }

    };


    return {
        inInt : function(){
           setEventListener();
          
           
        }
    }
 })(UIcontroller);



Controller.inInt();


