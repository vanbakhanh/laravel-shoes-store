<!--Footer section start-->
<footer class="mt-4">
    <div class="container">
        <div class="pt-4 border-top text-capitalize">
            <div class="row">

                <div class="footer-widget col-lg-6 col-md-6 col-sm-6 col-12 mb-4 mb-xs-3">
                    <p>@lang('layouts.slogan')</p>
                    <h3>@lang('layouts.follow_on_social'):</h3>
                    <div class="footer-social">
                        <a href="https://facebook.com/vanbakhanh" target="_blank" class="mr-4"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/vanbakhanh" target="_blank" class="mr-4"><i
                                class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/vanbakhanh/" target="_blank" class="mr-4"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/vanbakhanh/"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

                <div class="footer-widget col-lg-2 col-md-6 col-sm-6 col-12 mb-4 mb-xs-3">
                    <h4 class="title"><span class="text">@lang('layouts.open_time')</span></h4>
                    <p class="mb-15">@lang('layouts.mon') – @lang('layouts.fri'): 8AM – 10PM</p>
                    <p class="mb-15">@lang('layouts.sat'): 9AM-8PM</p>
                    <p class="mb-15">@lang('layouts.sun'): @lang('layouts.closed')</p>
                    <b class="opeaning-title">@lang('layouts.work_all_holiday')</b>
                </div>

                <div class="footer-widget col-lg-2 col-md-6 col-sm-6 col-12 mb-4 mb-xs-3">
                    <h4 class="title"><span>@lang('layouts.my_account')</span></h4>
                    <ul class="list-unstyled">
                        @auth
                        <li><a href="{{ route('user.edit', Auth::user()->id) }}">@lang('layouts.my_account')</a></li>
                        @endauth
                        @guest
                        <li><a href="{{ route('login') }}">@lang('layouts.my_account')</a></li>
                        @endguest
                        <li><a href="{{ route('cart.index') }}">@lang('layouts.wishlist')</a></li>
                        <li><a href="{{ route('order') }}">@lang('layouts.order_tracking')</a></li>
                        <li><a href="#">@lang('layouts.privacy_policy')</a></li>
                        <li><a href="#">@lang('layouts.shipping_info')</a></li>
                    </ul>
                </div>

                <div class="footer-widget col-lg-2 col-md-6 col-sm-6 col-12 mb-4 mb-xs-3">
                    <h4 class="title"><span>@lang('layouts.about_us')</span></h4>
                    <ul class="list-unstyled">
                        <li><a href="#">@lang('layouts.about_us')</a></li>
                        <li><a href="#">@lang('layouts.shopping_guide')</a></li>
                        <li><a href="#">@lang('layouts.delivery_info')</a></li>
                        <li><a href="#">@lang('layouts.privacy_policy')</a></li>
                        <li><a href="#">@lang('layouts.our_store')</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="py-4 border-top">
            <div class="row">
                <div class="col text-left">
                    <p class="m-0">
                        @lang('layouts.copyright')
                    </p>
                </div>
                <div class="col text-right">
                    <p class="m-0">
                        <a href="#">@lang('layouts.back_to_top')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>