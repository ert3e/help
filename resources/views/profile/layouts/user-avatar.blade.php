<div class="profile-head__avatar">
@auth
    @if ($avatar)
        <img height="86" src="{{ $avatar->temporaryUrl() }}" alt="Profile Photo" class=" rounded-circle">
    @else
        <img height="86" src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo" class=" rounded-circle">

            <div class="pencil-icon" onclick="document.getElementById('avatar').click();">Change Avatar</div>

    @endif
    <input class="d-none" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" class="mt-2 mx-5" wire:model="avatar"/>

    <button  class="btn w-100 btn-primary text-white mt-3" wire:click="changeAvatar">
        Save changes
    </button>
@else
    <img height="86" src="http://www.gravatar.com/avatar/?d=identicon" alt="Profile Photo" class=" rounded-circle">
        <div class="pencil-icon">
            <img src="/images/site/Subtract.svg" alt="Add photo">
        </div>

@endauth
</div>