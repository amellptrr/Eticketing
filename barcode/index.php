<html>
<head>
    <title>Tutorial Membuat Barcode dengan PHP</title>
</head>
<body>
    <h3>Membuat Barcode dengan PHP dan MySQL</h3>
    <p>
    <form method="POST">
    <table border="0" cellpadding="2">
        <tr>
            <td width="75">Input Kode</td>
            <td>: <input type="text" name="kode_barang" size="24" required></td>
        </tr>
        <tr>
            <td></td>
            <td>   <input type="submit" name="generate" value="Generate"></td>
        </tr>
    </table>
    </form>
    </p>
    <p>
    <?php
       if (isset($_POST['generate'])) {
            
            //buat folder untuk simpan file image
            $tempdir    ="img-barcode/";
            if (!file_exists($tempdir))
            mkdir($tempdir, 0755);
           
            $target_path    =$tempdir . $_POST['kode_barang'] . ".png";
           
            //cek apakah server menggunakan http atau https
            $protocol    =stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
           
            //url file image barcode 
            $fileImage    =$protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/php-barcode/barcode.php?text=" . $_POST['kode_barang'] . "&codetype=code128&print=true&size=55";
           
            //ambil gambar barcode dari url diatas
            $content    =file_get_contents($fileImage);
           
            //simpan gambar ke folder
            file_put_contents($target_path, $content);
           
            //menampilkan file image barcode
            echo '
            <table border="0" cellpadding="2">
                <tr>
                    <td width="75"></td>
                    <td><img src="php-barcode/barcode.php?text=' . $_POST['kode_barang'] . '&codetype=code128&print=true&size=55" /></td>
                </tr>
            </table>';
        }
    ?>
    </p>
</body>
</html>