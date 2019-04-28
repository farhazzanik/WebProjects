var budgetController = (function(){

		var Expense = function(id,description,value){
			this.id = id;
			this.description = description;
			this.value = value;
			this.percentage = -1;
		};

		Expense.prototype.calcPercentage = function(totalIncome){
			if(totalIncome >0){

			  this.percentage = Math.round((this.value / totalIncome) * 100 );
			}else{

				this.percentage = '-1';
			}
		};

		Expense.prototype.getPercentage = function(){
			return this.percentage;
		};

		var Income = function(id,description,value){
			this.id = id;
			this.description = description;
			this.value = value;
		};


		var calculateTotal  =  function(type){
				var sum = 0;
				data.allitem[type].forEach(function(cur){

						sum= sum+cur.value;
				});

				data.totals[type] = sum;
		};
		

		var data = {
				allitem:{
					exp:[],
					inc:[]
				 
				},

				totals:{
					exp:0,
					inc:0
				},
				budget : 0,
				percentage:-1,
		};


		return {

			addItem:function(type,des,val){
				
				var newItem,ID;
				
				//create new ID
				if(data.allitem[type].length > 0){
					ID = data.allitem[type][data.allitem[type].length-1].id+1;
				}else{
					ID = 0;
				}
				


				//create a new ID based on type
				if(type === 'exp'){
					newItem = new Expense(ID,des,val);
				}else if(type === 'inc'){
					newItem = new Income(ID,des,val);
				}

				//push into the our data structure
				data.allitem[type].push(newItem);

				//return the new elements
				return newItem;
			},

			calculateBudget : function(){

					//calculate total income and expense

					calculateTotal('exp');
					calculateTotal('inc');
					//calculate the budget : income - expense

					data.budget = data.totals.inc - data.totals.exp;
					
					// canculate the percentage of income that we spent
					if(data.totals.inc > 0){
							data.percentage = Math.round((data.totals.exp / data.totals.inc) * 100);
					}else{
						data.percentage = -1;
					}
					
			},


			calculatePercentages : function(){	

				data.allitem.exp.forEach(function(cur){
						
					cur.calcPercentage(data.totals.inc);
				});
			},

			getPercentages : function(){
				var allPerc = data.allitem.exp.map(function(cur){
					
					return cur.getPercentage();
				});

				return allPerc;
			},

			getBudget : function(){
				return{
					budget : data.budget,
					percentage: data.percentage,
					totalInc : data.totals.inc,
					totalExp : data.totals.exp,

				};
			},

			deleteItem: function(type,id){
				var ids,index;
				 ids = data.allitem[type].map(function(current){
					return current.id;
				});

				index = ids.indexOf(id);

				if(index !== -1){
					data.allitem[type].splice(index,1);
				}
			},

			
		};	

})();


//UI contorller
var UIcontroller =(function(){

	var DOMstring  = {

		input_type : '.input_type',
		input_description: '.input_description',
		input_value: '.input_value',
		input_button: '.add_btn',
		incomelistdiv :'.incomelist',
		expenselistdiv:'.expenselist',
		totalBudgetLabel:'#totalBudgetLabel',
		incomeLabel:'.incomeLabel',
		expenseLabel:'#expenseLabel',
		percentagLabel:'.percentagLabel',
		inc_exp_contaier:'.inc_exp_contaier',
		exp_percentage_label:'.itemPercentage'
}


 	return {
 			getInput : function(){
 				return{

 				  input_type : document.querySelector(DOMstring.input_type).value,
 				  input_description:document.querySelector(DOMstring.input_description).value,
 				  input_value: parseFloat(document.querySelector(DOMstring.input_value).value)

 				};
			},

 			getDomString: function(){
 				return DOMstring;
 			},

 			addListItem : function(obj,type){
 				var html,newHtml,element;
 				//create html string with placeholder text
 				if(type==='inc'){
 					element = DOMstring.incomelistdiv;
 					html = '<li id="inc-%id%" class="list-group-item d-flex justify-content-between align-items-center"><div style="width: 50%; float: left; clear: right;">'+
				   '%description%</div><div style="width: 50%; float: right; text-align: right;"><span class="">%value%&nbsp;&nbsp;&nbsp;</span>  <i class="fa fa-minus-circle" aria-hidden="true" style="cursor:pointer;"></i></div></li>';
 				}else{
 					element = DOMstring.expenselistdiv;
 					html = '<li id="exp-%id%" class="list-group-item d-flex justify-content-between align-items-center"><div style="width: 50%; float: left; clear: right;">'+
				   '%description%</div><div style="width: 50%; float: right; text-align: right;"><span class="">%value%&nbsp;&nbsp;&nbsp;</span> <span class="itemPercentage"></span> <i class="fa fa-minus-circle" aria-hidden="true" style="cursor:pointer;"></i></div></li>';
 				}
				

				 

 				//replace the placeholder tet with some actual data
 				newHtml = html.replace('%id%',obj.id);
 				newHtml = newHtml.replace('%description%',obj.description);
 				newHtml = newHtml.replace('%value%',obj.value);


 				//console.log(newHtml);
 				//Insert html into the dom
 				document.querySelector(element).insertAdjacentHTML('beforeend',newHtml);
 				
 			},

 			clearFields : function(){
 				var fields,fieldsArr;
 				fields = document.querySelectorAll(DOMstring.input_value+', '+DOMstring.input_description);
 				
 				fieldsArr = Array.prototype.slice.call(fields);

 				fieldsArr.forEach(function(current,index,array){

 					current.value = "";
 				});

 				fieldsArr[0].focus();
 			},

 			displayBudget : function(obj){

 				document.querySelector(DOMstring.totalBudgetLabel).textContent = obj.budget;
				document.querySelector(DOMstring.incomeLabel).textContent = obj.totalInc;
				document.querySelector(DOMstring.expenseLabel).textContent = obj.totalExp;
				if(obj.percentage > 0){
					document.querySelector(DOMstring.percentagLabel).textContent = obj.percentage+"%";
				}else{
					document.querySelector(DOMstring.percentagLabel).textContent = "---";
				}
				
				
 			},

 			displayPercentages : function(percentages){

 				var fields = document.querySelectorAll(DOMstring.exp_percentage_label);

 				var nodeListForEach = function(list,callback){
 						for (var i = 0; i < list.length; i++) {
 							callback(list[i],i);	
 						}
 				};	

 				nodeListForEach(fields, function(current,index){
 					if(percentages[index] > 0){
 						current.textContent = percentages[index] + '%';
 					}else{
 						current.textContent = '--';
 					}
 					
 				});

 			},

 			deleteListItem : function(id){
 				var el = document.getElementById(id);
 				el.parentNode.removeChild(el);
 			},

 	};
})();


//main controller
var controller = (function(budgCtrl,uiCtrl){

	var setEventlistener = function(){
		var Dom = uiCtrl.getDomString();
		document.querySelector(Dom.input_button).addEventListener('click',ctrlAddItem); 

		document.addEventListener('keypress',function(e){
			if(e.keyCode === 13 || e.which === 13){
				ctrlAddItem();
			}
		});

		document.querySelector(Dom.inc_exp_contaier).addEventListener('click',ctrlDeletItem);
	};




	var updateBudget = function(){
		var budget,Dom;
		Dom = uiCtrl.getDomString();
		//1.Calculate the budget
		budgCtrl.calculateBudget();
		//2. return the budget
		budget = budgCtrl.getBudget();

		//3.Display the budget on the UI
	
		uiCtrl.displayBudget(budget);
		

	};

	var updateParcentage = function(){


		//1. calculate the percentages

		budgCtrl.calculatePercentages();

		//2.Read percentage from the  gudget controller
		var percentages = budgCtrl.getPercentages(); 


		//3. update the UI eith the new percentages
		uiCtrl.displayPercentages(percentages);
	};

	var ctrlAddItem = function(){
		var allInput,newItem;
		//1.Get the field input data
		allInput = uiCtrl.getInput();

		if(allInput.input_description !== "" && allInput.input_value > 0 && !isNaN(allInput.input_value)){
		//2.Add the item to the budget controller
		newItem = budgCtrl.addItem(allInput.input_type, allInput.input_description, allInput.input_value);
		//3.add the item to the UI
		uiCtrl.addListItem(newItem,allInput.input_type);
		//4. clear all input fields
		uiCtrl.clearFields();

		//5. calculate and update budget
		updateBudget();

		//6. calculate and update percentages
		updateParcentage();

		}

		
	};



	var ctrlDeletItem = function(e){
		var ItemID,splitID, type,ID;
		ItemID = e.target.parentNode.parentNode.id;

		if(ItemID){
			splitID = ItemID.split('-');
			type = splitID[0];
			ID  = parseInt(splitID[1]);

			budgCtrl.deleteItem(type,ID);

			uiCtrl.deleteListItem(ItemID);

			//5. calculate and update budget
			updateBudget();

			//6. calculate and update percentages
			updateParcentage();

		}
	};

	return {
		inInt : function(){
			 uiCtrl.displayBudget({
			 	budget : 0,
				percentage: -1,
				totalInc : 0,
				totalExp : 0,
			 });
			 
			 setEventlistener();
		}
	}


})(budgetController,UIcontroller);

controller.inInt();