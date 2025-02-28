@extends('frontend.layouts.loca')

@section('title')
    {{ config('app.name') }} - Privacy Policy
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- WhatsApp Button -->
        <a href="https://wa.me/41793876020" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        </a>

        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

        <!-- Subheader Section -->
        <section id="subheader" class="jarallax text-light">
            <img src="{{ asset('images/background/subheader.jpg') }}" class="jarallax-img" alt="Subheader Image">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Privacy Policy</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <section aria-label="section">
            <div class="container mt-5">
                <h2>Privacy Policy</h2>
                <div class="policy-section">
                    <p>
                        At {{ config('app.name') }}, accessible at <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by {{ config('app.name') }} and how we use it.
                    </p>
                    <p>
                        If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us through email at info@locafri.ch.
                    </p>
                    <p>
                        This privacy policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collected in {{ config('app.name') }}. This policy is not applicable to any information collected offline or via channels other than this website.
                    </p>

                    <h3>Consent</h3>
                    <p>
                        By using our website, you hereby consent to our Privacy Policy and agree to its terms.
                    </p>

                    <h3>Information We Collect</h3>
                    <p>
                        The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.
                    </p>
                    <p>
                        If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.
                    </p>
                    <p>
                        When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.
                    </p>

                    <h3>How We Use Your Information</h3>
                    <p>
                        We use the information we collect in various ways, including to:
                    </p>
                    <ul class="list-disc list-inside">
                        <li>Provide, operate, and maintain our website</li>
                        <li>Improve, personalize, and expand our website</li>
                        <li>Understand and analyze how you use our website</li>
                        <li>Develop new products, services, features, and functionality</li>
                        <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
                        <li>Send you emails</li>
                        <li>Find and prevent fraud</li>
                    </ul>

                    <h3>Log Files</h3>
                    <p>
                        {{ config('app.name') }} follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.
                    </p>

                    <!-- Add more sections here as necessary -->

                    <!-- Shareable Link Section -->
                    {{-- <div class="mt-4">
                        <strong>Share this link:</strong>
                        <input type="text" class="form-control text-center form-border" readonly
                            value="{{ $link ?? 'No link provided' }}">
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection
