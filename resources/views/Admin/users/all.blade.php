@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container">
            <form>
                <div class="col-sm-12">
                    <table id="productsTable" class="table table-striped table-bordered dataTable no-footer" cellspacing="0" role="grid" aria-describedby="example_info">
                        <select id="action-list">
                            <option value="0" selected disabled>Actions</option>
                            <option value="1">Edit</option>
                            <option value="2" class="delete">Delete</option>
                        </select>
<!--                        <input id="save" type="submit" value="Save">-->
                        <button type="submit" onclick="editelement()" id="apply" class="hidden">Apply</button>
                        <div class="clearfix"></div>
                        <thead>
                            <tr role="row">
                                <th class="text-center delete select-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 12px; position: relative;"></th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Product Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Categories</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Regular Price</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Sale Price</th>
                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Inventory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row">
                                <td></td>
                                <td class="sorting_1" data-search="product 1" data-order="product 1">
                                    <input class="hide-input" type="text" name="name" value="product 1" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="cat 3" data-order="cat 3">
                                    <input class="hide-input" type="text" name="categories" value="cat 3" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="5000" data-order="5000">
                                    <input class="hide-input" type="text" name="regular-price" value="5000" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="2999" data-order="2999">
                                    <input class="hide-input" type="text" name="sale-price" value="2999" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="10" data-order="10">
                                    <input class="hide-input" type="text" name="inventory" value="10" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                            </tr>
                            <tr role="row">
                                <td></td>
                                <td class="sorting_1" data-search="product 2" data-order="product 2">
                                    <input class="hide-input" type="text" name="name" value="product 2" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="cat 2" data-order="cat 2">
                                    <input class="hide-input" type="text" name="categories" value="cat 2" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="1000" data-order="1000">
                                    <input class="hide-input" type="text" name="regular-price" value="1000" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="699" data-order="699">
                                    <input class="hide-input" type="text" name="sale-price" value="699" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="50" data-order="50">
                                    <input class="hide-input" type="text" name="inventory" value="50" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                            </tr>
                            <tr role="row">
                                <td></td>
                                <td class="sorting_1" data-search="product 3" data-order="product 3">
                                    <input class="hide-input" type="text" name="name" value="product 3" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="cat 1" data-order="cat 1">
                                    <input class="hide-input" type="text" name="categories" value="cat 1" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="10000" data-order="10000">
                                    <input class="hide-input" type="text" name="regular-price" value="10000" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="8999" data-order="8999">
                                    <input class="hide-input" type="text" name="sale-price" value="8999" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                                <td class="sorting_1" data-search="6" data-order="6">
                                    <input class="hide-input" type="text" name="inventory" value="6" disabled>
                                    <input type="hidden" value="hidden1" disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection  