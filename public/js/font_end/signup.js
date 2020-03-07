function ValidateForm() {
	var email = document.getElementById("email").value;
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	var user = document.getElementById("userName").value;

	var status = true;

	if(user==""){
		document.getElementById("userName").style = "border:1px solid red";
		document.getElementById("error_user").innerHTML = "Tên tài khoản không được để trống";
				status = false;
	}else{
		var sotu = user.length;
		if(sotu<8 || sotu>16){
			document.getElementById("userName").style = "border:1px solid red";
			document.getElementById("error_user").innerHTML = "Ít nhất 8 kí tự và nhiều nhất là 16";
			status = false;
		}else{
			document.getElementById("userName").style = "border:1px solid green";
			document.getElementById("error_user").innerHTML = "";
		}
	}


	// không được để trống email

	var emailReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(email==""){
				document.getElementById("email").style = "border:1px solid red";
				document.getElementById("error_email").innerHTML = "Email không được để trống";
				status = false;
			}else{
				if(emailReg.test(email)==false){
					document.getElementById("email").style = "border:1px solid red";
					document.getElementById("error_email").innerHTML = "Sai định dạng Email";
					status = false;
				}else{
					document.getElementById("email").style = "border:1px solid green";
					document.getElementById("error_email").innerHTML = "";
				}
				
			}

	//không được để trống pass


	if(pass1==""){
		document.getElementById("pass1").style = "border:1px solid red";
		document.getElementById("error_pass").innerHTML = "Mật khẩu không được để trống";
				status = false;
	}else{
		var sopass = pass1.length;
		if(sopass<6){
			document.getElementById("pass1").style = "border:1px solid red";
			document.getElementById("error_pass").innerHTML = "Mật khẩu ít nhất 6 kí tự";
			status = false;
		}else{
			document.getElementById("pass1").style = "border:1px solid green";
			document.getElementById("error_pass").innerHTML = "";
		}
	}
	if(pass2==""){
		document.getElementById("pass2").style = "border:1px solid red";
		document.getElementById("error_pass").innerHTML = "Mật khẩu không được để trống";
				status = false;
	}
	else{
		if(pass2!=pass1){
			document.getElementById("pass1").style = "border:1px solid red";
			document.getElementById("pass2").style = "border:1px solid red";
			document.getElementById("error_pass").innerHTML = "Mật khẩu không trùng khớp!";
					status = false;
		}else{
			document.getElementById("pass2").style = "border:1px solid green";
			document.getElementById("error_pass").innerHTML = "";
		}
	}
	if(status==false){	
			return false;
	}else{
			return true;
		}
}