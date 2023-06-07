<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="footer_wp">
                    <i class="icon_pin_alt"></i>
                    <h3>Contact us</h3>
                    <p>{!! $general ? $general->address:'' !!}</p>
                    <a href="tel:009442323221">{{ $general ? $general->primary_phone:'' }} </a>
                    <a href="tel:009442323221">{{ $general ? $general->secondary_phone:'' }} </a>
                    <a href="#0">{{ $general ? $general->email:'' }}</a>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <div class="footer_wp">
                    <i class="icon_tag_alt"></i>
                    <h3>Find us at</h3>
                    <p>
                        <p class="ganti-font"><span><a href="https://gofood.link/u/v2aRYq"><img src="{{ asset('assets/frontend/img/GoFood.png') }}" style="width:50%"></span></p>
                        <p class="margin_top_20"><span><a href="https://food.grab.com/id/id/restaurant/c-code-coffee-tomang-delivery/6-C2AFSBBEJXMTEN"><img src="{{ asset('assets/frontend/img/GrabFood.png') }}" style="width:50%"></a></span></p>
                        <!-- <p class="margin_top_20"><span><a href="https://tokopedia.link/Fyr9398M0zb"><img src="{{ asset('assets/frontend/img/tokopedia.png') }}" style="width:50%"></span></p> -->
                    </p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                <h3>Keep in touch</h3>
                <div id="newsletter">
                    <div id="message-newsletter"></div>
                    <!-- <form>
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control"
                                placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                        </div>
                    </form> -->
                    <div class="follow_us">
                        <ul>
                            <li><a href="{{ $general ? $general->facebook:'' }}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $general ? $general->twitter:'' }}"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ $general ? $general->instagram:'' }}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 text-center">
                <p class="copy">© {{ $general ? $general->company_name:'' }} - All rights reserved</p>
            </div>
        </div>
        <p class="text-center"></p>
    </div>
</footer>