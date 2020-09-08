<?php
$menus = [
    [
        'title' => 'Dashboard',
        'icon' => 'home',
        'route' => 'admin.dashboard',
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
            ],
            [
                'title' => 'Add Item',
                'route' => 'admin.items.create',
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
            ],
            [
                'title' => 'Add Category',
                'route' => 'admin.categories.create',
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
            ],
            [
                'title' => 'Add Variant',
                'route' => 'admin.variants.create',
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
            ],
            [
                'title' => 'Add Size',
                'route' => 'admin.sizes.create',
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
            ],
            [
                'title' => 'Add Ingredient',
                'route' => 'admin.ingredients.create',
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
            ],
            [
                'title' => 'Add Order',
                'route' => 'admin.orders.create',
            ],
        ],
    ],
    [
        'title' => 'User',
        'icon' => 'user',
        'route' => 'admin.users.index',
        'model' => App\Model\User::class,
    ],
]
?>
<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">Datta Able</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>

                @foreach($menus as $index => $menu)

                  @if(isset($menu['subMenu']))
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu {{ Request::routeIs("$menu[route]*") ? 'active pcoded-trigger' : '' }}">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-{{ $menu['icon'] }}"></i></span><span class="pcoded-mtext">{{ $menu['title'] }}</span></a>
                        <ul class="pcoded-submenu">
                          @foreach($menu['subMenu'] as $subMenu)
                            <li class="{{ Request::routeIs("$subMenu[route]*") ? 'active' : '' }}"><a href="{{ route($subMenu['route']) }}" class="">{{ $subMenu['title'] }}</a></li>
                          @endforeach
                        </ul>
                    </li>

                  @else

                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item {{ Request::routeIs("$menu[route]*") ? 'active' : '' }}">
                        <a href="{{ route($menu['route']) }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-{{ $menu['icon'] }}"></i></span><span class="pcoded-mtext">{{ $menu['title'] }}</span></a>
                    </li>

                  @endif

                @endforeach
            </ul>
        </div>
    </div>
</nav>
