<footer class="footer py-2 w-100">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="copyright float-left m-0">{{ trans('layout.copyright') }} <a href="https://fb.com/vanbakhanh" target="_blank">vanbakhanh</a></p> 
				<a class="float-right text-primary text-uppercase pl-1 m-0" href="{{ route('user.change-language', ['en']) }}" ><small>EN</small></a>
				<a class="float-right text-primary text-uppercase m-0" href="{{ route('user.change-language', ['vi']) }}" ><small>VI</small></a>
			</div>
		</div>
	</div>
</footer>
