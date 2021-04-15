<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- Page Title  -->
    <title>Login | FMREPO</title>

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('css/dashlite.css?ver=2.4.0')}}">
    <link rel="stylesheet" href="{{ asset('css/theme.css?ver=2.4.0')}}">
</head>

<body class="nk-body npc-default pg-auth">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-split nk-split-page nk-split-md">
                    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                        <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                            <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                        </div>
                        <div class="nk-block nk-block-middle nk-auth-body">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title">Register</h5>
                                    <div class="nk-block-des">
                                        <p>Create New FMREPO Account</p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <form method="POST" action="{{ route('register') }}">

                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="default-01">Name</label>
                                    <input autofocus type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" placeholder="Enter your name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-02">Surname</label>
                                    <input autofocus type="text" class="form-control form-control-lg @error('surname') is-invalid @enderror" name="surname" placeholder="Enter your surname">

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Email</label>
                                    <input autofocus type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" placeholder="Enter your email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Password</label>
                                    <input autofocus type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Enter your password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-01">Repeat password</label>
                                    <input autofocus type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Enter your password">

                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-control-xs custom-checkbox">
                                        <input type="checkbox" checked="false" class="custom-control-input" id="checkbox" name="checkbox">
                                        <label class="custom-control-label" for="checkbox">I agree to <a tabindex="-1" href="#">Privacy Policy</a> &amp; <a tabindex="-1" href="#"> Terms.</a></label>
                                    </div>

                                    @error('checkbox')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Register</button>
                                </div>
                            </form><!-- form -->
                            <div class="form-note-s2 pt-4"> Already have an account ? <a href="{{route('login')}}"><strong>Sign in instead</strong></a>
                            </div>
                            <div class="text-center pt-4 pb-3">
                                <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                            </div>
                            <ul class="nav justify-center gx-8">
                                <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                            </ul>
                        </div><!-- .nk-block -->
                        <div class="nk-block nk-auth-footer">
                            <div class="nk-block-between">
                                <ul class="nav nav-sm">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Terms & Condition</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Help</a>
                                    </li>
                                </ul><!-- nav -->
                            </div>
                            <div class="mt-3">
                                <p>&copy; 2021 Diverso Lab.</p>
                            </div>
                        </div><!-- nk-block -->
                    </div><!-- nk-split-content -->
                    <div class="nk-split-content nk-split-stretch bg-abstract"></div><!-- nk-split-content -->
                </div><!-- nk-split -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- JavaScript -->
<script src="{{asset('js/bundle.js?ver=2.4.0')}}"></script>
<script src="{{asset('js/scripts.js?ver=2.4.0')}}"></script>

</body>
</html>
