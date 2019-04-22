 
//table data paginate jquery function
 $(document).ready(function(){

         $(document).on('click', '.pagination a', function(event){
          event.preventDefault(); 
          var page = $(this).attr('href').split('page=')[1];
          fetch_data(page);
         });

         function fetch_data(page)
         {
          $.ajax({

           url:window.location.href+"fetch_data?page="+page,
           success:function(data)
           {
            $('#table_data').html(data);
           }
          });
         }
 
  });


 var UIcontroller = (function(){
      //all class and ID name get from here
      var  DOMstring = {
                    searchText : "#EmployeeName",
                    searchBtn : "#searchBtn",
                    listItem : "list-gpfrm-list",
                    Ulforautcom : "#list-gpfrm",
                    startDate : "#startDate",
                    endData : "#endDate",
                    each_employe : "#each_employe",
                    all_employee : "#all_employee",
                    reaload : "#reaload"
              };

      return {
          getInput : function(){
              return {
                searchText : document.querySelector(DOMstring.searchText).value,
                startDate : document.querySelector(DOMstring.startDate).value,
                endData : document.querySelector(DOMstring.endData).value,
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
      

        document.querySelector(dom.searchText).addEventListener('keyup',showAutoComplete);

        document.querySelector(dom.endData).addEventListener('change',showWorkingHoursByeach);
        document.querySelector(dom.startDate).addEventListener('change',showWorkingHoursByeach);
      
        document.querySelector(dom.searchBtn).addEventListener('click',function(e){
            e.preventDefault();   
            showWorkingHoursByeach();
        });

        

        document.addEventListener('keypress',function(e){
            if(e.keyCode === 13 || e.which === 13){
                   showWorkingHoursByeach();
            }
        });

    };


    var fixListConintoText =function(){
      var listItem;
      listItem = document.getElementsByClassName(dom.listItem);
       for (var i = 0; i < listItem.length; i++) {
          listItem[i].onclick = function(e){
            document.querySelector(dom.searchText).value=e.srcElement.firstChild.data;
            document.querySelector(dom.Ulforautcom).innerHTML = '';
            
          }
       }
        
    }
  
    //show woriking hour for each
    var showWorkingHoursByeach = function(){
        var showDatainDiv,all_employee;
        showDatainDiv = document.querySelector(dom.each_employe);
        all_employee = document.querySelector(dom.all_employee);
        allInput = Uictrl.getInput();

        if(allInput.searchText !== ''){

          $.ajax({
          
          url:window.location.href+"showEachEmpWH/"+allInput.searchText+"/"+allInput.startDate+"/"+allInput.endData,
           success:function(data)
             {  

              all_employee.style.display = "none";
              showDatainDiv.innerHTML = data;
              
            },
            error:function(data){
              showDatainDiv.innerHTML = "<div class='alert alert-warning'>something went wrong</div>";
               all_employee.style.display = "block";
            }
          });

        }else{
          alert('Employee Name is required ...!!');
        }

    };
    //auto complete data show function
    var showAutoComplete = function(){
        var autoTextShowdiv;
       
        autoTextShowdiv = document.querySelector(dom.Ulforautcom);
        allInput = Uictrl.getInput();

       if(allInput.searchText !== ''){
          $.ajax({
          
          url:window.location.href+"autoComName/"+allInput.searchText,
           success:function(data)
             {  

              autoTextShowdiv.innerHTML = data;
              fixListConintoText();
            }
          });
       }else{
           autoTextShowdiv.innerHTML ='' ; 
       }
        

    };

    
    return {
        inInt : function(){
           setEventListener();
          
           
        }
    }
 })(UIcontroller);



Controller.inInt();


