<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Absensi Siswa</title>

    <link
        rel="stylesheet"
        href="../assets/css/style.css">

</head>

<body>

<div class="container">

    <h2>DAFTAR HADIR SISWA</h2>

    <form
        id="filterForm"
        method="GET"
        action="index.php">

        <table class="form-table">

            <tr>

                <td width="180">

                    Guru

                </td>

                <td>

                    <select
                        name="guru"
                        id="guru"
                        onchange="document.getElementById('filterForm').submit();">

                        <?php foreach($guru as $g){ ?>

                            <option

                                value="<?= $g['id']; ?>"

                                <?= ($guru_id==$g['id']) ? 'selected' : ''; ?>

                            >

                                <?= htmlspecialchars($g['nama_guru']); ?>

                            </option>

                        <?php } ?>

                    </select>

                </td>

            </tr>

            <tr>

                <td>

                    Mata Pelajaran

                </td>

                <td>

                    <input

                        type="text"

                        class="readonly"

                        readonly

                        value="<?= htmlspecialchars($mapel['nama_mapel']); ?>"

                    >

                </td>

            </tr>

            <tr>

                <td>

                    Kelas

                </td>

                <td>

                    <select

                        name="kelas"

                        id="kelas"

                        onchange="document.getElementById('filterForm').submit();"

                    >

                        <?php foreach($kelas as $k){ ?>

                            <option

                                value="<?= $k['id']; ?>"

                                <?= ($kelas_id==$k['id']) ? 'selected' : ''; ?>

                            >

                                <?= htmlspecialchars($k['nama_kelas']); ?>

                            </option>

                        <?php } ?>

                    </select>

                </td>

            </tr>

            <tr>

                <td>

                    Tanggal

                </td>

                <td>

                    <input

                        type="date"

                        id="tanggal"

                        name="tanggal"

                        value="<?= $tanggal; ?>"

                        onchange="document.getElementById('filterForm').submit();"

                    >

                </td>

            </tr>

        </table>

    </form>

    <br>

    <table class="table-absensi">

        <thead>

            <tr>

                <th width="60">

                    No

                </th>

                <th>

                    Nama Murid

                </th>

                <th width="180">

                    Status

                </th>

            </tr>

        </thead>

        <tbody>

        <?php

        $no = 1;

        foreach($murid as $m){

        ?>

        <tr>

            <td align="center">

                <?= $no++; ?>

            </td>

            <td>

                <?= htmlspecialchars($m['nama_murid']); ?>

            </td>

            <td>

                <select

                    class="status"

                    data-header="<?= $header_id; ?>"

                    data-murid="<?= $m['id']; ?>"

                >

                    <option
                        value="Hadir"
                        <?= ($m['status']=="Hadir") ? 'selected' : ''; ?>
                    >
                        Hadir
                    </option>

                    <option
                        value="Izin"
                        <?= ($m['status']=="Izin") ? 'selected' : ''; ?>
                    >
                        Izin
                    </option>

                    <option
                        value="Sakit"
                        <?= ($m['status']=="Sakit") ? 'selected' : ''; ?>
                    >
                        Sakit
                    </option>

                    <option
                        value="Alpha"
                        <?= ($m['status']=="Alpha") ? 'selected' : ''; ?>
                    >
                        Alpha
                    </option>
                                        </select>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<script>

document.querySelectorAll(".status").forEach(function(item){

    item.addEventListener("change",function(){

        let formData = new FormData();

        formData.append(
            "header_id",
            this.dataset.header
        );

        formData.append(
            "murid_id",
            this.dataset.murid
        );

        formData.append(
            "status",
            this.value
        );

        fetch("index.php?action=simpan",{

            method:"POST",

            body:formData

        })

        .then(response=>response.json())

        .then(data=>{

            if(data.success){

                item.style.background="#d4edda";

                setTimeout(function(){

                    item.style.background="white";

                },500);

            }else{

                alert("Gagal menyimpan absensi.");

            }

        })

        .catch(function(){

            alert("Terjadi kesalahan koneksi.");

        });

    });

});

</script>

</body>

</html>