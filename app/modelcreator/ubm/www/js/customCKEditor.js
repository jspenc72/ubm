var editor, html = '';
	
			function createEditor() {
				showLoader();
				if ( editor )
					return;
				// Create a new editor inside the <div id="editor">, setting its value to html
				var config = {
					extraPlugins: 'xmas',
					xmas_wishes: '<p class="big"><strong>Customized</strong> user experiences are a </br><strong>big</strong> deal!!!</p>',			//Customize the greeting card plugin for the editor.
					xmas_signature: 'The UBM Team',
					xmas_link: 'www.universalbusinessmodel.com/web',		
					contentsCss: 'css/jquery.mobile-1.4.0.min.css'		
				};
				editor = CKEDITOR.appendTo( 'editor', config, html );
				setTimeout(function() {
					hideLoader();
				}, 500);				
			}
			function removeEditor() {
				if ( !editor )
					return;
	
				// Retrieve the editor contents. In an Ajax application, this data would be
				// sent to the server or used in any other way.
				document.getElementById( 'editorcontents' ).innerHTML = html = editor.getData();
				document.getElementById( 'editedcontents' ).style.display = '';
	
				// Destroy the editor.
				editor.destroy();
				editor = null;
			}
			function saveEditorContentsasaUBMProduct(){												
			//1. check to see if the editor has any contents to save.
				if ( CKEDITOR.instances.editor1.getData() == '' ){
			//2. If the editor doesnt contain anything, alert the user that noth
				    alert( 'A UBM product must contain at least a single alphanumeric character before it can be saved. The product currently contains nothing, add something and try saving it again.' );
				}else{
					var editor_data = CKEDITOR.instances.editor1.getData();
					alert(editor_data);
					$.getJSON('http://api.universalbusinessmodel.com/ubm_productreationsuite_saveProduct.php?callback=?', {//JSONP Request to Open Items Page setup tables
						username : window.username,
						activeModelUUID : window.activeModelUUID,
						productData : editor_data
					}, function(res, status) {
						if ( status = "SUCCESS") {//If request is successful, empty the form.

						}
					});
				}
			}