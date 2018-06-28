<footer class="footer py-4 w-100">
	<div class="container">
		<hr>
		<div class="row">
			<div class="col-md-12">
				<p class="copyright text-uppercase float-left m-0">{{ trans('layout.copyright') }} 
					<a class="text-dark" href="https://fb.com/vanbakhanh" target="_blank">vanbakhanh</a>
				</p> 
				<p class="float-right text-uppercase m-0">
					<a class="text-dark" href="{{ route('user.language', ['en']) }}" >{{ trans('layout.english') }}</a>
					|
					<a class="text-dark" href="{{ route('user.language', ['vi']) }}" >{{ trans('layout.vietnamese') }}</a>
				</p>
			</div>
		</div>
	</div>
</footer>
