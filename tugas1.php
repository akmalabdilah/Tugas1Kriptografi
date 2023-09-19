<?php
function headerInfo() {
    echo "Kriptografi Program Caesar Cipher Menggunakan PHP\n";
    echo "M. AKMAL AL ABDILAH\n";
    echo "312110034\n";
    echo "TI.21.A.1\n";
}

function menu() {
    while (true) {
        echo "\n================\n";
        echo "    MENU\n";
        echo "================\n";
        echo "1. Enkripsi\n";
        echo "2. Dekripsi\n";
        echo "3. Exit\n\n";

        $input_menu = (int)readline("Masukkan Menu yang Anda pilih, misalnya [1]: ");

        if ($input_menu == 1) {
            $hasil_enkripsi = enkripsi();
            echo "\nHasil enkripsi: " . $hasil_enkripsi . "\n";
            echo "Kembali ke Menu Awal.....\n";
        } elseif ($input_menu == 2) {
            dekripsi();
            echo "\nHasil dekripsi bisa dilihat di atas\n";
            echo "Kembali ke Menu Awal.....\n";
        } elseif ($input_menu == 3) {
            break;
        } else {
            echo "Error: pastikan Anda memasukkan angka yang benar!\n";
        }
    }
}

function enkripsi() {
    $input_text = readline("Masukkan teks yang akan Anda enkripsi, misalnya [imam]: ");
    $input_key = (int)readline("Masukkan kunci/shift yang akan Anda gunakan, misalnya [angka]: ");
    $result = "";

    for ($i = 0; $i < strlen($input_text); $i++) {
        $char = $input_text[$i];

        if (ctype_upper($char)) {
            $result .= chr((ord($char) + $input_key - 65) % 26 + 65);
        } elseif ($char == " ") {
            $result .= " ";
        } else {
            $result .= chr((ord($char) + $input_key - 97) % 26 + 97);
        }
    }

    return $result;
}

function dekripsi() {
    $Alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $input_encrypted = readline("Masukkan pesan yang akan didekripsi, misalnya [grgr wdpsdq]: ");

    for ($key = 0; $key < strlen($Alphabet); $key++) {
        $translated = "";

        for ($i = 0; $i < strlen($input_encrypted); $i++) {
            $symbol = $input_encrypted[$i];

            if (strpos($Alphabet, $symbol) !== false) {
                $num = strpos($Alphabet, $symbol);
                $num = $num - $key;

                if ($num < 0) {
                    $num = $num + strlen($Alphabet);
                }

                $translated .= $Alphabet[$num];
            } else {
                $translated .= $symbol;
            }
        }

        echo "Hacking key #" . $key . ": " . $translated . "\n";
    }
}

function main() {
    headerInfo();
    menu();
}

if (PHP_SAPI === 'cli') {
    main();
} else {
    echo "Program ini dimaksudkan untuk dijalankan dari command line.";
}
?>
