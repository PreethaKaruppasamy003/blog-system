
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
@if (session('success') || session('error'))
    <div class="alert alert-{{ session('error') ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
        {{ session('success') ?: session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <div class="aiz-titlebar text-left mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6" style="margin-left: 25px;">
                        <h1 class="h3">All Blog Categories</h1>
                    </div>
                    
                    <div class="col text-right">
                        <a href="{{ route('category.import_export') }}" class="btn btn-circle btn-primary">
                            <span>Category bulk import/Export</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="card" style="margin-left: 20px;">
                        <div class="card-header row gutters-5">
                            <div class="col text-center text-md-left">
                                <h5 class="mb-md-0 h6">All Categories</h5>
                            </div>
                            <div class="col-md-4">
                                <form class="" id="sort_on_behalves" action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name & Enter">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th class="text-right">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ ($key+1) + ($categories->currentPage() - 1)*$categories->perPage() }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td class="text-right">
                                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{url('blog-category/'.$category->id.'/edit')}}" title="Edit">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-id="{{ $category->id }}" data-href="{{route('blog-category.destroy', $category->id)}}" title="Delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0 h6">Add New Blog Category</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('blog-category.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" id="category_name" name="category_name" placeholder="Name" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3 text-right">
                                        <button type="submit" style="color: black;" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @section('modal')
                        @include('modals.delete_modal')
                    @endsection


                    <script>
                        $(document).ready(function () {
                            $('.confirm-delete').on('click', function (e) {
                                e.preventDefault();
                                var categoryId = $(this).data('id');
                                $('#delete-link').attr('href', '/blog-category/' + categoryId);
                                // Show the modal
                                $('#delete-modal').modal('show');
                            });
                        });
                    </script>


                        @include('modals.delete_modal')
                   
            
            </div>

    </div>
</div>

</x-app-layout>