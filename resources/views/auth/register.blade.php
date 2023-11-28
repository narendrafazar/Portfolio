@extends('layouts.auth')

@section('content')
<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-6">
            <h2>
              Ayo jadi bagian dari kami, <br />now or never.
            </h2>

            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <label for="">Full Name</label>
                <input id="name" v-model="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="">Email Address</label>
                {{-- :class = kelas dari Vue js --}}
                <input id="email" v-model="email" @change="checkForEmailAvailability()"  type="email" class="form-control @error('email') is-invalid @enderror" :class="{ 'is-invalid' : this.email_unavailable }"  name="email" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                {{-- password_confirmation adalah bawaan dari laravel yang match up sama confirmed di registercontroller --}}
                  @error('password_confirmation') 
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              <div class="form-group">
                <label for="">Store</label>
                <p class="text-muted">Mau membuat toko sendiri?</p>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" name="is_store_open" id="openStoreTrue" class="custom-control-input" v-model="is_store_open" :value="true" />
                  <label for="openStoreTrue" class="custom-control-label"> Ya </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" name="is_store_open" id="openStoreFalse" class="custom-control-input" v-model="is_store_open" :value="false" />
                  <label for="openStoreFalse" class="custom-control-label"> Tidak </label>
                </div>
              </div>

              <div class="form-group" v-if="is_store_open">
                <label for="">Nama Toko</label>
                <input type="text" v-model="store_name" id="store_name" class="form-control @error('password_confirm') is-invalid @enderror" name="store_name" required autocomplete="" autofocus>
                  @error('store_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
              </div>

              <div class="form-group" v-if="is_store_open">
                <label for="">Kategori</label>
                <select name="categories_id" id="" class="form-control">
                  <option value="" disabled>Select Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>            
                  @endforeach
                </select>
              </div>

              {{-- :disabled = akan mendisable atau melarang sebuah tindakan yang akan datang, seperti email yang sudah terdaftar akan dilarang untuk terdaftar lagi, karena bakalan jadi ada 2 emailnya --}}
              <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable" > Sign Up Now </button>
              <button href="{{ route('login') }}" class="btn btn-signup btn-block mt-2"> Sign In </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- <div class="container hide"> ini berarti div nya div hide--}}

{{-- <div class="container" style="display: none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('addon-script')
     <!-- Script memanggil Vue JS -->
     <script src="/vendor/vue/vue.js"></script>
     <!-- Script memanggil Vue Toasted -->
     <script src="https://unpkg.com/vue-toasted"></script>
     <!-- Script memanggil Vue axios buat cek register terdaftar -->
     <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
     <script>
       Vue.use(Toasted);
 
       var register = new Vue({
          el: "#register",
          mounted() {
            AOS.init();
            
          },

          methods: {
            checkForEmailAvailability: function() {
              // memindahkan this kedalam variable self agar bisa dipake didalam axiosnya
              var self = this;
              // Make a request for a user with a given ID
              axios.get('{{ route('api-register-check') }}', {
                params: {
                  email: this.email
                }
              })
                .then(function (response) {

                  if(response.data == 'Available'){
                    self.$toasted.show("Great! Email anda tersedia. Please, go to the next step!", {
                      position: "top-center",
                      className: "rounded",
                      // duration ini dalam milisecond, berarti 1000 = 1second, 1500 = 1.5second
                      duration: 1000,
                    });
                    self.email_unavailable = false;
                  } 
                  else {
                    self.$toasted.error("Maaf, email sudah terdaftar pada sistem kami.", {
                      position: "top-center",
                      className: "rounded",
                      // duration ini dalam milisecond, berarti 1000 = 1second, 1500 = 1.5second
                      duration: 1000,
                    });
                    self.email_unavailable = true;
                  }

                  // handle success
                  console.log(response);
                });
                
            }
          },

          data() {
            return {
              name: "Narendra Fazar",
              email: "narendra.fazar@gmail.com",
              is_store_open: true,
              store_name: "",
              email_unavailable: false
            }
          } ,

       });
     </script>
@endpush