import Hls from 'hls.js';

const videoSrc = 'https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8';
if (Hls.isSupported()) {
    const hls = new Hls();
    hls.loadSource(videoSrc);
    hls.attachMedia(player);
} else if (player.canPlayType('application/vnd.apple.mpegurl')) {
    player.src = videoSrc;
} else {
    const message = 'the browser is not supported HLS.';
    alert(message);
    throw new Exception(message);
}
