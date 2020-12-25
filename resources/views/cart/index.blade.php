@extends('layouts.livewire')
@section('content')
        <section class="header">
            <div class="container pt-4">
                <div class="row">
                    
                    <div class="col" id="logo">Bless</div>
                    <div class="col text-right" id="secure">SECURE CHECKOUT &nbsp;<i class="fa fa-lock fa-lg" aria-hidden="true"></i></div>
                </div>
            </div>
        </section>
        <section class="title">
          <div class="container pt-3">
              <div class="row">
                  <div class="col text-center">Complete Your Purchase</div>
              </div>
          </div>
        </section>
        <section class="barcode">
          <div class="container pt-5">
              <div class="row">
                  <div class="col">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <div class="tips">
                            <div class="alert alert-primary" role="alert">
                              <i class="fa fa-lightbulb-o" aria-hidden="true"> TIPS !</i>
                              Pastikan kotak input barcode berwarna biru sebelum scan barang.
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="tips">
                            <div class="alert alert-primary" role="alert">
                              <i class="fa fa-lightbulb-o" aria-hidden="true"> TIPS !</i>
                              Periksa barang terlebih dahulu sebelum anda melakukan CHECKOUT.
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="tips">
                            <div class="alert alert-primary" role="alert">
                              <i class="fa fa-lightbulb-o" aria-hidden="true"> TIPS !</i>
                              Pastikan data yang di masukan benar agar memudahkan kami untuk mengirim info selanjutnya.
                            </div>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <div class="tips">
                            <div class="alert alert-primary" role="alert">
                              <i class="fa fa-lightbulb-o" aria-hidden="true"> TIPS !</i>
                              Kerahasiaan data yang di masukan akan kami jamin.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <livewire:cart-create></livewire:cart-create>
                  </div>
              </div>
          </div>
        </section>
        <section class="item">
          <div class="container pt-3">
              <div class="row">
                  <div class="col-8">
                    <livewire:cart-index></livewire:cart-index>
                  </div>
                  <div class="col">
                    <livewire:cart-details></livewire:cart-details>
                  </div>
              </div>
          </div>
        </section>
@endsection