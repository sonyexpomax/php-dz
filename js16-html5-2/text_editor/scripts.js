let txtEditor = {
    isNewDraft : true,
    currentDateCreation : null,
    currentDateModify : null,
    currentText : '',
    currentName : '',
    generateTempName : 0,
};

let nameField = document.querySelector('#nameDraft');
let textField = document.querySelector('#textarea');

txtEditor.draftListLoad = () => {
    for (let i = 0; i < localStorage.length; i++) {
        txtEditor.createDraftItem(localStorage.key(i));
    }
};

txtEditor.clearField = () => {
    txtEditor.currentDateCreation = null;
    txtEditor.currentDateModify = null;
    txtEditor.currentText = '';
    txtEditor.name = '';

    textField.value = '';
    nameField.value = '';
    nameField.focus();
};

txtEditor.createDraft = () => {
    txtEditor.clearField();
};

txtEditor.loadDraft = (id) => {
    let objFromLocalStorage = JSON.parse(localStorage.getItem(id));
    txtEditor.currentDateCreation = objFromLocalStorage.dateCreation;
    txtEditor.currentDateModify = objFromLocalStorage.dateModify;
    txtEditor.currentText = objFromLocalStorage.text;
    txtEditor.currentName = id;
    textField.value = txtEditor.currentText;
    nameField.value = id;

};

txtEditor.createDraftItem = (name = txtEditor.currentName) => {

    let newli = document.createElement('li');
    newli.id = name ;
    newli.className = 'listItem' ;
    newli.title = 'Загрузить черновик в редактор';
    newli.textContent = name;

    let newCloser = document.createElement('strong');
    newCloser.id = 'closer-' + name;
    newCloser.className = 'closer';
    newCloser.title = 'Удалить';
    newCloser.innerHTML = `&times;`;
    newli.appendChild(newCloser);

    let newSpan = document.createElement('span');
    newSpan.className = 'lastModify';
    let lastModify;

    if (txtEditor.isNewDraft){
        lastModify = new Date();
    }
    else{
        lastModify = new Date(JSON.parse(localStorage.getItem(name)).dateModify);
    }

    newSpan.textContent =`(дата последней правки - ${lastModify.toLocaleTimeString()} ${lastModify.toLocaleDateString()})`;
    newli.appendChild(newSpan);

    document.body.querySelector('#ulList').appendChild(newli);
};

txtEditor.deleteDraft = (name) => {
    let dellName = name.slice(7);
    console.log('delete ' + dellName);
    localStorage.removeItem(dellName);
    document.querySelector("#" + dellName).parentElement.removeChild(document.querySelector("#" + dellName));
};

txtEditor.saveDraft = () => {
    let isFindKey = false;

    txtEditor.currentName = nameField.value;
    txtEditor.currentText = textField.value;

    if(txtEditor.currentName !== '') {

        //finding key in storage
        for (let i = 0; i < localStorage.length; i++) {
            if (localStorage.key(i) === txtEditor.currentName) {
                isFindKey = true;
                break;
            }
        }
        txtEditor.isNewDraft = isFindKey ? false : true;

        //check if is it new draft
        if (txtEditor.isNewDraft) {
            txtEditor.currentDateCreation = new Date();
            txtEditor.currentDateModify = txtEditor.currentDateCreation;
            txtEditor.createDraftItem();
        }
        else{
            txtEditor.currentDateModify = new Date();
        }

        txtEditor.savingToStorage();
    }
    else {
        alert('Укажите название черновика!')
    }
};

txtEditor.autoSaveDraft = () => {
let isNeedNewDraftItem = false;
    txtEditor.currentText = textField.value;
    txtEditor.currentDateModify = new Date();

    if(!txtEditor.currentName){
        if(nameField.value === ''){

            let findd = null;
            for (let i = 0; i < localStorage.length; i++) {
                if (localStorage.key(i).slice(0,8) === 'autosave') {
                    findd = parseInt(localStorage.key(i).slice(9));
                }
            }
            txtEditor.generateTempName = findd === null ? 0: (findd+1);
            txtEditor.currentName = 'autosave-' + txtEditor.generateTempName;
            nameField.value = txtEditor.currentName;
            isNeedNewDraftItem = true;
        }
        else {
            txtEditor.currentName = nameField.value;
        }
        txtEditor.currentDateCreation = txtEditor.currentDateModify;
    }
    else {
        txtEditor.currentDateModify = new Date();
    }
    console.log('auto save');

    txtEditor.savingToStorage();
    isNeedNewDraftItem ? txtEditor.createDraftItem() : '';

};

txtEditor.savingToStorage = () => {
    let dataDraft = JSON.stringify({dateCreation: txtEditor.currentDateCreation, dateModify: txtEditor.currentDateModify, text: txtEditor.currentText});
    console.log(dataDraft);
    localStorage.setItem(txtEditor.currentName,  dataDraft);
};

document.addEventListener("DOMContentLoaded", txtEditor.draftListLoad());

txtEditor.autoSaveStart = () => {
    setTimeout(function () {
        txtEditor.timerAutosave = setInterval(function () {
            txtEditor.autoSaveDraft();
        }, 10000);
    },5000);
};

textField.addEventListener("focus", txtEditor.autoSaveStart);

txtEditor.autoSaveStop = () => {
    clearInterval(txtEditor.timerAutosave);
};

document.body.onclick = function(event) {
    txtEditor.autoSaveStop();
    let elementWithClick = event.target || event.srcElement;

    if (elementWithClick.className === 'saveDraft') {
        txtEditor.saveDraft();
    }
    if (elementWithClick.className === 'clearField') {
        txtEditor.clearField();
    }
    if (elementWithClick.className === 'createDraft') {
        txtEditor.createDraft();
    }
    if (elementWithClick.className === 'listItem') {
        txtEditor.loadDraft(elementWithClick.id);
    }
    if (elementWithClick.className === 'lastModify') {
        txtEditor.loadDraft(elementWithClick.parentElement.id);
    }
    if (elementWithClick.className === 'closer') {
        txtEditor.deleteDraft(elementWithClick.id);
    }
};