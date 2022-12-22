<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catagoreis </title>
</head>

<body>
    <h2>
        {{$title}}
    </h2>
    <table>
        <thead>
            <tr>
                <th>loop</th>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Paretn id </th>
                <th>Status </th>
                <th>Create At</th>
            </tr>
        </thead>
        <tbody>

            @foreach($categories as $catagory)
            <tr>
                <!-- to do loop number  -->
                <td>{{ $loop->first? 'First' :($loop->last? 'Last' : $loop->iteration) }}</td>
                <td>{{$catagory->id}}</td>
                <td>{{ $catagory->name }}</td>
                <td>{{ $catagory->slug }}</td>
                <td>{{ $catagory->parent_name }}</td>
                <td>{{ $catagory->status }}</td>
                <td>{{ $catagory->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

<!-- test text  -->
