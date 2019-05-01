<div class="form-group row my-4">
    <div class="col">
        <a href="{{ route('oauth', ['provider' => 'google']) }}" class="btn btn-block btn-google"><i
                class="fab fa-google"></i> Google</a>
    </div>
    <div class="col">
        <a href="{{ route('oauth', ['provider' => 'facebook']) }}" class="btn btn-block btn-facebook"><i
                class="fab fa-facebook"></i> Facebook</a>
    </div>
    <div class="col">
        <a href="{{ route('oauth', ['provider' => 'facebook']) }}" class="btn btn-block btn-twitter"><i
                class="fab fa-twitter"></i> Twitter</a>
    </div>
</div>