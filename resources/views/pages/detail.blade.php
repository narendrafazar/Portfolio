@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection

@section('content')
<!-- Page Content -->
<div class="page-content page-details">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
      <div class="container">
        <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="/index.html">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Product Details
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </section>

    <section class="store-gallery mb-3" id="gallery">
      <div class="container">
        <div class="row">
          <div class="col-lg-8" data-aos="zoom-in">
            <transition name="slide-fade" mode="out-in">
              <img 
              :src="photos[activePhoto].url" 
              :key="photos[activePhoto].id" 
              class="w-100 main-image"
              alt="">
            </transition>
          </div>
          <div class="col-lg-2">
            <div class="row">
              <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
                <a href="#" @click="changeActive(index)">
                  <img :src="photo.url" class="w-100 thumbnail-image" :class="{active: index == activePhoto}" alt="">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="store-details-container" data-aos="fade-up">
      <section class="store-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h1>{{ $product->name }}</h1>
              <div class="owner">By {{ $product->user->store_name }}</div>
              <div class="price">${{ number_format($product->price) }}</div>
            </div>
            <div class="col-lg-2" data-aos="zoom-in">
              {{-- bikin sebuah kondisional untuk user,
                kalo user dah login maka akan ada tombol checkout, 
                else = kalo user belom login maka hanya ada link saja --}}
              @auth
                <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                    Add to my cart
                  </button>
                </form>
              @else
                <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                  Sign in to Add
                </a>
              @endauth  
            </div>
          </div>
        </div>
      </section>

      <section class="store-description">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8">
                {!! $product->description !!}
            </div>
          </div>
        </div>
      </section>

      <section class="store-review">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mt-3 mb-3">
              <h5>Customer Review (3)</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
                <li class="media">
                  <img src="/images/profile_reviewer_1.png" alt="" class="mr-3 rounded-circle">
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Jane</h5>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed architecto, 
                    provident neque eos repudiandae itaque est consequuntur sunt, doloremque 
                    autem nobis voluptate quia quam quae totam beatae ipsam consequatur cum?
                  </div>
                </li>
                <li class="media">
                  <img src="/images/profile_reviewer_2.png" alt="" class="mr-3 rounded-circle">
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Ahmad Rizky</h5>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed architecto, 
                    provident neque eos repudiandae itaque est consequuntur sunt, doloremque 
                    autem nobis voluptate quia quam quae totam beatae ipsam consequatur cum?
                  </div>
                </li>
                <li class="media">
                  <img src="/images/profile_reviewer_3.png" alt="" class="mr-3 rounded-circle">
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Ara</h5>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed architecto, 
                    provident neque eos repudiandae itaque est consequuntur sunt, doloremque 
                    autem nobis voluptate quia quam quae totam beatae ipsam consequatur cum?
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div> 
@endsection

@push('addon-script')
    <!-- Script memanggil Vue JS -->
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery", 
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach($product->galleries as $gallery)
              {
                id: {{ $gallery->id }},
                url: "{{ Storage::url($gallery->photos) }}"
              },
            @endforeach
          ]
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          }
        }
      });
    </script>
@endpush