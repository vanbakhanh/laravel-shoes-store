{{-- Display success notification --}}
@if (session('status'))
<div class="alert alert-dismissible alert-success mt-4">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('status') }}
</div>
@endif

{{-- Display errors notification --}}
@if ($errors->any())
@foreach ($errors->all() as $err)
<div class="alert alert-dismissible alert-danger mt-4">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ $err }}
</div>
@endforeach
@endif