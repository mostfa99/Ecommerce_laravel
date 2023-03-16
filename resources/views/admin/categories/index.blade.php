    @extends('layout.admin')
    @section('title')
    {{$title}}

    <a href="{{ route('catagories.create')}}"> Create</a>
    @endsection
    @section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('catagories.index')}}">{{__('Categories')}}</a></li>
    </ol>
    @endsection
    @section('content')
    <div class="row">
        <div class="col">
            <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between align-items-center mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h4 for="name">{{__('Filter')}}</h4>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}" value="{{request('name')}}">
                            <select name="status" class="form-control">
                                <option value="">{{__('All')}}</option>
                                <option value="active" @selected(request('status'))>Active</option>
                                <option value="draft" @selected(request('draft'))>Draft</option>
                            </select>
                            <button class="btn btn-dark ml-3">
                                {{__('Filter')}}
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- return count of categories in collection with singler or popular will use it in main dashbord  -->
    {{trans_choice('app.categoreis_count',$categories->count() , ['number' => $categories->count()])}}

    <!-- هنا بقدر احدد شيئ معين واعطيه قيمة معينة واعطيه ترجمة معينة -->
    {{__(' and Current Locale is :locale  ', ['locale' => App::getLocale()])}}
    <table class="table">
        <thead>
            <tr>
                <!-- <th>{{__('loop')}}</th> -->
                <th>{{__('ID')}}</th>
                <th>{{__('Name')}}</th>
                <!-- <th>{{__('Slug')}}</th> -->
                <th>{{__('Paretn Name')}} </th>
                <th>{{__('Products Count')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Create At')}}</th>
                <th>{{__('Edit')}}</th>
                <th>{{__('Delete')}}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $catagory)
            <tr>
                <!-- to do loop number  -->
                <!-- <td>{{ $loop->first? 'First' :($loop->last? 'Last' : $loop->iteration) }}</td> -->
                <td>{{$catagory->id}}</td>
                <td>{{ $catagory->name }}</td>
                <!-- <td>{{ $catagory->slug }}</td> -->
                <td>{{ @$catagory->parent->name}}</td>
                <td>{{ $catagory->count}}</td>
                <td>{{ $catagory->status }}</td>
                <td>{{ $catagory->created_at }}</td>
                <td> <a href="{{route('catagories.edit',$catagory->id)}}" class="btn btn-sm btn-dark">{{__('Edit')}}</a>
                </td>
                <td>
                    <form action="{{route('catagories.destroy',$catagory->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"> {{__('Delete')}}</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">There are no categories to display</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <!-- for number of pages  after paginte in controller to display it  -->
    <!-- http://localhost:8000/admin/products?page=2&cat_id=1 -->
    {{ $categories->withQueryString()->links() }}
    @endsection