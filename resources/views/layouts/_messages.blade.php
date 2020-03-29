@if(session()->has('message'))

<div class="alert-success">
    {{ session()->get('message')}}
</div>

@endif

@if(session()->has('message1'))

<div class="alert-danger">
    {{ session()->get('message1')}}
</div>

@endif
