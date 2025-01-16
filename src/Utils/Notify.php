<?php

namespace App\Utils;

class Notify {
    public static function notify(string $type, string $message, int $timer = 3000) {
        $toast =  "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: {$timer},
                        timerProgressBar: true,
                    });
                    Toast.fire({ icon: `{$type}`, title: `{$message}`})
                    console.log(Toast)
                </script>";
        echo $toast;
    }
}