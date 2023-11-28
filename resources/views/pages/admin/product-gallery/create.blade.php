@extends('layouts.admin')

@section('title')
    Product Gallery
@endsection

@section('content')
<!-- Section Content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Product Gallery</h2>
        <p class="dashboard-subtitle">
          Create New Product Gallery
        </p>
      </div>
      <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <div class="card">
                <div class="card-body">
                    <form action="{{ route('product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product</label>
                                    <select name="products_id" class="form-control">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Foto Product</label>
                                    <input type="file" name="photos" class="form-control" required>
                                </div>
                            </div>
                            
                        </div>
                        
                        {{-- Tombol Save --}}
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success px-5">
                                    Save Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
    {{-- Script CKEditor 4 --}}
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    {{-- Script CKEditor 5
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script> --}}

    <script>
        // CKEditor 4
        CKEDITOR.replace( 'editor' );

        // // CKEditor 5
        // ClassicEditor
        //         .create( document.querySelector( '#editor' ) )
        //         .then( editor => {
        //                 console.log( editor );
        //         } )
        //         .catch( error => {
        //                 console.error( error );
        //         } );
    </script>
@endpush