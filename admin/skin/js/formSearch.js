formSearch = {
	init : function(dataTable){

		var formSearchSelect      = document.getElementById('formSearch_select'),
		formSearchSearchInput = document.getElementById('formSearch_searchInput'),
		formSearchSubmit = document.getElementById('formSearch_submit');

		if(formSearchSelect){
			formSearchSelect.addEventListener("change", function(){
				var filtro = {
					filtro : this.value,
					valor  : formSearchSearchInput.value
				};
				if(filtro.valor){
					dataTable.fetchTable(filtro);
				}else{
					dataTable.fetchTable(null);
				}
				console.log(filtro);
			});
		}
		formSearchSubmit.addEventListener("click", function(){
			var filtro = {
				valor  : formSearchSearchInput.value
			};
			if(formSearchSelect){
				filtro.filtro = formSearchSelect.value;
			}
			console.log(filtro);
			if(filtro.valor){
				dataTable.fetchTable(filtro);
			}else{
				dataTable.fetchTable(null);
			}
		});

		formSearchSearchInput.addEventListener("keyup", function(){
			var filtro = {
				valor  : this.value
			};
			if(formSearchSelect){
				filtro.filtro = formSearchSelect.value;
			}
			console.log(filtro);
			if(filtro.valor){
				dataTable.fetchTable(filtro);
			}else{
				dataTable.fetchTable(null);
			}
		});


		
	}
};