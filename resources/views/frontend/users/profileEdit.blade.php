@extends('frontend.layouts.loca')

@section('title')
    Edit {{ $$module_name_singular->name }}'s Profile
@endsection

@section('content')
    <div class="profile-container">
        @include('frontend.includes.messages')
        <div class="header">
            <h4>Edit Profile</h4>
            <p>This information will be displayed publicly so be careful what you share.</p>
            <a href='{{ route('frontend.users.profile') }}' class="view-profile-button">View Profile</a>
        </div>

        <div class="form-section">
            {{ html()->modelForm($$module_name_singular, 'PATCH', route('frontend.users.profileUpdate', encode_id($$module_name_singular->id)))->acceptsFiles()->open() }}

            <form method="POST" action="{{ route('frontend.users.profileUpdate', encode_id($$module_name_singular->id)) }}"
                enctype="multipart/form-data">
                <div class="mb-10 sm:grid sm:grid-cols-3 sm:gap-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $field_name = 'first_name';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = 'required';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $field_name = 'last_name';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = 'required';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">Email</label>
                                <span class="text-danger text-red-600">*</span>
                                <input id="email" type="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $field_name = 'mobile';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $field_name = 'date_of_birth';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                $value = $user->date_of_birth == '' ? '' : \Carbon\Carbon::parse($user->date_of_birth)->toDateString();
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->type('date')->value($value)->class("profile-input")->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php
                                $field_name = 'gender';
                                $field_lable = label_case($field_name);
                                $field_placeholder = '-- Select an option --';
                                $required = '';
                                $select_options = [
                                    'Female' => 'Female',
                                    'Male' => 'Male',
                                    'Other' => 'Other',
                                ];
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->select($field_name, $select_options)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'address';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'url_website';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'url_facebook';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'url_twitter';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'url_linkedin';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                $field_name = 'url_instagram';
                                $field_lable = label_case($field_name);
                                $field_placeholder = $field_lable;
                                $required = '';
                                ?>
                                {{ html()->label($field_lable, $field_name) }}
                                {!! field_required($required) !!}
                                {{ html()->text($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required"]) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                        $field_name = 'bio';
                        $field_lable = label_case($field_name);
                        $field_placeholder = $field_lable;
                        $required = '';
                        ?>
                        {{ html()->label($field_lable, $field_name) }}
                        {!! field_required($required) !!}
                        {{ html()->textarea($field_name)->class("profile-input")->placeholder($field_placeholder)->attributes(["$required", 'rows' => 5]) }}
                    </div>

                    <div class="row">
                        <label for="avatar">Photo</label>
                        <div class="col-md-4">
                            <div class="form-group">
                                <img src="{{ asset('public/storage/' . $user->avatar) }}" alt="{{ $user->name }}" width="80px">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="file" id="avatar" name="avatar" class="profile-input">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit-button">Save</button>
            </form>
        </div>

        <div class="header">
            <h4>Account Settings</h4>
            <p>Update account information.</p>
            <a href="{{ route('frontend.users.changePassword') }}">
                <div class="view-profile-button">
                    Change Password
                </div>
            </a>
        </div>
    </div>
@endsection
