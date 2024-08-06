<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    </head>
    <header>
    <nav class="navbar navbar-expand-lg  bg-body-tertiary">
  <div style="padding-left:200px; padding-right:200px;" class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/logoooo.png" height="70px" alt="..."></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul style="margin: 0 auto;" class="navbar-nav d-flex justify-content-center mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#ssese">Características</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#sese2">Contacto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Bajar el Plugin</a>
        </li>
      
      </ul>
    </div>
    @if (Auth::check())
    <div>
        <a class="butonini" href="/dashboard">Ir al panel</a>
    </div>
@else
    <div>
        <a class="butonini" href="/login">Iniciar Sesión</a>
        <a class="butonini" href="/register">Registrarse</a>
    </div>
@endif
  </div>
</nav>
    </header>
    <body>
        <div style="height:815px; background-size:cover; background-repeat:no-repeat; background-image: url(img/banner.jpeg)"  class=" contenedorprimero container-fluid">
          
        </div>
        <div  class=" contenedorprimero2 container-lg">
        <div style="text-align: center;" class="col">
            <p class="parr2">PLUGIN STARKEN DESPACHO GRATIS</p>
            <p class="parr3">¿A domicilio, Agencias o Sucursales? ¡Listo!</p>
            <p class="parr4">Permite a tus clientes decidir la mejor opción para recibir su pedido. Sin costo para tu eCommerce.</p>
            <img src="img/screen.png" width="750px"  alt="...">
        </div>
        </div>
        <div  class=" contenedorprimero3 container-lg">
            <div id="ssese" style="text-align: center;" class="col">
                <p class="parr2">SIN NECESIDAD DE CONTRATOS</p>
                <p class="parr3">Nuestro servicio funciona y punto.</p>
                <p class="parr4">Nuestro plugin para WooCommerce entrega características y una performance que lo hacen único sin afectar el rendimiento de tu eCommerce.</p>
            </div>
            <div class="row">
                <div class="col">
                    <div class="cardsynx">
                        <img src="img/ejem.png"  alt="...">
                        <div class="conparf">
                            <p class="carp1">Despacho a Domicilio</p>
                            <p class="carp2">Tus clientes pueden saber con anticipación el costo preciso y transparente del despacho a su domicilio.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cardsynx">
                        <img src="img/ejem.png"  alt="...">
                        <div class="conparf">
                            <p class="carp1">Despacho a Domicilio</p>
                            <p class="carp2">Tus clientes pueden saber con anticipación el costo preciso y transparente del despacho a su domicilio.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cardsynx">
                        <img src="img/ejem.png"  alt="...">
                        <div class="conparf">
                            <p class="carp1">Despacho a Domicilio</p>
                            <p class="carp2">Tus clientes pueden saber con anticipación el costo preciso y transparente del despacho a su domicilio.</p>
                        </div>
                    </div>
                </div>
            
            </div>
            <div style="margin-top: 40px;" class="row">
                <div class="col">
                    <div class="cardsynx">
                        <img src="img/ejem.png"  alt="...">
                        <div class="conparf">
                            <p class="carp1">Despacho a Domicilio</p>
                            <p class="carp2">Tus clientes pueden saber con anticipación el costo preciso y transparente del despacho a su domicilio.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cardsynx">
                        <img src="img/ejem.png"  alt="...">
                        <div class="conparf">
                            <p class="carp1">Despacho a Domicilio</p>
                            <p class="carp2">Tus clientes pueden saber con anticipación el costo preciso y transparente del despacho a su domicilio.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="cardsynx">
                        <img src="img/ejem.png"  alt="...">
                        <div class="conparf">
                            <p class="carp1">Despacho a Domicilio</p>
                            <p class="carp2">Tus clientes pueden saber con anticipación el costo preciso y transparente del despacho a su domicilio.</p>
                        </div>
                    </div>
                </div>
            
            </div>

        </div>
            <div class=" contenedorprimero4 container-fluid">
                <div class="minrowcontact row">
                    <div class="forrep col"></div>
                    <div class="definit col">
                        <div class="marlef">
                        <p class="min1">VERSIÓN PREMIUM</p>
                        <p class="min2">Nuevas funcionalidades todo el tiempo…</p>
                        <p class="min3">Trabajamos día a día para agregar nuevas funcionalidades al plugin (como seguimiento de despacho dentro de la orden del cliente). Dichas funcionalidades serán añadidas a la versión premium del plugin que actualmente se encuentra en desarrollo. Infórmate de sus avances en nuestras Redes Sociales.

                            Facebook
                            Instagram</p>
                        </div>
                    </div>
                </div>
            </div>
           <div id="sese2" class="container-fluid" style="padding-top: 100px; padding-bottom:80px;">
                <div class="formulario">
                    <h2>Formulario de Contacto</h2>
                    <form action="#" method="POST">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" id="correo" name="correo" required>
                
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono">
                
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" required></textarea>
                
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html>
<style>
     .formulario {
        
    max-width: 1000px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px #ff4c24;
    }
    .formulario label, .formulario input, .formulario textarea {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
    .formulario textarea {
        height: 120px;
    }
    .formulario button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
    }
    .formulario button:hover {
        background-color: #0056b3;
    }
    .bbtnn{    font-family: "Montserrat", Sans-serif;
    font-size: 20px;
    fill: #FFFFFF;
    color: #FFFFFF;
    background-color: #FFFFFF00;
    border-style: solid;
    border-width: 3px 3px 3px 3px;
    border-color: #FFFFFF;
    border-radius: 50px 50px 50px 50px;
    padding: 15px 24px 15px 24px;}
    .butonini:hover{background:white; border:2px solid #ff4c24; color:#ff4c24; }
    .butonini{ background: #ff4c24; color:white; font-family: "Montserrat", Sans-serif; text-decoration: none; 
    padding-top: 9px;
    padding-bottom: 9px;
    padding-left: 24px;
    padding-right: 24px;
    border-radius: 50px;}
    .marlef{margin-left: 50px; width: 68%;}
    .definit{display: flex; justify-content: start; align-items: center;}
    .contenedorprimero4{ background: #111827; margin-top: 50px;   align-content: center; justify-content:center;  min-height: 500px;}
    .min1{color:#d1d5db;font-size: 16px;}
    .min3{ text-align:justify; color:#d1d5db;font-size: 18px;}
    .min2{color:#ffffff;font-size: 36px; font-weight: 700;}
    .forrep{background-image: url(img/social.jpg); background-size: cover; background-repeat: none; background-position: center;}
    .minrowcontact{min-height: 600px;}
    .carp1{color: black; font-weight: 600;}
    .carp2{font-size: 16px; color: gray;}
    .cardsynx{ text-align: center; width: 350px; }
    .conparf{ margin-top: -10px; padding: 40px 8px; background: #f9fafb;}
    .parr2{font-size: 18px; color: red;}
    .parr3{font-weight:700; font-size: 36px; color: #111827;}
    .parr4{font-size: 18px; color: white;}
    .contenedorprimero3{ margin-top: 50px;  padding: 40px 0px; align-content: center; justify-content:center;  min-height: 500px;}
    .contenedorprimero2{ margin-top: 50px; padding: 40px 0px; align-content: center; justify-content:center;  min-height: 500px;}
    .contenedorprimero{ align-content: center; justify-content: center; background: #111827; min-height: 600px;}
    .titulosP{font-size: 60px; color: white; font-weight: 700;}
    .titulosP2{font-size: 60px; color: red; font-weight: 700;}
    .parrafoprimero{font-size: 18px; color: white;}
    .contenedorsecond{display:flex; align-items: center; justify-content: center;}
</style>
