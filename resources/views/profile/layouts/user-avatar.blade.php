<div class="profile-head__avatar">
@auth
        @if (auth()->user()->avatar)
            <img height="86" src="/uploads/avatars/{{ auth()->user()->avatar }}" alt="Profile Photo" class=" rounded-circle">

                <div class="pencil-icon" onclick="document.getElementById('avatar').click();">
                    <img src="/images/site/Subtract.svg" alt="Add photo">
                </div>
                <form enctype="multipart/form-data" action="{{ route('profile.avatar') }}" method="POST">
                    <input name="avatar" type="file" id="avatar" accept="image/png, image/jpeg" onchange="form.submit()"  hidden>
                    <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                </form>
        @else
            <img height="86" src="http://www.gravatar.com/avatar/?d=identicon" alt="Profile Photo" class=" rounded-circle">
            <div class="pencil-icon" onclick="document.getElementById('avatar').click();">
                <img src="/images/site/Subtract.svg" alt="Add photo">
            </div>
            <form enctype="multipart/form-data" action="{{ route('profile.avatar') }}" method="POST">
                <input name="avatar" type="file" id="avatar" accept="image/png, image/jpeg" onchange="form.submit()"  hidden>
                <input type="hidden"  name="_token" value="{{ csrf_token() }}">
            </form>
        @endif
@endauth
</div>