<!-- Footer -->
    <footer>
        <div id="footer-top" class="footer-top container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="footer-logo"><img src="{{asset('assets/images/logo-transparent.png')}}"> Jersey Swap</h2>
                    <p>Jersey Swap is revolutionizing the industry. Our platform operates as the central hub for sports jerseys and sports cards transactions. Everything is completed online!</p>
                </div>
                <div class="col-md-2">
                    <h4>Quick Links</h4>
                    <ul class="ft-list">
                        <li>
                            <a href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('about')}}">About Us</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{route('faq')}}">FAQ</a>
                        </li>
                        <li>
                            <a href="{{route('exchange')}}">List It</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h4>Legal Pages</h4>
                    <ul class="ft-list">
                        <li>
                            <a href="{{url('/terms-conditions')}}">Terms & Conditions</a>
                        </li>
                        <li>
                            <a href="{{url('/terms-of-service')}}">Terms of Service</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Contact us</h4>
                    <ul class="ft-list">
                        <li>
                            <i class="fa fa-envelope"></i> <b>Email: </b>
                            <a href="mailto:officialjerseyswap@gmail.com">officialjerseyswap@gmail.com</a>
                        </li>
                        <li>
                            <i class="fa fa-phone-volume"></i> <b>Phone: </b>
                            <a href="tel:856-600-4178">856-600-4178</a>
                        </li>
                    </ul>
                    <p class="border-b mt-5">
                        <b>Follow us on</b>
                    </p>
                    <ul class="social-media-list">
                        <li>
                            <a href="https://www.facebook.com/OfficialJerseySwap/" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        {{--<li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>--}}
                        <li>
                            <a href="https://instagram.com/Officialjerseyswap" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <img class="mt-4" src="https://www.merchantequip.com/image/?logos=v|m|a|d&height=32" alt="Merchant Equipment Store Credit Card Logos"/>
                </div>
            </div>
        </div>
        <div id="footer-bottom" class="footer-bottom text-center">
            <p>Copyright &copy; 2021 | All Rights Reserved</p>
        </div>
    </footer>

    <!-- Scroll To Top Button -->
    <button id="scroll-to-top" onclick="scrollToTop()" class="btn btn-dark">
      <i class="fas fa-chevron-up"></i>
    </button>

    
    @include('frontend.components.scripts')
    @yield('custom-scripts')

            <script>
                @if (\Illuminate\Support\Facades\Auth::check())
                    $(document).ready(function () {
                        countTotalMessages();
                        setInterval(function () {
                            countTotalMessages()
                        }, 10000);
                    })
                    function countTotalMessages() {
                        $.ajax({
                            url: "{{url('/users/count_messages')}}",
                            method: 'get',
                            data: { },
                            success: function (result) {
                                if(result.count_messages > 0) {
                                    $('#msgnotify').html('<i>'+result.count_messages+'</i>')
                                } else {
                                    $('#msgnotify').html('')
                                }
                            },
                            error: function (request, status, error) {
                                console.error(error);
                            }
                        });
                    }
                @endif
            </script>

</body>

</html>
