<!-- Topbar Start -->
<div class="container-fluid px-5 d-none border-bottom d-lg-block bg-white">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-4 text-center text-lg-start mb-lg-0">
            {{-- <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="#" class="text-muted me-2"> Help</a><small> / </small>
                <a href="#" class="text-muted mx-2"> Support</a><small> / </small>
                <a href="#" class="text-muted ms-2"> Contact</a>
            </div> --}}
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="#" class="text-muted me-2"> GST : </a><small></small>
            </div>
        </div>
        <div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
    <small class="text-dark">Call Us:</small>
    <a href="tel:+919995969939" class="text-muted">+91 999 596 9939</a>
</div>

        
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
               @guest
                <style>
                    .login-botton {
                        font-weight: bold;
                        color: white;
                        border-radius: 2rem;
                        cursor: pointer;
                        width: 95.02px;
                        height: 32px;
                        padding: 5px 0;
                        border: none;
                        background-color: #3653f8;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    .login-botton .span-mother {
                        display: flex;
                        overflow: hidden;
                    }

                    .login-botton:hover .span-mother {
                        position: absolute;
                    }

                    .login-botton:hover .span-mother span {
                        transform: translateY(1.2em);
                    }

                    .login-botton .span-mother span:nth-child(1) {
                        transition: 0.2s;
                    }

                    .login-botton .span-mother span:nth-child(2) {
                        transition: 0.3s;
                    }

                    .login-botton .span-mother span:nth-child(3) {
                        transition: 0.4s;
                    }

                    .login-botton .span-mother span:nth-child(4) {
                        transition: 0.5s;
                    }

                    .login-botton .span-mother span:nth-child(5) {
                        transition: 0.6s;
                    }

                    .login-botton .span-mother span:nth-child(6) {
                        transition: 0.7s;
                    }

                    .login-botton .span-mother2 {
                        display: flex;
                        position: absolute;
                        overflow: hidden;
                    }

                    .login-botton .span-mother2 span {
                        transform: translateY(-1.2em);
                    }

                    .login-botton:hover .span-mother2 span {
                        transform: translateY(0);
                    }

                    .login-botton .span-mother2 span {
                        transition: 0.2s;
                    }

                    .login-botton .span-mother2 span:nth-child(2) {
                        transition: 0.3s;
                    }

                    .login-botton .span-mother2 span:nth-child(3) {
                        transition: 0.4s;
                    }

                    .login-botton .span-mother2 span:nth-child(4) {
                        transition: 0.5s;
                    }

                    .login-botton .span-mother2 span:nth-child(5) {
                        transition: 0.6s;
                    }

                    .login-botton .span-mother2 span:nth-child(6) {
                        transition: 0.7s;
                    }
                </style>
                <a href="{{ route('login') }}">
                <button class="login-botton">
                    <span class="span-mother">
                        <span>L</span>
                        <span>O</span>
                        <span>G</span>
                        <span>I</span>
                        <span>N</span>
                    </span>
                    <span class="span-mother2">
                        <span>L</span>
                        <span>O</span>
                        <span>G</span>
                        <span>I</span>
                        <span>N</span>
                    </span>
                </button>
                </a>
                @else
                <style>
.Btn {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  width: 45px;
  height: 35px;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition-duration: 0.3s;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
  background-color: white;
}

/* plus sign */
.sign {
  width: 100%;
  transition-duration: 0.3s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sign svg {
  width: 17px;
}

.sign svg path {
  fill: black;
}
/* text */
.text {
  position: absolute;
  right: 0%;
  width: 0%;
  opacity: 0;
  color: white;
  font-size: 1.2em;
  font-weight: 600;
  transition-duration: 0.3s;
}
/* hover effect on button width */
.Btn:hover {
  background-color: black;
  width: 125px;
  border-radius: 40px;
  transition-duration: 0.3s;
}

.Btn:hover .sign {
  width: 30%;
  transition-duration: 0.3s;
  padding-left: 20px;
}

.Btn:hover .sign svg path {
  fill: white;
}

/* hover effect button's text */
.Btn:hover .text {
  opacity: 1;
  width: 70%;
  transition-duration: 0.3s;
  padding-right: 10px;
}
/* button click effect*/
.Btn:active {
  transform: translate(2px, 2px);
}

                </style>
<form action="{{ route('user.logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-danger rounded-pill px-4 py-2">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
</form>

                @endguest
            </div>
        </div>
    </div>
</div>
<div class="container-fluid px-5 py-2 d-none d-lg-block">
    <div class="row gx-0 align-items-center text-center">
        <div class="col-md-4 col-lg-3 text-center text-lg-start">
            <div class="d-inline-flex align-items-center">
                <a href="" class="navbar-brand p-0">
                    {{-- <h1 class="display-5 text-primary m-0"><i
                            class="fas fa-shopping-bag text-secondary me-2"></i>Electro</h1> --}}
                        <img src="{{ asset('img/PATV2.png') }}" style="width:130px; height:80px;" alt="Logo">
                </a>
            </div>
        </div>
        {{-- <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">
                <div class="d-flex border rounded-pill">
                    <input class="form-control border-0 rounded-pill w-100 py-3" type="text"
                        data-bs-target="#dropdownToggle123" placeholder="Search Looking For?">
                    <select class="form-select text-dark border-0 border-start rounded-0 p-3" style="width: 200px;">
                        <option value=""> Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </div> --}}
        <div class="col-md-4 col-lg-6 text-center">
    <div class="position-relative ps-4">
        <div class="d-flex border rounded-pill">

            <input class="form-control border-0 rounded-pill w-100 py-3" 
                   type="text" placeholder="Search Looking For?">

            @php
                // ✅ Fetch categories directly from DB
                $categories = \App\Models\Category::orderBy('name', 'asc')->get();
            @endphp

            <select class="form-select text-dark border-0 border-start rounded-0 p-3" style="width: 200px;">
                <option value="">Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;">
                <i class="fas fa-search"></i>
            </button>

        </div>
    </div>
</div>

        <div class="col-md-4 col-lg-3 text-center text-lg-end">
            <div class="d-inline-flex align-items-center">
                
                {{-- <a href="#" class="text-muted d-flex align-items-center justify-content-center"><span
                        class="rounded-circle btn-md-square border"><i class="fas fa-shopping-cart"></i></span>
                    <span class="text-dark ms-2">$0.00</span></a> --}}
                   
    @auth
    @php
        $cartTotal = \App\Models\Cart::where('user_id', auth()->id())
                        ->count();
    @endphp

    <a href="{{ route('cart') }}" 
       class="text-muted d-flex align-items-center justify-content-center">
        <span class="rounded-circle btn-md-square border">
            <i class="fas fa-shopping-cart"></i>
            <span class="text-dark ms-2">
            {{ $cartTotal }}
        </span>
        </span>
        {{-- <span class="text-dark ms-2">
            {{ $cartTotal }}
        </span> --}}
    </a>
@endauth

            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid nav-bar p-0">
    <div class="row gx-0 bg-primary px-5 align-items-center">
        <div class="col-lg-3 d-none d-lg-block">
            <nav class="navbar navbar-light position-relative" style="width: 250px;">
                <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button"
                    data-bs-toggle="collapse" data-bs-target="#allCat">
                    <h4 class="m-0"><i class="fa fa-bars me-2"></i>All Categories</h4>
                </button>

                <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                    <div class="navbar-nav ms-auto py-0">
                        <ul class="list-unstyled categories-bars">
                            @foreach($categories as $category)
                                <li>
                                    <div class="categories-bars-item">
                                        <a href="#">{{ $category->name }}</a>
                                        <span>({{ $category->products_count }})</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
        <div class="col-12 col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                <a href="" class="navbar-brand d-block d-lg-none">
                    <h1 class="display-5 text-secondary m-0"><i class="fas fa-shopping-bag text-white me-2"></i>Electro
                    </h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars fa-1x"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                        {{-- <a href="{{ route('single-product') }}" class="nav-item nav-link">Single Page</a> --}}
                        {{-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="{{ route('best-seller') }}" class="dropdown-item">Bestseller</a>
                                <a href="{{ route('cart') }}" class="dropdown-item">Cart Page</a>
                                <a href="{{ route('checkout') }}" class="dropdown-item">Cheackout</a>
                                <a href="{{ route('shop') }}" class="dropdown-item">404 Page</a>
                            </div>
                        </div> --}}
                        <a href="{{ route('contact') }}" class="nav-item nav-link me-2">Contact</a>

                    </div>
                    <a href="tel:+919995969939" class="btn btn-secondary rounded-pill py-2 px-4 px-lg-3 mb-3 mb-md-3 mb-lg-0">
                        <i class="fa fa-mobile-alt me-2"></i>+91 999 596 9939</a>
                        {{-- <a href="tel:+919995969939" class="text-muted">+91 999 596 9939</a> --}}
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->