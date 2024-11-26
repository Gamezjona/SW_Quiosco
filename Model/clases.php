<?php

class Alerta
{

    private $tipoAlerta;


    function __construct($tipoAlerta)
    {
        $this->tipoAlerta = $tipoAlerta;
    }


    function mostrarAlerta($mensaje)
    {
        switch ($this->tipoAlerta) {
            case 'errorParametros':

                echo '<script>
                Swal.fire({
                position: "top-end",
                icon: "error",
                title: "'.$mensaje.'",
                showConfirmButton: false,
                timer: 2500});</script>';

                break;
            case 'planPremium':

                echo '<script>
                    let timerInterval;
                    Swal.fire({
                      title: "Creando Premium",
                      html: "Seras Premium en <b></b> milliseconds.",
                      timer: 2000,
                      timerProgressBar: true,
                      didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                          timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                      },
                      willClose: () => {
                        clearInterval(timerInterval);
                      }
                    }).then((result) => {
                      /* Read more about handling dismissals below */
                      if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                      }
                    });</script>';
                break;
            default:
                # code...
                break;
        }
    }
}
