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
                            <h1>{!! __('messages.register_title') !!}</h1>
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
                        <h3>{!! __('messages.register_prompt') !!}</h3>
                        <p>{!! __('messages.register_description') !!}</p>

                        <div class="spacer-10"></div>

                        <form name="contactForm" id='contact_form' class="form-border" method="post" action='blank.php'>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>{!! __('messages.name') !!}</label>
                                        <input type='text' name='first_name' id='name' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>{!! __('messages.email_address') !!}</label>
                                        <input type='email' name='email' id='email' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>{!! __('messages.username') !!}</label>
                                        <input type='text' name='name' id='username' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>{!! __('messages.phone') !!}</label>
                                        <input type='text' name='mobile' id='phone' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>{!! __('messages.password') !!}</label>
                                        <input type='text' name='password' id='password' class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="field-set">
                                        <label>{!! __('messages.re_password') !!}</label>
                                        <input type='text' name='password' id='re-password' class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <div id='submit' class="pull-left">
                                        <input type='submit' id='send_message' value='{!! __('messages.register_now') !!}'
                                            class="btn-main color-2">
                                    </div>
                                    <div class="text-center"><a class="res001" href="{{ route('login') }}">{!! __('messages.no_account') !!}</a>
                                    </div>
                                    <div id='mail_success' class='success'>{!! __('messages.success_message') !!}</div>
                                    <div id='mail_fail' class='error'>{!! __('messages.error_message') !!}
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
