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


<section class="py-4">
    <div class="container">
        <div class="row gutters-16 justify-content-center">

            <!-- Blog Details -->
            <div class="col-xxl-7 col-lg-8">
                <div class="mb-4">
                    <!-- Title -->
                    <h2 class="fs-20 fs-md-24 fw-700 mb-3">
                        <a class="text-reset hov-text-primary" title="{{ $blog->title }}">
                            {{ $blog->title }}
                        </a>
                    </h2>
                    <div class="row">
                        <div class="col-4">
                            <!-- Date -->
                            <div>
                                <small class="fs-12 fw-400 opacity-60">{{ date('M d, Y',strtotime($blog->created_at)) }}</small>
                            </div>
                            <!-- Caregory -->
                            @if($blog->category != null)
                                <div>
                                    <small class="fs-12 fw-400 text-blue">{{ $blog->category->category_name }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Image -->
                    <img src="{{ asset($blog->banner) }}"
                        data-src="{{ asset($blog->banner) }}"
                        alt="{{ $blog->title }}"
                        class="img-fluid lazyload w-100 mt-3 mb-4">
                    <!-- Description -->
                    <div class="mb-4 overflow-hidden">
                        {!! $blog->description !!}
                    </div> </br></br></br>



                    
                    @if (session('success') || session('error'))
                        <div class="alert alert-{{ session('error') ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
                            {{ session('success') ?: session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <span>Comments</span>
                    <hr>
                    @auth
                    <form id="commentForm" action="{{ route('comment.store') }}" method="POST">
                        @csrf
                    <div class="mb-4">
                        <input type="hidden" value="{{ $blog->id }}" name="blog_id">
                        <div class="form-group row">
                                <div class="col-md-9">
                                    <textarea class="form-control" name="comment" id="comment" placeholder="Enter your comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-primary">Submit Comment</button>
                            </div>
                        </div>
                    </div>
                    </form>
                    @else
                    <div class="mb-4">
                        <div class="form-group row">
                                <div class="col-md-9">
                                    <textarea class="form-control" name="comment" id="comment" placeholder="Enter your comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-9">
                        <a href="{{ route('login') }}"><button type="button" class="btn btn-primary">Login</button></a>
                        </div>
                        <span style="color:red;">*Login and Submit your Comment<span>
                    </div>
                    </div>
                    @endauth

                    @php $comments = \App\Models\Comment::where('blog_id', $blog->id)
                                    ->join('users', 'comments.user_id', '=', 'users.id')
                                    ->get(['comments.*', 'users.*']);
                    @endphp
                    @foreach($comments as $comment)
                        <div class="cmd">
                            <label style="font-weight: 900;">{{ $comment->name }}</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;<small class="fs-12 fw-400 opacity-60">{{ date('M d, Y', strtotime($comment->created_at)) }}</small></br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #06c4be;">{{ $comment->comment }}</span>

                            @auth
                                @if($comment->user_id == auth()->user()->id)
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm comment-confirm-edit"
                                        data-id="{{ $comment->comment_id }}"
                                        data-comment-value="{{ $comment->comment }}"
                                        data-href="{{ route('comment.edit', ['id' => $comment->comment_id, 'comment' => $comment->comment]) }}"
                                        title="Edit">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>



                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm comment-confirm-delete" data-id="{{ $comment->comment_id }}" data-href="{{route('comment.destroy', $comment->comment_id)}}" title="Delete">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                @endif
                            @endauth
                        </div>
                    @endforeach

            </div>

            <div>

                 <!-- jQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <!-- Bootstrap JS (popper.js and bootstrap.js) -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('.comment-confirm-delete').on('click', function (e) {
                            e.preventDefault();
                            var categoryId = $(this).data('id');
                            $('#comment-delete-link').attr('href', '/comment/' + categoryId);
                            // Show the modal
                            $('#comment-delete-modal').modal('show');
                        });
                    });

                    $(document).ready(function () {
                        $('.comment-confirm-edit').on('click', function (e) {
                        e.preventDefault();
                        var commentId = $(this).data('id');
                        var commentValue = $(this).data('comment-value');

                        // Set the initial value of the textarea
                        $('#comment-edit-textarea').val(commentValue);

                        // Update the data-id attribute and show the modal
                        $('#comment-edit-link').attr('data-id', commentId);
                        $('#comment-edit-modal').modal('show');
                    });

                    $('#comment-edit-link').on('click', function (e) {
                        e.preventDefault();

                        // Assuming you want to get the updated comment value from the textarea
                        var updatedCommentValue = $('#comment-edit-textarea').val();
                        var commentId = $(this).data('id');

                        // Construct the URL with both parameters (id and comment)
                        var editRoute = '/comment/edit/' + commentId + '/' + encodeURIComponent(updatedCommentValue);

                        // Perform any necessary logic here, like updating the comment on the server
                        window.location.href = editRoute;
                    });
                    });


                </script>

                <!-- delete Modal -->
                <div id="comment-delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title h6">Delete Confirmation</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p class="mt-1">Are you sure to delete this?</p>
                                <button type="button" class="btn btn-light mt-2" data-dismiss="modal">Cancel</button>
                                <a id="comment-delete-link" class="btn btn-primary mt-2">Delete</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->

                <!-- edit Modal -->
                <div id="comment-edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title h6">Edit Comment</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-comment-form">
                                    <div class="form-group">
                                        <label for="comment-edit-textarea">Edit your comment:</label>
                                        <textarea class="form-control" id="comment-edit-textarea" rows="3"></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-light mt-2" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="comment-edit-link" class="btn btn-primary mt-2">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->




            <div>

           

        </div>
    </div>
</section>


@include('inc/footer')