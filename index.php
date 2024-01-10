<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator | Sederhana</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
    body {
        background: #0174BE;
        font-family: 'Arial', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .kalkulator {
        width: 300px;
        background: #fff;
        margin: 50px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px 0px #000000;
    }

    .judul {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        align-items: start;
    }

    .bil,
    .opt,
    .tombol {
        width: 100%;
        margin: 8px 0;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .tombol {
        background: #e43a42;
        border: none;
        color: #fff;
        padding: 10px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .hasil {
        width: 100%;
        margin-top: 20px;
        padding: 10px;
        font-size: 18px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        text-align: center;
    }

    .error-message {
        color: #e43a42;
        font-size: 12px;
        text-align: left;
        margin-top: -5px;
        margin-left: 5px;
    }


    .error-input {
        border: 1px solid #e43a42;
    }
    </style>
</head>

<body>
    <div id="particle-canvas">
        <?php
        $hasil = ""; // Initialize $hasil variable
        $bil1_value = isset($_POST['bil1']) ? $_POST['bil1'] : "";
        $bil2_value = isset($_POST['bil2']) ? $_POST['bil2'] : "";
        $error_bil1 = $error_bil2 = ""; // Initialize error variables

        $selected_tambah = $selected_kurang = $selected_kali = $selected_bagi = ""; // Initialize selected options

        if (isset($_POST['hitung'])) {
            $bil1 = $_POST['bil1'];
            $bil2 = $_POST['bil2'];
            $operasi = $_POST['operasi'];

            // Validate input
            if (empty($bil1)) {
                $error_bil1 = "Bilangan Pertama wajib diisi!";
            }

            if (empty($bil2)) {
                $error_bil2 = "Bilangan Kedua wajib diisi!";
            }

            if (empty($bil1) || empty($bil2)) {
                $hasil = "0";
            } else {
                // Perform calculation only if both inputs are filled
                switch ($operasi) {
                    case 'tambah':
                        $hasil = $bil1 + $bil2;
                        $selected_tambah = "selected";
                        break;
                    case 'kurang':
                        $hasil = $bil1 - $bil2;
                        $selected_kurang = "selected";
                        break;
                    case 'kali':
                        $hasil = $bil1 * $bil2;
                        $selected_kali = "selected";
                        break;
                    case 'bagi':
                        $hasil = $bil1 / $bil2;
                        $selected_bagi = "selected";
                        break;
                    default:
                        $hasil = "Operasi tidak valid";
                }
            }
        }
        ?>

        <div class="kalkulator">
            <h2 class="judul">Kalkulator Sederhana</h2>
            <form method="post" action="index.php" class="form-container">
                <input type="text" name="bil1" class="bil <?php echo !empty($error_bil1) ? 'error-input' : ''; ?>"
                    autocomplete="off" placeholder="Masukkan Bilangan Pertama" value="<?php echo $bil1_value; ?>">
                <span class="error-message"><?php echo $error_bil1; ?></span>

                <input type="text" name="bil2" class="bil <?php echo !empty($error_bil2) ? 'error-input' : ''; ?>"
                    autocomplete="off" placeholder="Masukkan Bilangan Kedua" value="<?php echo $bil2_value; ?>">
                <span class="error-message"><?php echo $error_bil2; ?></span>

                <select class="opt" name="operasi">
                    <option value="tambah" <?php echo $selected_tambah; ?>>+</option>
                    <option value="kurang" <?php echo $selected_kurang; ?>>-</option>
                    <option value="kali" <?php echo $selected_kali; ?>>x</option>
                    <option value="bagi" <?php echo $selected_bagi; ?>>/</option>
                </select>
                <input type="submit" name="hitung" value="Hitung" class="tombol">
            </form>
            <?php if (isset($_POST['hitung'])) { ?>
            <div class="hasil">
                Hasil: <?php echo $hasil; ?>
            </div>
            <?php } else { ?>
            <div class="hasil">
                Hasil: 0
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>