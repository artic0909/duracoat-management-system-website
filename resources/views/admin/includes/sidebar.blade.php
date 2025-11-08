    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('admin.dashboard') }}">
                <h3 class="fw-bolder">SUPER ADMIN</h3>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>dashboard</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::routeIs('admin.paint-manage') ? 'active' : '' }}" href="{{ route('admin.paint-manage') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>paint</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(153.000000, 2.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M38,4 L10,4 C7.79,4 6,5.79 6,8 L6,14 C6,16.21 7.79,18 10,18 L38,18 C40.21,18 42,16.21 42,14 L42,8 C42,5.79 40.21,4 38,4 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M22,22 L26,22 L26,32 C26,35.31 28.69,38 32,38 C35.31,38 38,35.31 38,32 L38,22 L42,22 L42,32 C42,37.52 37.52,42 32,42 C26.48,42 22,37.52 22,32 L22,22 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Manage Paints</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::routeIs('admin.client-material-manage') ? 'active' : '' }}" href="{{ route('admin.client-material-manage') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>client</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(453.000000, 454.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M40,8 L8,8 C5.79,8 4,9.79 4,12 L4,16 L44,16 L44,12 C44,9.79 42.21,8 40,8 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M4,20 L4,36 C4,38.21 5.79,40 8,40 L40,40 C42.21,40 44,38.21 44,36 L44,20 L4,20 Z M16,32 L10,32 L10,26 L16,26 L16,32 Z M28,32 L22,32 L22,26 L28,26 L28,32 Z M38,32 L32,32 L32,26 L38,26 L38,32 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Client & Materials</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.orders-and-jobcards') ? 'active' : '' }}" href="{{ route('admin.orders-and-jobcards') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>ordersandjobcards</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(453.000000, 454.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M40,8 L8,8 C5.79,8 4,9.79 4,12 L4,16 L44,16 L44,12 C44,9.79 42.21,8 40,8 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M4,20 L4,36 C4,38.21 5.79,40 8,40 L40,40 C42.21,40 44,38.21 44,36 L44,20 L4,20 Z M16,32 L10,32 L10,26 L16,26 L16,32 Z M28,32 L22,32 L22,26 L28,26 L28,32 Z M38,32 L32,32 L32,26 L38,26 L38,32 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Orders & Jobcards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.all-jobcards') ? 'active' : '' }}" href="{{ route('admin.all-jobcards') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>alljobcards</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(453.000000, 454.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M40,8 L8,8 C5.79,8 4,9.79 4,12 L4,16 L44,16 L44,12 C44,9.79 42.21,8 40,8 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M4,20 L4,36 C4,38.21 5.79,40 8,40 L40,40 C42.21,40 44,38.21 44,36 L44,20 L4,20 Z M16,32 L10,32 L10,26 L16,26 L16,32 Z M28,32 L22,32 L22,26 L28,26 L28,32 Z M38,32 L32,32 L32,26 L38,26 L38,32 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">All Jobcards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  {{ Request::routeIs('admin.material-out') ? 'active' : '' }}" href="{{ route('admin.material-out') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>material-out</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(304.000000, 151.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M40,10 L28,10 L28,4 L20,4 L20,10 L8,10 C5.79,10 4,11.79 4,14 L4,18 L44,18 L44,14 C44,11.79 42.21,10 40,10 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M4,22 L4,40 C4,42.21 5.79,44 8,44 L40,44 C42.21,44 44,42.21 44,40 L44,22 L4,22 Z M30,32 L26,32 L26,36 L22,36 L22,32 L18,32 L24,26 L30,32 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Material Out</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::routeIs('admin.stocks-manage') ? 'active' : '' }}" href="{{ route('admin.stocks-manage') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>stocks</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(1.000000, 0.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M6,6 L6,18 L18,18 L18,6 L6,6 Z M14,14 L10,14 L10,10 L14,10 L14,14 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M22,6 L22,18 L34,18 L34,6 L22,6 Z M30,14 L26,14 L26,10 L30,10 L30,14 Z">
                                                </path>
                                                <path class="color-background" d="M38,6 L38,18 L42,18 L42,6 L38,6 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M6,22 L6,34 L18,34 L18,22 L6,22 Z M14,30 L10,30 L10,26 L14,26 L14,30 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M22,22 L22,34 L34,34 L34,22 L22,22 Z M30,30 L26,30 L26,26 L30,26 L30,30 Z">
                                                </path>
                                                <path class="color-background" d="M38,22 L38,34 L42,34 L42,22 L38,22 Z">
                                                </path>
                                                <path class="color-background opacity-6"
                                                    d="M6,38 L18,38 L18,42 L6,42 L6,38 Z"></path>
                                                <path class="color-background opacity-6"
                                                    d="M22,38 L34,38 L34,42 L22,42 L22,38 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Manage Stocks</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>profile</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(1.000000, 0.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>