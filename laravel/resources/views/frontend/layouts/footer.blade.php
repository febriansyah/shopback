</body>

<script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$(document).ready(function(){
		$(".trigger_close_all_limit").click(function(){
			$("#popup_limit_video").hide();
		})
        var idUnix = '';
		$(window).bind("load resize",function(){
			$(".fit_height").height($(window).height());
		});

			var qs = (function(a) {
			if (a == "") return {};
			var b = {};
			for (var i = 0; i < a.length; ++i)
			{
				var p=a[i].split('=', 2);
				if (p.length == 1)
					b[p[0]] = "";
				else
					b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
			}
			return b;
		})(window.location.search.substr(1).split('&'));


		var user='';

        var duration="";

		if(!qs.shopbackid || !qs.shopbackid2 || !qs.partner){
            $('#trigger_play').remove();
			// user =[{"shopbackid":qs.shopbackid, "shopbackid2":qs.shopbackid2,"partner":qs.partner,"video":"0","count_Play":0}];
			// console.log('baru masuk');
			// console.log(user[0].video);
			// if (localStorage.getItem('user'+qs.shopbackid)) {
			// 	  user = JSON.parse(localStorage.getItem('user'+qs.shopbackid));
			// 	  console.log('sudah pernah');
			// 	  console.log(user);
			// 	}
		}

		// setVideoInfo(videourl);

        var videonya = document.getElementById('videoXl');
        console.log(videonya);
		function closeWin() {
		    window.top.close();
		}
		$("#videoXl").on(
			"timeupdate",
			function(event){
			videonya=this.duration;
			onTrackedVideoFrame(this.currentTime, this.duration);

		});

		$(".trigger_close_all").click(function(e){
			e.preventDefault();
			var currenttime_vid = $("#current").text();
			// $("#canvas_banner").remove();
			$("#modal_popup").hide();
			alert("waktu anda menonton video: "+currenttime_vid);

		});
		$("#trigger_play").click(function(e){
			e.preventDefault();


			var base_url="https://dev.makan.club/api_videoads/api/";
            var token="";

		        $.ajax({
		            type: "POST",
		            url : url+"/checkData",
                    data: {
                            'shopbackid' : qs.shopbackid,
                            'shopbackid2' : qs.shopbackid2,
                            'patner': qs.partner,
                            'video_id':videoId,
                            'pageview':pageview
                        }
		        }).done(function(response){
                    var videonya = document.getElementById('videoXl');
                    if(response.status=='success'){
                        $(this).hide();
                        $(".bg_play").hide();
						$(".video_cover").hide();
                        $("#trigger_play").hide();
                        $('#videoXl').attr('src',videourl);
                        videonya.play();
                        $('.idUnix').val(response.id);
                    }else{
                        alert(response.message);
                    }
		         });

                console.log(videonya);






		});

		$("#close_button").click(function(e){
			var current = $('#current').text();
			var videonya = document.getElementById('videoXl');
			e.preventDefault();
			var upload = $(this).attr("href");
			$("#modal_popup").show();
			 videonya.pause();
			 //$("#detik_video").text(current);
			 /*user[0].count_Play=(user[0].count_Play+1);
				if(user!='')
				{
					savelocalstorage(user);
				}*/
		});
		$("#playButton").click(function(e){
			videonya.play();
		})
		$("#resumeVideo").click(function(e){
			var videonya = document.getElementById('videoXl');
			$("#trigger_play").hide();
			$(".video_cover").hide();
			$("#modal_popup").hide();
			videonya.play();
		});
		$("#close_browser").click(function(e){


			$("#canvas_banner").remove();
			$("#modal_popup").hide();

		});
	});

	function onTrackedVideoFrame(currentTime, duration){
	    $("#current").text(currentTime); //Change #current to currentTime
        $("#duration").text(duration);
        var qs = (function(a) {
			if (a == "") return {};
			var b = {};
			for (var i = 0; i < a.length; ++i)
			{
				var p=a[i].split('=', 2);
				if (p.length == 1)
					b[p[0]] = "";
				else
					b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
			}
			return b;
		})(window.location.search.substr(1).split('&'));
        var current = $('#current').text();
        var statusupdate = $('.statusupdate').val();
        var idUnix = $('.idUnix').val();
        if(statusupdate==0){
            $.ajax({
                type: "POST",
                url : url + "/setData",
                contentType: 'application/x-www-form-urlencoded',
                data: {
                        'shopbackid' : qs.shopbackid,
                        'shopbackid2': qs.shopbackid2,
                        'patner'     : qs.partner,
                        'duration'   : currentTime,
                        'total_duration':duration,
                        'video_id'   : videoId,
                        'id'         : idUnix
                    },
                beforeSend:function() {
							$('.statusupdate').val('1');
				},
            }).done(function(response){
                $('.statusupdate').val('0');

            });

        }


	}

	document.getElementById('videoXl').addEventListener('ended',myHandler,false);
    function myHandler(e) {
			$(".video_cover").show();
			$("#closeEnded").show();
			$("#close_button").hide();
    }
	function savelocalstorage(user){
		localStorage.setItem('user'+user[0].shopbackid,   JSON.stringify(user));
	}



</script>
</html>
