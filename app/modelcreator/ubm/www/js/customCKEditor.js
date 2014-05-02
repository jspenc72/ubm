var editor, html = '';
			var decodeHtmlEntity = function(str) {
			  return str.replace(/&#(\d+);/g, function(match, dec) {
			    return String.fromCharCode(dec);
			  });
			};
			 
			var encodeHtmlEntity = function(str) {
			  var buf = [];
			  for (var i=str.length-1;i>=0;i--) {
			    buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
			  }
			  return buf.join('');
			};
	
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
				//1. Encode the Source HTML of the editor as Entities, This is how the product is stored, as an entity, in the database.
				var entityEncodedHTML = encodeHtmlEntity(CKEDITOR.instances.editor1.getData());
				//2. Decode the HTML entity version
				var entityDecodedHTML = decodeHtmlEntity(entityEncodedHTML);
				//3. Set the editorcontents "PREVIEW" div equal to the decoded version.
				document.getElementById( 'editorcontents' ).innerHTML = html = entityDecodedHTML;
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
					var entityEncodedData = encodeHtmlEntity(editor_data);
					alert(entityEncodedData);					
					alert(decodeHtmlEntity(entityEncodedData));
					document.getElementById( 'editorcontents' ).innerHTML = entityEncodedData;
					document.getElementById( 'editedcontents' ).style.display = '';
					alert("JSON REQUEST WILL NOW BE SENT");
					$.getJSON('http://api.universalbusinessmodel.com/ubms_productreationsuite_saveProduct.php?callback=?', {//JSONP Request to Open Items Page setup tables
						key : window.key,
						username : window.username,
						activeModelUUID : window.activeModelUUID,
						productSource : editor_data
					}, function(res, status) {
						if ( status = "SUCCESS") {//If request is successful, empty the form.
							alert(res.message);
							//3. Set the editorcontents innerHTML equal to the string handed back by the php script in the message parameter.
							document.getElementById( 'editorcontents' ).innerHTML = res.message;
						}
					});
				}
			}