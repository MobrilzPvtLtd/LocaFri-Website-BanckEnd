@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Cars
@endsection
@section('content')
<style>
    .form-border input[type=email]{
        padding: 8px;
    margin-bottom: 10px;
    border: none;
    border: solid 2px #eeeeee;
    background: rgba(0, 0, 0, .025);
    border-radius: 6px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    height: auto;
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    color: #333;
}
    }
</style>
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
            <img src="images/background/subheader.jpg" class="jarallax-img" alt="">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center p-4">
                            <h1>Register</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h3>Don't have an account? Register now.</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                            dicta sunt explicabo.</p>

                        <div class="spacer-10"></div>

                        <form name="contactForm" id='contact_form' class="form-border" method="post" action='blank.php'>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Name:</label>
                                        <input type='text' name='first_name' id='name' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Email Address:</label>
                                        <input type='email' name='email' id='email' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Choose a Username:</label>
                                        <input type='text' name='name' id='username' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Phone:</label>
                                        <input type='text' name='mobile' id='phone' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Password:</label>
                                        <input type='text' name='password' id='password' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>Re-enter Password:</label>
                                        <input type='text' name='password' id='re-password' class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <div id='submit' class="pull-left">
                                        <input type='submit' id='send_message' value='Register Now'
                                            class="btn-main color-2">
                                    </div>
                                    <div class="text-center"><a class="res001" href="{{ route('login') }}">don't have an account?</a>
                                    </div>
                                    <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                    <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.
                                    </div>
                                    <div class="clearfix"></div>

                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
