<div class="card col-12 blue1">
        <div class="card-header">
            <h3 class="card-title">
                <b>Data Presensi Praktikum {{$mk[0]->nama_praktikum}} </b>
            </h3>
        </div>
    </div>
 <table class="table table-striped hover" style="width: 95%!important" id="export">
      <thead>
          <tr style="text-align: center">
              <th style="text-align: center">NO</th>
              <th style="text-align: center">NAMA</th>
              <th style="text-align: center">NIM</th>
              @foreach ($pertemuan as $item)
              <th style="text-align: center">PERTEMUAN {{$item->urutanpertemuan}}</th>
              @endforeach
              <th style="text-align: center">TOTAL HADIR</th>
              <th style="text-align: center">TOTAL TANPA KETERANGAN</th>
          </tr>
      </thead>
      <tbody>
              @foreach ($peserta as $user)
          <tr>
              <td style="text-align: center">{{ $loop->iteration }}</td>
              <td>{{ $user->nama_user }}</td>
              <td style="text-align: center">{{ $user->username }}</td>
              <?php 
                $count = 0;
                $count2 = 0;
              ?>
              @foreach ($pertemuan as $cek)
              <?php $hasil = App\Models\Presensi::where('id_wadah', $cek->id_wadah)->where('id_user', $user->id)->first(); ?>
              @if (!empty($hasil))
                @if ($hasil->id_wadah == $cek->id_wadah)
                    <td style="text-align: center">1</td>
                    <?php $count++; ?>
                @endif
              @else
                <td style="text-align: center">0</td>
                <?php $count2++; ?>
              @endif
                
              @endforeach
              <td style="text-align: center">{{$count}}</td>
              <td style="text-align: center">{{$count2}}</td>
          </tr>
              @endforeach
      </tbody>
  </table>