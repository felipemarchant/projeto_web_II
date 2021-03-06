<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="lib/skin/css/bootstrap.min.css">
      <link rel="stylesheet" href="skin/css/style.css">
      <title>Portal UNG</title>
   </head>
   <body id="portal">
            <div class="modal" id="modal_help_acess" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"><b>Acessibilidade<b></h5>
                </div>
                <div class="modal-body">
                 <h4 >Clique o botão ATIVAR para ativar a acessibilidade e ouvir o conteúdo da tela.
                 </h4>
                 <p style="color:red;">Para aumentar ou diminuir o texto pressione ctrl +/ctrl-.</p>
                 <p style="color:red;">Aperte o botão volume caso necessário.</p>
              </div>
              <div class="modal-footer">
                 <button data-rvContext="ATIVAR" type="button" id="btn_turn_on_voice" class="btn btn-primary btn-lg">ATIVAR</button>
                 <button data-rvContext="Fechar" type="button" class="btn btn-secondary" id="btn_turn_off_voice">Fechar</button>
              </div>
           </div>
        </div>
      </div>
      <div  class="container-fluid all">
         <div class="row">
            <div data-rvContext="Imagem. UNG" class="slide-all col-sm-9 d-none d-sm-block"></div>
            <div class="menu-all col-sm">
               <a data-rvContext="Imagem. UNG. Grupo Ser. fazendo o melhor por você" href="#">
               <img class="menu-logo img-fluid" src="skin/images/logo.png" alt="Logo" />
               </a>
               <a data-rvContext="LINK Graduação" href="#" class="menu-item">
                  <h2 class="title">Graduação</h2>
                  <p class="text">Presencial, semipresencial e a distância</p>
               </a>
               <hr/>
               <a data-rvContext="LINK Especialização e M B A Presencial e a distância" href="#" class="menu-item">
                  <h2 class="title">Especialização e MBA</h2>
                  <p class="text">Presencial e a distância</p>
               </a>
               <hr/>
               <a data-rvContext="LINK Mestrado e Doutorado" href="#" class="menu-item">
                  <h2 class="title">Mestrado e Doutorado</h2>
               </a>
               <hr/>
               <a data-rvContext="LINK Técnico presencial e a distância" href="#" class="menu-item">
                  <h2 class="title">Técnico</h2>
                  <p class="text">Presencial e a distância</p>
               </a>
               <hr/>
               <a data-rvContext="LINK Congressos presencial, semipresencial e a distância" href="#" class="menu-item">
                  <h2 class="title">Congressos</h2>
                  <p class="text">Presencial, semipresencial e a distância</p>
               </a>
               <hr/>
               <a data-rvContext="LINK Concurso à distância" href="#" class="menu-item">
                  <h2 class="title">Concurso</h2>
                  <p class="text">A distância</p>
               </a>
               <hr/>
               <a data-rvContext="LINK Site Institucional" href="#" class="menu-item">
                  <h2 class="title">Site Institucional</h2>
               </a>
               <hr/>
               <a data-rvContext="LINK LOGIN" href="admin/login.php" class="menu-item">
                  <h2 class="title" style="color:red;">LOGIN</h2>
               </a>
               <hr/>
               <a data-rvContext="LINK Professor A distância" href="admin/" class="menu-item">
                  <h2 class="title">Professor</h2>
                  <p class="text">a distância</p>
               </a>
               <hr/>
               <div class="groupfix">
	               <div class="row-left">
	                  <a data-rvContext="LINK Idiomas" class="btn-block" href="#">Idiomas</a>
	                  <a data-rvContext="LINK Profissionalizantes" class="btn-block" href="#">Profissionalizantes</a>
                       <div data-rvContext="Desenvolvido por: ianca Liessi" class="col-sm small text-center">Bianca Liessi</div>
		               <div data-rvContext="Desenvolvido por: Felipe Marchant Fernandes Soares" class="col-sm small text-center"><a style="color:blue;" href="https://github.com/felipemarchant"><b>Felipe Marchant F. Soares</b></a></div>
		               <div data-rvContext="Desenvolvido por: Leandro Sanson" class="col-sm small text-center">Leandro M. Sanson</div>
	               </div>
	               <div class="row-right">
	                  <a data-rvContext="LINK Ser educacional" class="btn-block" href="#">Ser educacional</a>
	                  <a data-rvContext="LINK C.R.A" class="btn-block" href="#">CRA</a>
              		  <div data-rvContext="Desenvolvido por: Rodrigo Matsuura" class="col-sm small text-center">Rodrigo Matsuura</div>
	               </div>
               </div>
               <div class="col-sm small text-center">Projeto Web de Acessibilidade</div>
            </div>
         </div>
      </div>
      <script src="lib/skin/js/jquery.min.js"></script>
      <script src="lib/skin/js/bootstrap.bundle.min.js"></script>
      <script src="lib/skin/js/responsivevoice.js"></script>
      <script src="lib/skin/js/acessibilidade.js"></script>
   </body>
</html>