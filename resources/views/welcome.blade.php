<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abaya Fishamo</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f4f4ef;
            color:#2d2d2d;
        }

        /* NAVBAR */
        .navbar{
            width:100%;
            padding:25px 80px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            position:absolute;
            top:0;
            z-index:10;
        }

        .logo{
            font-size:28px;
            font-weight:700;
            color:white;
            letter-spacing:2px;
        }

        .nav-links{
            display:flex;
            gap:20px;
        }

        .nav-links a{
            text-decoration:none;
            color:white;
            font-weight:500;
            transition:0.3s;
        }

        .nav-links a:hover{
            color:#d7e5d0;
        }

        /* HERO */
        .hero{
            height:100vh;
            background:
                linear-gradient(rgba(0,0,0,0.35),rgba(0,0,0,0.35)),
                url('https://images.unsplash.com/photo-1617038220319-276d3cfab638?q=80&w=1600&auto=format&fit=crop');
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            padding:20px;
        }

        .hero-content{
            max-width:800px;
            color:white;
        }

        .hero-content h1{
            font-size:72px;
            font-weight:700;
            margin-bottom:20px;
        }

        .hero-content p{
            font-size:20px;
            margin-bottom:35px;
            color:#f0f0f0;
        }

        .btn{
            display:inline-block;
            padding:15px 35px;
            background:#6f8f72;
            color:white;
            text-decoration:none;
            border-radius:40px;
            font-weight:600;
            transition:0.3s;
        }

        .btn:hover{
            background:#55745a;
            transform:translateY(-2px);
        }

        /* COLLECTION */
        .section{
            padding:80px;
        }

        .section-title{
            text-align:center;
            margin-bottom:50px;
        }

        .section-title h2{
            font-size:40px;
            color:#4e6752;
            margin-bottom:10px;
        }

        .section-title p{
            color:#777;
        }

        .products{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:30px;
        }

        .card{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-8px);
        }

        .card img{
            width:100%;
            height:380px;
            object-fit:cover;
        }

        .card-body{
            padding:20px;
        }

        .card-body h3{
            margin-bottom:10px;
            color:#4e6752;
        }

        .price{
            color:#6f8f72;
            font-weight:600;
        }

        /* FOOTER */
        footer{
            background:#4e6752;
            color:white;
            text-align:center;
            padding:30px;
            margin-top:50px;
        }

        @media(max-width:768px){

            .navbar{
                padding:20px;
            }

            .hero-content h1{
                font-size:42px;
            }

            .hero-content p{
                font-size:16px;
            }

            .section{
                padding:50px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">ABAYA FISHAMO</div>

        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    </div>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <h1>Elegant Muslim Fashion</h1>

            <p>
                Discover premium abaya collections with elegant modern style
                crafted for confidence and beauty.
            </p>

            <a href="/login" class="btn">
                Shop Collection
            </a>
        </div>
    </section>

    <!-- COLLECTION -->
    <section class="section">

        <div class="section-title">
            <h2>New Collection</h2>
            <p>Luxury modest wear with timeless elegance</p>
        </div>

        <div class="products">

    <div class="card">
        <img src="{{ asset('storage/products/1778754868.jpg') }}" alt="Abaya 1">

        <div class="card-body">
            <h3>Sage Premium Abaya</h3>
            <div class="price">Rp 499.000</div>
        </div>
    </div>

    <div class="card">
        <img src="{{ asset('storage/products/1778754953.jpg') }}" alt="Abaya 2">

        <div class="card-body">
            <h3>Luxury Olive Dress</h3>
            <div class="price">Rp 579.000</div>
        </div>
    </div>

    <div class="card">
        <img src="{{ asset('storage/products/1779105308.jpg') }}" alt="Abaya 3">

        <div class="card-body">
            <h3>Elegant Daily Abaya</h3>
            <div class="price">Rp 459.000</div>
        </div>
    </div>

</div>
        </div>

    </section>

    <footer>
        © 2026 Abaya Fishamo — Premium Muslim Fashion
    </footer>

</body>
</html>