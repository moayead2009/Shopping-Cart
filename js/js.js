window.addEventListener("load", function() {
	
	document.querySelectorAll("#signin").forEach(switchForms);
	document.getElementsByName("mainButton").forEach(btn);
	let signbuttons = document.getElementsByClassName("logoButtons");
	let logodiv = document.getElementsByClassName("logo");
	let regdiv = document.getElementsByClassName("forms");
	let regForm = document.forms[0];
	let logForm = document.forms[1];
	let regInputs = regForm.querySelectorAll('input');
	let logInputs = logForm.querySelectorAll('input');
	let error = document.getElementById("error");
	let topmessage = document.getElementById("topmessage");
	logForm.style.display = "none";
	signbuttons[1].style.display = "none";
	
	/**
	 *  @brief
	 *  this method to validation 
	 *  @param [data] get the data from the chcek.php
	 */
	function val(data) {
		let errorList = "<div class='errorlist'><ul>";	
		let stat = true;
		switch(data){
			case "-1":
				for(let i = 0; i < regInputs.length - 1; i++){
					if(!regInputs[i].value){
						errorList += "<li> - your " + regInputs[i].getAttribute('name') + " shouldn't be blank !</li>";
						stat = false;
					}
				}	
				break;
			case "0":
				error.style.display = "none";
				logForm[0].value = regForm[1].value;
				topmessage.innerHTML = "Your email is exist, please sign in now";
				topmessage.style.display = "block";
				logodiv[0].style.order = "1";
				regdiv[0].style.display = "2";
				signbuttons[1].style.display = "";
				logForm.style.display = "block";
				regForm.style.display = "none";
				signbuttons[0].style.display = "none";
				error.innerHTML = "";
				$("#topmessage").fadeOut(4500);
				
				
				stat = false;	
				break;
			case "1":
				logForm.submit();
				break;
			case "2":
				errorList += "Your password is incorrect! try again";
				stat = false;
				break;
			case "3":
				for(let i = 0; i < logInputs.length - 1; i++){
					if(!logInputs[i].value){
						errorList += "<li>your " + logInputs[i].getAttribute('name') + " shouldn't be blank !</li>";
						stat = false;
					}
				}
				break;
			case "4":
				if(logInputs[0].value){
					topmessage.innerHTML = "There is no user in DB, Please register";
					topmessage.style.display = "block";
					stat = false;
				}else{
					for(let i = 0; i < logInputs.length - 1; i++){
						if(!logInputs[i].value){
							errorList += "<li>your " + logInputs[i].getAttribute('name') + " shouldn't be blank !</li>";
							stat = false;
						}
					}		
				}
				break;
				default:
					errorList += "";
		}
		errorList += "</ul></div>";
		error.innerHTML = errorList;
		if(stat){
			let url = "name=" + regInputs[0].value;
			
			for(let i = 1; i < regInputs.length - 1; i++ ){
				url += "&" + regInputs[i].getAttribute('name') + "=" + regInputs[i].value;
			}
			fetch("server/addUser.php", {
					method: 'POST',
					credentials: 'include',
					headers: { "Content-Type": "application/x-www-form-urlencoded" },
					body: url
				})			
				.then(response => response.text())
				.then(function (data) {
					if(data === "5"){
						logForm.style.display = "block";
						regForm.style.display = "none";
						regForm[0].value = "";
						regForm[2].value = "";
						regForm[3].value = "";
						logForm[0].value = regForm[1].value;
						topmessage.innerHTML = "User has been added to DB, you can log in now ";
						topmessage.style.display = "block";
						logodiv[0].style.order = "1";
						regdiv[0].style.display = "2";
						signbuttons[1].style.display = "";
						logForm.style.display = "block";
						regForm.style.display = "none";
						signbuttons[0].style.display = "none";
						error.innerHTML = "";
						$("#topmessage").fadeOut(4500);
						
					}					
					if(data === "6"){
						error.innerHTML = "There is an issue when we insrt your name to DB";
					}
				})					
		}		
		
		
	}

	/**
	 *  @brief it will check on the email if is existing or not
	 *  
	 */
	function checkEmail(){
		let url = "email=" + 
		(this.value === "Register" ? regForm[1].value : logForm[0].value + "&pass=" + logForm[1].value);
		fetch("server/check.php", {
				method: 'POST',
				credentials: 'include',
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
				body: url
			})			
			.then(response => response.text())
			.then(val)	
	}
	/**
	 *  @brief switch between two forms
	 *  
	 */
	function switchForms(f) {
		f.addEventListener("click", function(){
			let fname = this.getAttribute('name');
			if (fname === "reg"){
				logodiv[0].style.order = "1";
				regdiv[0].style.display = "2";
				signbuttons[1].style.display = "";
				logForm.style.display = "block";
				regForm.style.display = "none";
				this.style.display = "none";
				error.innerHTML = "";
			}else{
				logodiv[0].style.order = "2";
				regdiv[0].style.display = "1";
				signbuttons[0].style.display = "";
				this.style.display = "none";				
				logForm.style.display = "none";
				regForm.style.display = "block";
				error.innerHTML = "";
			}
		});
    }
	
	function btn(b) {
        b.addEventListener("click", checkEmail);
    }


}); 