;(function(){
    tinyMCE.PluginManager.add('tmcd_plugin',function(editor,url){
        console.log(editor);
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

        editor.addButton('tmc_button_three',{
            'type': 'listbox',
            'text': 'select something',
            'values':  [
                {text: 'apple', value: 'you have selected <b>apple</b>'},
                {text: 'banana', value: 'you have selected banana'},
            ],
            onselect: function(){
                editor.insertContent(this.value());
            }
        });


        editor.addButton('tmc_form',{
            'text': 'form',
            onclick: function(){
                editor.windowManager.open({
                    title: 'User Input Form',
                    body: [
                        {
                            type: 'checkbox',
                            name: 'userinput1',
                            label: 'Test Checkbox',
                            value: 1,
                        },
                        {
                            type: 'colorpicker',
                            name: 'color1',
                            label: 'Test Checkbox',
                            value: '#3498db',
                        }
                    ],
                    onsubmit: function(e){
                        editor.insertContent(`<div style="width: 50px;height: 50px;background: ${e.data.color1}">Color Div</div>`);
                    }
                })
            },

        });


        editor.addButton('tmc_button_four',{
            'type': 'menubutton',
            'text': 'Short Codes',
            'menu' : [
                {
                    text: 'option A',
                    menu: [
                        {
                            text: 'Parent A Child  A',
                            onclick: function(){
                                editor.insertContent('Parent A Child  A');
                            }
                        },
                        {
                            text: 'Parent A Child  B',
                            onclick: function(){
                                editor.insertContent('Parent A Child  B');
                            }
                            
                        }
                    ],
                    onclick: function(){
                        editor.insertContent('Option A');
                    },
            
                },
                {
                    text: 'option B',
                    onclick: function(){
                        editor.insertContent('Option B');
                    }
                }
            ]
        });


    });
})();