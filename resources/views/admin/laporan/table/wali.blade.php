<table class="table table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th>#</th>
            <th>Nama Wali</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($walis as $wali)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $wali->name }}</td>
            <td class="text-center">{{ $wali->telepon }}</td>
            <td>{{ $wali->alamat }}</td>
            <td>{{ $wali->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
