/*================================================================
					        VARIABLES
================================================================== */ 
const login_form = document.querySelector("#login_form");
const username = document.querySelector("#username");
const password = document.querySelector("#password");
let error_massage = document.querySelector(".error-msg");
let success_massage = document.querySelector(".success-msg");
// console.log(error_massage);










/*================================================================
			            VARIABLES  ENDS
================================================================== */ 

/*================================================================
			                  FUNCTION
================================================================== */ 

function input_check(){

	if (username.value.trim() == "" && password.value.trim() == "") {
		username.style.border = "1px solid red";
		password.style.border = "1px solid red";
		let getMsg = "FILL OUT THE ABOVE FIELDS TEXT"
		errorMessage(getMsg);
		return;
	}

	if(username.value.trim() == ""){
		inputFail(username,"ENTER YOUR USERNAME");
	}else{
			inputSucces(username);
	}

	if(password.value.trim() == ""){
		inputFail(username,"ENTER YOUR PASSWORD");
	}else{
			inputSucces(password);
	}


}

function inputFail(idElement,msg){
	let getMsg = msg;
	idElement.style.border = "2px solid red";
	errorMessage(getMsg);
}


function inputSucces(idElement){
	setInterval(function(){
		idElement.style.border = "3px solid green";
	},1);
}

function errorMessage(msg){
	  error_massage.classList.remove('hide');
      error_massage.innerHTML = `<h5>${msg}</h5>`;
      setInterval(function(){
      	// error_massage.classList.add('hide');
      	location.reload(true);
      },4000);
}

function successMessage(msg){
	 success_massage.classList.remove('hide');
      success_massage.innerHTML = `<h5>${msg}</h5>`;
      // setInterval(function(){
      // 	// error_massage.classList.add('hide');
      // 	location.reload(true);
      // },4000);
}



function getData(){

	if ((username.value.trim()!="")&&(password.value.trim()!= "")) {

		let formData = new FormData(login_form);

		fetch('API/CONTROLLER/usersController.php?action=login',{
			method:"post",
			body:formData
		}).then(Response=> Response.json())
		  .then(function(data){
		  	console.log(data[0]);
		  	if (data[0]==true) {
		  		successMessage("LOGIN !!")
		  		setInterval(function(){

		  			window.top.location.href='/barstock/';
		  			
		  		},2000);

		  		
		  	} else {
		  		errorMessage("WRONG CREDENCIALS!!");
		  	}
		  });
	}
}







function loginForm(e){
	e.preventDefault();
	input_check();
	getData();
}







/*================================================================
			           FUNCTIONS ENDS
================================================================== */ 

/*================================================================
			               EVENTS
================================================================== */ 
if (login_form) {

	login_form.addEventListener('submit',loginForm);
}








/*================================================================
			           EVENTS ENDS
================================================================== */ 