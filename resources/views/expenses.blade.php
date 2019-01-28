@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fas fa-file-invoice-dollar"></i> {{ __('Expenses') }}</div>

                    <div class="card-body">
                        <table class="table mt-4 text-center table-striped" id="tblExpenses">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Price</th>
                                <th>Tags</th>
                            </tr>
                            </thead>
                        </table>
                        <hr>
                        <button class="btn btn-primary float-left mr-2" id="btnNew">{{ __('New') }}</button>
                        <button class="btn btn-success float-left mr-2" id="btnEdit" disabled>{{ __('Edit') }}</button>
                        <button class="btn btn-info float-left" id="btnCopy" disabled>{{ __('Copy') }}</button>
                        <button class="btn btn-danger float-right" id="btnDelete" disabled>{{ __('Delete') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="mdEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> <span id="mdEditTitle">Edit</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mdEditBody">
                    <form method="POST" id="formExpense">
                        @csrf

                        <input id="id" type="hidden" name="id" value="">
                        <input id="user_id" type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-3">
                                <input id="date" type="date" class="form-control date" name="date" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                            <div class="col-md-3">
                                <input id="time" type="time" class="form-control time" name="time" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-2">
                                <input id="price" type="text" class="form-control money" name="price" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control text-lowercase" name="tags" value="" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-secondary float-left" data-dismiss="modal" aria-label="Close">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mdDelete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-trash"></i> <span id="mdDeleteTitle">Delete</span></h5>
                </div>
                <div class="modal-body" id="mdDeleteBody">
                    <p>Are you sure you want to remove this expense '<span id="txtDeleteId">0</span>'?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal" id="btnDeleteConfirm">OK</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="js/expenses.js"></script>
    @endpush
@stop
