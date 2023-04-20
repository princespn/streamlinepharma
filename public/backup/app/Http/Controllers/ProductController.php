<?php

namespace App\Http\Controllers;

use App\Models\AffiliateKeyword;
use App\Models\AccountAffiliateKeywords;
use App\Models\Tag;
use App\Models\Label;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductInventory;
use App\Models\ProductPackaging;
use App\Models\ProductTax;
use App\Models\ProductSearchKeyword;
use App\Models\ProductWarranty;
use App\Models\ProductAffiliationKeyword;
use App\Models\ProductRelated;
use App\Models\OfferNormal;
use App\Models\ProductOffer;
use App\Models\ProductPrice;
use App\Models\ProductQc;
use App\Models\imageUpload;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ProductController extends Controller
{

    public function index()
    {
        $productList = Product::where('account_id',Session::get('user')->id)->get();
        return view('admin/product/product/index', compact('productList'));
    }

    public function getAllData($productId)
    {
        $accountId = Session::get('user')->id;

        // After Submit Data
        $productData = Product::with([
            'attributesFilter' => function ($query) {

                $query->where('type', 2);
            },
            'attributesOption' => function ($query) {
                $query->where('type', 3)->with('label');
            },
            'attributesHighlight' => function ($query) {
                $query->where('type', 1);
            },
            'productRelated' => function ($query) {
                $query->where('status', 1);
            },
            'tax_detail',
            'searchKeywords',
            'productvariations' => function ($query) {
                $query->with(['variant0', 'variant1', 'variant2', 'variant3', 'variant4', 'inventory_shipping', 'inventory_warranty', 'inventory_affiliation', 'inventory_price','inventory_message','inventory_offer' => function($query){
                    $query->with(['offer']);
                }]);
            }
        ])
        ->where('id', $productId)->first();
        
        $productVariations = array();

        if (isset($productData->attributesFilter)) {

            $productData->filterIds = $productData->attributesFilter->pluck('label_id')->toArray();

            $grouped = $productData->attributesOption->groupBy('label.tag_id');

            $arrayOfOptions = [];
            foreach ($grouped as $key => $value) {
                array_push($arrayOfOptions, $value);
            }

            $productVariations  = $this->combinations($arrayOfOptions);
          
            $dbCombination = ProductInventory::where('product_id', $productId)->get();
          
            if (count($dbCombination) > 0) {

                //ProductInventory::where('product_id', $productId)->update(['status' => 1]);
                foreach ($productVariations as $key => $combinations) {

                    $dbCombinationFirst = ProductInventory::where('product_id', $productId);

                    $inventoryJSON['product_id'] = $productId;
                    $inventoryJSON['productName'] = $productData->name;
                    $inventoryJSON['productDescription'] = $productData->description;

                    if(is_array ($combinations)){
                        foreach ($combinations as $combKey => $combination) {

                            $dbCombinationFirst->where("variation$combKey", $combination->label_id);
                            $inventoryJSON["variation$combKey"] = $combination->label_id;
                        }

                        $dbCombinationFirst = $dbCombinationFirst->first();

                        if ($dbCombinationFirst == null) {
                            ProductInventory::insert($inventoryJSON);
                        } else {
                            $dbCombinationFirst->status = 1;
                            $dbCombinationFirst->save();
                        }
                    } else {

                        $dbCombinationFirst->where("variation0", $combinations->label_id);
                        $dbCombinationFirst = $dbCombinationFirst->first();
                        if ($dbCombinationFirst == null) {
                            $inventoryJSON["variation0"] = $combinations->label_id;
                            ProductInventory::insert($inventoryJSON);
                        } else {
                            $dbCombinationFirst->status = 1;
                            $dbCombinationFirst->save();
                        }
                    }
                }

            } else {
             
                foreach ($productVariations as $key => $combinations) {

                    $inventoryJSON['product_id'] = $productId;
                    $inventoryJSON['productName'] = $productData->name;
                    $inventoryJSON['productDescription'] = $productData->description;


                    if(is_array ($combinations)) {
                        
                        foreach ($combinations as $combKey => $combination) {
                            
                            $inventoryJSON["variation$combKey"] = $combination->label_id;
                        }

                        ProductInventory::create($inventoryJSON);

                    } else{

                        $inventoryJSON["variation0"] = $combinations->label_id;
                        ProductInventory::create($inventoryJSON);
                    }
					
                }
            }
        }

        $productData = Product::with([
            'attributesFilter' => function ($query) use($accountId){
                $query->where('type', 2);
            },
            'attributesOption' => function ($query) {
                $query->where('type', 3)->with('label');
            },
            'attributesHighlight' => function ($query) {
                $query->where('type', 1);
            },
            'productRelated' => function ($query) {
                $query->where('status', 1);
            },
            'tax_detail',
            'searchKeywords',
            'productvariations' => function ($query) {
                $query->with([
                    'variant0',
                    'variant1',
                    'variant2',
                    'variant3',
                    'variant4',
                    'inventory_shipping',
                    'inventory_warranty',
                    'inventory_affiliation',
                    'inventory_price', 
                    'inventory_offer' => function($query) {
                        $query->with(['offer']);
                    },
                    'inventory_message',
                ]);
            }
        ])
        ->where('id', $productId)
        ->first();
        
        //dd($productData);

        if (isset($productData->attributesFilter)) {

            $productData->filterIds = $productData->attributesFilter->pluck('label_id')->toArray();
        }

        if (isset($productData->attributesOption)) {

            $productData->optionsIds = $productData->attributesOption->pluck('label_id')->toArray();
        }

        if (isset($productData->attributesHighlight)) {

            $productData->highlightIds = $productData->attributesHighlight->pluck('label_id')->toArray();
        }

        if (isset($productData->affiliationKeywords)) {

            $productData->affiliationKeywordIds = $productData->affiliationKeywords->pluck('keyword_id')->toArray();
        }

        if (isset($productData->productRelated)) {

            $productData->productRelatedIds = $productData->productRelated->pluck('related_product_id')->toArray();
        }

        //$productQCList = ProductQc::where('product_id', $productId)->orderBy('id', 'DESC')->get();

        // Default Load
        $categoryList = Category::with(['parentCategory' => function ($query) {
            $query->with('parentCategory');
        }])->where('account_id',$accountId)->get();

        $filterList = Tag::with([
            'filterLabels' => function ($query) {
                $query->where('filter', 1);
            }
        ])
        ->where('account_id', $accountId)
        ->get();

        $optionList = Tag::with([
            'optionLabels' => function ($query) {
                $query->where('option', 1);
            }
        ])
        ->where('account_id', $accountId)
        ->get();

        $highlightList = Tag::with([
            'highlightLabels' => function ($query) {
                $query->where('highlight', 1);
            }
        ])
        ->where('account_id', $accountId)
        ->get();

        //$affiliateKeywordList = AffiliateKeyword::get();
        $affiliateKeywordList = AccountAffiliateKeywords::with('keyword')->where('account_id',$accountId)->get();

        $productList = array();
        if ($productData) {
            $productList = Product::where('category_id2', $productData->category_id2)->get();
        }

        $offerNormalList = OfferNormal::get();
        $productPriceList = ProductInventory::get();

        $ref_id = null;
        $imageUploadList = imageUpload ::where('account_id',$accountId)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();

        return view('admin/product/product/add', compact('categoryList','imageUploadList', 'filterList', 'optionList', 'highlightList', 'affiliateKeywordList', 'productList', 'productData', 'productVariations', 'offerNormalList', 'productPriceList')); //,'productOfferList', 'productQCList'
    }

    function combinations($arrays, $i = 0)
    {

        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) : array($v, $t);
            }
        }

        return $result;
    }

    public function create(Request $request)
    {
        $productId = null;
        if ($request->has('productId')) {
            $productId = $request->input('productId');
        }
        return $this->getAllData($productId);
    }

    public function store(Request $request)
    {

        $input = $request->all();
        // dd($input);
     
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $input['account_id'] = Session::get('user')->id;
            $input['status'] = 1;

            $categoryIds = $input['category_id'];

            $arrayOfIds = explode(',' , $categoryIds);
            foreach ($arrayOfIds as $key => $id) {
                $input['category_id'.($key+1)] = $id;
            }
           
            unset($input['category_id']);
            unset($input['_token']);

            $product = Product::create($input);

            if ($product) {

                $productId = $product->id;

                return redirect()->to('admin/product/create?productId=' . $productId);
                // return $this->getAllData($productId);
            } else {

                return back()->withErrors(['Something went wrong']);
            }
        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function productAttribute(Request $request)
    {

        $input = $request->all();
        unset($input['_token']);

        $attributeJSON = array();

        $product_id = $input['product_id'];

        if (isset($input['filter'])) {

            $filter = $input['filter'];
            foreach ($filter as $key => $value) {

                array_push($attributeJSON, ['label_id' => $value, 'type' => 2, 'product_id' => $product_id]);
            }
        }

        if (isset($input['option'])) {

            $option = $input['option'];
            foreach ($option as $key => $value) {

                if($key<5)
                {
                    array_push($attributeJSON, ['label_id' => $value, 'type' => 3, 'product_id' => $product_id]);
                }
            }
        }

        if (isset($input['highlight'])) {

            $highlight = $input['highlight'];
            foreach ($highlight as $key => $value) {

                array_push($attributeJSON, ['label_id' => $value, 'type' => 1, 'product_id' => $product_id]);
            }
        }

        $product_attributes = ProductAttributes::insert($attributeJSON);
        if ($product_attributes) {

            return redirect()->to('admin/product/create?productId=' . $product_id);
            
        } else {

            return back()->withErrors(['Something went wrong']);
        }
    }

    public function productShipping(Request $request)
    {

        $input = $request->all();

        unset($input['_token']);

        $packaging = $input['packaging'];
        $tax = $input['tax'];
        // dd($tax['packaging']);

        $productPackaging = ProductPackaging::insert($packaging);
        ProductTax::insert($tax);

        if ($productPackaging) {

            return redirect()->to('admin/product/create?productId=' . $tax['product_id']);
        } else {

            return back()->withErrors(['Something went wrong']);
        }
    }

    public function productAdvanced(Request $request)
    {

        $input = $request->all();

        $product_id = $input['product_id'];


        $searchKeyword  = ProductSearchKeyword::where('product_id', $product_id)->first();
        if ($searchKeyword) {

            $searchKeyword->keyword = $input['keyword'];
            $searchKeyword->save();
        } else {
            ProductSearchKeyword::insert(['product_id' => $input['product_id'], 'keyword' =>  $input['keyword']]);
        }

        $warrantyList = $input['warranty'];

        foreach ($warrantyList as $key => $warranty) {
            $warrantyId = $warranty['warrantyId'];
            unset($warranty['warrantyId']);
            if ($warrantyId) {
                ProductWarranty::where('id', $warrantyId)->update($warranty);
            } else {
                ProductWarranty::insert($warranty);
            }
        }

        $affiliationInventoryList = $input['affiliation'] ?? [];

        foreach ($affiliationInventoryList as $key => $affiliationInventory) {

            foreach ($affiliationInventory as $key => $affiliation) {

                $affiliationId = $affiliation['affiliationId'];

                if ($affiliationId) {

                    $affilationObj =  ProductAffiliationKeyword::where('keyword_id', $affiliationId);

                    if (!isset($affiliation['keyword_id'])) {
                        $affilationObj->delete();
                    }
                    
                } else {

                    if (isset($affiliation['keyword_id'])) {
                        ProductAffiliationKeyword::insert(['inventoryId' => $affiliation['inventoryId'], 'keyword_id' => $affiliation['keyword_id']]);
                    }
                }
            }
        }

        return redirect()->to('admin/product/create?productId=' . $product_id);
    }

    public function productRelated(Request $request)
    {

        $input = $request->all();
        // dd($input);
        $product_id = $input['product_id'];
        ProductRelated::where('product_id', $product_id)->update(['status' => 1]);
        if (isset($input['relatedProduct'])) {
            foreach ($input['relatedProduct'] as $key => $relatedProductId) {
                $relatedProduct = ProductRelated::where('related_product_id', $relatedProductId)->first();
                if ($relatedProduct) {
                    $relatedProduct->status = 1;
                    $relatedProduct->save();
                } else {
                    ProductRelated::create(['related_product_id' => $relatedProductId, 'product_id' => $product_id]);
                }
            }
        }

        return redirect()->to('admin/product/create?productId=' . $product_id);
    }

    public function productOffer(Request $request)
    {

        $input = $request->all();

        foreach ($input['offer'] as $key => $offer) {

            $inventoryId = $offer['inventoryId'];
            $offerType = $offer['offerType'];
            $offerId = $offer['offerId'];
            ProductOffer::where('inventoryId', $inventoryId)->forceDelete();
            $offerObj = ProductOffer::where('inventoryId', $inventoryId)->where('offerType', $offerType)->where('offerId', $offerId)->first();
            if ($offerObj) {

                $offerObj->status = 1;
                $offerObj->save();

            } else {

                if($offerType){
                    ProductOffer::create($offer);
                }
                
            }
        }
        
        $product_id = $input['product_id'];
        return redirect()->to('admin/product/create?productId=' . $product_id);
    }

    public function productPrice(Request $request)
    {

        $input = $request->all();
        //dd($input);

        $product_id = $input['product_id'];
        $priceList = $input['price'];
        //dd($priceList);

        foreach ($priceList as $key => $price) {
            $priceId = $price['priceId'];
            unset($price['priceId']);
            if ($priceId) {
                ProductPrice::where('id', $priceId)->update($price);
            } else {

                ProductPrice::insert($price);
            }
        }

        return redirect()->to('admin/product/create?productId=' . $product_id);

        
    }

    // public function productQc(Request $request)
    // {

    //     $productId = $request->all()['product_id'];
    //     $QcData =  ['qc' => 1];

    //     $qc = Product::where('id', $productId)->update($QcData);

    //     if ($qc) {

    //         return redirect()->to('admin/product/create?productId=' . $productId);
    //     } else {

    //         return back()->withErrors(['Something went wrong']);
    //     }
    // }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {

        $input = $request->all();

        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $input['account_id'] = Session::get('user')->id;
            
            $categoryIds = $input['category_id'];

            Product::where('id', $product->id)->update(['category_id2'=>null,'category_id3'=>null]);

            $arrayOfIds = explode(',' , $categoryIds);
            foreach ($arrayOfIds as $key => $id) {
                $input['category_id'.($key+1)] = $id;
            }
           
            //dd($categoryIds);
            unset($input['category_id']);

            unset($input['_token']);
            unset($input['_method']);
            unset($input['product_id']);

            $productData = Product::where('id', $product->id)->update($input);

            if ($productData) {

                return redirect()->to('admin/product/create?productId=' . $product->id);
                // return $this->getAllData($product->id);

            } else {

                return back()->withErrors(['Something went wrong']);
            }
        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function productAttributeUpdate(Request $request, Product $product)
    {

        $input = $request->all();

        unset($input['_token']);

        $attributeJSON = array();

        $product_id = $input['product_id'];

        if (isset($input['highlight'])) {

            $highlight = $input['highlight'];
            $dbOptionsList = ProductAttributes::where('type', 1)->where('product_id', $product_id)->get();

            foreach ($dbOptionsList as $key => $dbOption) {

                if (!in_array($dbOption->label_id, $highlight)) {

                    $dbOption->delete();
                }
                $highlight = array_diff($highlight, [$dbOption->label_id]);
            }
            foreach ($highlight as $key => $value) {

                array_push($attributeJSON, ['label_id' => $value, 'type' => 1, 'product_id' => $product_id]);
            }
        }

        if (isset($input['filter'])) {

            $filter = $input['filter'];
            $dbOptionsList = ProductAttributes::where('type', 2)->where('product_id', $product_id)->get();

            foreach ($dbOptionsList as $key => $dbOption) {

                if (!in_array($dbOption->label_id, $filter)) {

                    $dbOption->delete();
                }
                $filter = array_diff($filter, [$dbOption->label_id]);
            }

            foreach ($filter as $key => $value) {

                array_push($attributeJSON, ['label_id' => $value, 'type' => 2, 'product_id' => $product_id]);
            }
        }

        if (isset($input['option'])) {

            $option = $input['option'];
            $dbOptionsList = ProductAttributes::where('type', 3)->where('product_id', $product_id)->get();

            foreach ($dbOptionsList as $key => $dbOption) {

                if (!in_array($dbOption->label_id, $option)) {

                    $dbOption->delete();
                }
                $option = array_diff($option, [$dbOption->label_id]);
            }

            foreach ($option as $key => $value) {

                if($key<5)
                {
                    array_push($attributeJSON, ['label_id' => $value, 'type' => 3, 'product_id' => $product_id]);
                }
            }
        }

        $product_attributes = ProductAttributes::insert($attributeJSON);
        if ($product_attributes) {

            return redirect()->to('admin/product/create?productId=' . $product_id);

        } else {

            return back()->withErrors(['Something went wrong']);
        }
    }

    public function productInventoryUpdate(Request $request)
    {

        $input = $request->all();
        
        $productId = $input['product_id'];
        foreach ($input['inventory'] as $key => $inventory) {
            
            $inventory['isIdle'] = $inventory['sku'] != '' ? 1 : 0;
            ProductInventory::where('id', $key)->update($inventory);

            $checkSKU =  ProductInventory::where('sku', $inventory['sku'])->get();
            if(count($checkSKU) != 1)
            {
                ProductInventory::where('id', $key)->update(['sku' => '','isIdle'=>0]);
            }  
        }

        return redirect()->to('admin/product/create?productId=' . $productId);
    }

    public function productShippingUpdate(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $packaging = $input['packaging'];
        $tax = $input['tax'];
        // dd($packaging);

        foreach ($packaging as $key => $package) {

            $shippingId = $package['shippingId'];
            unset($package['shippingId']);
            if ($shippingId) {
                
                ProductPackaging::where('id', $shippingId)->update($package);
            } else {

                ProductPackaging::insert($package);
            }
        }

        $product_id = $tax['product_id'];

        $packageTax = ProductTax::where('product_id', $product_id)->first();
        if ($packageTax) {

            unset($tax['product_id']);
            ProductTax::where('product_id', $product_id)->update($tax);
        } else {
            ProductTax::insert($tax);
        }

        return redirect()->to('admin/product/create?productId=' . $product_id);
    }

    public function destroy(Product $product)
    {
        $result = $product->delete();
        if($result == 1) {

            return redirect('/admin/product');
        } else  {

            return back()->withErrors(['failed to delete']);

        }
    }

    public function approveInventory(Request $request,$inventoryId)
    {
        $inventory = ProductInventory::find($inventoryId);
        $productId = $inventory->product_id;

        if($inventory) {

            $inventory->qc = 1;
            $inventory->save();
            return redirect()->to('admin/product/create?productId=' . $productId);

        } else {
            return back()->withErrors(['Inventory not found.']);
        }
    }
}
