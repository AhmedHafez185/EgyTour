/*Start Carousel*/
/*Time for swap photos*/
$(document).ready(function(){
	//start progress bar 
	$("#progressShow").on("click",function(){
			$(".progressBar").fadeToggle();
	});

// plan trip
function getPlan(page,func,syn)
{
		alert(page);
}

	//google map api

 function initMap() {
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          scrollwheel: false,
          zoom: 8
        });
      }
      
   
    // City services 
    	$(".ServiceCity .cityServiceType li").on("click", function () {
        	$(".ServiceCity .Service_Box").fadeOut(30);
        	$("#Hotel").fadeIn(400);
    });

	// slider
	$('.carousel').carousel({
		interval:4000
	});
	$('#myCarousel').carousel({
  interval: 40000
 });
	/*Plan check for login */
	var values = $('#planLogin').val();
	if(values==="FALSE")
		alert("Sorry, You should login to be able to plan your trip");
 /*city activity slider */
$('.ACtivityPlace .carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  if (next.next().length>0) {
 
      next.next().children(':first-child').clone().appendTo($(this)).addClass('rightest');
      
  }
  else {
      $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
     
  }
});
	// Category_BOx
	$(".log input").on('focus', function () {
  		$('.alert').fadeOut(600);
    });
		// Rating system 
	var average = $('.ratingAverage').attr('data-average');
	function avaliacao(average){
		average = (Number(average)*20);
		$('.bg').css('width', 0);		
		$('.barra .bg').animate({width:average+'%'}, 500);
	}
	
	avaliacao(average);
	$('.star').on('mouseover', function(){
		var indexAtual = $('.star').index(this);
		for(var i=0; i<= indexAtual; i++){
			$('.star:eq('+i+')').addClass('full');
		}
	});
	$('.star').on('mouseout', function(){
		$('.star').removeClass('full');
	});

	$('.star').on('click', function(){
		var x =parseInt("0"+$(".votos span").text());
		var rate1 = parseFloat($(this).attr('data-vote'));
		var newRate = parseFloat($(".votRate").text());
		var xRate=(rate1+x*newRate)/(x+1);
		xRate=xRate.toFixed(1);
		x=x+1;
		$(".votos span").text(x);
		$(".votRate").text(xRate);
		avaliacao(xRate);
		var type = $('.PlaceType').val();
		var sid = $('.article').attr('data-id');
		var rate = $(this).attr('data-vote');
		$.get('ratingSystem.php', 
			{
				SID: sid, 
				Rate: rate, 
				Type: type
			}, 
			function(retorno)
			{
			avaliacao(retorno.average);
			$('.votos span').html(retorno.votes);
		}, 'jSON');

	});
	//End of Rating System 

});
	function getAjax(page,func,syn)
 {
 	var user;
 	var textVal= $('#comment-post-text').val();
 	var sid= $('.sid').val();
 	var PlaceType= $('.PlaceType').val();
 	 page+='&comm='+textVal+"&sid="+sid+"&PlaceType="+PlaceType;
 	var xmlhttp;
 	if(window.XMLHttpRequest)//for modern browsers
 	{
 		xmlhttp=new XMLHttpRequest();
 	}
 	else //for old browsers 
 	{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 	}
 	xmlhttp.onreadystatechange=function()
 	{
 		if(xmlhttp.readyState==0 &xmlhttp.status==200)
 		{
 			document.getElementById('Myajax').innerHTML="request not intialized yet";
 		}
 		else if(xmlhttp.readyState==1 &xmlhttp.status==200)
 		{
 			document.getElementById('Myajax').innerHTML="conncting server now";
 		}
 		else if(xmlhttp.readyState==2 &xmlhttp.status==200)
 		{
 			document.getElementById('Myajax').innerHTML="connected to server successfully";
 		}
 		else if(xmlhttp.readyState==3 &xmlhttp.status==200)
 		{
 			document.getElementById('Myajax').innerHTML="treating with request now";
 			 			alert("Commenting Done");

 		}
 		else if(xmlhttp.readyState==4 &xmlhttp.status==200)
 		{
 			user=xmlhttp.responseText;
 		
 		}
 	}
 	xmlhttp.open("GET",page,syn);
    xmlhttp.send();
    var textVal= $('#comment-post-text').val();
		// ajax callback process
		if(textVal.length > 0)

		{
			var arr=user.split('#');
			user=arr[0];
			var img=arr[1];
			 fillComment(textVal,user,img);

		}
		else
		{
			$('.comment-insert-container').css("border","1px solid #ff0000");
			alert("You should Type text to post");
		}
 }
 
 

 function myfun(mess)
 {
 

 }

 function fillComment(mess,user,img)
 {
 		//	echo $_SESSION['username'] .'#data/uploaded/users/default.png';

  //	$(".comment-text").text(mess);
  			var t='';
			t+='<li class="comment-holder" id="_1">';
			t+='<div class="user-img">';
			t+='<img src="'+img+'" class="user-img-pic"/>';
			t+='</div>	<div class="comment-body">';
			t+='<h3 class="username-field">';
			t+='<a href="#">'+user+'</a></h3>';
			t+='<div class="comment-text">';
			t+=mess;
			t+='</div></div>';
			t+='<div class="comment-button-holder">';
			t+='<ul>';
			t+='<li class="delete-btn">X</li>';
			t+='</ul>';
			t+='</div>';
			t+='</li>';
			$('.comment-holder-ul').prepend(t);
 }
 /* Login and SignUp Forms  */
 $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
    	      label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }



});


