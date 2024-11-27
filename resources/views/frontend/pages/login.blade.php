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
        <section id="section-hero" aria-label="section" class="jarallax">
            <img src="images/background/2.jpg" class="jarallax-img" alt="">
            <div class="v-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 offset-lg-4">
                            <div class="padding40 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                                <h4>{!! __('messages.login') !!}</h4>
                                <?php if ($errors->has('email')): ?>
                                <span class="error"><?php echo $errors->first('email'); ?></span>
                                <?php endif; ?>
                                <?php if ($errors->has('password')): ?>
                                <span class="error"><?php echo $errors->first('password'); ?></span>
                                <?php endif; ?>
                                <div class="spacer-10"></div>
                                <form id="form_register" class="form-border" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="field-set">
                                        <input type="email" name="email" id="name" class="form-control"
                                            placeholder="Email" />
                                    </div>
                                    <div class="field-set">
                                        <input type="password" name="password" id="name" class="form-control"
                                            placeholder="{!! __('messages.password') !!} " />
                                    </div>
                                    <div id="submit">
                                        <input type="submit" id="send_message" value="{!! __('messages.sign_in') !!}"
                                            class="btn-main btn-fullwidth rounded-3" />
                                    </div>
                                </form>
                                <div class="mt-2">
                                    <a href="{{ route('password.email') }}" style="    text-decoration-line: underline;">{!! __('messages.forgot_password') !!} </a>
                                </div>

                                <div class="text-center mt-3"><a class="res001" href="{{ route('register') }}">{!! __('messages.no_account') !!} </a>
                                </div>
                                <div class="title-line">{!! __('messages.or') !!}&nbsp;</div>
                                <div class="row g-2">
                                    <div class="col-lg-6">
                                        <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                                src="images/svg/google_icon.svg" alt="">Google</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="btn-sc btn-fullwidth mb10" href="#"><img
                                                src="images/svg/facebook_icon.svg" alt="">Facebook</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
