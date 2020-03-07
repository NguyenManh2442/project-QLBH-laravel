function ValidateForm2(){

	var pass = document.getElementById("pass").value;
	var user = document.getElementById("userName").value;

	var status = true;
// kiểm tra userName
	if(user==""){
		document.getElementById("userName").style = "border:1px solid red";
		document.getElementById("error_user").innerHTML = "Vui lòng nhập tên tài khoản";
				status = false;
	}else{
		var sotu = user.length;
		if(sotu<8 || sotu>16){
			document.getElementById("error_pass").innerHTML = "Sai mật khẩu hoặc tên tài khoản!";
			status = false;
		}else{
			document.getElementById("error_user").innerHTML = "";
		}
	}


// Kiểm tra password
	if(pass==""){
		document.getElementById("pass").style = "border:1px solid red";
		document.getElementById("error_pass").innerHTML = "Vui lòng nhập mật khẩu";
				status = false;
	}else{
		var sopass = pass.length;
		if(sopass<6){
			document.getElementById("pass").style = "border:1px solid red";
			document.getElementById("error_pass").innerHTML = "Sai mật khẩu hoặc tên tài khoản!";
			status = false;
		}else{
			document.getElementById("error_pass").innerHTML = "";
		}
	}
	if(status==false){	
			return false;
	}else{
			return true;
		}
}