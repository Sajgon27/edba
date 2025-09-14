document.addEventListener('DOMContentLoaded', function() {
    initVideoPlayers();
});

function initVideoPlayers() {
    const videoContainers = document.querySelectorAll('.o-nas-film__video-container');
    
    videoContainers.forEach(container => {
        const video = container.querySelector('.o-nas-film__video');
        const overlay = container.querySelector('.o-nas-film__overlay');
        let isPlaying = false;
        
        container.addEventListener('click', function() {
            if (video.paused || video.ended) {
                playVideo();
            } else {
                pauseVideo();
            }
        });
        
        function playVideo() {
            video.play();
            container.closest('.o-nas-film').classList.add('o-nas-film--playing');
            isPlaying = true;
        }
        
        function pauseVideo() {
            video.pause();
            container.closest('.o-nas-film').classList.remove('o-nas-film--playing');
            isPlaying = false;
        }
        
        // Reset overlay when video ends
        video.addEventListener('ended', function() {
            container.closest('.o-nas-film').classList.remove('o-nas-film--playing');
            isPlaying = false;
        });
    });
}