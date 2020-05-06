/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : November 2016
 =============================================================================================================== */
var tag = document.createElement('script');
          tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

          var player;
          var player2;
          function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
              height: '206',
              width: '336',
              videoId: '2JDsQ2A4UuU',
              playerVars :{'autoplay':0,'loop':0,'vq':'hd720'},
              events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
              }
            });
            $(".video_trig").click(function(e){
              e.preventDefault();
              var dataVideo = $(this).attr("data-video");
              player2 = new YT.Player('playerPopup', {
                height: '206',
                width: '336',
                videoId: dataVideo,
                playerVars :{'autoplay':0,'loop':0,'vq':'hd720'},
                events: {
                  'onReady': onPlayerReady2,
                  'onStateChange': onPlayerStateChange
                }
              });
            });

          }
          function onPlayerReady2(event2) {
              event2.target.playVideo();
          }

          function onPlayerReady(event) {
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
          function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
        //      setTimeout(stopVideo, 6000);
                      done = true;
            }
               //event.target.setVolume(0);
          }
