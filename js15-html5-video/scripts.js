let videoList = [
    343516600,
    343670074,
    652878497,
    668865673,
    708209935,
];

let videoPlayer = document.querySelector('#videoPlayer');
let playPauseButton = document.querySelector('#playerPlayPause');

let playlistId = 0;
let currentVideoId = null;
let randomPlay = false;
let previousVideoId = -1;

addVideoToLibrary = () => {
    let newUl = document.createElement('ul');
    videoList.forEach(function (video, id) {
      let newli = document.createElement('li');
      newli.id = id ;
      newli.className = 'videoItem'  ;
      newli.textContent = video;
      newUl.appendChild(newli);
      document.body.querySelector('.library').appendChild(newUl);
  })  
};
addVideoToLibrary();

addVideoToPlaylist = (id, text) => {
        let newli = document.createElement('li');
        newli.id = 'pl' + playlistId ;
        newli.className = 'videoPlayItem';
        newli.textContent = text;
        //document.body.querySelector('.playlist').firstChild.appendChild(newLi);
        document.body.querySelector('.playlist').children[1].appendChild(newli);
    playlistId++;
};

startPlayNewVideo = (id,text) => {
    currentVideoId = parseInt(id.slice(2));

    if (previousVideoId != currentVideoId) {
        //videoPlayer.src = `http://frer.zzz.com.ua/video/${text}.mp4`;
        videoPlayer.src = `video/${text}.mp4`;
        document.querySelector('#playerPlayPause').className = 'fa fa-pause fa-lg';
        videoPlayer.play();
        document.querySelector('#volumeBar').value = videoPlayer.volume;

        if (previousVideoId > -1) {
            console.log('del <<<');
            document.querySelector('#pl' + previousVideoId).removeChild(document.querySelector('#pl' + previousVideoId).lastElementChild);
            document.querySelector('#pl' + previousVideoId).className = 'videoPlayItem';
        }

        previousVideoId = currentVideoId;
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
        videoPlayer.currentTime = 0;
        videoPlayer.play();
    }
};

playerPause = () => {
    videoPlayer.pause();
    playPauseButton.className = 'fa fa-play fa-lg';
};

playerPlay = () => {
    videoPlayer.play();
    playPauseButton.className = 'fa fa-pause fa-lg';
};

playerStop = () => {
    videoPlayer.pause();
    videoPlayer.currentTime = 0;
} ;

playerFullscreen = () => {
    if (videoPlayer.requestFullscreen) {
        videoPlayer.requestFullscreen();
    } else if (videoPlayer.mozRequestFullScreen) {
        videoPlayer.mozRequestFullScreen();
    } else if (videoPlayer.webkitRequestFullscreen) {
        videoPlayer.webkitRequestFullscreen();
    }
};

playerVolume  = () => {
    if(!videoPlayer.muted){
        videoPlayer.muted = true;
        document.querySelector('#playerVolume').className = 'fa fa-volume-off fa-lg';
        document.querySelector('#volumeBar').value = '0';
    }
    else {
        videoPlayer.muted = false;
        document.querySelector('#playerVolume').className = 'fa fa-volume-up fa-lg';
        document.querySelector('#volumeBar').value = '1';

    }

};

cleanPlaylist = () => {
    let playlistElem = document.querySelector('.playlist').lastElementChild;
    if(playlistElem.children.length > 0) {
        let count = playlistElem.children.length;
        for (let i = 0; i < count; i++) {
            playlistElem.removeChild(playlistElem.lastElementChild);
        }
        playlistId = 0;
    }
};

changeVolume = () => {
    videoPlayer.volume = document.querySelector('#volumeBar').value;
    document.querySelector('#progressBar').value = videoPlayer.currentTime;
    if(videoPlayer.volume > 0.5){
        document.querySelector('#playerVolume').className = 'fa fa-volume-up fa-lg';
    }
    else if(videoPlayer.volume < 0.5){
        document.querySelector('#playerVolume').className = 'fa fa-volume-down fa-lg';
    }
    if(videoPlayer.volume === 0){
        document.querySelector('#playerVolume').className = 'fa fa-volume-off fa-lg';
    }
};

changeVideo = () => {
    videoPlayer.currentTime = document.querySelector('#progressBar').value;
};

videoPlayer.addEventListener('loadedmetadata', function() {
    document.querySelector('#progressBar').min = 0;
    document.querySelector('#progressBar').max = videoPlayer.duration.toFixed(1);
    document.querySelector('#progressBar').step = 0.1;
});

videoPlayer.addEventListener('ended', function() {
    selectNextVideo();
});

selectNextVideo = (isPrevious = false) => {
    let nextVideo;
    if(isPrevious){
        if(previousVideoId > 0) {
            nextVideo = document.querySelector('#pl' + previousVideoId);
            startPlayNewVideo(nextVideo.id, nextVideo.textContent);
        }
    }
    else {
        if (document.querySelector('.playlist').lastElementChild.children.length > 0) {
            console.log('randomPlay = ' + randomPlay);
            let nextVideo;
            if (randomPlay) {
                let numRandom = Math.round(Math.random() * (playlistId - 1));
                nextVideo = document.querySelector('#pl' + numRandom);
            }
            else {
                if (document.querySelector('#pl' + (currentVideoId + 1))) {
                    nextVideo = document.querySelector('#pl' + (currentVideoId + 1));
                }
                else {
                    nextVideo = document.querySelector('#pl0');
                }
            }
            startPlayNewVideo(nextVideo.id, nextVideo.textContent);
        }
        else {
            previousVideoId = -1;
        }
    }

};

document.body.onclick = function(event) {
    let elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'videoItem'){
        addVideoToPlaylist(elementWithClick.id, elementWithClick.textContent);
    }

    if (elementWithClick.id === 'playerPlayPause'){
       if(elementWithClick.className === 'fa fa-play fa-lg'){
           playerPlay();
       }
       else {
           playerPause();
       }
    }
    if (elementWithClick.id === 'nextVideoButton'){
        selectNextVideo();
    }
    if (elementWithClick.id === 'previousVideoButton'){
        selectNextVideo(true);
    }
    if (elementWithClick.id === 'playerStop'){
        playerStop();
    }
    if (elementWithClick.id === 'playerFullscreen') {
        playerFullscreen();
    }
    if (elementWithClick.id === 'playerVolume') {
        playerVolume();
    }
    if (elementWithClick.id === 'videoPlayer') {
        if(videoPlayer.paused === true){
            playerPlay();
        }
        else {
            playerPause(elementWithClick);
        }
    }
    if (elementWithClick.id === 'cleanPlaylist') {
        cleanPlaylist();
    }
    if (elementWithClick.id === 'playerMode') {
        if(randomPlay){
            randomPlay = false;
            elementWithClick.className = 'fa fa-repeat fa-lg';
        }
        else {
            randomPlay = true;
            elementWithClick.className = 'fa fa-random fa-lg';
        }
    }
    };

document.body.ondblclick = function(event) {
    let elementWithClick = event.target || event.srcElement;
    if (elementWithClick.className === 'videoPlayItem'){
        startPlayNewVideo(elementWithClick.id,elementWithClick.textContent);
    }
    if (elementWithClick.id === 'videoPlayer') {
        playerFullscreen();
    }
};

videoPlayer.addEventListener('timeupdate', function() {
    let duration = videoPlayer.duration.toFixed(1);
    if(isNaN(videoPlayer.duration )){
        duration = 0;
    }
    document.querySelector('#timeInfo').textContent = `${videoPlayer.currentTime.toFixed(1)} / ${duration}`;
    document.querySelector('#progressBar').value = videoPlayer.currentTime;
});

