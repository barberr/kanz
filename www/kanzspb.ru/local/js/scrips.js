BX.ready(function(){
    var fields = BX.findChild(BX('results'), {tag: 'div'}, true, true);
    fields.forEach(function(element){
        BX(element).remove();
    }); 
});