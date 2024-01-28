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
background-color: #6cafd2;
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
