<x-app-layout>
    
    <style>

        .wrapper{
        display: flex;
        position: relative;
        }

        .wrapper .sidebar{
        width: 200px;
        height: 100%;
        background: #a8ddb5;
        padding: 30px 0px;
        position: fixed;
        }

        .wrapper .sidebar h2{
        color: #fff;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 30px;
        }

        .wrapper .sidebar ul li{
        padding: 15px;
        border-bottom: 1px solid #000000;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        border-top: 1px solid rgba(255,255,255,0.05);
        }    

        .wrapper .sidebar ul li a{
        color: #000000;
        display: block;
        }

        .wrapper .sidebar ul li a .fas{
        width: 25px;
        }

        .wrapper .sidebar ul li:hover{
        background-color: #594f8d;
        }
            
        .wrapper .sidebar ul li:hover a{
        color: #fff;
        }
        
        .wrapper .sidebar .social_media{
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        }

        .wrapper .sidebar .social_media a{
        display: block;
        width: 40px;
        background: #594f8d;
        height: 40px;
        line-height: 45px;
        text-align: center;
        margin: 0 5px;
        color: #000000;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        }

        .wrapper .main_content{
        width: 100%;
        margin-left: 200px;
        }

        .wrapper .main_content .header{
        padding: 20px;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
        }

        .wrapper .main_content .info{
        margin: 20px;
        color: #717171;
        line-height: 25px;
        }

        .wrapper .main_content .info div{
        margin-bottom: 20px;
        }

        @media (max-height: 500px){
        .social_media{
            display: none !important;
        }
        }

        .c-dashboardInfo {
        margin-bottom: 15px;
        }
        .c-dashboardInfo .wrap {
        background: #ffffff;
        box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 7px;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 40px 25px 20px;
        height: 100%;
        }
        .c-dashboardInfo__title,
        .c-dashboardInfo__subInfo {
        color: #6c6c6c;
        font-size: 1.18em;
        }
        .c-dashboardInfo span {
        display: block;
        }
        .c-dashboardInfo__count {
        font-weight: 600;
        font-size: 2.5em;
        line-height: 64px;
        color: #323c43;
        }
        .c-dashboardInfo .wrap:after {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        content: "";
        }

        .c-dashboardInfo:nth-child(1) .wrap:after {
        background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
        }
        .c-dashboardInfo:nth-child(2) .wrap:after {
        background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
        }
        .c-dashboardInfo:nth-child(3) .wrap:after {
        background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
        }
        .c-dashboardInfo:nth-child(4) .wrap:after {
        background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
        }
        .c-dashboardInfo__title svg {
        color: #d7d7d7;
        margin-left: 5px;
        }
        .MuiSvgIcon-root-19 {
        fill: currentColor;
        width: 1em;
        height: 1em;
        display: inline-block;
        font-size: 24px;
        transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        user-select: none;
        flex-shrink: 0;
        }


    </style>

    <div class="wrapper">
    <div class="sidebar">
        <h2>Blog System</h2>
        <ul>
        <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i>Dashboard</a></li>
        <li><a href="{{ route('blog-category.index') }}"><i class="fas fa-user"></i>Categories</a></li>
        <li><a href="{{ route('blog.index') }}"><i class="fas fa-address-card"></i>Blogs</a></li>
        <li><a href="{{ route('user.logout') }}#"><i class="fas fa-blog"></i>Logout</a></li>
        </ul> 
        
    </div>
    <div class="main_content">
        <div class="header">Welcome!! Have a nice day.</div>  
        <div class="info">

        <div id="root">
            <div class="container pt-5">
                <div class="row align-items-stretch">
                <div class="c-dashboardInfo col-lg-3 col-md-6">
                    <div class="wrap">
                    <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">My Blogs<svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                        </path>
                        </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">{{ \App\Models\Blog::where('user_id', Auth::id())->count() }}
</span>
                    </div>
                </div>
                </div>
            </div>
        </div>

      </div>
    </div>
</div>
</x-app-layout>
