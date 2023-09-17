@auth
@if(Auth::user()->isAdmin() ||Auth::user()->isFamily())
<footer class="page-footer font-small unique-color-dark pt-4">
    <div class="container text-center">
        <a target="_blank" class="btn" rel="noreferrer" href="http://owncloud.seatheworld.fr/"
            style="padding:10px;background-color:#1B223D;color:#fff;border-radius:3px;padding-left:4px;">
                <img src="http://owncloud.seatheworld.fr/core/img/logo-icon.svg" style="width:50px;position:relative;">
                Ajouter des photos
        </a>
    </div>
    </br>
</footer>
@endif
@endauth