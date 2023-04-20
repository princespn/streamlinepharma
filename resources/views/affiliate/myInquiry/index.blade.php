@extends('layouts.app')

@section('pageTitle')

    <h4 class="page-title"> <i class="dripicons-checklist"></i> My inquiry income</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Site</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Inquiry Budget</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Fashion</td>
                                <td>Electronic -> Mobile -> One Plus 6</td>
                                <td>One Plus 6</td>
                                <td>500.00</td>
                                <td>5.00</td>
                                <td>5.00</td>
                                <td>25.00</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection