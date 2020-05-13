<?php
use Illuminate\Support\Str;
/**
 * Limit Wordss
 */
function limitWord($str, $limit,$aftr='...') {
	$str = strtolower($str);
	$word = Str::words($str, $limit, $aftr);
	return $word;
}
/**
 * Current Storage
 */
function current_storage($path=''){
	return Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix().$path;
}
/**
 * Indonesian Date
 */
function indonesiaDate($date) {
    $date = str_replace('Monday', 'Senin', $date);
	$date = str_replace('Tuesday', 'Selasa', $date);
	$date = str_replace('Wednesday', 'Rabu', $date);
	$date = str_replace('Thursday', 'Kamis', $date);
	$date = str_replace('Friday', "Jum'at", $date);
	$date = str_replace('Saturday', 'Sabtu', $date);
	$date = str_replace('Sunday', 'Minggu', $date);
	$date = str_replace('January', 'Januari', $date);
	$date = str_replace('February', 'Februari', $date);
	$date = str_replace('March', 'Maret', $date);
	$date = str_replace('April', 'April', $date);
	$date = str_replace('May', 'Mei', $date);
	$date = str_replace('June', 'Juni', $date);
	$date = str_replace('July', 'Juli', $date);
	$date = str_replace('August', 'Agustus', $date);
	$date = str_replace('September', 'September', $date);
	$date = str_replace('October', 'Oktober', $date);
	$date = str_replace('November', 'November', $date);
	$date = str_replace('December', 'Desember', $date);
	return $date;

}
/**
 * Indonesian Date
 */
function eventDateFormat($date) {
	$date = Carbon::parse($date)->formatLocalized('%A, %d %B %Y');
	if (lang() != 'id') {
		return $date;
	}
	$date = str_replace('Monday', 'Senin', $date);
	$date = str_replace('Tuesday', 'Selasa', $date);
	$date = str_replace('Wednesday', 'Rabu', $date);
	$date = str_replace('Thursday', 'Kamis', $date);
	$date = str_replace('Friday', "Jum'at", $date);
	$date = str_replace('Saturday', 'Sabtu', $date);
	$date = str_replace('Sunday', 'Minggu', $date);
	$date = str_replace('January', 'Januari', $date);
	$date = str_replace('February', 'Februari', $date);
	$date = str_replace('March', 'Maret', $date);
	$date = str_replace('April', 'April', $date);
	$date = str_replace('May', 'Mei', $date);
	$date = str_replace('June', 'Juni', $date);
	$date = str_replace('July', 'Juli', $date);
	$date = str_replace('August', 'Agustus', $date);
	$date = str_replace('September', 'September', $date);
	$date = str_replace('October', 'Oktober', $date);
	$date = str_replace('November', 'November', $date);
	$date = str_replace('December', 'Desember', $date);
	return $date;
}
/**
 * Generate alert box notification with close button.
 *     style is based on bootstrap.
 *
 * @param string $msg          notification message
 * @param string $type         type of notofication
 * @param bool   $closeable closable button
 *
 * @return string notification with html tag
 */
function alert_box($msg, $type = 'warning', $closeable = true)
{
    $html = '';
    if ($msg != '') {
        $html .= '<div class="alert alert-'.$type.' alert-rounded alert-dismissible" role="alert">';
        if ($closeable) {
            $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
        $html .= (is_array($msg)) ? implode('<br/ >', $msg) : $msg;
        $html .= '</div>';
    }

    return $html;
}

/**
 * Upload path.
 *
 * @param  string $path
 *
 * @return string complete path
 */
function upload_path($path = '')
{
    return storage_path(). '/app/public/uploads/'. $path;
}

/**
 * Upload url.
 *
 * @param  string $path
 *
 * @return string complete url
 */
function upload_url($path = '')
{
    return asset('storage/uploads/'. $path);
}

/**
 * Upload url.
 *
 * @param  string $path
 *
 * @return string complete url
 */
function url_media($path = '')
{
    return asset('storage'. $path);
}

/**
 * Frontend path.
 *
 * @param  string $path
 *
 * @return string full path
 */
function frontend_path($path = '')
{
    return config('custom.location.frontend_path'). $path;
}

/**
 * Backend guard.
 *
 * @return string guard
 */
function frontend_guard()
{
    return config('custom.frontend.guard');
}


/**
 * Backend path.
 *
 * @param  string $path
 *
 * @return string full path
 */
function backend_path($path = '')
{
	return config('custom.location.backend_path'). $path;
}

/**
 * Backend url.
 *
 * @param  string $path
 *
 * @return string full url
 */
function backend_url($path = '')
{
	return config('custom.location.backend_url'). $path;
}

/**
 * Backend guard.
 *
 * @return string guard
 */
function backend_guard()
{
	return config('custom.backend.guard');
}

/**
 * Load assets url.
 *
 * @param  string $asset_url
 *
 * @return string assets url
 */
function load_asset($asset_url)
{
    return ( env('APP_ENV') === 'production' ) ? asset($asset_url) : asset($asset_url);
}

/**
 * Load backend assets url.
 *
 * @param  string $asset_url
 *
 * @return string assets url
 */
function frontend_assets_url($asset_url, $template = 'adminlte')
{
    // return asset('assets/'. $template. '/'. $asset_url);
    return asset('assets/'. $asset_url);
}

/**
 * Laravel Mix for path versioning
 *
 * @param  string $asset_url
 * @param  string $directory
 *
 * @return string asset url
 */
function mix_url($asset_url, $directory = 'assets')
{
    return mix($asset_url, $directory);
}

/**
 * Get generated laravel mix url.
 *
 * @param  string $asset_url
 * @param  string $location
 *
 * @return string asset location
 */
function backend_mix_url($asset_url, $location = 'backend/assets')
{
    return mix($asset_url, $location);
}
/**
 * Get generated id youtube.
 *
 * @param  string $url_youtube
 *
 * @return string asset id Youtube
 */
function getYouTubeVideoId($url_youtube) {
    $link = $url_youtube;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = @$video_id[1];
    if (empty($video_id[1])) $video_id = @explode("/v/", $link);
    $video_id = @explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}
/**
 * Load backend assets url.
 *
 * @param  string $asset_url
 * @param  string $template
 *
 * @return string assets url
 */
function backend_assets_url($asset_url, $template = 'adminlte')
{
    return asset('backend/assets/'. $asset_url);
    // return asset('backend/assets/'. $template. '/'. $asset_url);
}

/**
 * Generate filename
 * so we can customize.
 *
 * @param object $file
 *
 * @return string $filename
 */
function generate_filename($file)
{
    $filename = str_replace_last($file->getClientOriginalExtension(), '', str_slug($file->getClientOriginalName()));

    return $filename;
}

/**
 * Get auth user.
 *
 * @return mixed auth user
 */
function auth_user()
{
    if (auth()->guard(backend_guard())->check()) {
        return auth()->guard(backend_guard())->user();
    }

    return false;
}

/**
 * Check user superadmin status.
 *
 * @return boolean
 */
function is_superadmin()
{
    if (auth()->guard(backend_guard())->check()) {
        return auth()->guard(backend_guard())->user()->is_superadmin;
    }

    return false;
}


/**
 * Get auth employee.
 *
 * @return mixed auth user
 */
function auth_employee()
{
    if (auth()->check()) {
        return auth()->user();
    }

    return false;
}

/**
 * Check wheater is staff or not.
 *
 * @return boolean
 */
function is_staff()
{
    if (auth()->user() && auth()->user()->user_level != 'staff') {
        return false;
    }

    return true;
}

/**
 * Check wheater is head or not.
 *
 * @return boolean
 */
function is_head()
{
    if (auth()->user() && auth()->user()->user_level != 'head') {
        return false;
    }

    return true;
}

/**
 * Get the user level.
 *
 * @return string|bool user level
 */
function user_level()
{
    if (auth()->user()) {
        return auth()->user()->user_level;
    }

    return false;
}

/**
 * Print Json with header.
 *
 * @param array $params parameters
 *
 * @return string encoded json
 */
function json_exit($json)
{
    header('Content-type: application/json');
    exit(
        json_encode($json)
    );
}

/**
 * Debug variable.
 *
 * @param mixed $params data to debug
 *
 * @return string print debug data
 */
function debugvar($params)
{
    echo '<pre>';
    print_r($params);
    echo '</pre>';
}
