/**
 * Custom script.
 * 
 * @author ivan lubis
 * @version 2.0
 * @description this library is required jquery and other library
 */

/**
 * Convert string to url friendly. slugify the string.
 * 
 * @param  {String} val
 * 
 * @return {String} converted value
 */
function slugify(text)
{
    return text.toString().toLowerCase().trim()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/&/g, '-and-')         // Replace & with 'and'
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-');
}

/**
 * List of DataTables.
 * 
 * @param  {Object} element
 * @param  {String} url
 * 
 * @return {Object} List Data
 */
function list_dataTables(element, url) {
    $(document).ready(function () {
        var selected = [];
        var sort = [];
        if ($(element+' thead th.default_sort').index(element+' thead th') > 0) {
            sort.push([$(element+' thead th.default_sort').index(element+' thead th'),"desc"]);
        }
        var colom = [];
        var i=0;
        $(element+' thead th').each(function() {
            var edit = $(this).data('edit');
            var view = $(this).data('view');
            colom[i] = {
                'data':(typeof $(this).data('name') === 'undefined') ? null : $(this).data('name'),
                'name':(typeof $(this).data('name') === 'undefined') ? null : $(this).data('name'),
                'searchable':(typeof $(this).data('searchable') === 'undefined') ? true : $(this).data('searchable'),
                'sortable':(typeof $(this).data('orderable') === 'undefined') ? true : $(this).data('orderable'),
                'className':(typeof $(this).data('classname') === 'undefined') ? null : $(this).data('classname')
            };
            i++;
        });
        $(element +' tfoot th.searchable').each( function () {
            var title = $(this).text();
            var option_data = $(this).data('option-list');
            if (typeof option_data !== 'undefined') {
                var opt_html = '';
                opt_html += '<select class="form-control input-sm column-option-filter">';
                opt_html += '<option value=""></option>';

                $.each(option_data, function(value, text) {
                    opt_html += '<option value="'+ value +'">'+ text +'</option>';
                });
                opt_html += '</select>';
                $(this).html(opt_html);
            } else {
                $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control input-sm column-search-filter" />' );
            }
        } );
        var DTTable = $(element).DataTable({
            "processing": true,
            "serverSide": true,
            /*"ajax": $.fn.dataTable.pipeline({
                url: url,
                pages: perpage // number of pages to cache
            })*/
            "ajax": {
                "url": url,
                "type": "POST",
                "data": window.Laravel
            },
            "rowCallback": function( row, data ) {
                if ( $.inArray(data.DT_RowId, selected) !== - 1) {
                    $(row).addClass('selected');
                }
                if ( typeof data.RowClass !== 'undefined' && data.RowClass != '') {
                    $(row).addClass(data.RowClass);
                }
            },
            "columns":colom,
            "order":sort
        });
        $(element+'_filter input').unbind();
        $(element+'_filter input').keyup(function (e) {
            if (e.keyCode == 13) {
                DTTable.search(this.value).draw();
            }
        });
        if ($(element +' tfoot th.searchable').length > 1) {
            DTTable.columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keydown', function (ev) {
                     if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        that
                        .search( this.value )
                        .draw();
                    }
                } );
                $( 'select', this.footer() ).on( 'change', function (ev) {
                    that
                    .search( this.value )
                    .draw();
                } );
            } );
        }
        /*
        // edit record
        //$(element+' tbody').on('click', 'td.details-control', function () {
        $(element+' tbody').on('click', 'td.details-control span', function () {
            var selfspan = $(this);
            var selfurl = selfspan.data('url');
            var tr = this.closest('tr');
            var id = tr.id;
            window.location.href = current_ctrl+selfurl+'/'+id;
        });
        */
        // selected row
        $(element+' tbody').on('click', 'tr', function () {
            var id = this.id;
            var index = $.inArray(id, selected);

            if ( index === -1 ) {
                selected.push( id );
            } else {
                selected.splice( index, 1 );
            }
            console.log(selected);
            $("#delete-record-field").val(selected);

            $(this).toggleClass('selected');
        });
        // delete record
        $(document).on('click', '.delete-record, #delete-record', function () {
            if (selected.valueOf() != '') {
                
                var url_delete = $(this).data('url');
                var conf = confirm('Are You sure want to delete this record(s)?');
                console.log(selected);
                if (conf) {
                    $.ajax({
                        url:url_delete,
                        type:'delete',
                        data: {
                            'id': selected
                        },
                        dataType:'json'
                    }).
                    done(function(data) {
                        if (data.status=="success") {
                            $(".flash-message").html(data.message);
                            $(element+' tbody tr.selected').remove();
                            DTTable.draw();
                            selected = [];
                            $("#delete-record-field").val('');
                        }
                        if (data.status=="error") {
                            $(".flash-message").html(data['error']);
                        }
                    })
                    ;
                }
            }
        });
        //change status
        $(document).on('change','.change-status',function(){
            if (selected.valueOf() != '') {
                
                var url_change_status = $(this).data('url');
                var status = $(this).val();
                // var conf = confirm('Are You sure want to change status this record(s)?');
               if(status!=''){
                    var conf = confirm('Are You sure want to change status this record(s)?');
                
                }
                if (conf) {
                    $.ajax({
                        url:url_change_status,
                        type:'post',
                        data: {
                            'id': selected,
                            'status':status
                        },
                        dataType:'json'
                    }).
                    done(function(data) {
                        if (data.status=="success") {
                            $(".flash-message").html(data.message);
                            $(element+' tbody tr.selected').remove();
                            DTTable.draw();
                            selected = [];
                            $("#delete-record-field").val('');
                            $("#Modalkarya .close").click()
                        }
                        
                    })
                    ;
                }else{
                   $('.change-status').val('').change();
                }
            }
        })
		 //change city
        $(document).on('change','.change-city',function(){
               var url_change_city = $(this).data('url');
                var city = $(this).val();
               var  url =  url_change_city+'/'+city;
                // DTTable.reload();
                DTTable.ajax.url( url ).load();
                console.log(url);
        })
        $(document).on('click','.btn-detail-karya',function(){
            idKarya = $(this).attr('data-id');
            url = $(this).attr('data-url-get')+'/'+idKarya;
           
            $.ajax({
                url:url,
                type:'get',
               dataType:'json'
            }).
            done(function(data) {
               
                if (data.status=="success") {
                    
                   $('#JudulKarya').html(data.karya.judul_karya);
                   $('#CategoryKarya').html(data.karya.category.name);
                   $('#SubcategoryKarya').html(data.karya.subcategory.name);
                   $('#PenulisKarya').html(data.karya.user.name+' | email: '+data.karya.user.email+' | phone: '+data.karya.user.phone);
				   $('#DeskripsiKarya').html('<br>'+data.karya.deskripsi_karya);
                   $("#Modalkarya").modal("show");
                   
                   if(data.karya.category_id==2){
                         $('.galeriimageshowcase').html('<iframe width="800" height="450" src="https://www.youtube.com/embed/'+data.video+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
                       }else{
                        var str ='';
                                $.each(data.images,function(k,v){
                                    if(data.images.length==1){
                                        str +='<div class="col-md-12">';
                                        str +='<img data-enlargable  class="img-responsive" src="'+data.url+'/'+v.id+'/'+v.file_name+'">';
                                        str +='</div>';
                                    }else if(data.images.length>=3){
                                        str +='<div class="col-md-4">';
                                        str +='<img data-enlargable  class="img-responsive" src="'+data.url+'/'+v.id+'/'+v.file_name+'">';
                                        str +='</div>';
                                    }else{
                                        str +='<div class="col-md-6">';
                                        str +='<img data-enlargable  class="img-responsive" src="'+data.url+'/'+v.id+'/'+v.file_name+'">';
                                        str +='</div>';
                                    }
                                   
                                });
                              
                                console.log(str);
                                $('.galeriimageshowcase').html(str);
                                
                           }

                }
                
            })
        });
		$('#Modalkarya').on('hide.bs.modal', function (e) {
			 $('.galeriimageshowcase').html('');
		});
        $(document).on('click','img[data-enlargable]',function(){
            $(this).addClass('img-enlargable');
        // $('img[data-enlargable]').addClass('img-enlargable').click(function(){
            var src = $(this).attr('src');
            console.log(src);
            $('<div>').css({
                background: 'RGBA(0,0,0,.5) url('+src+') no-repeat center',
                backgroundSize: 'contain',
                width:'100%', height:'100%',
                position:'fixed',
                zIndex:'10000',
                top:'0', left:'0',
                cursor: 'zoom-out'
            }).click(function(){
                $(this).remove();
            }).appendTo('body');
        });
    });
}
$(document).on('change','.multipelFile',function(e){
    var input = $(this);
    var x = parseInt(input.attr('data-row'));
    // var urutan=0;
    console.log(x);
    var z = input.attr('data-row');
    var rowtotla= 0;
	for (var i = 0; i < input[0].files.length; i++) {
		// inject an image with the src url
        var fileName = input[0].files[i].name;
       
     
       
        
            var reader = new FileReader();
            
			reader.onload = function(event,wah) {
				the_url = event.target.result;
                 var mimeType = the_url.split(",")[0].split(":")[1].split(";")[0];
                 
                var newImages= new Image();
                var width = 500;
                ++x;
               var urutan = x;
               rowtotla=urutan;
               
                var scaleFactor = width / newImages.width;
                
                newImages.src = event.target.result;
                newImages.onload = () => {
                   
                    var canvs = document.createElement('canvas');
                   var max_size = 544; // TODO : pull max size from a site config
                    var width = newImages.width;
                   var  height = newImages.height;
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    canvs.width = width;
                    canvs.height = height;
                    
                    var ctx = canvs.getContext('2d');
                    // img.width and img.height will contain the original dimensions
                    ctx.drawImage(newImages, 0, 0, width,  height);
                    // var dataURL = ctx.toDataURL("image/jpeg");
                    //  ctx.toDataURL('image/jpeg');
                     var dataURL = ctx.canvas.toBlob((blob) => {
                        var file = new File([blob], fileName, {
                            type: 'image/jpeg',
                            lastModified: Date.now(),
                            url:dataURL
                        });
                       
                    }, 'image/jpeg', 1);
                    var dataurl = canvs.toDataURL();
                     
                    if(mimeType=='image/jpeg' || mimeType=='image/jpg')
                        {
                            if(x==0)
                            {
                                
                                var str='<div class="row row-upload col-md-12 urutan'+urutan+'">'
                                            +'<div class="col-md-6">'
                                                +'<div class="form-group">'
                                                    +'<label for="file">Caption <span class="text-danger">*</span></label>'
                                                    +'<textarea class="form-control editorable caption" rows="10" name="caption" id="caption"></textarea>'
                                                    +' <input type="hidden" class="form-control images" name="images" id="name" value="'+dataurl+'"/>'
                                                    +'</div>'
                                                +'</div>'
                                                +'<div class="col-md-4 col-md-offset-1">'
                                                +'<div class="form-group">'
                                                    +'<label for="avatar">Photo </label><br />'
                                                    +'<div class="fileinput fileinput-new" data-provides="fileinput">'
                                                        +'<div class="fileinput-new fileinput-upload thumbnail" style="width: 200px; height: 150px;">'
                                                            +'<img src="'+dataurl+'" id="post-image" />'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                            
                                            +'</div>'
                                            +'<div  class="col-md-1">'
                                                +'<div class="form-group Deletefile" data-urut="'+urutan+'">'
                                                    +'<label for="avatar "> Delete </label><br />'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>';
                                $('.list-upload').append(str); 
                            }
                            else{
                                
                                
                                var str='<div class="row row-upload col-md-12 urutan'+urutan+'">'
                                            +'<div class="col-md-6">'
                                                +'<div class="form-group">'
                                                    +'<label for="file">Caption <span class="text-danger">*</span></label>'
                                                    +'<textarea class="form-control editorable caption" rows="10" name="caption" id="caption"></textarea>'
                                                    +' <input type="hidden" class="form-control images" name="images" id="name" value="'+dataurl+'"/>'
                                                    +'</div>'
                                                +'</div>'
                                                +'<div class="col-md-4 col-md-offset-1">'
                                                +'<div class="form-group">'
                                                    +'<label for="avatar">Photo </label><br />'
                                                    +'<div class="fileinput fileinput-new" data-provides="fileinput">'
                                                        +'<div class="fileinput-new fileinput-upload thumbnail" style="width: 200px; height: 150px;">'
                                                            +'<img src="'+dataurl+'" id="post-image" />'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                            
                                            +'</div>'
                                            +'<div  class="col-md-1">'
                                                +'<div class="form-group Deletefile" data-urut="'+urutan+'">'
                                                    +'<label for="avatar "> Delete </label><br />'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>';		
                                
                                $('.list-upload').append(str);
                                
                            }
                            
                            
                        }


                }


               
               input.attr('data-row',urutan);
			
				
			
			}
           
		  // when the file is read it triggers the onload event above.
		  reader.readAsDataURL(input[0].files[i]);
		 
		  // image= input.files[i].toDataURL("image/jpg");
    	
    }
    
   

});

$(document).on('click','.Deletefile',function(e){
    var urutannya = $(this).attr('data-urut');
    $('.urutan'+urutannya).remove();

});

$(document).on('click','.sumbit-upload',function(){
    var url =$(this).attr('data-url');
    console.log(url);
    $('.row-upload').each(function(i, obj) {
        var thiss = $(this);
        var caption= $(this).find('.caption').val();
        var images = $(this).find('.images').val();
        $.ajax({ //ajax form submit
            url : url,
            type: "POST",
            data : {ajax:true,caption:caption,images:images},
            dataType : "json",
        }).done(function(res){ //fetch server "json" messages when done
		
            if(res.status=='success')
            {
                thiss.remove();
            }
			
        });
    });

});
$(document).on('click','.saveimage',function(){
	var urutan = $(this).attr('data-urut');
	if(urutan==0)
	{
		urutan="";
	}
     var url = $(this).attr('data-url');
	var data = new FormData($('#formupload'+urutan)[0]);
	var thisss= $(this);
	 $.ajax({ //ajax form submit
            url : url,
            type: "POST",
            data : data,
            dataType : "json",
            contentType: false,
            cache: false,
            processData:false,
        }).done(function(res){ //fetch server "json" messages when done
		
			if(res.status==1)
			{
				$('#formupload'+urutan).find('.msgError').html(res.success);
				thisss.remove();
				 $('html, body').animate({
					scrollTop: $('#formupload'+urutan).offset().top
				}, 200);
				totaltombol = $('.saveimage').length;
				if(totaltombol<1){
					window.location.replace("https://www.pbdjarum.org/djarumstaff/galeri/foto");
				}
			}
			else{
				console.log($('#formupload'+urutan).find('.msgError'));
				$('#formupload'+urutan).find('.msgError').html(res.warning);
				 $('html, body').animate({
					scrollTop: $('#formupload'+urutan).offset().top
				}, 200);
							
			}
			// w

          	return false;
        });
	return false;
});
$('#HasilKarya').slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear'
  });
/**
 * Ajax Post Data
 * 
 * @param  {string} url URL
 * @param  {string} data post data
 * @return {object} callback
 */
function ajax_post(url, data) {
    var callback = $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        cache: false
    });
    return callback;
}


/**
 * Submit via ajax by button
 * 
 * @param {string} url
 * @param {string} data
 * @param {object} this_var
 * @returns object/var
 */
function submit_ajax(url, data, this_var) {
    var callback = $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        beforeSend:function() {
            if (this_var || typeof this_var !== 'undefined') {
                this_var.html('Loading...');
                this_var.attr('disabled', true);
            }
        }
    });
    return callback;
}

$(function() {
    // listjs
    var options = {
        valueNames: ['auth_menu_name']
    };
    var authMenuList = new List('sidebar-auth', options);

    // select2
    $('.select2').select2()

    //Flat color scheme for iCheck
    $('.iCheckBox, input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        // checkboxClass: 'icheckbox_flat-green',
        // radioClass: 'iradio_flat-green'
    })
    $('input[type=checkbox].no-icheckbox').iCheck('destroy')

    $('.slugify').keyup(function () {
        $('#slug_url').val(slugify(this.value));
    })
})
$('.datepicker').datepicker({  

    format: 'yyyy-mm-dd'

  });  
