(function($){
	$(function(){
		
		var lastVoice;
		setUpResponsiveAcessibility(function(err, res){
			if(!err){
				$('*').on('mouseover', function(){
					var resp = $(this).data('rvcontext');

					if(resp){
						$(this).css("display","block");
						$(this).css("border","1px solid red");

						if(lastVoice !== resp){
							res.speak(resp);
							lastVoice = resp;
						}
					}
				});

				$('*').on('mouseout', function(){
					$(this).css("border","none");
				});

			}
		});

		function setUpResponsiveAcessibility(cb){
			//Setup: Verifica se a lib esta carregada
			if(responsiveVoice && responsiveVoice !== undefined){
				responsiveVoice.setDefaultVoice("Brazilian Portuguese Female");
				cb(null, responsiveVoice);
			}else{
				cb(new Error("Não Suportado"), null);
			}
		}

	});
})(jQuery);