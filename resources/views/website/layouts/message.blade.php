<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">
            {{ Session::get('alert-' . $msg) }} 
            <a href="#" class="close" data-dismiss="alert" aria-label="close" 
            onclick="event.preventDefault();closeAlert();location.reload();">&times;</a>
        </p>
        @endif
    @endforeach
</div>
<!-- Works sending message through flash() to Session::class in the controller. Needs JAVA query -->