
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

        <div style="margin-left: 20px;margin-right: 20px;">
            <div class="aiz-titlebar text-left mt-2 mb-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <h1 class="h3">All Posts</h1>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('blog.create') }}" class="btn btn-circle btn-primary">
                            <span>Add New Post</span>
                        </a>
                    </div>
                </div>
            </div>
            <br>

            <div class="card">
                <form class="" id="sort_blogs" action="" method="GET">
                    <div class="card-header row gutters-5">
                        <div class="col text-center text-md-left">
                            <h5 class="mb-md-0 h6">All blog posts</h5>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control form-control-sm" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type & Enter">
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="card-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th data-breakpoints="lg">Category</th>
                                    <th data-breakpoints="lg">Short Description</th>
                                    <th data-breakpoints="lg">Status</th>
                                    <th class="text-right" width="10%">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $key => $blog)
                                <tr>
                                    <td>
                                        {{ ($key+1) + ($blogs->currentPage() - 1) * $blogs->perPage() }}
                                    </td>
                                    <td>
                                        {{ $blog->title }}
                                    </td>
                                    <td>
                                        @if($blog->category != null)
                                            {{ $blog->category->category_name }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>
                                        {{ $blog->short_description }}
                                    </td>
                                    <td>
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input type="checkbox" onchange="change_status(this)" value="{{ $blog->id }}" <?php if($blog->status == 1) echo "checked";?>>
                                            <span></span>
                                        </label>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{ route('blog.edit',$blog->id)}}" title="Edit">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm blog-confirm-delete" data-id="{{ $blog->id }}" data-href="{{route('blog.destroy', $blog->id)}}" title="Delete">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $blogs->links() }}
                        </div>
                    </div>
            </div>
        <div>


    </div>
</div>



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS (popper.js and bootstrap.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.blog-confirm-delete').on('click', function (e) {
            e.preventDefault();
            var categoryId = $(this).data('id');
            $('#blog-delete-link').attr('href', '/blog/' + categoryId);
            // Show the modal
            $('#blog-delete-modal').modal('show');
        });
    });
</script>

<!-- delete Modal -->
<div id="blog-delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">Delete Confirmation'</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">Are you sure to delete this?</p>
                <button type="button" class="btn btn-light mt-2" data-dismiss="modal">Cancel</button>
                <a id="blog-delete-link" class="btn btn-primary mt-2">Delete</a>
            </div>
        </div>
    </div>
</div><!-- /.modal -->



<script type="text/javascript">
    function change_status(el){
        var status = 0;
        if(el.checked){
            status = 1;
        }
        $.post('{{ route('blog.change-status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                alert('Change blog status successfully');
            }
            else{
                alert('Something went wrong');
            }
        });
    }
</script>

</x-app-layout>