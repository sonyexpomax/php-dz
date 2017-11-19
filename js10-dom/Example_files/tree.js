
function printDom(nodItem,level) {
    var nodItemPrn;
    var subLevel = level;
    nodItem.tagName !== undefined ? nodItemPrn = nodItem.tagName : nodItemPrn = nodItem;
    console.log(subLevel + nodItem.nodeName);
    //document.getElementById('textBox').innerHTML = nodItem.tagName + "<br />";
    if(nodItem.childNodes.length > 0 ){
        for (var i = 0; i < nodItem.childNodes.length; i++){
            // level += "   ";
            printDom(nodItem.childNodes[i], level + " - ");
        }
    }
}
//printDom(document.body,"");
