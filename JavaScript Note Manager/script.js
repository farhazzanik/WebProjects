var ul = document.querySelector('ul');

document.getElementById('add-items').addEventListener('click',function(e){

	e.preventDefault();
	

	var inputValue = document.getElementById('itemText');
	if(inputValue.value != ""){
			
			var newLi = document.createElement('li'),
			firstPar  = document.createElement('p'),
			secondPar  = document.createElement('p'),
			firstIcon = document.createElement('i'),
			secondIcon = document.createElement('i'),
			hiddenInput	= document.createElement('input');

			secondPar.className="fonts-wrapper";
			firstIcon.className="fa fa-times";
			secondIcon.className="fa fa-pencil-square-o";
			hiddenInput.className="edit-note";
			hiddenInput.setAttribute('type','text');
			firstPar.textContent = inputValue.value;



			secondPar.appendChild(firstIcon);
			secondPar.appendChild(secondIcon);
			secondPar.appendChild(hiddenInput);
			newLi.appendChild(firstPar);
			newLi.appendChild(secondPar);
			ul.appendChild(newLi);

			inputValue.value = '';

	}
});

var checkBox = document.getElementById('hide');
checkBox.addEventListener('click',function(){
	
		
		var label = document.querySelector('div label');
		if(checkBox.checked){
			label.textContent = "Unhide Notes";
			ul.style.display="none";
		}else{
			label.textContent = "Hide Notes";
			ul.style.display="block";
		}
});

var searchBox = document.querySelector('#search-note input');

searchBox.addEventListener('keyup',function(e){
		var searchchar = e.target.value.toUpperCase();
		var notes = ul.getElementsByTagName('li');

		Array.from(notes).forEach(function(note){

			var partext = note.firstElementChild.textContent;
			if(partext.toUpperCase().indexOf(searchchar) !==-1){
				note.style.display = "block";
			}else{
				note.style.display = "none";
			}
		});
});

var close = document.getElementsByClassName('fa-times');
for (var i = 0; i < close.length; i++) {
		  close[i].onclick = function() {
		    var div = this.parentElement.parentElement;
		    div.style.display = "none";
		  }
	}

var edit = document.getElementsByClassName('fa-pencil-square-o');
console.log(edit);
for (var i = 0;i < edit.length; i++) {

	edit[i].onclick = function(){
		
	  	this.previousElementSibling.setAttribute("style","display:block;");
	   	this.setAttribute("style","display:none");
		this.nextElementSibling.style.display='block';
	}
}


var editSuccess = document.getElementsByClassName('fa-save');
console.log(editSuccess);
for (var i = 0; i < editSuccess.length; i++) {
	editSuccess[i].onclick = function(){
		var inputText = this.parentNode.lastElementChild;
		if(inputText.value !== ""){
			this.parentElement.parentElement.firstElementChild.textContent = inputText.value;
			this.parentElement.lastElementChild.style.display = "none";
			this.style.display="none";
			this.nextElementSibling.style.display="block";
		}
	}
}

