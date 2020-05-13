<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

use App\Models\Dashboard\UserMenu;

class StatisServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (request()->segment(1) == 'master' && request()->ajax() == false) {

            $allowed_url =array('login','logout','home','dashboard','profile','me');

            if (request()->segment(2) != '' && ! in_array(request()->segment(2), $allowed_url)) {

               $stringfile = request()->segment(2);
               if(request()->segment(3)!=''){
                $stringfile .= '/'.request()->segment(3);
               }
               if(request()->segment(4)!=''){
                $stringfile .= '/'.request()->segment(4);
               }
               if(request()->segment(5)!=''){
                $stringfile .= '/'.request()->segment(5);
               }

                $menu_info = (new UserMenu)->getUserMenuInfoByPath( $stringfile);
            //    dd( $menu_info);
                if ($menu_info && $menu_info->count()) {
                    $active_menus[] = $menu_info;

                    $active_menus = (new UserMenu)->getActiveMenuWithParent($menu_info['parent_id'], $active_menus);

                    $collect_menu = collect($active_menus);

                    $grouped_menu = $collect_menu->groupBy('id');

                    View::share('active_menus', $grouped_menu);

                    view()->composer('master.layouts.breadcrumbs', function ($view) use ($active_menus, $menu_info) {
                        $breadcrumbs = collect((new UserMenu)->getBreadcrumbs($active_menus, $menu_info['id']));

                        View::share('breadcrumbs', $breadcrumbs->reverse()->all());
                    });

                    View::share('menu_info', $menu_info);
                }

            }
            view()->composer('master.layouts.topbar', function ($view) {

                if (Auth::guard('backend')->check()) {

                    View::share('users', Auth::guard('backend')->user());
                }
            });

            view()->composer('master.layouts.sidebar', function ($view) {

                if (Auth::guard('backend')->check()) {

                    $user_group_id = Auth::guard('backend')->user()->user_group_id;
                    $menu_dashboard = (new UserMenu)->getAuthMenuByGroup($user_group_id)->threaded('parent_id');

                    View::share('menu_dashboard', $menu_dashboard);
                }
            });
        }else if (request()->segment(1) == 'cms' && request()->ajax() == false) {

            $allowed_url =array('login','logout','home','cms','profile','me');

            if (request()->segment(2) != '' && ! in_array(request()->segment(2), $allowed_url)) {

               $stringfile = request()->segment(2);
               if(request()->segment(3)!=''){
                $stringfile .= '/'.request()->segment(3);
               }
               if(request()->segment(4)!=''){
                $stringfile .= '/'.request()->segment(4);
               }
               if(request()->segment(5)!=''){
                $stringfile .= '/'.request()->segment(5);
               }


            }
            view()->composer('dashboard.layouts.header', function ($view) {
                View::share('login', true);
                if (Auth::guard('dashboard')->check()) {

                    View::share('users', Auth::guard('dashboard')->user());
                    View::share('login', false);
                }
            });



        }else{
            // dd('masuk');
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
