<?php session_start(); ?>
@if(Session::has('message')) 
  <script type="text/javascript">
    alert('<?php echo Session::get('message'); ?>');
  </script>
@endif
<!Doctype <!DOCTYPE html>
<html>
<head>
	
	<style type="text/css">
		@font-face {
	    font-family: 'THSarabunNew';
	    src: url('thsarabunnew-webfont.eot');
	    src: url('thsarabunnew-webfont.eot?#iefix') format('embedded-opentype'),
	         url('thsarabunnew-webfont.woff') format('woff'),
	         url('thsarabunnew-webfont.ttf') format('truetype');
	    font-weight: normal;
	    font-style: normal;
	    font-size: 19px !important;
		}


		 body {
		      font: 400 15px 'THSarabunNew', sans-serif;
		      line-height: 1.8;
		      color: #818181;
		  }
		  h2 {
		      font-size: 24px;
		      text-transform: uppercase;
		      color: #303030;
		      font-weight: 600;
		      margin-bottom: 30px;
		  }
		  h4 {
		      font-size: 19px;
		      line-height: 1.375em;
		      color: #303030;
		      font-weight: 400;
		      margin-bottom: 30px;
		  }  
		  #mapid {
		  	margin: 0%;
			height: 100%;
			background-color: white;
			width: 100%;
			display: inline-block;
			/*float: left;*/
		}
		#sideid {
		  	margin: 0%;
			height: 100%;
			background-color: white;
			width: 35%;
			display: none;
			float: right;
			border-radius: 10px;
		}
		  .jumbotron {
		      background-color: #f4511e;
		      color: #fff;
		      padding: 100px 25px;
		      font-family: 'Kanit', cursive;
		  }

		  .container-fluid {
		      padding: 60px 50px;
		  }
		  .bg-grey {
		      background-color: #f6f6f6;
		  }
		  .logo-small {
		      color: #f4511e;
		      font-size: 50px;
		  }
		  .logo {
		      color: #f4511e;
		      font-size: 200px;
		  }
		  .thumbnail {
		      padding: 0 0 15px 0;
		      border: none;
		      border-radius: 0;
		  }
		  .thumbnail img {
		      width: 100%;
		      height: 100%;
		      margin-bottom: 10px;
		  }
		  .carousel-control.right, .carousel-control.left {
		      background-image: none;
		      color: #f4511e;
		  }
		  .carousel-indicators li {
		      border-color: #f4511e;
		  }
		  .carousel-indicators li.active {
		      background-color: #f4511e;
		  }
		  .item h4 {
		      font-size: 19px;
		      line-height: 1.375em;
		      font-weight: 400;
		      font-style: italic;
		      margin: 70px 0;
		  }
		  .item span {
		      font-style: normal;
		  }
		  .panel {
		      border: 1px solid #f4511e; 
		      border-radius:0 !important;
		      transition: box-shadow 0.5s;
		  }
		  .panel:hover {
		      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
		  }
		  .panel-footer .btn:hover {
		      border: 1px solid #f4511e;
		      background-color: #fff !important;
		      color: #f4511e;
		  }
		  .panel-heading {
		      color: #fff !important;
		      background-color: #f4511e !important;
		      padding: 25px;
		      border-bottom: 1px solid transparent;
		      border-top-left-radius: 0px;
		      border-top-right-radius: 0px;
		      border-bottom-left-radius: 0px;
		      border-bottom-right-radius: 0px;
		  }
		  .panel-footer {
		      background-color: white !important;
		  }
		  .panel-footer h3 {
		      font-size: 32px;
		  }
		  .panel-footer h4 {
		      color: #aaa;
		      font-size: 14px;
		  }
		  .panel-footer .btn {
		      margin: 15px 0;
		      background-color: #f4511e;
		      color: #fff;
		  }
		  .navbar {
		      margin-bottom: 0;
		      background-color: #f4511e;
		      z-index: 9999;
		      border: 0;
		      font-size: 12px !important;
		      line-height: 1.42857143 !important;
		      letter-spacing: 4px;
		      border-radius: 0;
		      font-family: 'Kanit', cursive;
		  }
		  .navbar li a, .navbar .navbar-brand {
		      color: #fff !important;
		  }
		  .navbar-nav li a:hover, .navbar-nav li.active a {
		      color: #f4511e !important;
		      background-color: #fff !important;
		  }
		  .navbar-default .navbar-toggle {
		      border-color: transparent;
		      color: #fff !important;
		  }
		  footer .glyphicon {
		      font-size: 20px;
		      margin-bottom: 20px;
		      color: #f4511e;
		  }
		  .slideanim {visibility:hidden;}
		  .slide {
		      animation-name: slide;
		      -webkit-animation-name: slide;
		      animation-duration: 1s;
		      -webkit-animation-duration: 1s;
		      visibility: visible;
		  }
		  @keyframes slide {
		    0% {
		      opacity: 0;
		      transform: translateY(70%);
		    } 
		    100% {
		      opacity: 1;
		      transform: translateY(0%);
		    }
		  }
		  @-webkit-keyframes slide {
		    0% {
		      opacity: 0;
		      -webkit-transform: translateY(70%);
		    } 
		    100% {
		      opacity: 1;
		      -webkit-transform: translateY(0%);
		    }
		  }
		  @media screen and (max-width: 768px) {
		    .col-sm-4 {
		      text-align: center;
		      margin: 25px 0;
		    }
		    .btn-lg {
		        width: 100%;
		        margin-bottom: 35px;
		    }
		  }
		  @media screen and (max-width: 480px) {
		    .logo {
		        font-size: 150px;
		    }
		  }


		  	.accordion{
		  		width:500px; margin: 0 auto;
		  	}
			.accordion-toggle{
				border-bottom: 1px solid #cccccc;
				cursor: pointer;
				margin: 0;
				padding: 10px 0;
				position: relative;
			}
			.accordion-toggle.active:after{
				content:"";position:absolute;
				right:0;top:17px;
				width:0;height:0;
				border-bottom:5px solid #f00;
				border-left:5px solid rgba(0,0,0,0);
				border-right:5px solid rgba(0,0,0,0);
			}
			.accordion-toggle:before{
				content:"";position:absolute;
				right:0;top:17px;width:0;
				height:0;border-top:5px solid #000;
				border-left:5px solid rgba(0,0,0,0);
				border-right:5px solid rgba(0,0,0,0);
			}
			.accordion-toggle.active:before{
				display:none;
			}
			.accordion-content {
				display: none;
			}
			.accordion-toggle.active {
				color: #ff0000;
			}
			.sizeofh1{
				text-shadow: 4px 0 black, 0 3px black,
      			3px 0 black, 0 4px black;
      		}

      		#five_per{
				width: 5%;
			}
			#ten_per{
				width: 10%;
			}

			.hideme{
			    border: 0;
			    font-weight: normal;
			    font-family: 'THSarabunNew', sans-serif;
			    font-size: 15px;
			    height: 0.7cm;
			}

			/*.verticalTableHeader{
				-ms-transform: rotate(-90deg); 
				-webkit-transform: rotate(-90deg); 
				transform: rotate(-90deg);
			}*/

			th.rotate {
/*				transform: 
			    rotate(-90deg);*/
			  white-space: nowrap;
			}

/*			th.rotate > div {
			  transform: 
			    rotate(-90deg);
			}*/


			table { width: 100%; }

			#piechart{
				/*border: 1px solid black ;*/
			}

			#tree_num{
				width: 1em;
			}
			
      		footer {
			    position: fixed;
			    height: 100px;
			    bottom: 0;
			    width: 100%;
			}


	</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- responsive -->
	

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	
	<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>

	<script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>

	<title>My Tree</title>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	


	<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script> -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>


      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.1.0/dist/leaflet.css"
   integrity="sha512-wcw6ts8Anuw10Mzh9Ytw4pylW8+NAD4ch3lqm9lzAsTxg0GFeJgoAtxuCLREZSC5lUXdVyo/7yfsqFjQ4S+aKw=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.1.0/dist/leaflet.js"
   integrity="sha512-mNqn2Wg7tSToJhvHcqfzLMU6J4mkOImSPTxVZAdo+lcPlk+GhZmYgACEe0x35K7YzW1zJ7XyJV/TT1MrdXvMcA=="
   crossorigin=""></script>

	<script
	  src="https://code.jquery.com/jquery-3.1.1.min.js"
	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.js"></script>

  <script src="https://unpkg.com/esri-leaflet@2.1.1/dist/esri-leaflet.js"
      integrity="sha512-ECQqaYZke9cSdqlFG08zSkudgrdF6I1d8ViSa7I3VIszJyVqw4ng1G8sehEXlumdMnFYfzY0tMgdQa4WCs9IUw=="
      crossorigin=""></script>

  <link rel="stylesheet" href="{{asset('/css/L.Control.Locate.min.css')}}" />

<script src="{{asset('/js/L.Control.Locate.min.js')}}" charset="utf-8"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<script src="{{asset('Leaflet.Dialog.js')}}"></script>
   <script src="{{asset('Leaflet.Control.Custom.js')}}"></script>
   <link rel="stylesheet" type="text/css" href="{{asset('Leaflet.Dialog.css')}}">


</head>
<!-- <body style="background-image: url('{{asset('bg7.jpg')}}') !important;"> -->
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	@yield('content')


	<!-- ................       dropdown     ........................... -->
<script >
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>

<!-- /* ................            ...........................*/ -->
	<script>
		$(document).ready(function() {
	$('.accordion').find('.accordion-toggle').click(function() {
		$(this).next().slideToggle('600');
		$(".accordion-content").not($(this).next()).slideUp('600');
	});
	$('.accordion-toggle').on('click', function() {
		$(this).toggleClass('active').siblings().removeClass('active');
	});
});
	
	</script>


	<script>
	$(document).on('show','.accordion', function (e) {
         //$('.accordion-heading i').toggleClass(' ');
         $(e.target).prev('.accordion-heading').addClass('accordion-opened');
    });
    
    $(document).on('hide','.accordion', function (e) {
        $(this).find('.accordion-heading').not($(e.target)).removeClass('accordion-opened');
        //$('.accordion-heading i').toggleClass('fa-chevron-right fa-chevron-down');
    });
	</script>


<script type="text/javascript">
  function hidefunc(){
    // console.log('1');
    $("#myNavbar").attr("aria-expanded","false");
    $("#myNavbar").attr("class","navbar-collapse collapse");
  }
</script>

	<script>
	$(document).ready(function(){
	  // Add smooth scrolling to all links in navbar + footer link
	  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
	    // Make sure this.hash has a value before overriding default behavior
	    if (this.hash !== "") {
	      // Prevent default anchor click behavior
	      event.preventDefault();

	      // Store hash
	      var hash = this.hash;

	      // Using jQuery's animate() method to add smooth page scroll
	      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
	      $('html, body').animate({
	        scrollTop: $(hash).offset().top
	      }, 900, function(){
	   
	        // Add hash (#) to URL when done scrolling (default click behavior)
	        window.location.hash = hash;
	      });
	    } // End if
	  });
	  
	  $(window).scroll(function() {
	    $(".slideanim").each(function(){
	      var pos = $(this).offset().top;

	      var winTop = $(window).scrollTop();
	        if (pos < winTop + 600) {
	          $(this).addClass("slide");
	        }
	    });
	  });
	})
	</script>


	
	<!-- Photo -->
	<script type="text/javascript">
		function readURLTruck(input) {

				    if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('#Truck').attr('src', e.target.result);
				            document.getElementById("Truck").style.display = "inline";
				        }

				        reader.readAsDataURL(input.files[0]);
				    }
				}
		function readURLLeft(input) {

				    if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('#Left').attr('src', e.target.result);
				            document.getElementById("Left").style.display = "inline";
				        }

				        reader.readAsDataURL(input.files[0]);
				    }
				}
		function readURLTop(input) {

				    if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('#Top').attr('src', e.target.result);
				            document.getElementById("Top").style.display = "inline";
				        }

				        reader.readAsDataURL(input.files[0]);
				    }
				}
		function readURLRoot(input) {

				    if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('#Root').attr('src', e.target.result);
				            document.getElementById("Root").style.display = "inline";
				        }

				        reader.readAsDataURL(input.files[0]);
				    }
				}
		function readURLFull(input) {

				    if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('#Full').attr('src', e.target.result);
				            document.getElementById("Full").style.display = "inline";
				        }

				        reader.readAsDataURL(input.files[0]);
				    }
				}
		function readURLProfile(input) {

				    if (input.files && input.files[0]) {
				        var reader = new FileReader();

				        reader.onload = function (e) {
				            $('#picProfiles').attr('src', e.target.result);
				            document.getElementById("picProfiles").style.display = "inline";
				        }

				        reader.readAsDataURL(input.files[0]);
				    }
				}
				$("#imgTruck").change(function(){
				    readURLTruck(this);
				});
				$("#imgLeft").change(function(){
				    readURLLeft(this);
				});
				$("#imgTop").change(function(){
				    readURLTop(this);
				});
				$("#imgRoot").change(function(){
				    readURLRoot(this);
				});
				$("#imgFull").change(function(){
				    readURLFull(this);
				});

				///Photo profile
				$("#selectedFile").change(function(){
				    readURLProfile(this);
				});
	</script>
	 <!-- ................      location     ........................... -->
	<script>
		function showModals(){
			$('.ui.modal')
			  .modal('show')
			;
		}

		function getLocation() {
		    if (navigator.geolocation) {
		        navigator.geolocation.getCurrentPosition(showPosition, showError);
		    } else { 
		    	alert("Geolocation is not supported by this browser.");
		        document.getElementById("demo").value = "Geolocation is not supported by this browser.";
		    }
		}

		function showPosition(position) {
		    document.getElementById("Tree_lat").value =  position.coords.latitude;
		    document.getElementById("Tree_long").value =  position.coords.longitude;
		}

		function showError(error) {
		    switch(error.code) {
		        case error.PERMISSION_DENIED:
		            document.getElementById("demo").value = "User denied the request for Geolocation.";
		            alert("User denied the request for Geolocation.");
		            break;
		        case error.POSITION_UNAVAILABLE:
		            document.getElementById("demo").value = "Location information is unavailable.";
		            alert("Location information is unavailable.");
		            break;
		        case error.TIMEOUT:
		            document.getElementById("demo").value = "The request to get user location timed out.";
		            alert("The request to get user location timed out.");
		            break;
		        case error.UNKNOWN_ERROR:
		            document.getElementById("demo").value = "An unknown error occurred.";
		            alert("An unknown error occurred.");
		            break;
		    }
		}
	</script>
	


	


    <script type="text/javascript">
    	
        var y = 0;
        
        $("#add_edit").click(function(event){
              event.preventDefault();

              var data_edit = '<div class="divedit" data-id="'+y+'">'+'<span id="edit_span">วิธีแก้ไข</span>'+'<input type="text" class="form-control" name="Solution1">'+'<span>ปัญหาที่อาจหลงเหลือ</span>'+'<input type="text" class="form-control" name="problem2">'+'<br>'+'<button class="ui red button" id="delete_edit" data-id="'+y+'">ลบ</button>'+'</div>';

              $('#edit_div').append(data_edit);    
              y++;

		});
              
        $(document).on('click', '#delete_edit', function() {
        	var divID = $(this).data('id');
      
	     $('.divedit[data-id="'+divID+'"]').remove();

	    });
    </script>


   
<!--     <script type="text/javascript">
       
                      $(document).ready(function(){
                      	$('body').mouseenter(function(){
                      		

                      	  $.ajax({
                          type: 'post',
                          url: '/page_reload',
                          data: {
                            '_token': $('input[name=_token]').val(),
                
                          },
                          success: function(data) {
                            
                            // alert(data['Botanical_Name']);
                            alert("เกิดข้อผิดพลาด กรุณาล็อกอินอีกครั้ง");
                            // console.log(data);
                            // alert('ยืนยันสำเร็จ');
                            // location.reload();

                      	})
                      });
   	</script>    -->
          

</body>
</html>