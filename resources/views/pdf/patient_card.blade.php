<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ficha do Paciente - {{ $patient->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #000; }
        .row { display: flex; margin-bottom: 5px; }
        .label { width: 150px; font-weight: bold; }
        .value { flex: 1; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Ficha do Paciente</h2>
        <h3>{{ $patient->name }}</h3>
    </div>

    <div class="section">
        <div class="section-title">Dados Pessoais</div>
        <div class="row">
            <div class="label">Nome:</div>
            <div class="value">{{ $patient->name }}</div>
        </div>
        <div class="row">
            <div class="label">CPF:</div>
            <div class="value">{{ $patient->cpf }}</div>
        </div>

    </div>

</body>
</html>