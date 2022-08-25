@extends('layouts.app')
@push('post_styles')

@endpush

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Product</h1>
    </div>
    <div class="modal-body">
        <form action="#" id="ProductForm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="{{$edit->id}}">
                            <input type="hidden" name="hidden_image" id="hidden_image_id">
                            <div>
                                <div class="mb-4">
                                    <input class="form-control" type="text" name="title" id="title" placeholder="Title" value="{{$edit->title}}">
                                </div>
                                <div class="mb-4">
                                    <input class="form-control" type="text"  name="sku" id="sku" placeholder="SKU" value="{{$edit->sku}}">
                                </div>
                                <div class="mb-4">
                                    <textarea style="height: 155px" class="form-control" type="text"  name="description" id="description" placeholder="Description">{{$edit->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Variants</h6>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Option</label>
                                        <select class="form-control" name="variant_one" id="variant_one">
                                            <option selected>Color</option>
                                            @foreach ($variants as $item )
                                                <option  value="{{ $item->id }}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>.</label>
                                        @php
                                         $html = '';
                                        @endphp
                                       @foreach($edit->product_variants as $pv)
                                           @foreach($pv->variant as $item)
                                                $html= $html.$item;
                                            @endforeach
                                        @endforeach
                                        <select name="tag[]" id="select2-example-tags" class="form-control select2-example-tags-two" multiple="multiple" style="width: 100%">{{$html}}</select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Option</label>
                                        <select class="form-control" name="variant_two" id="variant_two">
                                            <option selected>Size</option>
                                            @foreach ($variants as $item )
                                                <option  value="{{ $item->id }}" >{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>.</label>
                                        <select name="tags[]" id="select2-example-tags-two" class="form-control select2-example-tags" multiple="multiple" style="width: 100%"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Option</label>
                                        <select class="form-control" name="variant_three" id="variant_three">
                                            <option selected>Style</option>
                                            @foreach ($variants as $item )
                                                <option  value="{{ $item->id }}" >{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>.</label>
                                        <select name="tagss[]" id="select2-example-tags-three" class="form-control select2-example-tags-two" multiple="multiple" style="width: 100%" value="{{$item->variant}}"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-uppercase">Image</div>
                        <div class="card-body">

                            <div class="row">
                                <div>
                                    <div class="mb-4">
                                        <input class="form-control putImage1" type="file" name="image" id="image" placeholder="image" value="{{$edit->images->thumbnail}}">
                                        <img src="" id="target1"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-uppercase">Preview</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="mb-3">
                                            <input class="form-control" type="number" value="{{$edit->price}}" name="price" id="price" placeholder="Price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input class="form-control" type="number" value="{{$edit->qty}}" name="qty" id="qty" placeholder="Quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button type="button" id="saveBtn" class="btn btn-primary waves-effect waves-light">Save</button>
    </div>


    @push('post_scripts')

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


                $("#saveBtn").on('click',function (e){
                    e.preventDefault();
                    var formdata = new FormData(document.getElementById("ProductForm"));
                    $.ajax({
                        {{--url: '{{ route('product.update') }}',--}}
                        method: 'post',
                        data: formdata,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function (data){
                            if(data.success == true){

                            }else{

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
