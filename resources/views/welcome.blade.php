@include('inc/header')
<style>


    .cat-checkbox-list {
        padding: 0 0;
    }
    .cat-checkbox,
    .cat-radio {
        display: inline-block;
        position: relative;
        padding-left: 28px;
        margin-bottom: 10px;
        cursor: pointer;
        font-size: 0.875rem;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    [dir="rtl"] .cat-checkbox,
    [dir="rtl"] .cat-radio {
        padding-right: 28px;
        padding-left: 0;
    }
    .cat-checkbox-list .cat-checkbox,
    .cat-radio-list .cat-radio {
        display: block;
    }
    .cat-checkbox.cat-checkbox-disabled,
    .cat-radio.cat-radio-disabled {
        opacity: 0.8;
        cursor: not-allowed;
    }
    .cat-checkbox-inline .cat-checkbox,
    .cat-radio-inline .cat-radio {
        display: inline-block;
        margin-right: 15px;
        margin-bottom: 5px;
    }
    .cat-checkbox-inline .cat-checkbox:last-child,
    .cat-radio-inline .cat-radio:last-child {
        margin-right: 0;
    }
    .cat-checkbox > input,
    .cat-radio > input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .cat-square-check,
    .cat-rounded-check {
        background: 0 0;
        position: relative;
        height: 16px;
        width: 16px;
        border: 1px solid #d1d7e2;
    }

    .cat-checkbox .cat-square-check,
    .cat-checkbox .cat-rounded-check,
    .cat-radio .cat-square-check,
    .cat-radio .cat-rounded-check {
        position: absolute;
        top: 2px;
        left: 0;
    }
    [dir="rtl"] .cat-checkbox .cat-square-check,
    [dir="rtl"] .cat-checkbox .cat-rounded-check,
    [dir="rtl"] .cat-radio .cat-square-check,
    [dir="rtl"] .cat-radio .cat-rounded-check {
        left: auto;
        right: 0;
    }
    .cat-square-check {
        border-radius: 3px;
    }
    .cat-rounded-check {
        border-radius: 50%;
    }
    .cat-square-check:after,
    .cat-rounded-check:after {
        content: "";
        position: absolute;
        visibility: hidden;
        opacity: 0;
        top: 50%;
        left: 50%;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    .cat-square-check:after {
        margin-left: -2px;
        margin-top: -6px;
        width: 5px;
        height: 10px;
        border-width: 0 2px 2px 0 !important;
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg);
        border: solid var(--primary);
    }
    .cat-rounded-check:after {
        margin-left: -5px;
        margin-top: -5px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--primary);
    }
    .cat-checkbox > input:checked ~ .cat-square-check:after,
    .cat-radio > input:checked ~ .cat-square-check:after,
    .cat-checkbox > input:checked ~ .cat-rounded-check:after,
    .cat-radio > input:checked ~ .cat-rounded-check:after {
        visibility: visible;
        opacity: 1;
    }
    .bg-white {
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity));
        width: 250px;
        margin-top: 20px;
    }
    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
        padding: inherit;
    }
    .hed{
        font-size: larger;
        font-weight: 900;
    }


        /*pagination*/
        .cat-pagination-center .pagination {
        -ms-flex-pack: center;
        justify-content: center;
    }
    .cat-pagination-right .pagination {
        -ms-flex-pack: end;
        justify-content: flex-end;
    }
    .cat-pagination .pagination {
        margin-bottom: 0;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .pagination .page-link,
    .page-item.disabled .page-link {
        min-width: 36px;
        min-height: 36px;
        line-height: 36px;
        text-align: center;
        padding: 0;
        border: 0;
        font-size: 0.875rem;
        border-radius: 50% !important;
        color: var(--dark);
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .active .page-link {
        background-color: var(--primary);
    }
    .pagination .page-link:hover {
        background-color: var(--primary);
        color: #fff;
    }

</style>

<section class="pb-4 pt-5">
        <div class="container">
            <div class="row gutters-16">
                <!-- Contents -->
                <div class="col-xl-9 order-xl-1" style="margin-top: -25px;">
                    <!-- Breadcrumb -->
                    <div class="row gutters-16 mb-4">
                        
                        
                        <div class="col d-xl-none mb-lg-3 text-right">
                            <button type="button" class="btn btn-icon p-0 active" data-toggle="class-toggle" data-target=".cat-filter-sidebar">
                                <i class="la la-filter la-2x"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Blogs -->
                    <div class="bloglist card-columns">
                        @foreach($blogs as $blog)
                            <div class="card mb-4 overflow-hidden shadow-none border rounded-0 hov-scale-img p-3" style="height: 450px;">
                                <a href="{{ url("blog-details").'/'. $blog->id }}" class="text-reset d-block overflow-hidden h-180px">
                                    <img src="{{ asset($blog->banner) }}"
                                        data-src=""
                                        alt="{{ $blog->title }}"
                                        class="img-fit lazyload h-100 has-transition" style="width: 222px;max-height: 250px;">
                                </a>
                                <div class="py-3">
                                    <h5 style="font-weight: 900;color:#d3b750;">
                                        <a href="{{ url("blog-details").'/'. $blog->id }}" class="text-reset hov-text-primary" title="{{ $blog->title }}">
                                            {{ $blog->title }}
                                        </a>
                                    </h5>
                                    <p style="font-size: smaller;" title="{{ $blog->short_description }}">
                                        {{ $blog->short_description }}
                                    </p>
                                    <div>
                                        <small class="fs-12 fw-400 opacity-60">{{ date('M d, Y',strtotime($blog->created_at)) }}</small>
                                    </div>
                                    @if($blog->category != null)
                                        <div>
                                            <small style="color:#d3b750;">{{ $blog->category->category_name }}</small>
                                        </div>
                                    @endif
                                    <div class="mt-3 text-primary">
                                        <a href="{{ url("blog-details").'/'. $blog->id }}" class="fs-14 fw-700 text-primary has-transition d-flex align-items-center hov-column-gap-1">
                                            Read Full Blog
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                    <!-- Pagination -->
                    <div class="cat-pagination mt-4">
                        {{ $blogs->links() }}
                    </div>
                </div>
                
                <style>
                    .bloglist a:hover{
                        text-decoration: none;
                        color: #d3b750 !important;
                    }
                </style>
                

                <!-- Sidebar -->
                <div class="col-xl-3">
                    <!-- Filters -->
                    <form class="mb-4" id="search-form" action="" method="GET">
                        <div class="cat-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".cat-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                            <div class="collapse-sidebar c-scrollbar-light text-left">
                                <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                    <h3 class="h6 mb-0 fw-600">Filters</h3>
                                    <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".cat-filter-sidebar" >
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>

                                
                                <!-- Search -->
                                <div class="mb-4 mt-3 px-3 mt-xl-0 px-xl-0">
                                    <div class="input-group w-100">
                                        <input type="text" class="border border-right-0 rounded-0 fs-14 flex-grow-1" name="search" value="{{ $search }}" placeholder="Search..." autocomplete="off" style="padding: 14px;">
                                        <div class="input-group-append">
                                            <button class="btn bg-transparent hov-bg-light rounded-0 border border-left-0" type="submit" style="">
                                                <i class="la la-search la-flip-horizontal fs-18 text-gray"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Categories -->
                                @php $get_all_blog_categories = \App\Models\BlogCategory::get(); @endphp
                                <div class="bg-white border mb-3 mx-3 mx-xl-0">
                                    <div class="fs-16 fw-700 p-3">Categories</div>
                                    <div class="p-3 cat-checkbox-list">
                                        @foreach ($get_all_blog_categories as $category)
                                        <label class="cat-checkbox mb-3">
                                            <input
                                                type="checkbox"
                                                name="selected_categories[]"
                                                value="{{ $category->slug }}" @if (in_array($category->slug, $selected_categories)) checked @endif
                                                onchange="filter()"
                                            >
                                            <span class="cat-square-check"></span>
                                            <span class="fs-14 fw-400 text-dark has-transition hov-text-primary">{{ $category->category_name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>

                    

                </div>

            </div>
        </div>
    </section>

    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
    </script>


@include('inc/footer')