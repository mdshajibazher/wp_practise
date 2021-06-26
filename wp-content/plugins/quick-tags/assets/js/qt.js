QTags.addButton('qtsd-demo-button1','U','<u>','</u>');
QTags.addButton('qtsd-demo-button2','JS',function(){
    var name = prompt('whats your name?');
    var text = "Hello "+name;
    QTags.insertContent(text);
});

QTags.addButton('qtsd-demo-button3','FA',QtagsPopup);

function QtagsPopup(){
    tb_show('Fontawesome',qtsd.preview);
}

function insertFa(text){
    let iconTags = `<i class="${text}"></i>`;
    QTags.insertContent(iconTags);
    tb_remove();
}