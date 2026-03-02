
const BASE_URL = "http://localhost/casas_e_propriedades/";









var DIFERE = {

  init_tinymce : function() {

    tinymce.init({

        relative_urls: false,

        remove_script_host : false,

        language: "pt_BR",

        selector: "textarea",

        plugins: [

            "advlist autolink lists link image charmap print preview anchor",

            "searchreplace visualblocks code fullscreen",

            "insertdatetime media table contextmenu paste",

            "emoticons textcolor colorpicker"

        ],

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fontsizeselect forecolor backcolor emoticons",

        fontsize_formats: '11px 12px 14px 16px 18px 24px 36px 48px',

        image_advtab: true ,

        external_filemanager_path: BASE_URL + "public/filemanager/",

        filemanager_title:"Responsive Filemanager" ,

        external_plugins: { "filemanager" : BASE_URL + "public/filemanager/plugin.min.js"}

    });

  },

}

DIFERE.init_tinymce();