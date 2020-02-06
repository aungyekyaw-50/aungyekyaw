<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/material-icons.css" rel="stylesheet"/>
	<script src="library/jquery_lib.js"></script>
	<style>
		html,body{background:#003366;
			height:99%;
			justify-content:center;
			display:flex;
			align-items:center;
			box-sizing:border-box;}
			.inner{
				font-size:10vw;
			}
			[name=gray]{background:gray}
			form div i{
			  padding: 10px;
			  background: dodgerblue;
			  color: white;
			  min-width: 50px;
			  text-align: center;border-top-left-radius:5px;border-bottom-left-radius:5px;
			}
			form div{
			  display: -ms-flexbox; /* IE10 */
			  display: flex;
			  width: 50%;
			  margin-bottom: 15px;

			}
			form div button{
			 
			  width: 100%;
			  padding: 10px;
			  outline: none;border:none;
			  background:dodgerblue;

			}
			form input {
			  width: 100%;
			  padding: 10px;
			  outline: none;border:none;
			  border-top-right-radius:5px;border-bottom-right-radius:5px;
			}

			form input:focus {
			  border: 2px solid dodgerblue;
			}

	</style>
	<script>
		$(document).ready(function()
		{
			$(".inner").fadeIn(3500, function(){
   			$(".inner").fadeOut(1000);$(".form").fadeIn(3500);
			});
			$(document).on("click",".signup",function()
			{
				$(".childform").css("background","lightgray");
			});
			$(document).on("click",".sigin",function()
			{
				$(".childform").css("background","gray");
			
			});
			
			
		});
	</script>
</head>
<body>
	<div class="box">
		<div class="inner" style="display:none">
			<span style="color:white;opacity:0.2;">Welcome To You</span>
		</div>
		
	</div>
	<div  class="form" style="display:none;height:400px;width:600px;background:rgba(0,0,0,0.3);position:absolute;border-radius:10px;">
		<div class="sigin" style="display:flex;justify-content:center;align-items:center;border-radius:5px 0px;width:50%;height:50px;background:gray;float:left;cursor:pointer;">
			<span  style="padding:10px 15px;">SIGNIN</span>
		</div>
		<div class="signup" style="display:flex;justify-content:center;align-items:center;border-radius:0px 5px;width:50%;height:50px;background:lightgray;float;right;right:0;position:absolute;cursor:pointer;">
			<span  style="padding:10px 15px;">SIGNUP</span>
		</div>
		<div class="childform" style="width:100%;height:88%;position:absolute;bottom:0;">
			<center>
			<form  style="margin-bottom:5px;margin-top:50px;">
				<div><i class="material-icons">account_box</i><input type="text" name="" placeholder="username"></div><br>
				<div><i class="material-icons">lock</i><input type="text" name=""  placeholder="password"></div><br>
				<div><i class="material-icons">email</i><input type="text" name="" placeholder="email"></div><br>
				<div><button>Log in</button></div>
			</form>
			</center>
			
		</div>
	</div>
</body>
</html>