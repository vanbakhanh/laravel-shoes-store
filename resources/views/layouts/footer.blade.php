<footer class="footer py-4 w-100 bg-light">
	<div class="container">
		<div class="row">
			<div class="col-6 col-md">
				<p class="float-left text-center text-uppercase m-0">{{ trans('layouts.copyright') }} 
					<a href="https://fb.com/vanbakhanh" target="_blank">vanbakhanh</a>
				</p>
			</div>
			<div class="col-6 col-md">
				<p class="float-right text-center text-uppercase m-0">
					<a href="{{ route('user.language', ['en']) }}" >{{ trans('layouts.english') }}</a>
					|
					<a href="{{ route('user.language', ['vi']) }}" >{{ trans('layouts.vietnamese') }}</a>
				</p>
			</div>
		</div>
	</div>
</footer>
