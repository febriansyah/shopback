/*=============================================================================================================== 
Author     : Muhammad Febriansyah
Date       : November 2016
 =============================================================================================================== */
var tag = document.createElement('script');
          tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

          var player2;
          function onYouTubeIframeAPIReady2() {
            player2 = new YT.Player('playerPopup', {
              height: '206',
              width: '336',
              videoId: '7pqhkYhMH6k',
              playerVars :{'autoplay':0,'loop':0,'playlist':'7pqhkYhMH6k','vq':'hd720'},
              events: {
                'onReady2': onPlayerReady2,
                'onStateChange2': onPlayerStateChange2
              }
            });
          }

          function onPlayerReady2(event) {
            //event.target.setVolume(0);
           //event.target.playVideo();
           $("#trigger-player").click(function(e){
              e.preventDefault();
              event.target.playVideo();
              $('html, body').animate({
                    scrollTop: $("#home_trailer").offset().top
                }, 2000);
            });
          }

          var done = false;
          function onPlayerStateChange2(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
        //      setTimeout(stopVideo, 6000);
                      done = true;
            }
               //event.target.setVolume(0);
          }
