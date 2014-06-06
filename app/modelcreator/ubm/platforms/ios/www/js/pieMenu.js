function PieMenuInit(){		
				$('#overlayTest').PieMenu({
					'starting_angel':35,
					'angel_difference' : 270,
					'radius':50,
				});			
			}
			$(function() {          
				$("#submit_button").click(function() {reset(); }); 
				//$( "#overlayTest" ).draggable();
				PieMenuInit();
				
			});
			function reset(){
				if($(".menu_button").hasClass('btn-rotate'))
				$(".menu_button").trigger('click');
				
				$("#info").fadeIn("slow").fadeOut("slow");
				PieMenuInit();
			}