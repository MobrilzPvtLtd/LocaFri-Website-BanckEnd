
@extends('frontend.layouts.loca')

@section('title')
    {{ app_name() }} - Rent a car
@endsection

<a href="https://wa.me/41793876020" target="_blank" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat with us on WhatsApp" style="width: 60px; height: 60px; border-radius: 50%; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
</a>


@section('style')
<style>
    * {
        box-sizing: border-box;
        /* outline:1px solid ;*/
    }

    body {
        background: #ffffff;
        background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e1e8ed', GradientType=0);
        height: 100%;
        margin: 0;
        background-repeat: no-repeat;
        background-attachment: fixed;

    }

    .wrapper-1 {
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .wrapper-2 {
        padding: 30px;
        text-align: center;
    }

    h1 {
        font-family: 'Kaushan Script', cursive;
        font-size: 4em;
        letter-spacing: 3px;
        color: #f36a21;
        margin: 0;
        margin-bottom: 20px;
    }

    .wrapper-2 p {
        margin: 0;
        font-size: 1.3em;
        color: #aaa;
        font-family: 'Source Sans Pro', sans-serif;
        letter-spacing: 1px;
    }

    .go-home {
        color: #fff;
        background: #f36a21;
        border: none;
        padding: 10px 50px;
        margin: 30px 0;
        border-radius: 30px;
        text-transform: capitalize;
        box-shadow: 0 10px 16px 1px rgba(174, 199, 251, 1);
    }

    .footer-like {
        margin-top: auto;
        background: #D7E6FE;
        padding: 6px;
        text-align: center;
    }

    .footer-like p {
        margin: 0;
        padding: 4px;
        color: #f36a21;
        font-family: 'Source Sans Pro', sans-serif;
        letter-spacing: 1px;
    }

    .footer-like p a {
        text-decoration: none;
        color: #f36a21;
        font-weight: 600;
    }

    @media (min-width:360px) {
        h1 {
            font-size: 4.5em;
        }

        .go-home {
            margin-bottom: 20px;
        }
    }

    @media (min-width:600px) {
        .content {
            max-width: 1000px;
            margin: 0 auto;
        }

        .wrapper-1 {
            height: initial;
            max-width: 620px;
            margin: 0 auto;
            margin-top: 20%;
            margin-bottom: 50px;
            box-shadow: 4px 8px 40px 8px #f36a2133;
        }

    }
</style>
@endsection
@section('content')

    <div class=content>
        <div class="wrapper-1">
            <div class="wrapper-2">
                <h1>{!! __('messages.thank_you') !!}</h1>
                <p>{!! __('messages.thanks_message') !!}</p>
                <p>{!! __('messages.response_message') !!}</p>
                <button class="go-home">
                    <a href="/" style="color: #fff">{!! __('messages.go_home') !!}</a>
                </button>
            </div>
        </div>
    </div>

@endsection
