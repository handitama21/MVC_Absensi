/*
==========================================================
LOAD TABEL ABSENSI
==========================================================
*/

function loadAbsensi(){

    let guru=document.getElementById("guru").value;

    let kelas=document.getElementById("kelas").value;

    let tanggal=document.getElementById("tanggal").value;

    fetch(

        "index.php?action=load"

        +"&guru="+guru

        +"&kelas="+kelas

        +"&tanggal="+tanggal

    )

    .then(response=>response.text())

    .then(html=>{

        document
        .getElementById("tabelAbsensi")
        .innerHTML=html;

        bindStatus();

    });

}

/*
==========================================================
SIMPAN STATUS
==========================================================
*/

function bindStatus(){

    let status=document.querySelectorAll(".status");

    status.forEach(function(item){

        item.addEventListener("change",function(){

            let formData=new FormData();

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

            fetch(

                "index.php?action=simpan",

                {

                    method:"POST",

                    body:formData

                }

            )

            .then(response=>response.json())

            .then(data=>{

                if(data.success){

                    item.style.background="#b8f5c4";

                    setTimeout(function(){

                        item.style.background="";

                    },500);

                }

            });

        });

    });

}

/*
==========================================================
GURU
==========================================================
*/

document
.getElementById("guru")
.addEventListener(

    "change",

    function(){

        loadAbsensi();

    }

);

/*
==========================================================
KELAS
==========================================================
*/

document
.getElementById("kelas")
.addEventListener(

    "change",

    function(){

        loadAbsensi();

    }

);

/*
==========================================================
TANGGAL
==========================================================
*/

document
.getElementById("tanggal")
.addEventListener(

    "change",

    function(){

        loadAbsensi();

    }

);

/*
==========================================================
PERTAMA KALI
==========================================================
*/

window.onload=function(){

    loadAbsensi();

};