<!-- Modal -->
                <div class="modal fade" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-notify modal-lg modal-info" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title " id="exampleModalLabel">ADD NEW CATEGORY</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{ route('category.update', $category_id) }}">
                        @csrf
                        @method('PUT')
                       
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">category name</span>
                                        </div>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Category name">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Save category</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
