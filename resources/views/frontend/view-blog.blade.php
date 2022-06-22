@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- blog heading -->
        <style>
            .blog-heading {
                background-image: url("{{ asset('frontend/images/art/blog-bg.png') }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
                position: relative;
            }

            .blog-heading-background {
                height: 100%;
                width: 100%;
                position: absolute;
                background: #380f28b3;
                backdrop-filter: blur(70px);
            }

            .heading-content-box {
                z-index: 999 !important;
                position: relative;
                color: white;
                width: 945px;
            }
        </style>
        <div class="blog-heading">
            <div class="blog-heading-background"></div>
            <div class="container px-lg-0 px-xl-0 px-xxl-0 heading-content-box pt96">
                <p class="my-0 mb30-important"><a href="/" class="text-decoration-none">Home</a> / <a href="{{ route('blogs') }}" class="text-decoration-none">Blog</a>/ <a href="javascript:void();" class="text-decoration-none">Sample Single Post</a></p>
                <h2 class="my-0 mb25-important">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
                <a href="javascript:void();" class="btn category-btn btn-sm">Abstract</a>
            </div>
        </div>
        <!-- blog heading -->
        <div class="container blog-details">
            <div class="container px-0 details-content-box">
                <img src="{{ asset('frontend/images/art/blog.png') }}" alt="" />
                <h3 class="mb-0">Lorem ipsum dolor sit amet,</h3>
                <p class="mb-0 pb96">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu condimentum viverra fermentum non iaculis. Vel ut vitae morbi porta egestas sit quam vitae, elementum. Volutpat amet, iaculis potenti vitae, arcu, mattis non. Quam eget adipiscing dictum et orci laoreet. Ornare suspendisse mattis vitae consectetur orci. Mattis vestibulum, turpis velit amet varius pellentesque.
                    Sollicitudin nisl dui, mi pulvinar nullam arcu integer sed lobortis. Tristique tincidunt nisi, ac tortor platea laoreet sit. Leo semper diam egestas amet lacus, lacus, bibendum aliquet. Volutpat, diam et ut dolor ultrices tortor, nullam sit. Sem sem at volutpat urna aliquam. Bibendum volutpat ac condimentum dui tellus enim mattis. Nibh enim massa et risus amet. Vitae donec
                    donec at lectus. Aliquam phasellus ultricies a, magna. Nunc purus sit amet, semper at amet, mus netus aliquam. Molestie risus quis molestie porta euismod volutpat eget. Nunc dolor justo lacus, quis tortor tellus purus placerat. Vitae, curabitur quam congue odio elit imperdiet aliquam. Vehicula justo, quam erat id dictum sit purus malesuada purus. Mi pellentesque scelerisque
                    fermentum lectus elit tortor. Massa ut felis purus cursus. Dui placerat eget tempus turpis elementum malesuada. Odio et cursus pellentesque amet ipsum, bibendum consequat non. Feugiat sit nibh turpis vitae sagittis nascetur id enim. Aliquet mauris, a et velit amet augue. Eu sit urna urna dui etiam turpis ac lorem. Sodales et massa faucibus a donec commodo sagittis. Dui eget
                    arcu vivamus sit morbi aliquam tempus. Eget sodales sapien eget aliquet hac. Sem aliquet consequat vitae sed. Sit purus sed egestas laoreet id elementum ac duis. Dolor eget lacinia arcu fames erat eget tincidunt tristique. Viverra netus volutpat diam ipsum tellus netus. Elementum cras id tristique non interdum eget integer. Quis nunc, pulvinar mauris, habitant proin. Eget
                    quis eu sit non quis tortor. Congue interdum tristique diam quis malesuada sapien viverra ornare. Libero, sit ultricies libero, sit. Urna, eu nulla habitant parturient mattis nisl gravida. Lorem nec est duis tincidunt laoreet viverra et egestas. Blandit bibendum scelerisque eget quam fermentum. Id volutpat sed ultrices nisl. Libero amet, dignissim pellentesque eu at nisl
                    sed. Interdum aenean tempus volutpat eu. Faucibus habitant vulputate accumsan sit sem volutpat gravida egestas eu. Sem pellentesque tincidunt lectus habitant at nunc a. Id enim nisl etiam tellus phasellus. Lectus eget lobortis adipiscing congue. In vestibulum porttitor eget pellentesque sem quis neque, a. Gravida nulla viverra eu justo, pellentesque. Mauris enim a nullam
                    ultrices leo, nisl, iaculis mus amet. Sit arcu congue ultrices ac urna, tellus sagittis pretium magna. Ut ornare ornare dui gravida. Dignissim faucibus blandit lacus cursus scelerisque purus. Mollis magna sed ipsum massa sed laoreet eget. Ut leo nunc donec turpis augue hac in. Faucibus mus fermentum tortor mauris, eget malesuada elit lobortis. Lacus, integer egestas cum
                    tempus consectetur consectetur augue. Maecenas congue lectus adipiscing in. A quam integer nec felis velit malesuada. Sollicitudin enim, id dictum sollicitudin eget. Diam neque, donec orci, morbi tortor feugiat. Diam nisl rutrum curabitur euismod donec pretium. Nisi, malesuada sit nulla cursus ut ultricies. Sollicitudin mollis laoreet vitae mattis risus leo. Sed viverra
                    bibendum augue mi. Interdum egestas viverra nunc orci luctus. Odio sodales porttitor ornare tincidunt. Nec, tellus urna orci mi risus. Venenatis nulla dis ut amet, feugiat. Sit tortor luctus mi, donec orci congue gravida posuere turpis. Quis in vitae congue purus sed dis eget. Dolor aliquam, mauris purus facilisis vitae purus diam et. Nisi massa sed pretium feugiat odio
                    leo. Odio lectus lorem iaculis nibh aliquam, blandit varius vestibulum. Mattis eget velit orci arcu. Suspendisse porta varius lacus fames consequat magna. Mattis mattis aliquet quis et adipiscing. Amet egestas quam vitae tristique. Sollicitudin ullamcorper integer faucibus nunc, etiam et. Fermentum, eu nunc in molestie. Eu bibendum adipiscing nisi, tristique pulvinar non.
                    Metus vel, nibh nunc gravida aliquet aliquet eu. Eget adipiscing non mi elit est sagittis amet, risus. Lorem lorem eget massa sit. Eget ullamcorper ut consectetur pharetra amet nulla in interdum ac. Viverra urna duis nunc, nam ut rhoncus, lacus, quam nibh. Risus, hac commodo sed risus condimentum mus ac facilisis nulla. Elit arcu, et id praesent dui. Mattis facilisis et
                    vestibulum pharetra pretium nunc. Massa at justo, ipsum magna. Sit turpis faucibus diam quis iaculis pretium. Sit non pulvinar sit amet, nisl sagittis. Donec facilisi viverra cursus viverra elit a justo. Quis vulputate egestas ut amet morbi condimentum. Lectus elit porttitor sit gravida molestie pretium proin integer. Fermentum felis velit mi proin vivamus quis aenean erat
                    tristique. Arcu nullam ut nascetur lectus placerat.
                </p>
            </div>
        </div>

        <!-- related blog -->
        <div class="view-blog">
            @include('frontend.related-blog')
        </div>
        <!-- related blog -->

        <!-- blog details -->
        <div class="container-fluid px-0"></div>
        <!-- blog details -->
    </div>
@endsection
