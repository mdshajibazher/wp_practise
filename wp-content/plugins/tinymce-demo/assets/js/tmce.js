;(function(){
    tinyMCE.PluginManager.add('tmcd_plugin',function(editor,url){
        console.log(editor);
        alert(url);
        editor.addButton('tmc_button_one',{
            'text': 'B1',
            'icon': 'insertdatetime',
            onclick: function(){
                editor.insertContent("Hello World");
            }
        });

        editor.addButton('tmc_button_two',{
            'text': 'B2',
            onclick: function(){
                editor.insertContent("Jello Universe");
            }
        });


    });
})();