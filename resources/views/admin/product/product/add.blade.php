@extends('layouts.app')

@section('pageTitle')

<div class="float-right">

    <input type="hidden" value="1" id="position">
    <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
    <a href="{{route('product.index')}}" class="btn btn-outline-light">
        Back
    </a>
</div>
<h4 class="page-title"> <i class="dripicons-toggles"></i> Add product</h4>

@endsection

@section('contentData')

<div class="row">

    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if($errors->any())
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            {{$errors->first()}}
                        </div>
                        @endif
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">About Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Attributes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">Inventory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab5" role="tab">Advance</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab6" role="tab">Related Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab7" role="tab">Offers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab8" role="tab">Prices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab9" role="tab">QC</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            {{-- Product Add --}}
                            <div class="tab-pane active mt-3" id="tab1" role="tabpanel">

                                @if(isset($productData))

                                {{ Form::model($productData, array('route' => array('product.update', $productData->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
                                <input type="hidden" name="product_id" class="form-control" value="{{$productData->id ?? ''}}" />

                                @else

                                {!! Form::open(['route' => 'product.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}

                                @endif
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Select Category</label>

                                            <select class="select2 form-control" name="category_id" required>
                                                <option value="">Select Category</option>

                                                @foreach ($categoryList as $key=>$category)
                                                    @if($category->parentCategory && $category->parentCategory->parentCategory)

                                                    <option value="{{ $category->parentCategory->parentCategory->id }},{{ $category->parentCategory->id}},{{ $category->id}}" {{($category->id ?? 0) == ($productData->category_id3 ?? 0) ? 'selected' : ''}}>
                                                        {{ $category->parentCategory->parentCategory->name }} -> {{ $category->parentCategory->name }} -> {{ $category->name }}

                                                    </option>

                                                    @elseif($category->parentCategory)

                                                    <option value="{{ $category->parentCategory->id}},{{$category->id}}" {{ (($category->id ?? 0) == ($productData->category_id2 ?? 0) && $productData->category_id3 == null) ? 'selected' : ''}}>
                                                        {{ $category->parentCategory->name }} -> {{ $category->name }}

                                                    </option>

                                                    @else

                                                    <option value="{{$category->id}}" {{ (($category->id ?? 0) == ($productData->category_id1 ?? 0) && $productData->category_id2 == null  && $productData->category_id3 == null) ? 'selected' : ''}}>
                                                        {{ $category->name }}

                                                    </option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $productData->name ?? ''}}" required />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-9 col-lg-9">
                                        <div class="form-group">
                                            <label>Short Description</label>
                                            <input type="text" name="description" class="form-control" value="{{ $productData->description ?? ''}}" required />
                                            <!-- <textarea name="description" class="summernote" required>
                                            {{$productData->description ?? ''}}
                                            </textarea> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Select Status</label>
                                            <select name="status" class="form-control select2" value="{{$productData->status ?? ''}}" required>
                                                <option value="1" {{ ($productData->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ ($productData->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    @if(Session::get('user')->id != 1)
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <button type="submit" class="btn btn-outline-primary">
                                                Save to draft
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                {!! Form::close() !!}
                            </div>

                            {{-- Attributes --}}
                            <div class="tab-pane mt-3" id="tab2" role="tabpanel">

                                @if(!isset($productData))
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add About Product Details</h4>
                                    </div>
                                @else

                                    @if( (count($productData->attributesFilter) > 0) || (count($productData->attributesOption) > 0) || (count($productData->attributesHighlight) > 0) )
                                        {!! Form::open(['route' => 'productAttributeUpdate','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                    @else
                                        {!! Form::open(['route' => 'productAttribute','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                    @endif
                                    {{ csrf_field() }}

                                    <input type="hidden" name="product_id" class="form-control" value="{{$productData->id ?? ''}}" />

                                    {{-- Filter --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Filter</span>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row" style="height:250px;overflow-y: scroll">

                                        @foreach ($filterList as $key=>$filterTags)

                                            @if(count($filterTags->filterLabels))

                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <h4 class="text-muted font-14">{{$filterTags->tag}}</h4>
                                                </div>

                                                @foreach ($filterTags->filterLabels as $key=>$label)
                                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="filter[]" value="{{$label->id}}" id="filter{{$label->id}}" {{ in_array($label->id, ($productData->filterIds ?? [])) ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="filter{{$label->id}}">{{$label->label}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @endif

                                        @endforeach
                                    </div>

                                    {{-- Options --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Option (Select maximum 5) </span>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row" style="height:250px;overflow-y: scroll">
                                        @foreach ($optionList as $key=>$optionTags)

                                            @if(count($optionTags->optionLabels))

                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <h4 class="text-muted font-14">{{$optionTags->tag}}</h4>
                                                </div>

                                                @foreach ($optionTags->optionLabels as $key=>$label)
                                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="option[]" value="{{$label->id}}" id="option{{$label->id}}" {{ in_array($label->id, $productData->optionsIds) ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="option{{$label->id}}">{{$label->label}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- HighLight --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Highlight</span>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="row" style="height:250px;overflow-y: scroll">
                                        @foreach ($highlightList as $key=>$highlightTags)

                                            @if(count($highlightTags->highlightLabels))

                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <h4 class="text-muted font-14">{{$highlightTags->tag}}</h4>
                                                </div>

                                                @foreach ($highlightTags->highlightLabels as $key=>$label)
                                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="highlight[]" value="{{$label->id}}" id="highlight{{$label->id}}" {{ in_array($label->id, $productData->highlightIds) ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="highlight{{$label->id}}">{{$label->label}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @endif

                                        @endforeach
                                    </div>

                                    @if(Session::get('user')->id != 1)
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Save to draft
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    {!! Form::close() !!}

                                @endif

                            </div>

                            {{-- Variations --}}
                            <div class="tab-pane mt-3" id="tab3" role="tabpanel">

                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add Attribute Options</h4>
                                    </div>

                                @else

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Variation</span>
                                            </h4>
                                        </div>
                                    </div>

                                    {!! Form::open(['route' => 'productInventoryUpdate','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                    <input type="hidden" name="product_id" class="form-control" value="{{$productData->id ?? ''}}" />

                                    @foreach ($productData->productVariations as $keyMain=>$productVariation)
@php
                                            $colorTagFound=false;
                                            @endphp
                                        <input type="hidden" class="form-control" value="{{$productVariation->id}}" />

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <!-- <input type="hidden" name="inventory[{{ $productVariation->id }}][isIdle]" value="{{ $productVariation->isIdle }}"> -->
                                                        <input type="checkbox" class="custom-control-input" name="inventory[{{ $productVariation->id }}][isIdle]" id="availableInventory{{$keyMain}}" onclick="addRemoveDiv({{$keyMain}});" value="{{ $productVariation->isIdle == 1 ? 1 : 0 }}" {{ $productVariation->isIdle == 1 ? 'checked' : '' }} >
                                                        <label class="custom-control-label" for="availableInventory{{$keyMain}}">Inventory Available</label>
                                                        
                                                    </div>
                                                    <div class="custom-control">
                                                        <a href="#collapseOne{{$keyMain}}" class="badge badge-dark collapsed pull-right" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne{{$keyMain}}">
                                                            + View More 
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <input type="text" name="inventory[{{ $productVariation->id }}][sku]" id="sku{{$keyMain}}" class="form-control" value="{{$productVariation->sku}}" {{ $productVariation->isIdle == 1 ? 'required' : 'readonly' }} />
                                                </div>
                                            </div>

                                            @if($productVariation->variation0)
                                                <div class="col-sm-3 col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="{{$productVariation->variant0->label}}" readonly />
                                                    </div>
                                                </div>
                                            @endif

                                            @if($productVariation->variation1)
                                                <div class="col-sm-3 col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="{{$productVariation->variant1->label}}" readonly />
                                                    </div>
                                                </div>
                                            @endif

                                            @if($productVariation->variation2)
                                                <div class="col-sm-3 col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="{{$productVariation->variant2->label}}" readonly />
                                                    </div>
                                                </div>
                                            @endif

                                            @if($productVariation->variation3)
                                                <div class="col-sm-3 col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="{{$productVariation->variant3->label}}" readonly />
                                                    </div>
                                                </div>
                                            @endif

                                            @if($productVariation->variation4)
                                                <div class="col-sm-3 col-md-2 col-lg-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="{{$productVariation->variant4->label}}" readonly />
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($productVariation->variant1 && $productVariation->variant1->tag->tag=='Color')
                                            @php 
                                            $colorTagFound=true;
                                            @endphp
                                            @endif
                                            @if($productVariation->variant2 && $productVariation->variant2->tag->tag=='Color')
                                            
                                            @php
                                            $colorTagFound=true;
                                            @endphp
                                            @endif
                                            @if($productVariation->variant3 && $productVariation->variant3->tag->tag=='Color')
                                            @php
                                            $colorTagFound=true;
                                            @endphp
                                            @endif
                                            @if($productVariation->variant4 && $productVariation->variant4->tag->tag=='Color')
                                            @php
                                            $colorTagFound=true;
                                            @endphp
                                            @endif
                                        </div>
                                        
                                        <div class="row collapse" id="collapseOne{{$keyMain}}" data-parent="#accordion">

                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input type="text" name="inventory[{{ $productVariation->id }}][productName]" class="form-control" value="{{$productVariation->productName}}" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>Payment Options</label>
                                                    <select name="inventory[{{ $productVariation->id }}][payementOption]" class="form-control select2">
                                                        <option value="1" {{($productVariation->payementOption ?? 0) == 1 ? 'selected' : ''}}>Both</option>
                                                        <option value="2" {{($productVariation->payementOption ?? 0) == 2 ? 'selected' : ''}}>COD</option>
                                                        <option value="3" {{($productVariation->payementOption ?? 0) == 3 ? 'selected' : ''}}>Online</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label>Product Description</label>
                                                    <textarea name="inventory[{{ $productVariation->id }}][productDescription]" class="summernote" required>{{$productVariation->productDescription}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup({{ $productVariation->id }}0)">Front View <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" onchange="validateImageUrl({{ $productVariation->id }}0)" id="image{{ $productVariation->id }}0" name="inventory[{{ $productVariation->id }}][imageURL0]" class="form-control" placeholder="Front View" value="{{$productVariation->imageURL0}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup({{ $productVariation->id }}1)">Back View <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" onchange="validateImageUrl({{ $productVariation->id }}1)" id="image{{ $productVariation->id }}1" name="inventory[{{ $productVariation->id }}][imageURL1]" class="form-control" placeholder="Back View" value="{{$productVariation->imageURL1}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup({{ $productVariation->id }}2)">Side View <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" onchange="validateImageUrl({{ $productVariation->id }}2)" id="image{{ $productVariation->id }}2" name="inventory[{{ $productVariation->id }}][imageURL2]" class="form-control" placeholder="Side View" value="{{$productVariation->imageURL2}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup({{ $productVariation->id }}3)">Side View <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" onchange="validateImageUrl({{ $productVariation->id }}3)" id="image{{ $productVariation->id }}3" name="inventory[{{ $productVariation->id }}][imageURL3]" class="form-control" placeholder="Side View" value="{{$productVariation->imageURL3}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup({{ $productVariation->id }}4)">Extra Image 1 <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" onchange="validateImageUrl({{ $productVariation->id }}4)" id="image{{ $productVariation->id }}4" name="inventory[{{ $productVariation->id }}][imageURL4]" class="form-control" placeholder="Extra Image" value="{{$productVariation->imageURL4}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup({{ $productVariation->id }}5)">Extra Image 2 <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" onchange="validateImageUrl({{ $productVariation->id }}5)" id="image{{ $productVariation->id }}5" name="inventory[{{ $productVariation->id }}][imageURL5]" class="form-control" placeholder="Extra Image" value="{{$productVariation->imageURL5}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="inventory[{{ $productVariation->id }}][videoURL]" class="form-control" placeholder="Youtube video url" value="{{$productVariation->videoURL}}" />
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="inventory[{{ $productVariation->id }}][pdfURL]" class="form-control" placeholder="PDF url" value="{{$productVariation->pdfURL}}" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    
                                                </div>
                                            </div>
                                            @if(isset($colorTagFound) && $colorTagFound)
                                            <!--div class="col-sm-6 col-md-3 col-lg-4">
                                                <div class="form-group">
                                                    <label onclick="openImagePopup()">Color Thumbnail <i class="mdi mdi-file-image"></i></label>
                                                    <input type="text" name="" class="form-control" placeholder="Color Thumbnail Url" value="" />
                                                </div>
                                            </div-->
                                            @endif
                                        </div>
                                    @endforeach

                                    @if(Session::get('user')->id != 1)
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Save to draft
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::close() !!}
                                @endif
                            </div>

                            {{-- Shipping --}}
                            <div class="tab-pane mt-3" id="tab4" role="tabpanel">

                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add SKU</h4>
                                    </div>
                                    
                                @else
                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Packaging details</span>
                                            </h4>
                                        </div>
                                        
                                    </div>

                                    {!! Form::open(['route' => 'productShippingUpdate','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                    {{ csrf_field() }}
                                    
                                    @foreach ($productData->productVariations as $keyMain=>$productVariation)
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label>SKQ</label>
                                                    <input type="text" class="form-control" value="{{$productVariation->sku}}" readonly />
                                                    <input type="hidden" name="packaging[{{ $productVariation->id }}][inventoryId]" class="form-control" value="{{$productVariation->id}}" readonly />
                                                    <input type="hidden" name="packaging[{{ $productVariation->id }}][shippingId]" class="form-control" value="{{ $productVariation->inventory_shipping->id ?? ''}}" readonly />
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Weight (kg)</label>
                                                    <input type="text" name="packaging[{{ $productVariation->id }}][weight]" value="{{$productVariation->inventory_shipping->weight ?? ''}}" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Length (cm)</label>
                                                    <input type="text" name="packaging[{{ $productVariation->id }}][length]" value="{{$productVariation->inventory_shipping->length ?? ''}}" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Width (cm)</label>
                                                    <input type="text" name="packaging[{{ $productVariation->id }}][width]" value="{{$productVariation->inventory_shipping->width ?? ''}}" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Height (cm)</label>
                                                    <input type="text" name="packaging[{{ $productVariation->id }}][height]" value="{{$productVariation->inventory_shipping->height ?? ''}}" class="form-control" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-sm-2 col-md-4 col-lg-2">
                                                <div class="form-group">
                                                    <label>Shipping Include</label>
                                                    <select name="packaging[{{ $productVariation->id }}][includeShipping]" class="form-control select2">
                                                        <option value="0" {{($productVariation->inventory_shipping->includeShipping ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                        <option value="1" {{($productVariation->inventory_shipping->includeShipping ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-4 col-lg-2">
                                                <div class="form-group">
                                                    <label>Cancel Order</label>
                                                    <select name="packaging[{{ $productVariation->id }}][cancelOrder]" class="form-control select2">
                                                        <option value="0" {{($productVariation->inventory_shipping->cancelOrder ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                        <option value="1" {{($productVariation->inventory_shipping->cancelOrder ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Return Order</label>
                                                    <select onchange="returnValidate({{$productVariation->id}})" id="return{{ $productVariation->id }}" name="packaging[{{ $productVariation->id }}][returnOrder]" class="form-control select2">
                                                        <option value="0" {{($productVariation->inventory_shipping->returnOrder ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                        <option value="1" {{($productVariation->inventory_shipping->returnOrder ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Return Order In Days</label>
                                                    <input type="text" id="returnDays{{ $productVariation->id }}" {{($productVariation->inventory_shipping->returnOrder ?? 0) == 1 ? 'required' : 'readonly'}} name="packaging[{{ $productVariation->id }}][returnOrderDays]" value="{{$productVariation->inventory_shipping->returnOrderDays ?? ''}}" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Replacement Order</label>
                                                    <select onchange="replacementValidate({{$productVariation->id}})" id="replacement{{ $productVariation->id }}" name="packaging[{{ $productVariation->id }}][replacementOrder]" class="form-control select2">
                                                        <option value="0" {{($productVariation->inventory_shipping->replacementOrder ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                        <option value="1" {{($productVariation->inventory_shipping->replacementOrder ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="form-group">
                                                    <label>Replacement Order In Days</label>
                                                    <input type="text" id="replacementDays{{ $productVariation->id }}" {{($productVariation->inventory_shipping->replacementOrder ?? 0) == 1 ? 'required' : 'readonly'}} name="packaging[{{ $productVariation->id }}][replacementOrderDays]" value="{{$productVariation->inventory_shipping->replacementOrderDays ?? ''}}" class="form-control" />
                                                </div>
                                            </div>
                                            
                                        </div>
                                    @endforeach
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Tax Details</span>
                                            </h4>
                                        </div>

                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>HSN Code</label>
                                                <input type="text" name="tax[hsn]" value="{{ $productData->tax_detail->hsn ?? ''}}" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-md-4 col-lg-2">
                                            <div class="form-group">
                                                <label>Tax Include</label>
                                                <select name="tax[includeTax]" class="form-control select2">
                                                    <option value="0" {{($productData->tax_detail->includeTax ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                    <option value="1" {{($productData->tax_detail->includeTax ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label>Tax %</label>
                                                <input type="number" name="tax[tax]" class="form-control" value="{{ $productData->tax_detail->tax ?? ''}}" min="2" required />
                                                <input type="hidden" name="tax[product_id]" class="form-control" value="{{$productData->id ?? ''}}" min="2" required />
                                            </div>
                                        </div>
                                    </div>

                                    @if(Session::get('user')->id != 1)
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Save to draft
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::close() !!}
                                @endif

                            </div>

                            {{-- Advance --}}
                            <div class="tab-pane mt-3" id="tab5" role="tabpanel">

                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add SKU</h4>
                                    </div>
                                    
                                @else                                    

                                {!! Form::open(['route' => 'productAdvanced','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                {{ csrf_field() }}

                                <input type="hidden" name="product_id" class="form-control" value="{{$productData->id}}" />

                                {{-- Search Keyword --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <h4 style="border-bottom: 1px solid #67479e;">
                                            <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Search Keyword</span>
                                        </h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>
                                                Search Keyword
                                                <button type="button" class="btn btn-link" role="button" data-toggle="popover" data-trigger="focus" title="Hint for search keyword " data-content="Product Name, SKU, Other Text , separating values."><i class="mdi mdi-help-circle"></i></button>
                                            </label>
                                            <input type="text" name="keyword" class="form-control" value="{{$productData->searchKeywords->keyword ?? ''}}" required />
                                        </div>
                                    </div>
                                </div>
                                {{-- Search Keyword --}}

                                {{-- Warranty Start --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <h4 style="border-bottom: 1px solid #67479e;">
                                            <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Warranty</span>
                                        </h4>
                                    </div>
                                </div>
                                
                                @foreach ($productData->productVariations as $keyMain=>$productVariation)
                                <div class="row">
                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label>SKU</label>
                                            <input type="text" class="form-control" value="{{$productVariation->sku}}" readonly />
                                            <input type="hidden" name="warranty[{{ $productVariation->id }}][inventoryId]" class="form-control" value="{{$productVariation->id}}" readonly />
                                            <input type="hidden" name="warranty[{{ $productVariation->id }}][warrantyId]" class="form-control" value="{{$productVariation->inventory_warranty->id ?? ''}}" readonly />
                                        </div>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label>Domestic Warranty</label>
                                            <select name="warranty[{{ $productVariation->id }}][domestic]" class="form-control select2">
                                                <option value="">Select Warranty</option>
                                                <option value="0" {{($productVariation->inventory_warranty->domestic ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                <option value="1" {{($productVariation->inventory_warranty->domestic ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label>International Warranty</label>
                                            <select name="warranty[{{ $productVariation->id }}][international]" class="form-control select2">
                                                <option value="">Select Warranty</option>
                                                <option value="0" {{($productVariation->inventory_warranty->international ?? 0) == 0 ? 'selected' : ''}}>No</option>
                                                <option value="1" {{($productVariation->inventory_warranty->international ?? 0) == 1 ? 'selected' : ''}}>Yes</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Warranty Summary</label>
                                            <input type="text" name="warranty[{{ $productVariation->id }}][summary]" class="form-control" value="{{$productVariation->inventory_warranty->summary ?? ''}}" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Covered in warranty</label>
                                            <input type="text" name="warranty[{{ $productVariation->id }}][coveredIn]" class="form-control" value="{{$productVariation->inventory_warranty->coveredIn ?? ''}}" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Not covered warranty</label>
                                            <input type="text" name="warranty[{{ $productVariation->id }}][notCovered]" class="form-control" value="{{$productVariation->inventory_warranty->notCovered ?? ''}}" />
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{-- Warranty End --}}

                                
                                {{-- Affiliation Start --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <h4 style="border-bottom: 1px solid #67479e;">
                                            <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Affiliation</span>
                                        </h4>
                                    </div>
                                </div>

                                @foreach ($productData->productVariations as $keyMain=>$productVariation)
                                
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label>SKU</label>
                                                <input type="text" class="form-control" value="{{$productVariation->sku}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @foreach ($affiliateKeywordList as $key=>$affiliateKeyword)
                                            <div class="col-sm-4 col-md-3 col-lg-2">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">

                                                        <input type="hidden" name="affiliation[{{ $productVariation->id }}][{{ $affiliateKeyword->keyword_id }}][inventoryId]" class="form-control" value="{{$productVariation->id}}" readonly />
                                                        @if(isset($productData))
                                                            <input type="hidden" name="affiliation[{{ $productVariation->id }}][{{ $affiliateKeyword->keyword_id }}][affiliationId]" class="form-control" value="{{$productVariation->inventory_affiliation->where('keyword_id' , $affiliateKeyword->keyword_id)->first()->keyword_id  ?? ''  }}" readonly />
                                                            <input type="checkbox" class="custom-control-input" name="affiliation[{{ $productVariation->id }}][{{ $affiliateKeyword->keyword_id }}][keyword_id]" value="{{$affiliateKeyword->keyword_id}}" id="affiliation{{ $productVariation->id }}{{$affiliateKeyword->keyword_id}}" {{ ($productVariation->inventory_affiliation->where('keyword_id' , $affiliateKeyword->keyword_id)->first()->keyword_id ?? null) ? 'checked' : ''  }}>
                                                        @else
                                                            <input type="hidden" name="affiliation[{{ $productVariation->id }}][{{ $affiliateKeyword->keyword_id }}][affiliationId]" class="form-control" value="" readonly />
                                                            <input type="checkbox" class="custom-control-input" name="affiliation[{{ $productVariation->id }}][{{ $affiliateKeyword->keyword_id }}][keyword_id]" value="{{$affiliateKeyword->keyword_id}}" id="affiliation{{ $productVariation->id }}{{$affiliateKeyword->keyword_id}}">
                                                        @endif
                                                        <label class="custom-control-label" for="affiliation{{ $productVariation->id }}{{$affiliateKeyword->keyword_id}}">{{ ( isset($affiliateKeyword->keyword->keyword) ? $affiliateKeyword->keyword->keyword : '' ) }}</label>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                                @if(Session::get('user')->id != 1)
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <button type="submit" class="btn btn-outline-primary">
                                                Save to draft
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                {!! Form::close() !!}

                                @endif

                            </div>

                            {{-- Related Products --}}
                            <div class="tab-pane mt-3" id="tab6" role="tabpanel">
                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add SKU</h4>
                                    </div>
                                    
                                @else
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Manage Related Products</span>
                                            </h4>
                                        </div>
                                    </div>

                                    {!! Form::open(['route' => 'productRelated','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" class="form-control" value="{{$productData->id ?? ''}}" />
                                    <div class="row">

                                        @foreach ($productList as $key=>$product)
                                            <div class="col-sm-4 col-md-3 col-lg-2">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">

                                                        @if(isset($productData))
                                                        <input type="checkbox" class="custom-control-input" name="relatedProduct[]" value="{{$product->id}}" id="relatedProduct{{$product->id}}" {{ in_array($product->id, $productData->productRelatedIds) ? 'checked' : ''}}>
                                                        @else
                                                        <input type="checkbox" class="custom-control-input" name="relatedProduct[]" value="{{$product->id}}" id="relatedProduct{{$product->id}}">
                                                        @endif

                                                        <label class="custom-control-label" for="relatedProduct{{$product->id}}">{{$product->name}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if(Session::get('user')->id != 1)
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Save to draft
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    {!! Form::close() !!}
                                @endif
                            </div>

                            {{-- Offers --}}
                            <div class="tab-pane mt-3" id="tab7" role="tabpanel">

                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add SKU</h4>
                                    </div>
                                    
                                @else
                                    
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                            <h4 style="border-bottom: 1px solid #67479e;">
                                                <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Manage Offers</span>
                                            </h4>
                                        </div>
                                    </div>

                                    {!! Form::open(['route' => 'productOffer','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" class="form-control" value="{{$productData->id ?? ''}}" />
                                    
                                        @foreach ($productData->productVariations as $keyMain=>$productVariation)
                                            <div class="row">
                                                <input type="hidden" name="offer[{{ $productVariation->id }}][inventoryId]" class="form-control" value="{{$productVariation->id}}" readonly />
                                                
                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>SKU</label>
                                                        <input type="text" class="form-control" value="{{$productVariation->sku}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Select Offer Type</label>
                                                        <select name="offer[{{ $productVariation->id }}][offerType]" value="{{ $productVariation->inventory_offer->offerType ?? null }}" class="form-control select2">
                                                            <option value="">Select Offer Type</option>
                                                            <option value="1"  {{ ($productVariation->inventory_offer->offerType ?? 0)  == 1 ? 'selected' : ''}} >Normal Offer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Select Offer</label>
                                                        
                                                        <select name="offer[{{ $productVariation->id }}][offerId]" value="{{ $productVariation->inventory_offer->offerId ?? '' }}" class="form-control select2">
                                                            <option value="">Select Offer</option>
                                                            @foreach ($offerNormalList as $key=>$offerNormal)
                                                            <option value="{{$offerNormal->id}}" {{ ($productVariation->inventory_offer->offerId ?? null) == $offerNormal->id ? 'selected' : ''}} >{{$offerNormal->couponCode}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endforeach

                                        @if(Session::get('user')->id != 1)
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        Save to draft
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                    {!! Form::close() !!}
                                @endif
                            </div>

                            {{-- Prices --}}
                            <div class="tab-pane mt-3" id="tab8" role="tabpanel">
                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add SKU</h4>
                                    </div>
                                    
                                @else

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                                        <h4 style="border-bottom: 1px solid #67479e;">
                                            <span class="badge badge-pill badge-primary" style="border-radius: 0px;font-weight: lighter;">Manage Prices</span>
                                        </h4>
                                    </div>
                                </div>

                                {!! Form::open(['route' => 'productPrice','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-12">

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SKU</th>
                                                    <th>Qty.</th>
                                                    <th>MRP</th>
                                                    <th>Selling Price</th>
                                                    <th>S.Affiliation Budget</th>
                                                    <th>I.Affiliation Budget</th>
                                                    <th>Commission</th>
                                                    <th>Offer</th>
                                                    <th>Cash On Hend</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <input type="hidden" name="product_id" class="form-control" value="{{$productData->id}}" />
                                    
                                                @foreach ($productData->productVariations as $keyMain=>$productVariation)
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{$productVariation->sku}}" readonly />
                                                        <input type="hidden" name="price[{{ $productVariation->id }}][inventoryId]" class="form-control" value="{{$productVariation->id}}" readonly />
                                                        <input type="hidden" name="price[{{ $productVariation->id }}][priceId]" class="form-control" value="{{$productVariation->inventory_price->id ?? ''}}" readonly />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[{{ $productVariation->id }}][qty]" class="form-control" value="{{$productVariation->inventory_price->qty ?? ''}}" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[{{ $productVariation->id }}][mrp]" class="form-control" value="{{$productVariation->inventory_price->mrp ?? ''}}" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" id="sprice{{$keyMain}}" name="price[{{ $productVariation->id }}][sprice]" class="form-control" value="{{$productVariation->inventory_price->sprice ?? ''}}" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[{{ $productVariation->id }}][sellingAffiliationCharge]" class="form-control" value="{{$productVariation->inventory_price->sellingAffiliationCharge ?? 0}}" required />
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[{{ $productVariation->id }}][inquiryAffiliationCharge]" class="form-control" value="{{$productVariation->inventory_price->inquiryAffiliationCharge ?? 0}}" required />
                                                    </td>
                                                    <td>
                                                        <input type="text" id="chargePrice{{$keyMain}}" class="form-control" readonly />
                                                        <input type="hidden" id="chargePercentage{{$keyMain}}" class="form-control" value="{{Session::get('user')->charge}}" />
                                                    </td>
                                                    <td>
                                                        <input type="text" id="offerPrice{{$keyMain}}" class="form-control" readonly />
                                                        <input type="hidden" id="offerPercentage{{$keyMain}}" class="form-control" value="{{ $productVariation->inventory_offer->offer->discount ?? 0 }}"/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="amount{{$keyMain}}" class="form-control" readonly />
                                                    </td>
                                                    <td>
                                                        <i class="mdi mdi-calculator btn btn-outline-primary" onclick="amountCalculation({{$keyMain}});"></i>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if(Session::get('user')->id != 1)
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <button type="submit" class="btn btn-outline-primary">
                                                Save to draft
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                {!! Form::close() !!}
                                
                                @endif
                            </div>

                            {{-- QC --}}
                            <div class="tab-pane mt-3" id="tab9" role="tabpanel">

                                @if(!isset($productData) || (count($productData->productvariations)==0))
                                    
                                    <div class="ex-page-content text-center">
                                        <h1>Sorry!</h1>
                                        <h4>Add SKU</h4>
                                    </div>

                                @else
                                
                                    <div class="row">

                                        <div class="col-sm-12 col-md-12 col-lg-12">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SKU</th>
                                                        <th>Status</th>
                                                        <th>Messages</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productData->productVariations as $keyMain=>$productVariation)

                                                        @if($productVariation->qc != 3)
                                                            <tr>
                                                                <td>
                                                                    {{$productVariation->sku}}
                                                                </td>
                                                                <td>
                                                                @switch($productVariation->qc)

                                                                    @case(0)
                                                                        <i class="mdi mdi-checkbox-blank-circle text-default"></i> Ready to Send QC
                                                                    @break

                                                                    @case(1)
                                                                        <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Sent To QC
                                                                    @break

                                                                    @case(2)
                                                                        <i class="mdi mdi-checkbox-blank-circle text-primary"></i> QC Reviewed
                                                                    @break

                                                                    @default
                                                                        <i class="mdi mdi-checkbox-blank-circle text-success"></i> QC Approved
                                                                    @endswitch
                                                                </td>
                                                                <td>
                                                                    <!-- {!!$productVariation->inventory_message['description'] ?? '' !!}
                                                                    {{$productVariation->inventory_message}} -->

                                                                    @if($productVariation->qc == 2)
                                                                        <i class="mdi mdi-eye btn btn-outline-warning" data-toggle="modal" data-target="#myModal{{$productVariation->id}}" title="Send Message"></i>

                                                                        <div id="myModal{{$productVariation->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title mt-0" id="myModalLabel">
                                                                                            {{$productVariation->productName}} - {{$productVariation->sku}}
                                                                                        </h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <ol class="activity-feed mb-0">
                                                                                            @foreach ($productVariation->inventory_message as $keyMain=>$qcMessage)
                                                                                                <li class="feed-item">
                                                                                                    <span class="date">{{$qcMessage->created_at}}</span>
                                                                                                    <span class="activity-text">
                                                                                                        {!!$qcMessage->description ?? '' !!}
                                                                                                    </span>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ol>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div><!-- /.modal-content -->
                                                                            </div><!-- /.modal-dialog -->
                                                                        </div>
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @if($productVariation->qc != 1)
                                                                    <a href="{{url("admin/approveInventory/".$productVariation->id)}}">
                                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Send to QC"></i>
                                                                    </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title mt-0">Choose Image</h5>
                
                <button type="button" id="closeButton" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>

            <div class="modal-body">

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="mb-2 text-center card-body text-muted">
                        <ul class="new_friend_list list-unstyled row" id="replceFolderImage">
                        
                            @foreach ($imageUploadList as $key=>$image)
                                
                                @if($image->mediaType == 1)
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('{{$image->id}}')">
                                        <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @else
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('{{$image->name}}')">
                                        <img src="{{URL::asset($image->name)}}" class="img-thumbnail" >
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection