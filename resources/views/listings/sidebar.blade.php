<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('sidebar.css') }}">

<div id="app">
    <!-- Hamburger Icon -->
    <div class="hamburger" @click="open = !open" :class="{ active: open }">
        <button class="p-2">
            <i :class="open ? 'mdi mdi-close' : 'mdi mdi-menu'" class="hamburger-icon"></i> <!-- Toggle Hamburger and Close Icon -->
        </button>
    </div>

    <aside :class="['aside', { 'is-expanded': open }]" v-if="!isSmallScreen || open">
        <div class="aside-tools">
            <div class="dashboard-title">
                Dashboard
            </div>
        </div>
        <div class="menu is-menu-main">
            <ul class="menu-list">
                <li class="--set-active-index-html">
                    <a href="index.html">
                        <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
                        <span class="menu-item-label">Listing</span>
                    </a>
                </li>
            </ul>
            <ul class="menu-list">
                <li class="--set-active-tables-html">
                    <a href="tables.html">
                        <span class="icon"><i class="mdi mdi-table"></i></span>
                        <span class="menu-item-label">Get a free valuation</span>
                    </a>
                </li>
            </ul>
            <ul class="menu-list">
                <li class="--set-active-tables-html">
                    <a href="tables.html">
                        <span class="icon"><i class="mdi mdi-phone"></i></span>
                        <span class="menu-item-label">Contact</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            open: false,
            isSmallScreen: false
        },
        mounted() {
            this.checkScreenSize();
            window.addEventListener('resize', this.checkScreenSize);
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.checkScreenSize);
        },
        methods: {
            checkScreenSize() {
                this.isSmallScreen = window.innerWidth <= 768; // Adjust the breakpoint as needed
                if (this.isSmallScreen && this.open) {
                    this.open = false; // Close the sidebar if screen size is small and it's open
                }
            }
        }
    });
</script>
<style>
    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background-color: var(--primary-dark-blue);
        padding: 20px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        transition: transform 0.3s ease;
    }

    .sidebar-hidden {
        transform: translateX(-100%);
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        background-color: var(--white);
        color: var(--primary-dark-blue);
    }

    /* Hamburger and Close Icon */
    .hamburger {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 500;
        display: none;
        background-color: transparent;
        border: none;
    }

    .hamburger.active {
        z-index: 1100;
    }

    .hamburger button {
        padding: 10px;
    }

    .hamburger-icon {
        color: gray;
        font-size: 24px;
    }

    /* Close Icon */
    .hamburger-icon.mdi-close {
        color: white;
    }


    .dashboard-title {
        font-size: 20px;
        color: white;
        text-align: center;
        position: relative;
        z-index: 1000;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            transform: translateX(-100%);
        }

        .sidebar.is-expanded {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
            padding: 10px;
        }

        .hamburger {
            display: block;
        }
    }

    /* Toggle sidebar */
    .hamburger.active+.sidebar {
        transform: translateX(0);
    }

    .hamburger.active {
        transform: rotate(0deg);
    }

    .aside {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        background-color: #333;
        padding: 20px;
        z-index: 1000;
    }

    .aside-tools {
        background-color: #444;
        padding: 10px;
        color: #fff;
    }

    .menu {
        padding: 20px;
    }

    .menu-label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-list li {
        margin-bottom: 10px;
    }

    .menu-list li a {
        color: #fff;
        text-decoration: none;
    }

    .menu-list li a:hover,
    .menu-list li.active a {
        color: #B4B4B8;
    }
</style>