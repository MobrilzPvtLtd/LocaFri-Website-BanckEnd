@extends('frontend.layouts.loca')

@section('title')
    @lang('Change Password: ') {{ $$module_name_singular->name }}
@endsection

@section('content')
    <div class="profile-container">
        @include('frontend.includes.messages')
        <div class="header">
            {{-- <h4>There is no doubt that</h4> --}}
            <p>{{ __('messages.change_password') }}</p>
            <a href="{{ route('frontend.users.profile') }}">
                <div class="view-profile-button">
                    {{ __('messages.view_profile') }}
                </div>
            </a>
        </div>

        <div class="form-section">
            {{ html()->modelForm($$module_name_singular, 'PATCH', route('frontend.users.changePasswordUpdate', encode_id($$module_name_singular->id)))->acceptsFiles()->open() }}

            <form method="POST" action="{{ route('frontend.users.changePasswordUpdate', encode_id($$module_name_singular->id)) }}"
                enctype="multipart/form-data">
                <div class="mb-10 sm:grid sm:grid-cols-3 sm:gap-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'password';
                                $field_lable = __('messages.change_password');
                                $field_placeholder = $field_lable;
                                $required = 'required';
                                ?>
                                {{ html()->label($field_lable, $field_name)}}
                                {!! field_required($required) !!}
                                {{ html()->password($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'password_confirmation';
                                $field_lable = __('messages.re_password');
                                $field_placeholder = $field_lable;
                                $required = 'required';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->password($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-button">{{ __('messages.update_password') }}</button>
            </form>
        </div>
        <div class="header">
            <h4>{{ __('messages.edit_profile') }}</h4>
            <p>{{ __('messages.update_account_info') }}</p>
            <a href="{{ route('frontend.users.profileEdit') }}">
                <div class="view-profile-button">
                    {{ __('messages.edit_profile') }}
                </div>
            </a>
        </div>
    </div>
@endsection
