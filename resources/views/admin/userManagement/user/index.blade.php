@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                                <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">प्रयोगकर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रयोगकर्ता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> प्रयोगकर्ता सूची</h4>
                        @can('user_create')
                            <a href="{{route('admin.systemSetting.userManagement.user.create')}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ प्रयोगकर्ता थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>नाम</th>
                                <th>इमेल</th>
                                <th>फोन नम्बर</th>
                                <th>भूमिका</th>
                                <th>स्थिति</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td class="table-user">
                                        {{$user->name}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>
                                        <span class="badge bg-info">{{$user->role->title??''}}</span>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.systemSetting.userManagement.user.updateStatus',$user)}}">
                                            <i class="fa fa-2x {{$user->is_active ? 'fa-toggle-on text-success' : 'fa-toggle-off text-danger'}}"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @can('user_edit')
                                            <a  href="{{route('admin.systemSetting.userManagement.user.edit',$user)}}"
                                               title="सम्पादन गर्नुहोस्"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('user_delete')
                                            <form data-bs-type="delete" action="{{route('admin.systemSetting.userManagement.user.destroy',$user)}}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-xs btn-outline-danger show_confirm" title="मेटाउनु होस्">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
