<script type="text/javascript">
	tinymce.init({
		selector: "textarea#editor",
                    width: "99.9%",
                    height: "350px",
                    font_formats:
                        "Arial=arial,helvetica,sans-serif;"+
                        "Arial Black=arial black,avant garde;"+
                        "Helvetica=helvetica;"+
                        "Tahoma=tahoma,arial,helvetica,sans-serif;"+
                        "Times New Roman=times new roman,times;"+
                        "Trebuchet MS=trebuchet ms,geneva;"+
                        "Verdana=verdana,geneva;",
                    plugins: [
                        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
                    ],

                    toolbar: "copy paste cut searchreplace bold italic underline strikethrough alignleft aligncenter alignright alignjustify visualblocks | bullist numlist outdent indent blockquote forecolor backcolor link unlink undo redo | anchor image media hr removeformat ltr rtl subscript superscript charmap nonbreaking pagebreak | table fontselect fontsizeselect ",
                    menubar: false,

                    language : "pt_BR",

                    rel_list:   [ { title: "Vazio", value: ""},
                    {title: "Lightbox", value: "lightbox" } ],

                    external_filemanager_path:"{{url('/')}}/filemanager/",
                    filemanager_title:"Galeria" ,
                    external_plugins: { "filemanager" : "{{url('/')}}/filemanager/plugin.min.js"}

  			  }
	);
</script>