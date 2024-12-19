<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Digital Board | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta
        content="A complete solution for digital board."
        name="description"
    />
    <meta content="NINJA INFOSYS" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/np.png')}}"/>

    <!-- Bootstrap css -->
    <link
        href="{{asset('assets/backend/css/bootstrap.min.css')}}"
        rel="stylesheet"
        type="text/css"
    />
    <!-- App css -->
    <link
        href="{{asset('assets/backend/css/app.min.css')}}"
        rel="stylesheet"
        type="text/css"
        id="app-style"
    />
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="auth-page" style="background-image: url({{asset('images/mountain_photo.jpg')}});
height: 100vh;
overflow: hidden">
<div class="pt-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6 system_info">
                            <div class="logo">
                                <img src="{{asset('images/np.png')}}" height="80" alt="Logo">
                            </div>
                            <div class="m-2">
                                <h3 class="text-white">{{$officeSetting->name??''}}</h3>
                                <h4 class="text-white pt-2">डिजिटल बोर्ड</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-body">
                                <h2 class="text-center">
                                    <i class="fa fa-user-lock"></i>
                                </h2>
                                <form class="mt-1" action="{{route('login')}}" method="post">
                                    @csrf
                                    <div class="mb-1">
                                        <label for="email" class="form-label">
                                            प्रयोगकर्ता इमेल
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            type="email"
                                            value="{{old('email')}}"
                                            id="email"
                                            placeholder="प्रयोगकर्ता इमेल"
                                        />
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2"><label for="password" class="form-label">
                                            पासवर्ड <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="पासवर्ड"
                                            />
                                            <div class="input-group-text"
                                                 data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            @error('password')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <i class="fa fa-lock"></i>
                                            लग - इन
                                        </button>
                                        <button type="reset" class="btn btn-danger waves-effect ms-3">
                                            <i class="fa fa-times-circle"></i>
                                            रिसेट
                                        </button>
                                    </div>
                                </form>
                                <div class="col-12 text-lg-end mt-2">
                                    <a href="#" class="ms-1">Forgot password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="thought">
        <h4 class="mb-1 text-dark fw-bold">प्राविधिक सहायता कक्ष</h4>
        <p>
            <i class="fa fa-phone-alt"></i> : 081-520361
        </p>
        <p class="text-center">
            <i class="fa fa-envelope"></i> : ninjainfosys@gmail.com
        </p>
    </div>
</div>

<footer class="footer footer-alt bg-soft-main">
    2022 -
    {{date('Y')}}
    &copy; Design & Developed by <a href="#" class="text-white text-decoration-underline">NINJA INFOSYS</a>
</footer>
<script src="{{asset('assets/backend/js/vendor.min.js')}}"></script>
<script src="{{asset('assets/backend/js/app.min.js')}}"></script>
</body>
</html>
