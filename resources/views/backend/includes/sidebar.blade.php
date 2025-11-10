<div class="leftside-menu">

    
    <a href="#" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('backend/deafult_images/no-cat-img.png') }}" class="h-30" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('backend/deafult_images/no-cat-img.png') }}" class="h-20" alt="small logo">
        </span>
    </a>

    
    <a href="#" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('backend/deafult_images/no-cat-img.png') }}" class="h-30" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('backend/deafult_images/no-cat-img.png') }}" class="h-20" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <!-- <li class="side-nav-title">Main</li> -->

            <li class="side-nav-item">
                <a href="{{ route('contact.list') }}" class="side-nav-link">
                    <i class="mdi mdi-monitor-dashboard"></i>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                    <span> Contacts </span>
                </a>
            </li>

            

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
