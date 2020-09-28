<?php
$menus = [
    [
        'title' => 'Dashboard',
        'icon' => 'home',
        'route' => 'admin.dashboard',
        'model' => App\Model\Item::class,
    ],
    [
        'title' => 'Item',
        'icon' => 'clipboard',
        'route' => 'admin.items',
        'model' => App\Model\Item::class,
        'subMenu' => [
            [
                'title' => 'Item List',
                'route' => 'admin.items.index',
                'policy' => 'viewAny',
            ],
            [
                'title' => 'Add Item',
                'route' => 'admin.items.create',
                'policy' => 'create',
            ],
        ],
    ],
    [
        'title' => 'Category',
        'icon' => 'list',
        'route' => 'admin.categories',
        'model' => App\Model\Category::class,
        'subMenu' => [
            [
                'title' => 'Category List',
                'route' => 'admin.categories.index',
                'policy' => 'viewAny',
            ],
            [
                'title' => 'Add Category',
                'route' => 'admin.categories.create',
                'policy' => 'create',
            ],
        ],
    ],
    [
        'title' => 'Variant',
        'icon' => 'grid',
        'route' => 'admin.variants',
        'model' => App\Model\Variant::class,
        'subMenu' => [
            [
                'title' => 'Variant List',
                'route' => 'admin.variants.index',
                'policy' => 'viewAny',
            ],
            [
                'title' => 'Add Variant',
                'route' => 'admin.variants.create',
                'policy' => 'create',
            ],
        ],
    ],
    [
        'title' => 'Size',
        'icon' => 'package',
        'route' => 'admin.sizes',
        'model' => App\Model\Size::class,
        'subMenu' => [
            [
                'title' => 'Size List',
                'route' => 'admin.sizes.index',
                'policy' => 'viewAny',
            ],
            [
                'title' => 'Add Size',
                'route' => 'admin.sizes.create',
                'policy' => 'create',
            ],
        ],
    ],
    [
        'title' => 'Ingredient',
        'icon' => 'home',
        'route' => 'admin.ingredients',
        'model' => App\Model\Ingredient::class,
        'subMenu' => [
            [
                'title' => 'Ingredient List',
                'route' => 'admin.ingredients.index',
                'policy' => 'viewAny',
            ],
            [
                'title' => 'Add Ingredient',
                'route' => 'admin.ingredients.create',
                'policy' => 'create',
            ],
        ],
    ],
    [
        'title' => 'Order',
        'icon' => 'edit',
        'route' => 'admin.orders',
        'model' => App\Model\Order::class,
        'subMenu' => [
            [
                'title' => 'Order List',
                'route' => 'admin.orders.index',
                'policy' => 'viewAny',
            ],
            [
                'title' => 'Add Order',
                'route' => 'admin.orders.create',
                'policy' => 'create',
            ],
        ],
    ],
    [
        'title' => 'User',
        'icon' => 'user',
        'route' => 'admin.users.index',
        'policy' => 'viewAny',
        'model' => App\Model\User::class,
    ],
]
?>
<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{ route('index') }}" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">Kapesop</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>


        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>User</label>
                </li>

                <li>
                    <div class="">
                        <div class="pro-head px-3 d-flex justify-content-between align-items-center">
                            <div>
                                <img src="{{ asset('dattalite/assets/images/user/avatar-1.jpg') }}" class="img-radius mr-2" alt="User-Profile-Image" style="width: 50px">
                                <span>
                                    <a href="{{ route('admin.users.show', auth()->user()->id) }}" class="text-white">
                                        {{ auth()->user()->name }}
                                    </a>
                                </span>
                            </div>
                            <form action="{{ route('admin.logout') }}" method="post" class="d-inline-block ">
                                @csrf
                                <button class="" style="border: none; cursor: pointer; background: none">
                                    <i class="feather icon-log-out text-white" style="font-size: 18px; color: #a9b7d0"></i>
                                </button>

                            </form>
                        </div>
                    </div>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>

                @foreach($menus as $index => $menu)

                @can('viewAny', $menu['model'])

                  @if(isset($menu['subMenu']))
                    <li data-username="{{ $menu['title'] }} components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu {{ Request::routeIs("$menu[route]*") ? 'active pcoded-trigger' : '' }}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-{{ $menu['icon'] }}"></i></span><span class="pcoded-mtext">{{ $menu['title'] }}</span></a>
                        <ul class="pcoded-submenu">
                          @foreach($menu['subMenu'] as $subMenu)
                            @can($subMenu['policy'], $menu['model'])
                            <li class="{{ Request::routeIs("$subMenu[route]*") ? 'active' : '' }}"><a href="{{ route($subMenu['route']) }}" class="">{{ $subMenu['title'] }}</a></li>
                            @endcan
                          @endforeach
                        </ul>
                    </li>

                  @else

                    <li data-username="{{ $menu['title'] }} Default Ecommerce CRM Analytics Crypto Project" class="nav-item {{ Request::routeIs("$menu[route]*") ? 'active' : '' }}">
                        <a href="{{ route($menu['route']) }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-{{ $menu['icon'] }}"></i></span><span class="pcoded-mtext">{{ $menu['title'] }}</span></a>
                    </li>

                  @endif

                @endcan

                @endforeach
            </ul>
        </div>
    </div>
</nav>
