(function(){
    tinymce.create('tinymce.plugins.fonformats', {
        init : function(ed, url){
            // a ameliorer
            var theme_uri = document.getElementById('fon-syntax-template-uri').value;
            ed.addCommand('mcefonCol2', function(){
                tinyMCE.activeEditor.selection.setContent(
                    '<p>Loremipsum</p>'+
                    '<div class="fon-post-format-1">'+
                        '<div class="col1">'+
                            '<p>Colonne_gauche</p>'+
                        '</div>'+
                        '<div class="col2">'+
                            '<p>Colonne_droite</p>'+
                        '</div>'+
                    '</div>'+
                    '<p>Loremipsum</p>');
            });
            ed.addButton('fonCol2', {
                title: 'Add two Columns',
                image:theme_uri+'/assets/img/icons/mce-col2.png',
                cmd: 'mcefonCol2'
            });
            ed.addCommand('mcefonCode', function(){
                tinyMCE.activeEditor.selection.setContent(
                    '<code>' + ed.selection.getContent({format : 'text'}) + '</code>');
            });
            ed.addButton('fonCode', {
                title: 'Small',
                image:theme_uri+'/assets/img/icons/mce-code.png',
                cmd: 'mcefonCode'
            });
        },
        createControl : function(n, cm){
            return null;
        },
        getInfo : function(){
            return {
               longname: 'Colorz',
                author: '@Colorz',
                authorurl: 'http://www.colorz.fr/',
                infourl: 'http://twitter.com/Colorz',
                version: "1.0"
            };
        }
    });
    tinymce.PluginManager.add('fonformats', tinymce.plugins.fonformats);
})();