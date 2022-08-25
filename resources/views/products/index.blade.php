@extends('layouts.app')
@push('post_styles')
    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend')}}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <div class="card">
        <form action="" method="get" class="card-header">
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" id="title" placeholder="Product Title" class="form-control">
                </div>
{{--                <div class="col-md-2">--}}
{{--                    <select name="variant" id="" class="form-control">--}}

{{--                    </select>--}}
{{--                </div>--}}

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="priceFrom" id="priceFrom" aria-label="First name" placeholder="From" class="form-control">
                        <input type="text" name="priceTo" id="priceTo" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" id="srcDate" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light" data-bs-toggle="modall" data-bs-target=".bs-example-modal-lg" id="srcResult"><i class="fa fa-search"></i></a>
{{--                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>--}}
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-response">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('products.modal_edit')
@push('post_scripts')
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script>

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#select2-example-tags").select2({
                placeholder: "Enter Feature Tag",
                allowClear: true,
                tags: true,
                tokenSeparators: [',']
            });

            $("#select2-example-tags-two").select2({
                placeholder: "Enter Feature Tag",
                allowClear: true,
                tags: true,
                tokenSeparators: [',']
            });
            $("#select2-example-tags-three").select2({
                placeholder: "Enter Feature Tag",
                allowClear: true,
                tags: true,
                tokenSeparators: [',']
            });

            //data show in table
            function load_date(title='',priceFrom='',priceTo='',date=''){
                // let title = $("#title").val();
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{route('product.index')}}",
                        data:{
                            title:title,
                            priceFrom:priceFrom,
                            priceTo:priceTo,
                            date:date
                        }
                    },
                    columns: [
                        {
                            data: 'Title',
                            name: 'Title'
                        },
                        {
                            data: 'Description',
                            name: 'Description'
                        },
                        {
                            data: 'Variant',
                            name: 'Variant'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        }
                    ]
                });
            }
            load_date();
            $('#srcResult').on('click',function () {
                // $('#datatable').DataTable().destroy();
                $('#datatable').DataTable().clear().destroy();
                let title =$("#title").val();
                let priceFrom =$("#priceFrom").val();
                let priceTo =$("#priceTo").val();
                let date =$("#srcDate").val();
                load_date(title,priceFrom,priceTo,date);
            });

            //Edit Category............
            $('body').on('click', '.editBlog', function () {
                $('#ajaxModelProduct').modal('show');
                var id = $(this).data('id');
                var flagsUrl = '{{ asset(product_image()) }}';
                $.ajax({
                    method:"GET",
                    dataType:"json",
                    url:'product/'+id+'/edit',
                    success:function(data){
                        console.log(data);
                        $('#id').val(id);

                        $('#hidden_image_id').val(data.images.thumbnail);
                        $('#ttitle').val(data.title);
                        $('#sku').val(data.sku);
                        $('#description').val(data.description);
                        $('#price').val(data.price);
                        $('#qty').val(data.qty);

                        $('#variant_one option').filter(':selected').text('Color').val(1);
                        $('#variant_two option').filter(':selected').text('Size').val(2);
                        $('#variant_three option').filter(':selected').text('Style').val(2);


                        $('#target1').attr('src', flagsUrl +'/'+ data.images.thumbnail).css({"width" :"120 px" , "height" : "80px"});

                        $('#modelHeading').html("Edit Product");
                        $('#saveBtn').html("Update-Product");
                        $('#ajaxModelProduct').modal('show');
                    },
                    error:function (data){
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                })
            });
            $("#updateBtn").on('click',function (e){
                e.preventDefault();
                var formdata = new FormData(document.getElementById("ProductForm"));
                $.ajax({
                    url: '{{ route('admin.product.update') }}',
                    method: 'post',
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function (data){
                        // console.log(data);
                        if(data.success == true){
                            // toastr["success"]("Product added successfully");
                            $('#ProductForm').trigger("reset");
                            $('#ajaxModelProduct').modal('hide');
                            $('#datatable').DataTable().draw();

                        }else{
                            // toastr["error"]("Product already exits");
                            $('#ProductForm').trigger("reset");
                            $('#ajaxModelProduct').modal('hide');
                            $('#datatable').DataTable().draw();
                        }
                    },
                    error:function(data){
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

        });
    </script>
@endpush
@endsection
