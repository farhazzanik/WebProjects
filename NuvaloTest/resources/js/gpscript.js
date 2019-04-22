var UIcontroller = (function(){
      //all class and ID name get from here
      var  DOMstring = {
                    startMonth : "#startMonth",
                    endMonth : "#endMonth",
                    searchBtn_for_gw : "#searchBtn_for_gw",
                    groupWorks_hours_div : "#groupWorks_hours",
                    reset_button : "#reset_button",
                    my_form : ".form-inline"
              };

      return {
          getInput : function(){
              return {
                startMonth : document.querySelector(DOMstring.startMonth).value,
                endMonth : document.querySelector(DOMstring.endMonth).value,
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
            showWorkingHoursByGroup();
        });

       document.querySelector(dom.reset_button).addEventListener('click',function(e){
            e.preventDefault();   
            resetPage();
        });

       document.querySelector(dom.startMonth).addEventListener('change',showWorkingHoursByGroup);

       document.querySelector(dom.endMonth).addEventListener('change',showWorkingHoursByGroup); 

        

        document.addEventListener('keypress',function(e){
            if(e.keyCode === 13 || e.which === 13){
                   showWorkingHoursByGroup();
            }
        });

    };


    //reset page 
    var resetPage = function(){
         document.querySelector(dom.my_form).reset();
         document.querySelector(dom.groupWorks_hours_div).innerHTML = '';
     

    };
    //show woriking hour for each
    var showWorkingHoursByGroup = function(){
        var groupWorks_hours_div;
        groupWorks_hours_div = document.querySelector(dom.groupWorks_hours_div);

        allInput = Uictrl.getInput();

        if(allInput.startMonth !== '' &&  allInput.endMonth !== ''){

          $.ajax({
      
          url:window.location.href+"/showGroupWorkHours/"+allInput.startMonth+"/"+allInput.endMonth,
           success:function(data)
             {  
                groupWorks_hours_div.innerHTML = data;
             }
          });
          

        }else{
          alert('Month Fields are required ...!!');
        }

    };


    return {
        inInt : function(){
           setEventListener();
          
           
        }
    }
 })(UIcontroller);



Controller.inInt();


