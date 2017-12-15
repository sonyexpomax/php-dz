let vp = {
    videoList: [
        ['Wood', 343516600],
        ['Night', 343670074],
        ['Eagle', 652878497],
        ['Wind',668865673],
        ['Lake',708209935],
    ],
    videoPlayer: document.querySelector('#videoPlayer'),
    playPauseButton: document.querySelector('#playerPlayPause'),
    playlistId: 0,
    currentVideoId: null,
    randomPlay: false,
    previousVideoId: -1,
    playlistArr: [],
    playloadArr: [],
};

vp.addVideoToLibrary = () => {
    let newUl = document.createElement('ul');
    newUl.className = 'ulVideo'  ;
    vp.videoList.forEach(function (video, id) {
      let newli = document.createElement('li');
      newli.id = 'lib' + id ;
      newli.className = 'videoItem'  ;
      newli.textContent = video[0];
        newUl.appendChild(newli);
      document.body.querySelector('.library').appendChild(newUl);
  })  
};
vp.addVideoToLibrary();

vp.addVideoToPlaylist = (id, text) => {

    //create li
    let newli = document.createElement('li');
    newli.id = 'pl' + vp.playlistId ;
    newli.className = 'videoPlayItem';
    newli.textContent = text;
    newli.dataset.id = +id.slice(3);

    //create X
    let newCloser = document.createElement('strong');
    newCloser.id = 'closer-' + vp.playlistId;
    newCloser.className = 'closer';
    newCloser.title = 'Удалить';
    newCloser.innerHTML = `&times;`;
    newli.appendChild(newCloser);

    document.body.querySelector('.playlist').children[1].appendChild(newli);

    vp.playloadArr[vp.playlistId] = text;
    vp.playlistId++;
};

vp.startPlayNewVideo = (id,dataId,text) => {

    vp.currentVideoId = parseInt(id.slice(2));

    if (vp.previousVideoId != vp.currentVideoId) {

        console.log('start play with id=' + id + '  ----  dataId=' + dataId + '  ---  text='+ text);
        vp.videoPlayer.src = `http://frer.zzz.com.ua/video/${vp.videoList[dataId][1]}.mp4`;
        //vp.videoPlayer.src = `video/${vp.videoList[dataId][1]}.mp4`;

        document.querySelector('#playerPlayPause').className = 'fa fa-pause fa-lg';
        vp.videoPlayer.play();
        document.querySelector('#volumeBar').value = vp.videoPlayer.volume;

        if (vp.previousVideoId > -1) {
            console.log('del <<<');
            document.querySelector('#pl' + vp.previousVideoId).removeChild(document.querySelector('#pl' + vp.previousVideoId).lastElementChild);
            document.querySelector('#pl' + vp.previousVideoId).className = 'videoPlayItem';
        }

        vp.previousVideoId = vp.currentVideoId;
        document.querySelector('#' + id).className += ' nowPlaying';

        let newSpan = document.createElement('span');
        newSpan.textContent = ' <<< now playing';
        document.querySelector('#' + id).appendChild(newSpan);
        document.querySelector('#videoName').textContent = text;
        document.querySelector('#videoName').style.display = 'block';
        setTimeout(function () {
                    document.querySelector('#videoName').style.display = 'none';
        }, 2000);
    }
    else {
        vp.videoPlayer.currentTime = 0;
        vp.videoPlayer.play();
    }
};

vp.playerPause = () => {
    vp.videoPlayer.pause();
    vp.playPauseButton.className = 'fa fa-play fa-lg';
};

vp.playerPlay = () => {
    vp.videoPlayer.play();
    vp.playPauseButton.className = 'fa fa-pause fa-lg';
};

vp.playerStop = () => {
    vp.videoPlayer.pause();
    vp.videoPlayer.currentTime = 0;
} ;

vp.playerFullscreen = () => {
    if (vp.videoPlayer.requestFullscreen) {
        vp.videoPlayer.requestFullscreen();
    } else if (vp.videoPlayer.mozRequestFullScreen) {
        vp.videoPlayer.mozRequestFullScreen();
    } else if (vp.videoPlayer.webkitRequestFullscreen) {
        vp.videoPlayer.webkitRequestFullscreen();
    }
};

vp.playerVolume  = () => {
    if(!vp.videoPlayer.muted){
        vp.videoPlayer.muted = true;
        document.querySelector('#playerVolume').className = 'fa fa-volume-off fa-lg';
        document.querySelector('#volumeBar').value = '0';
    }
    else {
        vp.videoPlayer.muted = false;
        document.querySelector('#playerVolume').className = 'fa fa-volume-up fa-lg';
        document.querySelector('#volumeBar').value = '1';

    }

};

vp.cleanPlaylist = () => {
    let playlistElem = document.querySelector('.playlist').lastElementChild;
    if(playlistElem.children.length > 0) {
        let count = playlistElem.children.length;
        for (let i = 0; i < count; i++) {
            playlistElem.removeChild(playlistElem.lastElementChild);
        }
        vp.playlistId = 0;
    }
};

vp.changeVolume = () => {
    vp.videoPlayer.volume = document.querySelector('#volumeBar').value;
    document.querySelector('#progressBar').value = vp.videoPlayer.currentTime;
    if(vp.videoPlayer.volume > 0.5){
        document.querySelector('#playerVolume').className = 'fa fa-volume-up fa-lg';
    }
    else if(vp.videoPlayer.volume < 0.5){
        document.querySelector('#playerVolume').className = 'fa fa-volume-down fa-lg';
    }
    if(vp.videoPlayer.volume === 0){
        document.querySelector('#playerVolume').className = 'fa fa-volume-off fa-lg';
    }
};

changeVideo = () => {
    vp.videoPlayer.currentTime = document.querySelector('#progressBar').value;
};

vp.videoPlayer.addEventListener('loadedmetadata', function() {
    document.querySelector('#progressBar').min = 0;
    document.querySelector('#progressBar').max = vp.videoPlayer.duration.toFixed(1);
    document.querySelector('#progressBar').step = 0.1;
});

vp.videoPlayer.addEventListener('ended', function() {
    vp.selectNextVideo();
});


vp.selectNextVideo3 = (isPrevious = false) => {
    console.log(vp.previousVideoId);
    let nextVideo;
    if(isPrevious){
        if(vp.previousVideoId > 0) {
            nextVideo = document.querySelector('#pl' + vp.previousVideoId);
            console.log('nextVideo.textContent = ' +  nextVideo.textContent);
            vp.startPlayNewVideo(nextVideo.id, nextVideo.textContent);
        }
    }
    else {
        if (document.querySelector('.playlist').lastElementChild.children.length > 0) {
            console.log('randomPlay = ' + vp.randomPlay);
            let nextVideo;
            if (vp.randomPlay) {
                let numRandom = Math.round(Math.random() * (vp.playlistId - 1));
                nextVideo = document.querySelector('#pl' + numRandom);
            }
            else {
                if (document.querySelector('#pl' + (vp.currentVideoId + 1))) {
                    nextVideo = document.querySelector('#pl' + (vp.currentVideoId + 1));
                }
                else {
                    nextVideo = document.querySelector('#pl0');
                }
            }
            console.log('nextVideo.textContent 2 = ' +  nextVideo.textContent);
            vp.startPlayNewVideo(nextVideo.id, nextVideo.textContent.slice(0,-1));
        }
        else {
            vp.previousVideoId = -1;
        }
    }

};



vp.selectNextVideo = (isPrevious = false) => {
    console.log(vp.previousVideoId);
    let nextVideo;
    let nextVideoId = null;

    let IsEmptyPlaylist = true;

    for (let i = 0; i < vp.playloadArr.length; i++) {
        if (vp.playloadArr[i]) {
            IsEmptyPlaylist = false;
            break;
        }
    }
console.log('IsEmptyPlaylist = ' + IsEmptyPlaylist);
    if(!IsEmptyPlaylist) {

        //find previous
        if (isPrevious) {
            if (vp.playlistArr.length > 2) {
                let k = 1;
                for (let i = vp.playlistArr.length-2; i > 0; i--) {
                    console.log('ee = ' + vp.playloadArr[vp.playlistArr[i]]);
                    if (vp.playloadArr[vp.playlistArr[i]]) {
                        nextVideoId = vp.playlistArr[i];
                        vp.playlistArr.splice(-k);
                        break;
                    }
                    k++;

                }
                console.log(vp.playlistArr);
            }
            else if (vp.playlistArr.length === 2) {
                if (vp.playloadArr[vp.playlistArr[0]]) {
                    nextVideoId = vp.playlistArr[0];
                    vp.playlistArr.splice(-1);
                }
                else {
                    vp.playloadArr = [];
                }
            }
            else if (vp.playlistArr.length === 1) {
                nextVideoId = vp.playlistArr[0];
            }
        }
        else {
            console.log('next');

            //find next not random
            if (!vp.randomPlay) {
                console.log('not random');
                for (let i = vp.currentVideoId+1; i < vp.playloadArr.length; i++) {
                    if (vp.playloadArr[i]) {
                        console.log('i = ' + i);
                        nextVideoId = i;
                        break;
                    }
                }
                if (!nextVideoId) {
                    console.log('random');
                    for (let i = 0; i < vp.playloadArr.length; i++) {
                        if (vp.playloadArr[i]) {
                            nextVideoId = i;
                            break;
                        }
                    }
                }
            }
            //find next random
            else {
                console.log('nextVideoId before random = ' + nextVideoId);

                while (!nextVideoId) {
                    let yy = Math.round(Math.random() * (vp.playlistId - 1));
                    if (vp.playloadArr[yy]) {
                        nextVideoId = yy;
                    }
                }

            }
            vp.playlistArr.push(nextVideoId);
        }
        if(nextVideoId !== null){
            console.log('nextVideoId = ' + nextVideoId);
            nextVideo = document.querySelector('#pl' + nextVideoId);
            vp.startPlayNewVideo(nextVideo.id, nextVideo.getAttribute('data-id'), nextVideo.textContent.slice(0,-1));
        }

    }

};



document.body.onclick = function(event) {
    let elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'videoItem'){
        vp.addVideoToPlaylist(elementWithClick.id, elementWithClick.textContent);
    }

    if (elementWithClick.id === 'playerPlayPause'){
       if(elementWithClick.className === 'fa fa-play fa-lg'){
           vp.playerPlay();
       }
       else {
           vp.playerPause();
       }
    }
    if (elementWithClick.id === 'nextVideoButton'){
        vp.selectNextVideo();
    }
    if (elementWithClick.id === 'previousVideoButton'){
        vp.selectNextVideo(true);
    }
    if (elementWithClick.id === 'playerStop'){
        vp.playerStop();
    }
    if (elementWithClick.id === 'playerFullscreen') {
        vp.playerFullscreen();
    }
    if (elementWithClick.id === 'playerVolume') {
        vp.playerVolume();
    }
    if (elementWithClick.id === 'videoPlayer') {
        if(vp.videoPlayer.paused === true){
            vp.playerPlay();
        }
        else {
            vp.playerPause(elementWithClick);
        }
    }
    if (elementWithClick.id === 'cleanPlaylist') {
        vp.cleanPlaylist();
    }
    if (elementWithClick.className === 'closer') {
        vp.deleteVideo(elementWithClick.id);
    }
    if (elementWithClick.id === 'playerMode') {
        if(vp.randomPlay){
            vp.randomPlay = false;
            elementWithClick.className = 'fa fa-repeat fa-lg';
        }
        else {
            vp.randomPlay = true;
            elementWithClick.className = 'fa fa-random fa-lg';
        }
    }
};

document.body.ondblclick = function(event) {
    let elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'videoPlayItem'){
        vp.playlistArr.push(+elementWithClick.id.slice(2));
        vp.startPlayNewVideo(elementWithClick.id, elementWithClick.getAttribute('data-id'), elementWithClick.textContent.slice(0,-1));
    }
    if (elementWithClick.id === 'videoPlayer') {
        vp.playerFullscreen();
    }
};

vp.videoPlayer.addEventListener('timeupdate', function() {
    let duration = vp.videoPlayer.duration.toFixed(1);
    if(isNaN(vp.videoPlayer.duration )){
        duration = 0;
    }
    document.querySelector('#timeInfo').textContent = `${vp.videoPlayer.currentTime.toFixed(1)} / ${duration}`;
    document.querySelector('#progressBar').value = vp.videoPlayer.currentTime;
});

vp.deleteVideo = (name) => {
    let dellName = name.slice(7);
    console.log('delete ' + dellName);
    document.querySelector("#pl" + dellName).parentElement.removeChild(document.querySelector("#pl" + dellName));

    //vp.playloadArr.splice((+dellName), 1);
    delete vp.playloadArr[(+dellName)];
};