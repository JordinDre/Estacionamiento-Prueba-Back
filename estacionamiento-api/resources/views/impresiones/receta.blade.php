<!DOCTYPE html>
<html>

<head>

    <style>
        @page {
            margin: 0;
        }

        @font-face {
            font-family: 'Arial';
            src: url('/ruta/a/arial.ttf');
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        p {
            font-family: 'Arial', sans-serif;
        }

        header {
            margin: 1cm
        }

        .icono {
            margin-right: 5px;
            height: 30px;
        }

        section {
            margin: 0.5cm 2cm
        }

        section::after {
            content: "";
            display: block;
            position: absolute;
            top: 350px;
            left: 130px;
            width: 85%;
            height: 85%;
            background-image: url("{{ public_path('/img/logo.png') }}");
            background-repeat: no-repeat;
            background-size: contain;
            opacity: 0.04;
            pointer-events: none;
            z-index: -1;
        }

        h1 {
            font-size: 27px;
            font-weight: bold;
            margin: 0;
            margin-bottom: 10px;
            color: rgb(16, 124, 160);
        }

        h2 {
            font-size: 18px;
            margin: 0;
            color: rgb(11, 92, 119)
        }

        h3 {
            font-size: 15px;
            margin: 0;
            margin-bottom: 10px;
            color: rgb(12, 77, 124);
        }

        h4 {
            font-size: 15px;
            margin: 0;
            margin-bottom: 10px;
            color: black;
            font-weight: bold
        }

        h5 {
            font-size: 12px;
            margin: 0;
            margin-bottom: 10px;
            color: white;
            font-weight: lighter
        }

        span {
            font-weight: lighter
        }

        .salto {
            margin-top: 14px
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 80px;
            background-color: rgb(16, 124, 160);
            text-align: center;
            padding: 1cm;
            padding-top: 1cm;
            padding-bottom: 1.5cm
        }

        .separator {
            border-top: 4px solid rgb(16, 124, 160);
            margin: 1cm;
        }
    </style>
</head>

<body>
    <header>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: middle; width: 15%;">
                    <img src="{{ public_path('/img/logo.png') }}" alt="Logo" style="max-width: 100%;">
                </td>
                <td style="vertical-align: middle; padding-left: 10px;width: 50%;">
                    <h1>Fisio. Jennifer Acevedo T.</h1>
                    <h2>FISIO HIS GRACE</h2>
                </td>
                <td style="text-align: right; padding-left: 10px;">
                    <h3>Clínica de Terapia Física y Terapia Ocupacional</h3>
                </td>
            </tr>
        </table>
    </header>

    <div class="separator"></div>

    <section>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: middle; ">
                    <h4>Paciente: </h4>
                    <h4>Diagnóstico: </h4>
                </td>
                <td style="text-align: right; ">
                    <h4>Edad: </h4>
                    <h4>Fecha: </h4>
                </td>
            </tr>
        </table>
    </section>

    <footer>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="vertical-align: middle; width: 33.33%;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: right; padding-right: 5px;">
                                <img src="{{ public_path('/img/telefono.png') }}" class="icono"
                                    style="vertical-align: middle;">
                            </td>
                            <td style="padding-left: 5px;">
                                <h5 style="margin: 0;">(+502) 3830-9366</h5>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: middle; width: 33.33%;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: right; padding-right: 5px;">
                                <img src="{{ public_path('/img/whatsapp.png') }}" class="icono"
                                    style="vertical-align: middle;">
                            </td>
                            <td style="padding-left: 5px;">
                                <h5 style="margin: 0;">(+502) 3830-9366</h5>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: middle; width: 33.33%;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: right; padding-right: 5px;">
                                <img src="{{ public_path('/img/facebook.png') }}" class="icono"
                                    style="vertical-align: middle;">
                            </td>
                            <td style="padding-left: 5px;">
                                <h5 style="margin: 0;">Fisio His Grace</h5>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-top:20px">
            <tr>
                <td style="vertical-align: middle; width: 24%;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: right; padding-right: 5px;">
                                <img src="{{ public_path('/img/instagram.png') }}" class="icono"
                                    style="vertical-align: middle;">
                            </td>
                            <td style="padding-left: 5px;">
                                <h5 style="margin: 0;">FISIOHIS</h5>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: middle; width: 11%;">
                </td>
                <td style="vertical-align: middle; width: 65%;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="text-align: right; padding-right: 5px;">
                                <img src="{{ public_path('/img/direccion.png') }}" class="icono"
                                    style="vertical-align: middle;">
                            </td>
                            
                            <td style="padding-left: 5px;">
                                <h5 style="margin: 0;">Calzada 25 de Junio, Barrio Las Joyas, Poptún, Petén</h5>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </footer>
</body>

</html>
