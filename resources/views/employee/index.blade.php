@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Employees</h4>
                        <h6>Manage your employees</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"
                            onClick="window.location.href=window.location.href"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addEmployee"><i
                            data-feather="plus-circle" class="me-2"></i> Add New Employee</a>
                </div>
            </div>

            <div class="employee-grid-widget">
                <div class="row">
                    @foreach ($data as $item)
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                            <div class="employee-grid-profile">
                                <div class="profile-head">
                                    <label class="checkboxs">
                                    </label>
                                    <div class="profile-head-action">
                                        <div class="dropdown profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i data-feather="more-vertical"
                                                    class="feather-user"></i></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" data-bs-effect="effect-sign"
                                                        data-bs-toggle="modal" href="#modaledit{{ $item->id }}">
                                                        <i data-feather="edit" class="feather-edit"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item mb-0"
                                                        onclick="confirm_modal('delete-employee/{{ $item->id }}');"
                                                        data-bs-toggle="modal" data-bs-target="#modal_delete">
                                                        <i data-feather="trash-2" class="feather-trash-2"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-info">
                                    <div class="profile-pic active-profile">
                                        <img src="{{ asset('storage/avatar/' . $item->avatar) }}" alt>
                                    </div>
                                    <h5>EMP ID : {{ $item->nip }}</h5>
                                    <h4>{{ $item->name }}</h4>
                                    <span>{{ $item->professions->professions }}</span>
                                </div>
                                <ul class="department">
                                    <li>
                                        NIP
                                        <span>{{ $item->nip }}</span>
                                    </li>
                                    <li>
                                        Profession
                                        <span>{{ $item->professions->professions }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="modal fade" id="modaledit{{ $item->id }}">
                            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Employee</h4><button aria-label="Close"
                                            class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="employee/{{ $item->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label class="form-label">NIP</label>
                                                <input type="text" name="nip" value="{{ $item->nip }}"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="name" value="{{ $item->name }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" name="phone" value="{{ $item->phone }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Profession</label>
                                                <select class="select" name="profession">
                                                    <option>Choose Profession</option>
                                                    @foreach ($professions as $itemprofession)
                                                        <option value="{{ $itemprofession->id }}"
                                                            @if ($item->professions_id == $itemprofession->id) selected="selected" @endif>
                                                            {{ $itemprofession->professions }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class=" mb-3">
                                                <div class="new-employee-field">
                                                    <label class="form-label">Avatar</label>
                                                    <div class="profile-pic-upload">
                                                        <div class="profile-pic active-profile">
                                                            @if ($item->avatar != null)
                                                                <img src="{{ asset('storage/avatar/' . $item->avatar) }}"
                                                                    alt="avatar">
                                                            @else
                                                                <img src="{{ asset('assets') }}/img/notfound/not found.png"
                                                                    alt="avatar">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="file" class="form-control" name="avatar">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" name="address">{{ $item->address }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="select" name="status">
                                                    <option>Choose Status</option>
                                                    <option value="1"
                                                        @if ($item->status == 1) selected="selected" @endif>
                                                        Active</option>
                                                    <option value="2"
                                                        @if ($item->status == 2) selected="selected" @endif>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-cancel"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $data->onEachSide(4)->links() }}
        </div>
    </div>

    <div class="modal fade" id="addEmployee">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title">Create Employee</h4><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <form action="employee" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profession</label>
                            <select class="select" name="profession">
                                <option>Choose Profession</option>
                                @foreach ($professions as $itemprofession)
                                    <option value="{{ $itemprofession->id }}">{{ $itemprofession->professions }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Avatar</label>
                            <div class="col-md-12">
                                <input class="form-control" name="avatar" type="file">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="select" name="status">
                                <option>Choose Status</option>
                                <option value="1"> Active</option>
                                <option value="2"> Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Popup untuk delete-->
    <div class="modal custom-modal fade" id="modal_delete">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Perhatian !!</h4>
                        <p class="mt-3">Yakin menghapus data ini ?</p>
                        <a id="delete_link" class="btn btn-danger my-2" data-dismiss="modal">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript untuk popup modal Delete-->
    <script type="text/javascript">
        function confirm_modal(delete_url) {
            $('#modal_delete').modal('show', {
                backdrop: 'static'
            });
            document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
@endsection
