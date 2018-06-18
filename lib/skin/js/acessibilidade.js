	(function($){
		$(function(){

			var isAc = parseInt(getCookie('cookie_is_acessiblidade'));
			if(!isAc){
				setTimeout(function	(){
					setUpResponsiveAcessibility(function(err, res){
						if(!err){
							res.speak('Acessibilidade.Clique no botão ATIVAR para ativar a acessibilidade e ouvir o conteúdo da tela. Para aumentar ou diminuir o texto pressione contro mais ou contro menos. Aperte o botão volume caso necessário. Ou se não clique em fechar');
						}
						$("#btn_turn_on_voice, #btn_turn_off_voice").on('mouseover',function	(){
							var resp = $(this).data('rvcontext');

							if(resp){
								res.speak(resp);
							}
						});
					});
				},1000);
				$('#modal_help_acess').modal('show');
			}else if(isAc === 1){
				setUpResponsiveAcessibility(acessibilityAction);
			}

			var lastVoice;
			$('#btn_turn_on_voice').on('click', function(){
				$('#modal_help_acess').modal('hide');
				setCookie('cookie_is_acessiblidade',1);	
				setUpResponsiveAcessibility(acessibilityAction);
			});
			$('#btn_turn_off_voice').on('click', function(){
				setCookie('cookie_is_acessiblidade',2);
				location.reload();
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

			function acessibilityAction(err,res){
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
			}
			function setCookie(cname, cvalue, exdays) {
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+ d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}
			function getCookie(cname) {
				var name = cname + "=";
				var decodedCookie = decodeURIComponent(document.cookie);
				var ca = decodedCookie.split(';');
				for(var i = 0; i <ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}

		});
	})(jQuery);