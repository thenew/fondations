(function(){
    tinymce.create('tinymce.plugins.fon_mce', {
        init : function(ed, url){
            // a ameliorer
            // var theme_uri = document.getElementById('fon-syntax-template-uri').value;

            // Col2
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
                image: fonThemeUrl + '/assets/img/icons/mce-col2.png',
                cmd: 'mcefonCol2'
            });

            // Code
            ed.addCommand('mcefonCode', function(){
                tinyMCE.activeEditor.selection.setContent(
                    '<code>' + ed.selection.getContent({format : 'text'}) + '</code>'
                );
            });
            ed.addButton('fonCode', {
                title: 'Code',
                image: fonThemeUrl + '/assets/img/icons/mce-code.png',
                cmd: 'mcefonCode'
            });
        },
        createControl : function(n, cm){
            return null;
        },
        getInfo : function(){
            return {
               longname: 'Fondations',
                author: '@remybarthez',
                authorurl: 'http://thenew.fr',
                infourl: 'http://thenew.fr',
                version: "1.0"
            };
        }
    });
    tinymce.PluginManager.add('fon_mce', tinymce.plugins.fon_mce);
})();