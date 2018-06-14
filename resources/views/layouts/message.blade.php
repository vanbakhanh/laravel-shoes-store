@extends('layouts.master')
@section('title', 'Message')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Message</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    @if (session('status'))
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('status') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    @foreach($errors->all() as $err)
                    <p class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ $err }}
                    </p>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
