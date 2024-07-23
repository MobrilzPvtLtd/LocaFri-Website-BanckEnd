@extends('frontend.layouts.loca')

@section('title')
    @lang('Change Password: ') {{ $$module_name_singular->name }}
@endsection

@section('content')
    <div class="profile-container">
        @include('frontend.includes.messages')
        <div class="header">
            <h4>There is no doubt that</h4>
            <p>Use the following form to change your account password!</p>
            <a href="{{ route('frontend.users.profile') }}">
                <div class="view-profile-button">
                    View Profile
                </div>
            </a>
        </div>

        <div class="form-section">
            {{ html()->modelForm($$module_name_singular, 'PATCH', route('frontend.users.profileUpdate', encode_id($$module_name_singular->id)))->acceptsFiles()->open() }}

            <form method="POST" action="{{ route('frontend.users.profileUpdate', encode_id($$module_name_singular->id)) }}"
                enctype="multipart/form-data">
                <div class="mb-10 sm:grid sm:grid-cols-3 sm:gap-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'password';
                                $field_lable = __('labels.backend.users.fields.' . $field_name);
                                $field_placeholder = $field_lable;
                                $required = 'required';
                                ?>
                                {{ html()->label($field_lable, $field_name)}}
                                {!! field_required($required) !!}
                                {{ html()->password($field_name)->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'password_confirmation';
                                $field_lable = __('labels.backend.users.fields.' . $field_name);
                                $field_placeholder = $field_lable;
                                $required = 'required';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->password($field_name)->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-button">Update Password</button>
            </form>
        </div>
        <div class="header">
            <h4>Edit Profile</h4>
            <p>Update account information.</p>
            <a href="{{ route('frontend.users.profileEdit') }}">
                <div class="view-profile-button">
                    Edit Profile
                </div>
            </a>
        </div>
    </div>
@endsection
