<div class="list-group">
    <a href="{{url('/users/settings/profile-photo')}}" class="list-group-item list-group-item-action @if(Request::path()=='users/settings/profile-photo') active @endif">Profile Photo</a>
    <a href="{{url('users/settings/account')}}" class="list-group-item list-group-item-action @if(Request::path()=='users/settings/account') active @endif" aria-current="true">
        Account
    </a>
    <a href="{{url('users/settings/security')}}" class="list-group-item list-group-item-action @if(Request::path()=='users/settings/security') active @endif">Security</a>
</div>
