<?php
	include('process.php');
?>
<html>
<head>
	<title>Login Page</title>
	<script src="library/jquery_lib.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#loginBtn").on("click",function(){					
				var department = $("#department").val();
				var userLevel = $("#userrole").val();
				var userName = $("#userName").val();
				var passWord = $("#passWord").val();
				var login = "login";
				if(department=="" || userName=="" || passWord==""){
					alert("Please Fill Form");
				}else{
					$.post("process.php",{login:"login",department:department,userLevel:userLevel,userName:userName,passWord:passWord},function(data){
					//alert (data);
					if(data.trim()=="user"){
						window.location.assign("testlogin.php");
					}else if(data.trim()=="Admin"){
						window.location.assign("responsive_test.php");
					}else if(data.trim()=="superuser"){
						window.location.assign("testlogin.php");
						//alert("This is Site Admin Login");
					}else{
						$(".container3").show();
						$(".attachFile").show();
						$("#loginForm").hide();
					}/**/
					});
					}
					$(document).on("click","#errorClose",function(){
						$(".container3").hide();
						$(".attachFileError").hide();
					});
				});
			});
			</script>
			<style>
			html,body{
				margin:0;
				padding:0;
			}
				.shakeBtn{
				  animation: shake 0.5s;
				  animation-iteration-count:1;
				}
				@keyframes shake {
				  0% { transform: translate(1px, 1px) rotate(0deg); }
				  10% { transform: translate(-1px, -2px) rotate(-1deg); }
				  20% { transform: translate(-3px, 0px) rotate(1deg); }
				  30% { transform: translate(3px, 2px) rotate(0deg); }
				  40% { transform: translate(1px, -1px) rotate(1deg); }
				  50% { transform: translate(-1px, 2px) rotate(-1deg); }
				  60% { transform: translate(-3px, 1px) rotate(0deg); }
				  70% { transform: translate(3px, 1px) rotate(-1deg); }
				  80% { transform: translate(-1px, -1px) rotate(1deg); }
				  90% { transform: translate(1px, 2px) rotate(0deg); }
				  100% { transform: translate(1px, -2px) rotate(-1deg); }
				}
				.attachFile{
					position: relative;
					background-color:#fefefe;
					margin:auto;
					padding:0;
					border:1px solid #888;
					width:80%;
					box-shadow:0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
					-webkit-animation-name: animatetop;
					-webkit-animation-duration: 0.4s;
					animation-name: animatetop;
					animation-duration: 0.9s;
				}
				/* Add Animation */
				@-webkit-keyframes animatetop{
					from {top:-300px; opacity:0} 
					to {top:0; opacity:1}
				}
				@keyframes animatetop{
					from {top:-300px; opacity:0}
					to {top:0; opacity:1}
				}
				tr td #import a:hover{
					background-color:gray;
				}
				#closeEditForm{
						border-radius: 50%;
						-webkit-transition: -webkit-transform .3s ease-in-out;
						transition:transform .3s ease-in-out;
				}
				#closeEditForm:hover{
					-webkit-transform: rotate(90deg);
					transform: rotate(90deg);
				}
			</style>
	</head>
	<body>
		<div class="container col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border:1px solid #ccc;padding:10px;background-color:#3c4154;height:130px;color:#000;">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="margin-top:10px;">
				<img src="" sizes="20x20" style="-webkit-filter:drop-shadow(5px 5px 5px #272727);filter: drop-shadow(5px 5px 5px #272727);">
				</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="color:#CCCCCC;
				 text-shadow: 0 1px 0 #999999, 0 2px 0 #888888,
				 0 3px 0 #777777, 0 4px 0 #666666,
				 0 5px 0 #555555, 0 6px 0 #444444,
				 0 7px 0 #333333, 0 8px 7px rgba(0, 0, 0, 0.4),
				 0 9px 10px rgba(0, 0, 0, 0.2);
				 padding-left:10px;font-size:20px;
				 text-align:center;margin-top:-10px;">
				ကာကွယ်ရေးဦးစီးချုပ်ရုံး( ကြည်း )<br>
				စစ်ဖက်ရေးရာလုံခြုံရေးဌာနချုပ်<br>
				Forein Call Record System
			</div>
			
			</div>
			<div class="loginDiv" style="display:flex;background:linear-gradient(#ccc);vertical-align:center;justify-content:center;align-content:center;">
				<div id="loginForm" class="col-xs-8  col-sm-4 col-md-4 col-lg-3" style="box-shadow:10px 10px 70px #949494;padding:10px 70px 70px 70px;margin-top:7%;margin-left:80px;background:linear-gradient(0deg, #eee,  #d1d1d1);border:none;z-index:100">
					<div style="text-align:center;font-weight:bold;color:#273141;font-size:18px;padding-top:20px;">
						USER AUTHENTICATION
					</div>
					<hr style="border:none;
						height: 40px;
						width: 100%;
						height: 50px;
						margin-top: 0;
						border-bottom: 1px solid #425a64;
						box-shadow: 0 20px 20px -20px #333;
						margin: -50px auto 10px;">
					<div style="text-align:center;">
						
					</div>
					<table width="100%">
						<tr>
							<td width="50%">
								<label style="font-family:'Open Sans Condensed', sans-serif;">Choose Department</label>
								<select style="width:100%;height:30px;outline:none;"id="department">
									<option value="">ဌာနရွေးချယ်ရန်</option>
									<option value="foreinDpr">နိုင်ငံခြားဌာန</option>
									<!--<option value="supplierFour">ထောက်-၄</option>
									<option value="supplierFive">ထောက်-၅(က)</option>-->
								</select>
							</td>
							<td width="50%">
								<label style="font-family:'Open Sans Condensed', sans-serif;">Login As</label>
								<select style="width:100%;height:30px;outline:none;" id="userrole">
									<option value="Admin" style="font-family:'Open Sans Condensed', sans-serif;">Admin</option>
									<option value="SuperUser" style="font-family:'Open Sans Condensed', sans-serif;">SuperUser</option>
									<option value="User" style="font-family:'Open Sans Condensed', sans-serif;">User</option>
								</select>
							</td>
						</tr>
					</table>
					<div style="margin-top:10px;">
						<strong style="font-family:'Open Sans Condensed', sans-serif;">Username:</strong><input type="text" id="userName" name="userName" class="username form-control" style="caret-color:green;padding:8px;background-image:url('');background-size: 30px 30px;bacbackground-position:2px 3px;background-repeat:no-repeat;outline:none;" placeholder="Username...">
					</div>
					<div style="margin-top:10px">
						<strong style="font-family:'Open Sans Condensed', sans-serif;">Password:</strong><input type="password" id="passWord" name ="passWord" class="password form-control" style="caret-color:green;padding:8px;background-image:url('img/log.png');background-size: 30px 30px;background-position:2px 3px;background-repeat:no-repeat;outline:none;" placeholder="Password...">
					</div>
					<br>
					<div style="margin-top:10px;">
						<input type="button" value="LOGIN" id="loginBtn"  style="color:#ccccca;background-color:#425a64;opacity:;font-weight:bold;border:none;outline:none;font-size:17px;border-radius:10px;" class="loginBtn form-control">
					</div>
				</div>
			</div>
			<div class="container3" id="msgBox" style="display:none;/* Hidden by default */
					position:fixed; /* Stay in place */
					z-index:1; /* Sit on top */
					left:0;
					top:0;
					width:100%; /* Full width */
					height:100%; /* Full height */
					overflow:auto; /* Enable scroll if needed */
					background-color:rgb(0,0,0); /* Fallback color */
					background-color:rgba(0,0,0,0.7); /* Black w/ opacity */
					padding-top:60px;">
					<div class="attachFile" style="vertical-align:center;width:20%;height:15%;background-color:#ffffff;border:1px solid #546e7a;border-radius:5px;">
						<div id="msgBoxDiv" name="msgBoxDiv">
							<form id="submitDelFile" name="submitDelFile" enctype="multipart/form-data">
								<center>
									<div style="color:#d3312c;font-size:15px;vertical-align:center;padding-top:10%;"><img src="" />Authentication Failed
									<br>
									</br>
									<button style="border:none;outline:none;width:100px;background-color:#ff2323;color:#fff;border-radius:5px;" id="closeMsg">OK</button>
									</div>
								</center>
							</form>
						</div>
					</div>
			</div>
		
	</body>
</html>
