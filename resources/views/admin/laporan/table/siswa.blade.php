<table class="table table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th>#</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Nama Wali</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswas as $siswa)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $siswa->nama }}</td>
            <td class="text-center">{{ $siswa->kelas->nama }}</td>
            <td>{{ $siswa->wali->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
