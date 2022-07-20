                    <div class="col-md-3 profile-section bg-white">
                        <div class="profile-info-section">
                            <h1 class="my-0 mb40-important">Hello {{ strtok(Auth::user()->name, ' ') }},</h1>
                            <p class="my-0 mb10-important">{{ date('h:i:s') }}</p>
                            <p class="my-0 mb40-important">{{ date('M d Y') }}</p>
                            <a href="{{ route('logout') }}" class="btn rounded-0 sign-in-button logout mb45" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        <hr class="mb50-important" />
                        <div class="row mx-auto profile-product-section">
                            <div class="col-md-12 d-flex align-items-center px-lg-0 px-xl-0 px-xxl-0 mb40">
                                <img src="{{ asset('frontend/images/art/demo3.png') }}" alt="" />
                                <a href="{{ route('painting.show', 1) }}" class="">La Réunion Acryilic</a>
                            </div>
                            <div class="col-md-12 d-flex align-items-center px-lg-0 px-xl-0 px-xxl-0">
                                <img src="{{ asset('frontend/images/art/demo3.png') }}" alt="" />
                                <a href="{{ route('painting.show', 1) }}" class="">La Réunion Acryilic</a>
                            </div>
                        </div>
                    </div>
