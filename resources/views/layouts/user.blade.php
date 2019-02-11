@guest
    <div class="right-side">
        <div class="header-widget">
            <a href="#sign-in-dialog" class="popup-with-zoom-anim log-in-button"><i class="icon-feather-log-in"></i>
                <span>Log In / Register</span></a>
        </div>
        <span class="mmenu-trigger">
    		<button class="hamburger hamburger--collapse" type="button">
    			<span class="hamburger-box">
    				<span class="hamburger-inner"></span>
    			</span>
    		</button>
    	</span>
    </div>

    <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <div class="sign-in-form">
            <ul class="popup-tabs-nav">
                <li><a href="#login">Log In</a></li>
                <li><a href="#register">Register</a></li>
            </ul>

            <div class="popup-tabs-container">

                <!-- Login -->
                <div class="popup-tab-content" id="login">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>We're glad to see you again!</h3>
                        <span>Don't have an account? <a href="#" class="register-tab">Sign Up!</a></span>
                    </div>

                    <!-- Form -->
                    <form role="form" method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf
                        <div class="input-with-icon-left">
                            <i class="icon-material-baseline-mail-outline"></i>
                            <input 
                                type="text" 
                                class="input-text with-border" 
                                name="username" 
                                id="emailaddress"
                                value="{{ old('username') }}" 
                                placeholder="Email Address" 
                                required/>
                        </div>

                        <div class="input-with-icon-left">
                            <i class="icon-material-outline-lock"></i>
                            <input 
                                type="password" 
                                class="input-text with-border" 
                                name="password" 
                                id="password"
                                placeholder="Password" required/>
                        </div>
                        <a href="{!! route('password.request') !!}" class="forgot-password">Forgot Password?</a>
            
                        <!-- Button -->
                        <button class="button full-width button-sliding-icon ripple-effect" type="submit" form="login-form">
                            Log In <i class="icon-material-outline-arrow-right-alt"></i>
                        </button>
                    </form>
                </div>

                <!-- Register -->
                <div class="popup-tab-content" id="register">

                    <!-- Welcome Text -->
                    <div class="welcome-text">
                        <h3>Let's create your account!</h3>
                    </div>

                    <!-- Form -->
                    <form role="form" method="POST" action="{{ url('registeration') }}" id="register-account-form">
                    {{ csrf_field() }}
                        <!-- Account Type -->
                        <div class="account-type">
                            <div>
                                <input type="radio" name="role" id="freelancer-radio" value="8" 
                                       class="account-type-radio" checked/>
                                <label for="freelancer-radio" class="ripple-effect-dark"><i
                                            class="icon-material-outline-account-circle"></i> Участник</label>
                            </div>

                            <div>
                                <input type="radio" name="role" id="employer-radio" value="9" 
                                       class="account-type-radio"/>
                                <label for="employer-radio" class="ripple-effect-dark"><i
                                            class="icon-material-outline-business-center"></i> Заказчик</label>
                            </div>
                        </div>

                        <div class="input-with-icon-left" title="Наименование организации" data-tippy-placement="bottom">
                            <i class="fa fa-address-book"></i>
                            <input type="text" value="{{ old('company_legal_name') }}" class="input-text with-border" name="company_legal_name" placeholder="Наименование организации" required/>
                        </div>

                        <div class="input-with-icon-left" title="Юридический адрес" data-tippy-placement="bottom">
                            <i class="fas fa-map-marked-alt"></i>
                            <input type="text" value="{{ old('address') }}" class="input-text with-border" name="address" placeholder="Юридический адрес" required/>
                        </div>

                        <div class="input-with-icon-left" title="ИНН должно быт шестизначное число" data-tippy-placement="bottom">
                            <i class="fa fa-list"></i>
                            <input type="text" value="{{ old('inn') }}" class="input-text with-border" name="inn" placeholder="ИНН" onkeypress="javascript:return isNumber(event)" required/>
                        </div>

                        <div class="input-with-icon-left" title="Фамилия Имя Отчество" data-tippy-placement="bottom">
                            <i class="fa fa-user"></i>
                            <input type="text" value="{{ old('name') }}" class="input-text with-border" name="name" placeholder="Ф.И.О" required/>
                        </div>

                        <div class="input-with-icon-left" title="Aдрес электронной почты" data-tippy-placement="bottom">
                            <i class="icon-material-baseline-mail-outline"></i>
                            <input type="email" value="{{ old('email') }}" class="input-text with-border" name="email"
                                   id="emailaddress-register" placeholder="Email Address" required/>
                        </div>

                        <div class="input-with-icon-left" title="Контактный номер (xx) xxx-xxxx" data-tippy-placement="bottom">
                            <i class="fa fa-phone"></i>
                            <input type="tel" value="{{ old('phone') }}" class="input-text with-border" id="phone" name="phone" placeholder="Телефон" required/>
                        </div>
                        <!-- Button -->
                        <button class="margin-top-10 button full-width button-sliding-icon ripple-effect" type="submit"
                                form="register-account-form">Register <i class="icon-material-outline-arrow-right-alt"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @section('scripts')
    <script type="text/javascript">
        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;

            return true;
        }

        const isNumericInput = (event) => {
        const key = event.keyCode;
            return ((key >= 48 && key <= 57) || // Allow number line
                (key >= 96 && key <= 105) // Allow number pad
            );
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            // Input must be of a valid number format or a modifier key, and not longer than ten digits
            if(!isNumericInput(event) && !isModifierKey(event)){
                event.preventDefault();
            }
        };

        const formatToPhone = (event) => {
            if(isModifierKey(event)) {return;}
            const target = event.target;
            const input = event.target.value.replace(/\D/g,'').substring(0,9); // First ten digits of input only
            const zip = input.substring(0,2);
            const middle = input.substring(2,5);
            const last = input.substring(5,9);

            if(input.length > 5){target.value = `(${zip}) ${middle} - ${last}`;}
            else if(input.length > 2){target.value = `(${zip}) ${middle}`;}
            else if(input.length > 0){target.value = `(${zip}`;}
        };

        const inputElement = document.getElementById('phone');
        inputElement.addEventListener('keydown',enforceFormat);
        inputElement.addEventListener('keyup',formatToPhone);
    </script>
    @endsection
@else
    <div class="right-side">
        <div class="header-widget hide-on-mobile">
            <div class="header-notifications">
                <div class="header-notifications-trigger">
                    <a href="#"><i class="icon-feather-bell"></i><span>4</span></a>
                </div>
            </div>

            <!-- Messages -->
            <div class="header-notifications">
                <div class="header-notifications-trigger">
                    <a href="#"><i class="icon-feather-mail"></i><span>3</span></a>
                </div>
            </div>
        </div>

        <!-- User Menu -->
        <div class="header-widget">
            <div class="header-notifications user-menu">
                <div class="header-notifications-trigger">
                    <a href="#">
                        <div class="user-avatar status-online">
                            <img src="{{ asset('front/img/user.png') }}" alt="">
                        </div>
                    </a>
                </div>
                <div class="header-notifications-dropdown">
                    <div class="user-status">
                        <div class="user-details">
                            <div class="user-avatar status-online">
                                <img src="{{ asset('front/img/user.png') }}" alt="">
                            </div>
                            <div class="user-name">
                                <i>{{ Auth::user()->name }}</i>
                                <span>
                                    @foreach(Auth::user()->roles as $role)
                                        {{ $role->display_name }}
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>

                    <ul class="user-menu-small-nav">
                        <li>
                            <a href="{{ url('dashboard') }}">
                                <i class="icon-material-outline-dashboard"></i> Профиль
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-material-outline-power-settings-new"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- User Menu / End -->

        <!-- Mobile Navigation Button -->
        <span class="mmenu-trigger">
			<button class="hamburger hamburger--collapse" type="button">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
		</span>
    </div>
    </div>
    </div>
</header>
@endguest