
@include('inc/admin/header')


@include('inc/admin/sidebar')

<x-app-layout>

    <style>
        .aiz-table thead th {
            border-top: 0;
            border-bottom: 1px solid #eceff7;
        }
        .aiz-table th {
            font-weight: 600;
        }
        .aiz-table td,
        .aiz-table th {
            border-top: 1px solid #eceff7;
        }
        .aiz-table td,
        .aiz-table th {
            padding: 1rem 0.75rem;
        }
        .aiz-table.table-bordered td,
        .aiz-table.table-bordered th {
            border: 1px solid #eceff7;
        }
        .aiz-table .footable-detail-row > td {
            padding: 0;
        }
        .aiz-table .footable-toggle {
            height: 16px;
            width: 16px;
            line-height: 16px;
            font-size: 16px;
            border-radius: 4px;
            text-align: center;
            opacity: 1;
            color: var(--primary);
            background-color: var(--soft-primary);
            margin-right: 10px;
        }
        .aiz-table .footable-toggle.fooicon-minus {
            color: var(--white);
            background-color: var(--primary);
        }
        .aiz-table.footable > tbody > tr.footable-empty > td {
            font-size: 20px;
            position: relative;
            padding-top: 100px;
        }

        .aiz-table.footable > tbody > tr.footable-empty > td:before {
            content: "\f119";
            font-family: "Line Awesome Free";
            font-weight: 900;
            position: absolute;
            left: 50%;
            top: 20px;
            font-size: 60px;
            opacity: 0.5;
            transform: translate(-50%, 0px);
        }
        .aiz-table .footable-pagination-wrapper {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: space-between;
            justify-content: space-between;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .aiz-table .footable-page-link,
        .aiz-table .footable-page.disabled .footable-page-link {
            min-width: 36px;
            min-height: 36px;
            line-height: 36px;
            text-align: center;
            padding: 0;
            border: 0;
            font-size: 0.875rem;
            border-radius: 50% !important;
            color: var(--dark);
            display: inline-block;
        }

        .aiz-table .footable-page {
            margin: 0 2px;
        }

        .aiz-table .active .footable-page-link ,
        .aiz-table .footable-page-link:hover {
            background-color: var(--primary);
            color: #fff;
        }
        /*footable*/
        .aiz-table {
            opacity: 0;
            height: 0;
        }
        div.footable-loader {
            height: 220px;
        }
        .aiz-table.footable,
        .aiz-table.footable-details {
            opacity: 1;
            height: auto;
        }

        /*pagination*/
        .aiz-pagination-center .pagination {
            -ms-flex-pack: center;
            justify-content: center;
        }
        .aiz-pagination-right .pagination {
            -ms-flex-pack: end;
            justify-content: flex-end;
        }
        .aiz-pagination .pagination {
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

    
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

        <div style="margin-left: 20px;margin-right: 20px;">
            <div class="row">
            <div class="col-lg-8 mx-auto" style="margin-top: 20px;">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Blog Information</h5>
                    </div>
                    <div class="card-body">
                        <form id="add_form" class="form-horizontal" action="{{ route('blog.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Blog Title
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="Blog Title" onkeyup="makeSlug(this.value)" id="title" name="title" class="form-control">
                                    @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="category">
                                <label class="col-md-3 col-from-label">
                                    Category
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-9">
                                    <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true">
                                        <option value="">Select One</option>
                                        @foreach ($blog_categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Banner
                                </label>
                                <div class="col-md-9">
                                    <input type="file" name="banner" accept="image/*" />
                                    </br>
                                    @error('banner')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <small class="text-muted">Accepts only image files.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">
                                    Short Description
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-9">
                                    <textarea name="short_description" rows="5" class="form-control"></textarea>
                                @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">
                                    Description
                                </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="description" id="description"></textarea>
                                </div>
                            </div>

                            <script>
                                CKEDITOR.replace('description', {
                                
                                });
                            </script>

                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-primary" style="color:black;">
                                    Save
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            </div>
        <div>


    </div>
</div>

</x-app-layout>