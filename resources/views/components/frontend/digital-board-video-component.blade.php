<div class="player">
    <div id="youtube" style="width: 100%; height: 100%;"></div>
</div>
@push('scripts')
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        var videos = "{{ $videos }}".split(',');

        var YouTubePlayer = {
            current: 0,
            player: null,
            videos: videos,
            currentlyPlaying: function() {
                console.log('Current Track id', YouTubePlayer.videos[YouTubePlayer.current]);
                return YouTubePlayer.videos[YouTubePlayer.current];
            },
            playNext: function() {
                YouTubePlayer.increaseTrack();
                if (YouTubePlayer.player) {
                    YouTubePlayer.currentlyPlaying();
                    YouTubePlayer.player.loadVideoById(YouTubePlayer.videos[YouTubePlayer.current]);
                    YouTubePlayer.player.mute(); // Start with muted sound
                    YouTubePlayer.player.playVideo();
                } else {
                    alert('Please Wait! Player is loading');
                }
            },
            playPrevious: function() {
                YouTubePlayer.decreaseTrack();
                if (YouTubePlayer.player) {
                    YouTubePlayer.currentlyPlaying();
                    YouTubePlayer.player.loadVideoById(YouTubePlayer.videos[YouTubePlayer.current]);
                    YouTubePlayer.player.mute(); // Start with muted sound
                    YouTubePlayer.player.playVideo();
                } else {
                    alert('Please Wait! Player is loading');
                }
            },
            increaseTrack: function() {
                YouTubePlayer.current = (YouTubePlayer.current + 1) % YouTubePlayer.videos.length;
            },
            decreaseTrack: function() {
                YouTubePlayer.current = (YouTubePlayer.current - 1 + YouTubePlayer.videos.length) % YouTubePlayer.videos.length;
            },
            onPlayerReady: function(event) {
                // Start with muted sound
                event.target.mute();
                event.target.playVideo();
            },
            onPlayerStateChange: function(event) {
                if (event.data == YT.PlayerState.PLAYING) {
                    // Unmute after video starts playing
                    YouTubePlayer.player.unMute();
                } else if (event.data == YT.PlayerState.ENDED) {
                    YouTubePlayer.playNext();
                }
            }
        };

        function onYouTubeIframeAPIReady() {
            YouTubePlayer.player = new YT.Player('youtube', {
                height: '350',
                width: '425',
                videoId: YouTubePlayer.videos[YouTubePlayer.current],
                events: {
                    'onReady': YouTubePlayer.onPlayerReady,
                    'onStateChange': YouTubePlayer.onPlayerStateChange
                },
                playerVars: {
                    autoplay: 1,
                    controls: 1,
                    mute: 1, // Start with muted sound
                    playsinline: 1 // Plays inline for mobile devices
                }
            });
        }
    </script>
@endpush
