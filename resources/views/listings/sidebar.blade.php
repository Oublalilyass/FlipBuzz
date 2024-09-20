<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>
            <div class="sidebar-toggle">
                <button class="sidebar-btn" id="toggle-btn">
                    <i class='bx bx-chevron-right' id="toggle-icon"></i> <!-- Default icon for closed state -->
                </button>
            </div>
        </div>
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Listings</span>
                </a>
                <span class="tooltip">Listings</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Get a free valuation</span>
                </a>
                <span class="tooltip">Get a free valuation</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Contact</span>
                </a>
                <span class="tooltip">Contact</span>
            </li>
        </ul>
    </div>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let toggleBtn = document.querySelector("#toggle-btn");
        let toggleIcon = document.querySelector("#toggle-icon");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open"); // Toggle the sidebar open/close
            // Change the icon based on the sidebar state
            if (sidebar.classList.contains("open")) {
                toggleIcon.classList.remove('bx-chevron-right');
                toggleIcon.classList.add('bx-chevron-left');
            } else {
                toggleIcon.classList.remove('bx-chevron-left');
                toggleIcon.classList.add('bx-chevron-right');
            }
        });
    </script>
</body>

</html>

<style>
    /* Google Font Link */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    .sidebar {
        position: sticky;
        top: 0;
        height: 100vh;
        width: 78px;
        background: #11101D;
        padding: 6px 14px;
        z-index: 99;
        transition: all 0.5s ease;
    }


    .sidebar.open {
        width: 250px;
    }

    .main-content {
        margin-left: 38px;
        transition: margin-left 0.5s ease;
    }

    .sidebar.open~.main-content {
        margin-left: 20px;
    }

    .sidebar .logo-details {
        height: 60px;
        display: flex;
        align-items: center;
        position: relative;
        transition: opacity 0.5s ease;
    }

    .sidebar .sidebar-toggle {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 50%;
        right: -40px;
        transform: translateY(-50%);
    }

    .sidebar-btn {
        background-color: #11101D;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 5px 0;
        cursor: pointer;
        transition: background 0.3s;
    }

    .sidebar-btn:hover {
        background-color: #444;
    }

    .sidebar i {
        color: #fff;
        height: 60px;
        min-width: 50px;
        font-size: 28px;
        text-align: center;
        line-height: 60px;
    }

    .sidebar .nav-list {
        margin-top: 20px;
        height: 100%;
    }

    .sidebar li {
        position: relative;
        margin: 8px 0;
        list-style: none;
    }

    .sidebar li .tooltip {
        position: absolute;
        top: -20px;
        left: calc(100% + 15px);
        z-index: 3;
        background: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 15px;
        font-weight: 400;
        opacity: 0;
        white-space: nowrap;
        pointer-events: none;
        transition: 0s;
    }

    .sidebar li:hover .tooltip {
        opacity: 1;
        pointer-events: auto;
        transition: all 0.4s ease;
        top: 50%;
        transform: translateY(-50%);
    }

    .sidebar.open li .tooltip {
        display: none;
    }

    .sidebar input {
        font-size: 15px;
        color: #FFF;
        font-weight: 400;
        outline: none;
        height: 50px;
        width: 100%;
        border: none;
        border-radius: 12px;
        transition: all 0.5s ease;
        background: #1d1b31;
    }

    .sidebar.open input {
        padding: 0 20px 0 50px;
    }

    .sidebar .bx-search {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        font-size: 22px;
        background: #1d1b31;
        color: #FFF;
    }

    .sidebar.open .bx-search:hover {
        background: #1d1b31;
        color: #FFF;
    }

    .sidebar .bx-search:hover {
        background: #FFF;
        color: #11101d;
    }

    .sidebar li a {
        display: flex;
        height: 100%;
        width: 100%;
        border-radius: 12px;
        align-items: center;
        text-decoration: none;
        transition: all 0.4s ease;
        background: #11101D;
    }

    .sidebar li a:hover {
        background: #FFF;
    }

    .sidebar li a .links_name {
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: 0.4s;
    }

    .sidebar.open li a .links_name {
        opacity: 1;
        pointer-events: auto;
    }

    .sidebar li a:hover .links_name,
    .sidebar li a:hover i {
        transition: all 0.5s ease;
        color: #11101D;
    }

    .sidebar li i {
        height: 50px;
        line-height: 50px;
        font-size: 18px;
        border-radius: 12px;
    }

    @media (max-width: 420px) {
        .sidebar li .tooltip {
            display: none;
        }
    }

    /* this media query for small screens (max-width: 576px) */
    @media (max-width: 576px) {
        .sidebar {
            width: 60px;
            padding: 4px 10px;
        }

        .sidebar .logo-details {
            height: 40px;
        }

        .sidebar .sidebar-toggle {
            right: -30px;
        }

        .sidebar-btn {
            width: 30px;
            height: 30px;
        }

        .sidebar i {
            font-size: 20px;
        }

        .sidebar li {
            margin: 5px 0;
        }

        .sidebar input {
            height: 40px;
        }

        .sidebar .bx-search {
            font-size: 18px;
        }
    }

    /* this media query for medium screens (max-width: 768px) */
    @media (max-width: 768px) {
        .sidebar {
            width: 70px;
            padding: 6px 12px;
        }

        .sidebar .logo-details {
            height: 50px;
        }

        .sidebar .sidebar-toggle {
            right: -35px;
        }

        .sidebar-btn {
            width: 35px;
            height: 35px;
        }

        .sidebar i {
            font-size: 22px;
        }

        .sidebar li {
            margin: 6px 0;
        }

        .sidebar input {
            height: 45px;

        }

        .sidebar .bx-search {
            font-size: 20px;

        }
    }
</style>