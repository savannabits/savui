<div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header text-center"><strong>{{ trans('savannabits/admin-ui::admin.profile_dropdown.account') }}</strong></div>
    <a href="{{ url('profile') }}" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
    <a href="{{ url('password') }}" class="dropdown-item"><i class="fa fa-key"></i> Password</a>
    {{-- Do not delete me :) I'm used for auto-generation menu items --}}
    <a href="{{ url('logout') }}" class="dropdown-item"><i class="fa fa-lock"></i> {{ trans('savannabits/admin-auth::admin.profile_dropdown.logout') }}</a>
</div>
