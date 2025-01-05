<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #74b9ff,rgb(17, 59, 91));
            font-family: 'Arial', sans-serif;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 50px 100px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin-bottom: 40px;
            font-size: 3rem;
            color: #333;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 20px;
            margin: 20px 0;
            font-size: 1.5rem;
            color: white;
            background:  #4cafa2;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background:rgb(54, 82, 133);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> Bilgi Sistemi</h1>
        <form action="akademisyen_giris.php" method="post">
            <button class="btn" type="submit">Akademisyen Girişi</button>
        </form>
        <form action="ogrenci_giris.php" method="post">
            <button class="btn" type="submit">Öğrenci Girişi</button>
        </form>
    </div>
</body>
</html>
