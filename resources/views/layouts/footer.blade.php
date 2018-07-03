<footer class="footer py-4 w-100">
	<div class="container">
		<hr>
		<div class="row">
			<div class="col-md-12">
				<p class="copyright text-uppercase float-left m-0">{{ trans('layouts.copyright') }} 
					<a href="https://fb.com/vanbakhanh" target="_blank">vanbakhanh</a>
				</p> 
				<p class="float-right text-uppercase m-0">
					<a href="{{ route('user.language', ['en']) }}" >{{ trans('layouts.english') }}</a>
					|
					<a href="{{ route('user.language', ['vi']) }}" >{{ trans('layouts.vietnamese') }}</a>
				</p>
			</div>
		</div>
	</div>
</footer>
