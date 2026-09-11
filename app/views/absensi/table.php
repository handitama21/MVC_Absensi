<table class="table-absensi">

    <thead>

        <tr>

            <th width="60">No</th>

            <th>Nama Murid</th>

            <th width="180">Status</th>

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
                        <?= ($m['status']=="Hadir")?"selected":""; ?>
                    >
                        Hadir
                    </option>

                    <option
                        value="Izin"
                        <?= ($m['status']=="Izin")?"selected":""; ?>
                    >
                        Izin
                    </option>

                    <option
                        value="Sakit"
                        <?= ($m['status']=="Sakit")?"selected":""; ?>
                    >
                        Sakit
                    </option>

                    <option
                        value="Alpha"
                        <?= ($m['status']=="Alpha")?"selected":""; ?>
                    >
                        Alpha
                    </option>

                </select>

            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>