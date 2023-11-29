<!DOCTYPE html>
<html>

<head>

    <style>
        @page {
            margin: 0;
            font-family: 'Arial';
        }

        @font-face {
            font-family: 'Arial';
            src: url('/ruta/a/arial.ttf');
        }

        body {
            font-family: 'Arial', sans-serif;
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

        /* Establece un salto de página antes de la sección */
        section {
            margin: 0.5cm 2cm;
            /* Salto de página antes de la sección */
        }

        section.plan-educacional {
            page-break-inside: avoid;
            padding-top: 3cm;
        }

        /* Establece el padding-top del primer elemento .plan-educacional a 0cm */
        section.plan-educacional:nth-of-type(2) {
            padding-top: 0cm;
        }

        /* Evita que las imágenes se dividan entre páginas */
        img {
            max-width: 100%;
            /* Evita que las imágenes se dividan entre páginas */
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
            margin: 0.5cm 1cm;
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
                    <h4>Paciente: <span>{{ $data->name }}</span></h4>
                </td>
                <td style="text-align: right; ">
                    <h4>Fecha: <span>{{ now()->format('d/m/Y') }}</span></h4>
                </td>
            </tr>
        </table>
    </section>


    <h1 style="text-align: center;">PLAN EDUCACIONAL</h1>


    @foreach ($data->planes_educacionales as $plan_educacional)
        <section class="plan-educacional" style="font-family: 'Arial';">
            <div style="font-weight: bold; font-size: 20px; text-align: center; font-family: 'Arial';">
                {{ $plan_educacional->plan_educacional['plan_educacional'] }}
            </div>
            <div style="font-size: 16px; text-align: center; width: 100%; margin: 0 auto; font-family: 'Arial';">
                {{ $plan_educacional->plan_educacional['descripcion'] }}
            </div>
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ $plan_educacional->plan_educacional['imagen'] }}" alt=""
                    style="max-width: 500px; max-height: 500px;">
            </div>
        </section>
    @endforeach


</body>

</html>
