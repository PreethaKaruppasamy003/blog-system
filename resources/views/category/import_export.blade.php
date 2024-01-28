
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
            


<div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">Category Bulk Upload</h5>
        </div>
        <div class="card-body">
            <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <strong>Step 1:</strong>
                <p>1. Download the skeleton file and fill it with proper data.</p>
                <p>2. You can download the example file to understand how the data must be filled.</p>
                <p>3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.</p>
            </div>
            <br>
            <div class="">
                <a href="{{ asset('download/member_bulk_demo.xlsx') }}" download><button class="btn btn-primary">Download CSV</button></a>
            </div>
            
            <br>
            <div class="">
                <a href="{{ route('pdf.category') }}"><button class="btn btn-primary">Download Category</button></a>
            </div>
            <br>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6"><strong>Import</strong></h5>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('bulk_category_upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="custom-file">
    						<label class="custom-file-label">
    							<input type="file" name="bulk_file" required>
    							
    						</label>
    					</div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" style="color:black;" class="btn btn-primary">Upload CSV</button>
                </div>
            </form>
        </div>
    </div>















    </div>
</div>

</x-app-layout>