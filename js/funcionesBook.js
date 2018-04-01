	function deleteBook(idBook){
		var parametros = {
			"idBook" : idBook
		};
		$.ajax({
			data:  parametros,
			url:   'Controllers/CtrlDeleteBook.php',
			type:  'post',
			beforeSend: function () {},
			success:  function (response) {
				location.reload();
			}
		});
	}

	function updateBook(idSubida, activo){
		var parametros = {
			"idSubida" : idSubida,
			"activo" : activo
		};
		$.ajax({
			data:  parametros,
			url:   'Controllers/CtrlActivateBook.php',
			type:  'post',
			beforeSend: function () {},
			success:  function (response) {
				location.reload();
			}
		});
	}

	function infoBook(idBook){
		var parametros = {
			"idBook" : idBook
		};
		$.ajax({
			data:  parametros,
			url:   'Controllers/CtrlInfoBook.php',
			type:  'post',
			beforeSend: function () {},
			success:  function (response) {
				
			}
		});
	}