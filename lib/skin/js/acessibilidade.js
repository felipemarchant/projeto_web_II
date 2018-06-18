(function($){
	$(function(){

		setTimeout(function	(){
			setUpResponsiveAcessibility(function(err, res){
				if(!err){
					res.speak('Clique no botão ATIVAR para ativar a acessibilidade e ouvir o conteúdo da tela.');
				}
			});
		},1000);
		
		var lastVoice;
		$('#modal_help_acess').modal('show');

		$('#btn_turn_on_voice').on('click', function(){
			$('#modal_help_acess').modal('hide');		
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