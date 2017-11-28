
function printDom(nodItem,level) {
    var nodItemPrn;
    var subLevel = level;
    var nodeVal="";
    if(nodItem.tagName !== undefined){
        nodItemPrn = nodItem.tagName
    } else{
        nodItemPrn = nodItem;
    }

    if (nodItem.nodeName === "#text" || nodItem.nodeName === "#comment"){
        nodeVal = " = \"" + nodItem.nodeValue + "\"" ;
    }
    else{
        nodeVal = "";
    }


    console.log(subLevel + nodItem.nodeName + nodeVal);
    //document.getElementById('textBox').innerHTML = nodItem.tagName + "<br />";
    if(nodItem.childNodes.length > 0 ){
        for (var i = 0; i < nodItem.childNodes.length; i++){
            // level += "   ";
            printDom(nodItem.childNodes[i], level + "  ");
        }
    }
}
//printDom(document.body,"");
