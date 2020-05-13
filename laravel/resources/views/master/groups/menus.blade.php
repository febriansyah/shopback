@foreach($menu_listing as $list_menu)
	<div class="checkbox">
		<label>
			@if ($list_menu['parent_id'] != '' && $list_menu['parent_id'] != 0)
				{!! $prefix !!}
				<!-- <img src="{{ backend_assets_url('images/tree-taxo.png', 'global') }}"/>&nbsp;&nbsp; -->
			@endif

			<input type="checkbox" value="{{ $list_menu['id'] }}" name="user_menus[]" id="auth-{{ $list_menu['id'] }}" class="auth-menu checkauth" {!! (isset($permission_menus[$list_menu['id']])) ? 'checked="checked"' : '' !!} /> {{ $list_menu['menu'] }}
		</label>
	</div>
	@if (isset($user_menus[$list_menu['id']]))
		@include(backend_path('.groups.menus'), ['menu_listing' => $user_menus[$list_menu['id']], 'prefix' => $prefix. '&nbsp;&nbsp;&nbsp;&nbsp;'])
	@endif
@endforeach