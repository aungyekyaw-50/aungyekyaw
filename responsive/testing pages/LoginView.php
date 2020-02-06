<link href="css/material-icons.css" rel="stylesheet"/>

	 <!--	<link rel="stylesheet" type="text/css" href="./css/font_image.css"> -->
	 	<style>
	 	body{background:#F1F5F5;     
	         margin:0;
	         padding:0;
	        }
#header{width: 100%;
	    height: 65px;
	    position: absolute;
	    background:linear-gradient(#222f3e,#1e272e);
	      }
#head_table{width: 100%;
	        height:40px;
            margin-top: 10px;
            position: absolute;
           }
#main{margin-top:10%;
      margin-left:30%;
      position:absolute;
	  width:60%;
	  }	
h2{color:white;
   width:50%;
   border-bottom:5px solid #2ecc71;
   }   
#yoo{width:100%;}
i{float:left:text-align:center;color:white;}
#yoo input{background:none;
           border:none;
		   outline:none;
           margin-left:15px;
		   color:white;
		  font-size:20px;
		  letter-spacing:2px;
		}	
.sub_btn{
	   text-align:center;
	   border:3px solid #2ecc71;
	   background:none;
	   width:100%;
	   margin-top:15px;
	   height:40px;
	   color:white;
	   font-size:20px;
	   cursor:pointer;
}	
::placeholder{color:#95a5a6;}	
.main{
	  height:2px;
	  display:block;
	  background:#2ecc71;
	  border:1px solid rgba(0,0,0,0.3);
	  box-shadow:0 0 15px white;
      width:100%;
      	  
}
#hey_col{width: 50%;height: 450px;background: #2c3335;margin-left: 480px;position: absolute;margin-top: 200px;
  border-radius:5px;box-shadow:1px 2px 14px 3px #2ecc71;animation: mymove 2s;}
@keyframes mymove {from {opacity:0;}to {opacity:0.1;},from {opacity:0.1;}to {opacity:0.2;}}
.main span{height:2px;
           float:left;
           background:white;
         }	

.last{width:50%;animation:dog 3s;animation-iteration-count: infinite;}
.oot{width:90%;animation:cat 3s;animation-iteration-count: infinite;}
@keyframes dog{0%{width:0;}100%{width:50%;}}
@keyframes cat{0%{width:0;}100%{width:90%;}}
	    </style>
	 	<body>
	 		
<div id='header'>
	    <table id='head_table' color="white">
	    	   <tr> <td width="5%" align="right"><img src="co.gif" style="border-radius: 50%;width: 35px;height: 35px;"></td>
	    	   	    <td style="width: 27%;color: white;font-size: 20">စရခ</td>
		    	   	<td style="width: 68%;font-size: 20;color:white;">ကာကွယ်ရေးဦးစီးချုပ်ရုံး(ကြည်း)စစ်ဖက်ရေးရာလုံခြုံရေးဌာနချုပ်</td>
		     </tr>
	    </table>
</div>
<form method="post">
<div id="hey_col">
	 
<div id="main">
  <h2>ADMIN</h2>
  <div id="yoo"><i class="material-icons">account_circle</i>
	    <input type="text" placeholder=" Username" name="username" value="">
        <span class="main"><span class="last"></span></span></div>
        <div id="yoo"><i class="material-icons">https</i>
	    <input type="password" placeholder=" Password" name="password" value="">
        <span class="main"><span class="oot"></span></span></div>
        <input  class="sub_btn" type="submit" name="btn_login" value="Login">
        <p align="center"  style="color:#ff2e31">
	    </p>
</div>
</div>



</form>
</body>	  	 	
	
