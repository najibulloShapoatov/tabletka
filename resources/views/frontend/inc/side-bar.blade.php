
<aside id="sidebarContent2" class="u-sidebar u-sidebar__md u-sidebar--left" aria-labelledby="sidebarNavToggler2">
    <div class="u-sidebar__scroller js-scrollbar">
        <div class="u-sidebar__container">
            <div class="u-header-sidebar__footer-offset">

                <div class="u-sidebar__body">
                    <div class="u-sidebar__content u-header-sidebar__content">

                        <header class="border-bottom px-4 px-md-5 py-4 d-flex align-items-center justify-content-between">
                            <h2 class="font-size-3 mb-0">ТАБЛЕТКА</h2>

                            <div class="d-flex align-items-center">
                                <button id="close-sidebar" type="button" class="close ml-auto" aria-controls="sidebarContent2" aria-haspopup="true"
                                        aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarContent2" data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                                        data-unfold-duration="100">
                                    <span aria-hidden="true"><i class="fas fa-times ml-2"></i></span>
                                </button>
                            </div>

                        </header>

                        <div class="border-bottom">
                            <div class="zeynep pt-4">
                                <ul>
                                    <li>
                                        <a href="/">Главная</a>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#" data-submenu="off-pages">Каталог</a>
                                        <div id="off-pages" class="submenu">
                                            <div class="submenu-header" data-submenu-close="off-pages">
                                                <a href="#">Назад</a>
                                            </div>
                                            <ul>
                                                @if(count($categories) >0)
                                                    @foreach($categories as $catlvl1)
                                                        @if($catlvl1->parent_id == 0 )
                                                            <li class="has-submenu">
                                                                <a href="#" data-submenu="catlvl2-{{ $catlvl1->id }}">{!! $catlvl1->title !!}</a>
                                                                <div id="catlvl2-{{ $catlvl1->id }}" class="submenu js-scrollbar" style="overflow-x: hidden!important;">
                                                                    <div class="submenu-header" data-submenu-close="catlvl2-{{ $catlvl1->id }}">
                                                                        <a href="#">{!! $catlvl1->title !!}</a>
                                                                    </div>
                                                                    <ul>
                                                                        @foreach($categories as $catlvl2)
                                                                            @if($catlvl2->parent_id == $catlvl1->id )
                                                                                <li class="has-submenu">
                                                                                    <a href="#" data-submenu="catlvl3-{{ $catlvl2->id }}">{!! $catlvl2->title !!}</a>
                                                                                    <div id="catlvl3-{{ $catlvl2->id }}" class="submenu js-scrollbar" style="overflow-x: hidden!important;">
                                                                                        <div class="submenu-header" data-submenu-close="catlvl3-{{ $catlvl2->id }}">
                                                                                            <a href="#">{!! $catlvl2->title !!}</a>
                                                                                        </div>
                                                                                        <ul >
                                                                                            @foreach($categories as $catlvl3)
                                                                                                @if($catlvl3->parent_id == $catlvl2->id )
                                                                                                    <li>
                                                                                                        <a href="{{ url('/products/'. $catlvl3->id) }}">{!! $catlvl3->title !!}</a>
                                                                                                    </li>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </li>



                                    <li onclick="function closeSidebar(){ document.getElementById('close-sidebar').click() }" >
                                        @if(Auth::check())
                                            <a href="{{ url('/user') }}">
                                                Личный кабинет
                                            </a>
                                        @else
                                            <a id="sidebarNavToggler" href="javascript:;" role="button" aria-controls="sidebarContent"
                                               aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                               data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent"
                                               data-unfold-type="css-animation" data-unfold-overlay='{
                                                "className": "u-sidebar-bg-overlay",
                                                "background": "rgba(0, 0, 0, .7)",
                                                "animationSpeed": 100                    }'
                                               data-unfold-animation-in="fadeInRight"
                                               data-unfold-animation-out="fadeOutRight"
                                               data-unfold-duration="100">
                                                Мой аккаунт
                                            </a>
                                        @endif
                                    </li>

                                    <li onclick="function closeSidebar(){ document.getElementById('close-sidebar').click() }" >
                                        <a id="sidebarNavToggler3" href="javascript:;" role="button" class=""
                                           aria-controls="sidebarContent3" aria-haspopup="true" aria-expanded="false"
                                           data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                           data-unfold-target="#sidebarContent3" data-unfold-type="css-animation"
                                           data-unfold-overlay='{
                                            "className": "u-sidebar-bg-overlay",
                                            "background": "rgba(0, 0, 0, .7)",
                                            "animationSpeed": 100
                                        }' data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                                           data-unfold-duration="100">
                                            Мои желания
                                        </a>
                                    </li>

                                    <li onclick="function closeSidebar(){ document.getElementById('close-sidebar').click() }" >
                                        <a id="sidebarNavToggler1" href="javascript:;" role="button" class=""
                                           aria-controls="sidebarContent1" aria-haspopup="true" aria-expanded="false"
                                           data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                           data-unfold-target="#sidebarContent1" data-unfold-type="css-animation"
                                           data-unfold-overlay='{
                                                "className": "u-sidebar-bg-overlay",
                                                "background": "rgba(0, 0, 0, .7)",
                                                "animationSpeed": 100
                                            }' data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                                           data-unfold-duration="100">
                                            Моя корзина
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/about-us') }}">О сервисе</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/delivery-and-payment') }}">Доставка и оплата</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/contacts') }}">Контакты</a>
                                    </li>

                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <li>
                                            <a href="{{ url('/logout') }}">Выход</a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                        {{--<div class="px-4 px-md-5 pt-5 pb-4 border-bottom">
                            <h2 class="font-size-3 mb-3">HELP & SETTINGS </h2>
                            <ul class="list-group list-group-flush list-group-borderless">
                                <li class="list-group-item px-0 py-2 border-0"><a href="#" class="h-primary">Your
                                        Account</a></li>
                                <li class="list-group-item px-0 py-2 border-0"><a href="#" class="h-primary">Help</a></li>
                                <li class="list-group-item px-0 py-2 border-0"><a href="#" class="h-primary">Sign In</a>
                                </li>
                            </ul>
                        </div>
                        <div class="px-4 px-md-5 py-5">
                            <select class="custom-select mb-4 rounded-0 pl-4 height-4 shadow-none text-dark">
                                <option selected>English (United States)</option>
                                <option value="1">English (UK)</option>
                                <option value="2">Arabic (Saudi Arabia)</option>
                                <option value="3">Deutsch</option>
                            </select>
                            <select class="custom-select mb-4 rounded-0 pl-4 height-4 shadow-none text-dark">
                                <option selected>$ USD</option>
                                <option value="1">د.إ AED</option>
                                <option value="2">¥ CNY</option>
                                <option value="3">€ EUR</option>
                            </select>

                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a class="h-primary pr-2 font-size-2" href="#">
                                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="h-primary pr-2 font-size-2" href="#">
                                        <span class="fab fa-google btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="h-primary pr-2 font-size-2" href="#">
                                        <span class="fab fa-twitter btn-icon__inner"></span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="h-primary pr-2 font-size-2" href="#">
                                        <span class="fab fa-github btn-icon__inner"></span>
                                    </a>
                                </li>
                            </ul>

                        </div>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</aside>
