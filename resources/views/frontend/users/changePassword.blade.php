@extends('frontend.layouts.loca')

@section('title')
    @lang('Change Password: ') {{ $$module_name_singular->name }}
@endsection

@section('style')
    <style>
        .container-new {
            max-width: 60%;
            margin: 12% auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header p {
            color: #777;
            margin-bottom: 18px;
        }

        .view-profile-button {
            display: inline-block;
            padding: 3px;
            width: 100%;
            color: #464648;
            font-size: 14px;
            font-weight: 600;
            /* background-color: #333; */
            border: 2px solid #333;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .view-profile-button:hover {
            background-color: #13161c;
            color: #fff;
        }

        .form-section {
            padding: 20px;
            border-top: 1px solid #eaeaea;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Form Group */
        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        /* Custom Input */
        .custom-input,
        input {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #374151;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .custom-input:focus,
        input:focus {
            color: #374151;
            background-color: #ffffff;
            border-color: transparent;
            outline: 0;
            box-shadow: 0 0 0 1px rgba(37, 99, 235, 1);
        }

        .submit-button {
            display: inline-block;
            padding: 6px;
            width: 100%;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="container-new">
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
