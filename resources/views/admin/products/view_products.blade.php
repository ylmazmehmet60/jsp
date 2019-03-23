@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Ana</a> <a href="#">Ürünler</a> <a href="#" class="current">Ürünleri Gör</a> </div>
    <h1>Ürünler</h1>
     @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif   
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif   
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Ürünleri Gör</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Ürün ID</th>
                  <th>Kategori ID</th>
                  <th>Kategori İsim</th>
                  <th>Ürün İsim</th>
                  <th>Ürün Kodu</th>
                  <th>Ürün Rengi</th>
                  <th>Fiyat</th>
                  <th>Resim</th>
                  <th>İşlemler</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
                <tr class="gradeX">
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->category_id }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->price }}</td>
                  <td>
                    @if(!empty($product->image))
                      <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width:60px;">
                    @endif
                  </td>
                  <td class="center">
				  <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">Gör</a> 
				  <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Düzenle</a> 
				  <a href="{{ url('/admin/add-attributes/'.$product->id) }}" class="btn btn-success btn-mini">Özellik Ekle</a>
				  <a href="{{ url('/admin/add-images/'.$product->id) }}" class="btn btn-info btn-mini">Ek Resim Ekle</a>
				  <a id="delProduct" rel="{{ $product->id }}" rel1="delete-product" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Sil</a>
				  </td>
                </tr>
				
                    <div id="myModal{{ $product->id }}" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>{{ $product->product_name }} Tam Detaylar</h3>
                      </div>
                      <div class="modal-body">
                        <p>Ürün ID: {{ $product->id }}</p>
                        <p>Kategori ID: {{ $product->category_id }}</p>
                        <p>Ürün Kodu: {{ $product->product_code }}</p>
                        <p>Ürün Rengi: {{ $product->product_color }}</p>
                        <p>Fiyat: {{ $product->price }}</p>
                        <p>Kumaşı: </p>
                        <p>Materyali: </p>
                        <p>Açıklama: {{ $product->description }}</p>
                      </div>
                    </div>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection