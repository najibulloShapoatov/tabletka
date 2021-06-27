<!-- Side Header Start -->
<div class="side-header show">
    <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
    <!-- Side Header Inner Start -->
    <div class="side-header-inner custom-scroll">

        <nav class="side-header-menu" id="side-header-menu">
            <ul>
                <li>
                    <a href="{{ url('/admin') }}"><i class="ti-home"></i> <span>Главная</span></a>
                </li>
                <li><a href="{{ url('/admin/users') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Пользователи</span></a></li>

                <li  class="has-sub-menu">
                    <a data-id="0" href="{{ url('/admin/categories') }}">
                       <span > <i class="ti-package"></i> <span>Каталог</span></span>
                    </a>
                    @if(count($categories) > 0)
                    <ul class="side-header-sub-menu">
                            @foreach($categories as $cat)
                                @if($cat->parent_id == 0 )
                                    <li id="cat_side_bar_{{ $cat->id }}" class="has-sub-menu">
                                        <a catLevel="1" data-id="{{ $cat->id }}" href="#"><span>{!! mb_substr($cat->title, 0, 23)  !!}</span></a>
                                        <ul class="side-header-sub-menu">
                                            @foreach($categories as $ca)
                                                @if($cat->id == $ca->parent_id)
                                                    <li id="cat_side_bar_{{ $cat->id }}" class="has-sub-menu">
                                                        <a catLevel="2" data-id="{{ $ca->id }}" href="#"><span>{!! mb_substr($ca->title, 0, 20)  !!}</span></a>
                                                        <ul class="side-header-sub-menu">
                                                            @foreach($categories as $c)
                                                                @if($ca->id == $c->parent_id)
                                                                    <li id="cat_side_bar_{{ $cat->id }}">
                                                                        <a catLevel="3" data-id="{{ $c->id }}" href="#"><span>{!! mb_substr($c->title, 0, 20)  !!}</span></a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                    </ul>
                    @endif
                </li>
                <li><a href="{{ url('/admin/orders') }}"><i class="zmdi zmdi-shopping-basket zmdi-hc-fw"></i> <span>Заказы</span></a></li>
                <li><a href="{{ url('/admin/delivery') }}"><i class="zmdi zmdi-truck zmdi-hc-fw"></i> <span>Доставка</span></a></li>
                <li><a href="{{ url('/admin/slideshow') }}"><i class="zmdi zmdi-collection-image zmdi-hc-fw"></i> <span>Слайдшоу</span></a></li>
                <li><a href="{{ url('/admin/home-cats') }}"><i class="zmdi zmdi-dns zmdi-hc-fw"></i> <span>Категории на главной</span></a></li>
                <li><a href="{{ url('/admin/site-settings') }}"><i class="zmdi zmdi-settings"></i> <span>Конфигурации</span></a></li>
                <li><a href="{{ url('/logout') }}"><i class="ti-unlock"></i> <span>Выход</span></a></li>
            </ul>
        </nav>

    </div><!-- Side Header Inner End -->
</div><!-- Side Header End -->
