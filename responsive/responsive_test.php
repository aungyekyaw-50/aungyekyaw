<?php 
	session_start();
	if($_SESSION["user_role"]!="1") 
	{
		header("Location:testlogin.php");
		exit();	
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>responsive</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="library/sweetalert2.min.js"></script>
	<link href="css/sweetalert2.min.css" rel="stylesheet"/>
	<link href="css/material-icons.css" rel="stylesheet"/>
	<script src="library/jquery_lib.js"></script>
	<script src="library/Chart.min.js"></script>
	<script src="library/printThis.js"></script>
	<style>
		body{padding:0;margin:0;font-size:13px;box-sizing: border-box;}
		.wrap{
			width:100%;
			height:100%;
			box-sizing:border-box;
		}
		header {
			height: 50px;
			background: #3367d6;
		}
		section {
			display: flex;
			align-items: stretch;
			height:550.5px;padding:3px;
		}
		nav{
			width: 0;
			height:100%;
		    position: fixed;
		    z-index: 1;top:0;left:0;
		    overflow-x: hidden;
		    transition: 0.5s;
		    overflow-y: hidden;
		    padding-top: 160px;
			background: #ffffff;box-shadow:1px 1px 35px rgba(0,0,0,0.5);

		}
		nav div i{
			float:left;margin-right:25px;color:gray;
			font-weight:bold;font-size:20px;
		}
		article {
			flex-grow: 1;margin-left:2px;
			background:#F8F9FA;
			box-shadow:1px 1px 5px black;
		}
		footer {
			height: 50px;
			background: #3367d6;
		}
		@media only screen and (max-width:1920px) 
		{
			section {
			display: flex;
			align-items: stretch;
			height:863px;padding:3px;
			}
			.listdiv{
				background-color:rgba(0,0,0,0.2);font-size:14px;width:300px;padding:15px 15px;margin-bottom:5px;color:#505050;cursor:pointer;
					font-weight:bold;box-shadow:1px 1px 1px rgba(122,122,122,0.8);
			}
			.listdiv:hover{
				background-color:rgba(0,0,0,0.3	);border-left:5px solid #3367d6;transition-duration:0.8s; 
			}
			.inserttbl{
				width:100%;float:left;
				table-layout:auto;height:10%;padding:10px;
			}
			.inserttbl td{text-align:left;}
			
			.inserttbl td input{
				padding:0 5px;width:90%;margin:3px;height:30px;border-style:none;border:0.5px solid black;
				background:lightgray;border-radius:5px;outline:none;
			}
			::-webkit-scrollbar{width:0px;}
			
			.inserttbl td button{
				float:right;border-radius:5px;padding:8px 10px;border:1px solid #0066cc;background:	#0066cc;color:white;cursor:pointer;outline:none;
			}
			.inserttbl 	button:hover{
				opacity:0.8;transition-duration:0.3s;
			}
			.showtbl,.searchtbl{
				width:98.5%;
				margin:10px; border:0.2px solid lightgray;table-layout:auto;
				height:auto;overflow:scroll;text-shadow: 0 0 3px #204060;
			}
			.showtbl th,.searchtbl th{
				height:30px;width:150px;text-align:center;background:gray;border:1px solid lightgray;margin-right:5px;top:0;position:sticky;
			}
			.showtbl tbody tr,.searhtbl tbody tr{text-align:center;}
			.showtbl td,.searchtbl td{
				height:30px;width:150px;margin:3px;border:px solid black lightblue;overflow-y:scroll;
			}
			.showtbl tbody tr:nth-child(odd),.searchtbl tbody tr:nth-child(odd){
				background:lightgray;
			}
			.title img{display:none;float:right;width:20px;height:20px;margin:8px;padding:5px 5px;px;cursor:pointer;border-radius:50%;transition-duration:0.5s;}
			.title  img:not([title=search]):hover{border-radius:50%;background-color:rgba(133,133,133,0.5);}
			#chart-container {
		        width: 75%;
		        height:75%;
		        margin:0 auto;
		        margin-top:15px;
			   }
			#myInput{
				float:right;border-style:none;outline-style:none;border-radius:5px;margin-right:-35px;width:0px;
			    font-size: 13px;margin-top:10px; transition: width 1s;
			    background-color:lightgray;height:15px;
			    
			 }
			[name="pop"]{box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);border-radius:5px;margin:0 auto;position:absolute;top:20px;left:0;right:0;width:400px;height:100px;background-color:rgba(200,200,200,1)}
			[name="alartspan"]{cursor:pointer;padding:1px 7.5px;color:lightgray;background-color:red;float:right;width:5px;height:20px;border-radius:25px;}
			[name="alartp"]{text-align:center;left:0;right:0;top:40px;position:absolute;}
			[name="alarttitle"]{border-top-right-radius:5px;border-top-left-radius:5px;z-index:-1;width:99%;height:25px;background-color:rgba(0, 102, 102,0.8);padding:2px 2px;}
			.search_select_table{table-layout:fixed;width:95%;margin:15px;}
			.search_select_table td{border:0.1px solid lightgray;width:180px;height:30px;}
			.search_select_table input[type=text]{display:none;padding:5px;}
			.search_select_table input[type=date]{display:none;width:95%;padding:1.5px;}
			.searchtbl{margin-top:10px;}
			
		}

	</style>
	<script>
		$(document).ready(function()
		{
			datashow();
			chart();
			search();
			
			$(".main").show();$(".showdiv").hide();$(".insertdiv").hide();$(".search").hide();$(".title img,.title i,#myInput").hide();
				$(".cover").hide();$("nav").css({"width":"0","transition-duration":"0.5s"});
				$("[name=open]").attr("name","close");
			$(document).on("click","[name=close]",function()
			{
				$("nav").css({"width":"250px","transition-duration":"0.5s"});
				$(this).attr("name","open");
				$(".cover").fadeIn(100);
			});
			$(document).on("click","[name=open]",function()
			{
				$("nav").css({"width":"0","transition-duration":"0.5s"});
				$(this).attr("name","close");
				
			});
			$(document).on("click",".cover",function()
			{
				$("nav").css({"width":"0","transition-duration":"0.5s"});
				$(this).fadeOut(100);$("[name=open]").attr("name","close");$("[name=pop]").hide();$(".insertdiv").hide();
			});
			
			$(document).on("click",".add",function()
			{
				$(".cover").fadeIn(100);$(".insertdiv").css({"z-index":"100","position":"absolute","top":"20px","margin":"0 auto","left":"0","right":"0","bottom":"0"}).slideDown();

			});
			$(document).on("mouseover","[title=search]",function()
			{
				$("#myInput").css({"width":"200px","padding":"6px 5px"});
			});
			$(document).on("click","[title=search]",function()
			{
				$("#myInput").css({"width":"0px","padding":"6px 0px"});
			});
			
			$(document).on("click","nav div",function()
			{
				var indexval=$(this).index();
				if(indexval==1)
				{
					$(".main").show();$(".showdiv").hide();$(".insertdiv").hide();$(".searchdiv").hide();$(".title img,.title i,#myInput").hide();
					$(".cover").hide();$("nav").css({"width":"0","transition-duration":"0.5s"});
					$("[name=open]").attr("name","close");
					$("[title=noti]").show();
				}
				if(indexval==2)
				{
					$(".main").hide();$(".showdiv").show();$(".insertdiv").hide();$(".searchdiv").hide();$(".title img,.title i,#myInput").show();
					$(".cover").hide();$("nav").css({"width":"0","transition-duration":"0.5s"});
					$(this).attr("name","close");$("[name=open]").attr("name","close");

				}
				if(indexval==3)
				{
					$(".main").hide();$(".showdiv").hide();$(".insertdiv").hide();$(".searchdiv	").show();$(".title img,.title i,#myInput").hide();
					$(".cover").hide();$("nav").css({"width":"0","transition-duration":"0.5s"});$("[name=open]").attr("name","close");

				}
				if(indexval==4)
				{
					window.location.href="logout.php";
				}
			});
			$(document).on("dblclick",".showtbl tbody tr",function()
			{
					datashow();
			});
			$(document).on("change","[name=checkall]",function()
			{
					var tr=$(".showtbl tr").not(".showtbl thead tr");
					$("input:checkbox").prop("checked", $(this).prop("checked"));
					if ($(this).prop("checked") == true)
					{
						$(tr).css("background-color","rgba(150,150, 150,0.8)");
					}
					if ($(this).prop("checked") == false)
					{
						$(tr).css("background-color","");
					}
			});
			$(document).on("change","[name=check]",function()
				{
					var tr=$(this).parent().parent();
					if($(this).prop("checked") == false)
					{
						$("[name=checkall]").prop("checked", false);
						$(tr).css("background-color","");
			
					}
					if($("[name=check]:checked").length == $("[name=check]").length)
					{
						$("[name=checkall]").prop("checked", true);
					}
					if($(this).prop("checked") == true)
					{
						
						$(tr).css("background-color","rgba(150,150, 150,0.8)");
					}
								
				});
			$(document).on("click","#savebtn",function()
			{
				var input=$(".inserttbl td input").not("[name=file]");
				var count=0;
				var val=[];
				$.each(input,function()
				{
					val[count]=$(this).val();
					if(val[count] == "")
					{
						Swal.fire({
							 type: 'info',
							  position: 'top-center',
							  text: "အချက်အလက်ဖြည့်သွင်းရန်ကျန်ရှိခဲ့ပါသည်။",
							  showConfirmButton: true
						  });
					}else
					{
						val[count]=[$(this).val(),$(this).attr("name")];
					}
					count++;//alert(val[4]);
				});
					val[count]=[$(".inserttbl td textarea").val(),$(".inserttbl td textarea").attr("name")];
					var array=JSON.stringify(val);
					$.post("process.php",{array:array},function(data)
					{
						if(data.trim()=="good")
						{
						  var pdf=$("[name=file]").val();alert(pdf);
						 $.post("process.php",{pdf:pdf},function(rep)
						 {
						 	//alert(rep);
						 });
						  Swal.fire({
							  type: 'success',
							  position: 'top-center',
							  title: 'success',
							  text: 'သိမ်းဆည်းမှုအောင်မြင်ပါသည်။',
							  showConfirmButton: false,
							  timer: 1500
						 	 });
						 	$(".cover, .insertdiv").hide();
						 	datashow();
						 	input.val("");
						 	$(".inserttbl td textarea").val("");
						}
					});
			});
			$(document).on("click","[title=delete]",function()
			{	
				delete1();
			});
			$(document).on("click","[title=Excel]",function()
			{
				//alert("see");
				print();
			});
			$(document).on("click","[name=alartspan]",function()
			{
				$("[name=pop]").hide();$(".cover").hide();

			});
			$(document).on("click","[title=update]",function()
			{
				update();

			});
			$(document).on("click",".searchBtn",function()
				{
					advanceSearch();

				});
			$(document).on("click",".search_select_table input[type=checkbox]",function()
			{
				checkboxshow();
			});
			$(document).on("click","[title=Excel1]",function()
			{
				print1();
			});
			$(document).on("click","[name=editbtn]",function()
			{
				
				var tr=$(this).parent().parent();
				var td=$("td",tr);
				var val=[];
				var id=[];
				var count=0;
				$.each(td,function(j,item)
				{
					if(j!=0 && j!=8)
					{
						val[count]=$("input",this).val();
						count++;
					}
					
				});

				$.each(tr,function()
				{
					val[count]=$(this).attr("mainId");
					count++;
				});
				//alert(val);
				//alert(id);
				var editarray=JSON.stringify(val);//alert(editarray);
				$.post("process.php",{editarray:editarray},function(reply)
				{
					if(reply.trim()=="successful")
					{
						Swal.fire({
							  type: 'success',
							  position: 'top-center',
							  title: 'success',
							  text: 'ပြုပြင်ခြင်းအောင်မြင်ပါသည်။',
							  showConfirmButton: false,
							  timer: 1500
						 	 });
						datashow();

					}
				});/**/
			});
			function search()
			{
				$("#myInput").on("keyup", function() {
				    var value = $(this).val().toLowerCase();
				    $(".showtbl tbody tr").filter(function() {
				      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				    });
				  });
			}
			function datashow(d)
			{
				//$("[name=checkall]").prop("checked", false);
				$.post("process.php",{x:"x"},function(data){
					callback=JSON.parse(data);
					setdata(callback);
					//alert(callback);
					
				});
			}/**/
			
			function setdata(myarray)
			{
				$(".showtbl tbody tr").remove();
				$.each(myarray,function(i,item){
					var tr=$("<tr>").attr("mainId",item[0]);
					var td=$('<td>').attr('name', 'td');
					var check=$('<input>').attr({'type':'checkbox','name':'check'});
					$("<td>").text(i+1).appendTo(tr);
					var l=item.length;
					$.each(item,function(j,item2)
					{
						if(j!=0 && j!=7)	
							{	
								$("<td>").text(item2).appendTo(tr);
							}
						if(j==7)
						{
							$("<td>").css("color","red").text(item2).appendTo(tr);

						}

					});
					$(tr).appendTo(".showtbl tbody");
					$(td).appendTo(tr);
					$(check).appendTo(td);
					
				});
			}/**/
			function delete1()
			{
				var tr = $(".showtbl tr").not(".showtbl thead tr");
				var array = [];
				var count = 0;
					$.each(tr, function()
						{	
							var td=$("td:last-child",this);
							if($("input",td).is(":checked")){
							array[count] = $(this).attr("mainId");
							count++;
						}
					});
					var len=array.length;//alert(array);
					if (len!=0) 
					{
						var id = JSON.stringify(array);
						//$(".main,header,footer").css("filter","blur(25px)");
						Swal.fire({
						  title: 'ဖျက်မှာသေခြာပါသလား?',
						  text: "အချက်အလက်များပြန်လည်ရရှိတော့မည်မဟုတ်ပါ!",
						  type: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'Delete!'
						}).then((result) =>{if (result.value){
						  	$.post("process.php",{id:id},function(data)
							{
								//alert(data);

									if(data.trim() == "successful")
									{
										Swal.fire(
									      'ဖျက်ပြီးပါပြီ!',
									      'ဖျက်သိမ်းမှုအောင်မြင်ပါသည်။',
									      'success'
								    	)
									}
									datashow();
									$("[name=checkall]").prop("checked", false);
								});
							}
							//$(".main,header,footer").css("filter","blur(0px)");
						});
					}
					else{alart(1,1);}
			}
			function print()
			{
			    var	excel_data="";
			    $("input[name=check]:checked").each(function()
				{
					excel_data+="/"+$(this).parent().parent().attr("mainid");
				});
				//alert(excel_data);
				var page = "process.php?data="+excel_data+"";
				window.location = page;

			}
			function print1()
			{
				var tr=$(".searchtbl tbody tr").not(".searchtbl tbody:nth-child(0)");
				var	excel_data="";
			    $(tr).each(function()
				{
					excel_data+="/"+$(this).attr("main_id");
				});
				alert(excel_data);
				var page = "process.php?data="+excel_data+"";
				window.location = page;
			}
			/*function print()
			{
					$(".showtbl").printThis({
					  debug: false,               // show the iframe for debugging
					  importCSS: true,            // import page CSS
					  importStyle: true,         // import style tags
					  printContainer: true,       // grab outer container as well as the contents of the selector
					  loadCSS: "path/to/my.css",  // path to additional css file - use an array [] for multiple
					  pageTitle: "My Document",   // add title to print page
					  removeInline: false,        // remove all inline styles from print elements
					  printDelay: 333,            // variable print delay
					  header: "<h1>My Document</h1>", // prefix to html
					  footer: "<h1>My Document</h1>", // postfix to html
					  base: false ,               // preserve the BASE tag, or accept a string for the URL
					  formValues: true,           // preserve input/form values
					  canvas: false,              // copy canvas elements (experimental)
					  doctypeString: "...",       // enter a different doctype for older markup
					  removeScripts: false,       // remove script tags from print content
					  copyTagClasses: false       // copy classes from the html & body tag
					});
			}*/
			function chart()
			{	
				var hello="hello";
				$.post("process.php",{hello:hello},function(data){
				//alert(data);
					 var data=JSON.parse(data);
					 console.log(data);
					  var player = [];
				      var score = [];
				      for(var i in data) {
				        player.push(data[i].place);
				        score.push(data[i].place);
				      }
					  //alert (player);
					  //alert(score);
				    	 var chartdata = {
				        labels: score,
				        datasets : [
				          {
				            label: 'တွေ့ဆုံမှုအခြေအနေ',
				            backgroundColor: 'rgba(100, 200,200,1)',
				            borderColor: 'rgba(100, 200, 200, 0.75)',
				            hoverBackgroundColor: 'rgba(100,200,200,0.7)',
				            hoverBorderColor: 'rgba(200, 200, 200, 1)',
				            data: player
				          }
				        ]
				      };
					//alert (chartdata);
				      var ctx = $("#mycanvas");
				      var barGraph = new Chart(ctx, {
				        type: 'bar',
				        data: chartdata
				      });//alert (barGraph);
			    });
			}
			function alart(a,b)
			{
				//$("[name=inputdiv]").hide();
				//$(".main,header,footer").css("filter","blur(15px)");
				$(".cover").fadeIn();
				$("[name=pop]").slideDown(500).css("z-index","5");
				$("[name=alartp]").empty().show();
				var txt2=['Warning State..','Information State..']
				var txt=['update လုပ်လိုသည့် row အားရွေးချယ်ပါ။','delete လုပ်လိုသည့် row အားရွေးချယ်ပါ။','view လုပ်လိုသည့် row အားရွေးချယ်ပါ။',"print လုပ်လိုသည့်  row အားရွေးချယ်ပါ။"];
				var x=txt[a];
				var x2=txt2[b];
				$("[name=alartp]").text(x).css("font-size","15px");
				$("[name=alarttitle] p").text(x2);
			}
			
			function makeedit(tr)
			{
				var td=$("td",tr);
				$.each(td,function()
				{
					var text=$(this).text();
					var index=$(this).index();
					if(index==1)
					{
						$(this).html($("<input type='date'>").css("height","100%").val(text));
					} 

					if(index!=0 && index!=1 && index!=8 )
					{
						$(this).html($("<input type='text'>").css("height","100%").val(text));

					}
					if(index ==8)
					{
						$(this).html($("<button name='editbtn'>save</button>").css({"background":"	#006699","width":"100%","height":"80%","border-radius":"3px;","outline":"none","border-style":"none","color":"white","cursor":"pointer"}));
					}
				});
			}
			function update()
			{
				var tr = $(".showtbl tbody tr");
				var array=[];
				var count=0;
				$.each(tr, function(i,item)
				{	
					var td=$("td:last-child",this);
					if($("input",td).is(":checked"))
					{
						makeedit(item);
					}else{
						//alart(0,1);
					}
					
				});
			}
			function advanceSearch()
			{
				
				var valofdate1=$("[name=date1]").val();
				var valofdate2=$("[name=date2]").val();
				var valofrankto=$("[name=rankto]").val();
				var valofto=$("[name=to]").val();
				var valofrankfrom=$("[name=rankfrom]").val();
				var valoffrom=$("[name=from]").val();
				var valofplace=$("[name=place1]").val();
				if(valofdate1.length<1 && valofdate2.length<1 && valofrankto.length<1 && valofto.length<1 && valofrankfrom.length<1 && valoffrom.length<1 && valofplace<1)
				{
					alert("ရှာလိုသည့်အချက်အလက်အားဖြည့်သွင်းပေးပါ!!!");
					$("searchtbl").remove();	
				}
				else
				{
					var searching="search";
					$.post("process.php",
					{
						d1:valofdate1,
						d2:valofdate2,
						rankto:valofrankto,
						to:valofto,
						rankfrom:valofrankfrom,
						from:valoffrom,
						place1:valofplace,
						searching:searching
					},function(data)
					{
						$(".searchtbldiv").html(data);
					});
				}/**/
			}
			function checkboxshow()
			{
				var checkbox=$(".search_select_table input[type=checkbox]");
				var index="";
				//var room=0;
				$.each(checkbox,function()
				{
					if($(this).prop("checked") == true)
					{
						index=$(this).parent().index();
						if(index==0)
						{
							$("[name=date1]").show();
						}
						if(index==1)
						{
							$("[name=date2]").show();
						}
						if(index==2)
						{
							$("[name=rankto]").show();
						}
						if(index==3)
						{
							$("[name=to]").show();
						}
						if(index==4)
						{
							$("[name=rankfrom]").show();
						}
						if(index==5)
						{
							$("[name=from]").show();
						}
						if(index==6)
						{
							$("[name=place1]").show();
						}
					}
					if($(this).prop("checked") == false)
					{
						index=$(this).parent().index();
						if(index==0)
						{
							$("[name=date1]").hide().val("").val("");
						}
						if(index==1)
						{
							$("[name=date2]").hide().val("");
						}
						if(index==2)
						{
							$("[name=rankto]").hide().val("");
						}
						if(index==3)
						{
							$("[name=to]").hide().val("");
						}
						if(index==4)
						{
							$("[name=rankfrom]").hide().val("");
						}
						if(index==5)
						{
							$("[name=from]").hide().val("");
						}
						if(index==6)
						{
							$("[name=place1]").hide().val("");
						}
					}
				});
			}
		});
	</script>
</head>
<body>
	<div class="wrap">
		<header>
			<img src="co.gif" style="width:40px;height:40px;border-radius:50%;margin:5px 10px;border:1px solid lightgray">
			<span style="position:absolute;margin-top:10px;color:white;font-weight:bold;font-size:18px;">ကာကွယ်ရေးဦးစီးချုပ်ရုံး(ကြည်း)၊ တပ်မတော်စစ်ဘက်ရေးရာလုံခြုံရေးအရာရှိချုပ်ရုံး</span>
			<i class="material-icons" name="close" style="float:right;margin-right:15px;margin-top:10px;color:white;cursor:pointer;">menu</i>
		</header>
		<section>
			<nav>
				<div style="margin:3px;position:absolute;top:15px;width:210px;height:100px;border:1px solid black;background-image: linear-gradient(to right, rgba(255,0,0,0), rgb(77, 121, 255));">
					
				</div>
				<div class="listdiv">
					<i class="material-icons" style="">dashboard</i>
					မူလစာမျက်နှာ
				</div>
				<div class="listdiv">
					<i class="material-icons">edit</i>
					စာရင်းသွင်းရန်
				</div>
				<div class="listdiv">
					<i class="material-icons">search</i>
					ရှာဖွေရန်
				</div>
				<div class="listdiv">
					<i class="material-icons">settings_power</i>
					စနစ်မှထွက်ရန်
				</div>
 			</nav>
			<article>
				<div class="title" style="width:99.3%;height:50px;border-radius:20px;background:#FFFFFF;margin:5px;box-shadow:0.1px 0.1px 5px black">
						
						<i class="material-icons add" style="box-shadow:0.1px 0.1px 5px black;border-radius:50%;cursor:pointer;background-color:lightgray;padding:5px;margin:8px 10px;">add</i>
						<img src="img/content/icon/Excel.ico" style="margin-right:10px;" title="Excel"/>
						<img src="img/content/icon/delete.png" title="delete"/>
						<img src="img/content/icon/update.png" title="update"/>
						<img src="img/content/icon/view1.png" title="view"/>
						<img src="img/content/icon/noti.png" title="noti"/>
						<div style="display: -ms-flexbox;flex-flow: flex-end;
			  		display: flex;float:right;"><input id="myInput" 
						  type="text" placeholder="Search.." ><img src="img/content/icon/search1.png" title="search" /></div>
						
				</div>
				<div style="display:show;width:99.2%;height:90%;border-radius:20px;background:#FFFFFF;margin:5px;box-shadow:0.1px 0.1px 5px black"  class="main">
					<div id="chart-container">
				      <canvas id="mycanvas"></canvas>
				    </div>
					
				</div>
				<div style="display:none;width:99.2%;height:90%;border-radius:20px;background:#FFFFFF;margin:5px;box-shadow:0.1px 0.1px 5px black"  class="search">

					
				</div>
				<div class="insertdiv" style="display:none;padding:5px;width:50%;height:40%;border-radius:20px;background:#FFFFFF;margin:5px;box-shadow:1px 1px 15px black;">
					<table class="inserttbl">
						<tr>
							<td><label>ရက်စွဲ:</label></td>
							<td><input type="date" name="date"></td>
							<td><label>လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်:</label></td>
							<td><input type="text" name="come"></td>
							<datalist id="rank">
							    <option value="ဗိုလ်ချုပ်မှူးကြီး"/>
							    <option value="ဒု-ဗိုလ်ချုပ်မှူးကြီး"/>
							    <option value="ဗိုလ်ချုပ်ကြီး"/>
							    <option value="ဒု-ဗိုလ်ချုပ်ကြီး"/>
							    <option value="ဗိုလ်ချုပ်"/>
							    <option value="ဗိုလ်မှူးချုပ်"/>
							    <option value="ဗိုလ်မှူးကြီး"/>
							    <option value="ဒု-ဗိုလ်မှူးကြီး"/>
							    <option value="ဗိုလ်မှူး"/>
							    <option value="ဗိုလ်ကြီး"/>
						 	 </datalist>
						</tr>
						<tr>
							<td><label>လက်ခံတွေ့ဆုံသူ၏ရာထူး:</label></td>
							<td><input type="text" list="rank" name="rank"></td>
							<td><label>ဧည့်သည်၏ရာထူး:</label></td>
							<td><input type="text" name="rankaccepted"></td>
						</tr>
						<tr>
							<td><label>လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်:</label></td>
							<td><input type="text" name="accept"></td>
							<td><label>နေရာ:</label></td>
							<td><input type="text" name="place"></td>
							</td>
						</tr>

						<tr>
							<td  colspan="4"><textarea style="width:98.3%;height:100%;resize:none" placeholder="မှတ်ချက်" name="note"></textarea></td>
						</tr>
						<tr>
							
							<td colspan="4"><input style="width:30%;float:left" type="file" name="file"><button id="savebtn">သိမ်းဆည်းရန်</button>
						</tr>

					</table>
										
				</div>
				<div class="showdiv" style="display:none;padding:5px;width:98.5%;height:90%;border-radius:20px;background:#FFFFFF;margin:5px;box-shadow:0.1px 0.1px 5px black;overflow-y:scroll;">
					<table class="showtbl">
						<thead>
							<th>စဉ်</th>
							<th>ရက်စွဲ</th>
							<th>လက်ခံတွေ့ဆုံသူ၏ရာထူး</th>
							<th>လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
							<th>ဧည့်သည်၏ရာထူး</th>
							<th>လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
							
							<th>နေရာ</th>
							<th>မှတ်ချက်</th>
							<th>Action<input type="checkbox" name="checkall" style="vertical-align:baseline;"></th>
							
						</thead>
						<tbody>
							
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				<div class="searchdiv" style="display:none;padding:5px;width:98.5%;height:90%;border-radius:20px;background:#FFFFFF;margin:5px;box-shadow:0.1px 0.1px 5px black;overflow-y:scroll;">
					<img src="img/content/icon/Excel.ico" style="float:right;width:30px;height:30px;border-radius:10px;margin:20px 5px;display:inline-block;cursor:pointer;" title="Excel1"/>
					<table class="search_select_table">
						<tr>
							<td style="border-style:none;"><input type="checkbox" id="datestart" style="vertical-align:middle">ရက်စွဲ(မှ)</td>
							<td style="border-style:none;"><input type="checkbox" id="dateend" style="vertical-align:middle">ရက်စွဲ(ထိ)</td>
							<td style="border-style:none;"><input type="checkbox" id="rank" style="vertical-align:middle">လက်ခံတွေ့ဆုံသူ၏ရာထူး</td>
							<td style="border-style:none;"><input type="checkbox" id="rankto" style="vertical-align:middle">လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်</td>
							<td style="border-style:none;"><input type="checkbox" id="comerank" style="vertical-align:middle">ဧည့်သည်၏ရာထူး</td>
							<td style="border-style:none;width:180px;"><input type="checkbox" id="come" style="vertical-align:middle">လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်</td>
							<td style="border-style:none;"><input type="checkbox" id="place" style="vertical-align:middle">နေရာ</td>
							
						</tr>
						<tr>
							<td style="border-style:none;"><input type="date" name="date1"  style="border-style:none;border-bottom:1px solid gray;"></td>
							<td style="border-style:none;"><input type="date" name="date2" style="border-style:none;border-bottom:1px solid gray;outline-style:none;"></td>
							<td style="border-style:none;"><input type="text" name="rankto" placeholder="လက်ခံတွေ့ဆုံသူ၏ရာထူး" style="border-style:none;border-bottom:1px solid gray;outline-style:none;"></td>
							<td style="border-style:none;"><input type="text" name="to" placeholder="လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်" style="border-style:none;border-bottom:1px solid gray;outline-style:none;"></td>
							<td style="border-style:none;"><input type="text" name="rankfrom" placeholder="ဧည့်သည်၏ရာထူး" style="border-style:none;border-bottom:1px solid gray;outline-style:none;"></td>
							<td style="border-style:none;"><input type="text" name="from" placeholder="လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်" style="border-style:none;border-bottom:1px solid gray;outline-style:none;"></td>
							<td style="border-style:none;"><input type="text" name="place1" placeholder="နေရာ" style="border-style:none;border-bottom:1px solid gray;outline-style:none;"></td>
						</tr>
						<tr>
							<td style="border-style:none;">
								<span class="searchBtn" style="border-radius:20px;cursor:pointer;padding:5px 8px;background:rgba(15,100,105,0.5);width:100%;height:100%;color:white">Search..</span>
							</td>
							
						</tr>
					</table>
					<hr style="border:0.5px solid lightgray;">
					<div class="searchtbldiv" style="padding-bottom:0px;border:0.1px solid lightgray;height:80%;">
						
					</div>
					
				</div>
			</article>
		</section>

		<footer></footer>
		
	</div>
	<div class="cover" style="display:none;width:100%;background-color:rgba(0,0,0,0.6);height:100%;position:absolute;top:0;">
	</div>
	<div name="pop" style="display:none;">
		<div name="alarttitle">
			<p style="float:left;color:lightgray;"></p>
			<span name="alartspan">x</span>
		</div>
		<div name="inputdiv" style="display:none">
			<label style="float:left;width:40%;margin-top:20px;padding-left:5px;"></label><input type="text" id="val" name="inputcountry">
			<span id="newsave" style="cursor:pointer;background:#0092d8;border-radius:3px;padding:5px 10px;color:lightgray;">save</span>
		</div>
		<p name="alartp" style="display:none"></p>
	</div>
</body>
</html>