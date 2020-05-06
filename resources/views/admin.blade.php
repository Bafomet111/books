<!DOCTYPE html>
<html>

@if(!$auth)
    @include('auth')
@else
     @include('admincontent')
@endif



</html>
