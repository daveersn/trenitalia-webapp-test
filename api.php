<?php

//  Cerca stazioni
//************************************************************************************************************
//***  http://www.viaggiatreno.it/viaggiatrenonew/resteasy/viaggiatreno/cercaStazione/{NOME STAZIONE}      ***
//************************************************************************************************************

if(isset($_GET['partenzaSelect']) && isset($_GET['destinazioneSelect'])) {
    $rawResponse = file_get_contents("http://www.viaggiatreno.it/viaggiatrenonew/resteasy/viaggiatreno/soluzioniViaggioNew/".trim($_GET['partenzaSelect'])."/".trim($_GET['destinazioneSelect'])."/".trim($_GET['data'])."T".trim($_GET['time']).":00");
    $res = json_decode($rawResponse);
}

$stazioniRaw = file_get_contents("./stazioni.json");
$stazioni = json_decode($stazioniRaw);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
    <title></title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-800 flex justify-center items-center min-h-screen p-10">
    <a href="api.php" class="absolute top-0 left-0">
        <i class="fas fa-home text-5xl text-white p-5"></i>
    </a>
    <div class="flex flex-col justify-start items-center p-8 border-2 border-blue-200 shadow-md bg-white rounded-md space-y-7" style="min-height: 70vh; min-width: 50vw;">
        <form action="#" method="GET" class="flex w-full justify-between items-end">
            <div>
                <p class="uppercase text-lg font-bold tracking-wider">Cerca tratte</p>
                <div class="flex space-x-2">
                    <select name="partenzaSelect" class="border border-blue-200 rounded-md shadow p-1 bg-gray-100 w-36" required>
                        <option value="">Partenza</option>
                        <?php foreach ($stazioni as $key => $stazione):?>
                            <option value="<?=substr($stazione->id, 2) ?> "><?= $stazione->nomeLungo ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="destinazioneSelect" class="border border-red-300 rounded-md shadow p-1 bg-gray-100 w-36" required>
                        <option value="">Destinazione</option>
                        <?php foreach ($stazioni as $key => $stazione):?>
                            <option value="<?=substr($stazione->id, 2) ?> "><?= $stazione->nomeLungo ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="flex space-x-1">
                <input type="time" name="time" class="border border-blue-800 rounded-md shadow p-1 bg-gray-100" required>
                <input name="data" class="border border-yellow-400 rounded-md shadow p-1 bg-gray-100" type="date" required>
                <input type="submit" value="Cerca" class="border border-green-500 hover:bg-green-500 hover:text-white transition rounded-md shadow p-1 bg-gray-100">
            </div>
        </form>

        <?php (isset($res)) ? include 'printSolutions.php' : ""; ?>

        <?php if(isset($res)): ?>
        <hr class="py-4 w-full">
        <p class="text-center text-xl font-semibold uppercase">Struttura response</p>
        <pre class="border shadow-md bg-gray-900 text-white rounded-md p-6 overflow-auto w-full" style="max-height: 1000px;"><?= print_r($res); ?></pre>
        <hr class="py-4 w-full">
        <p class="text-center text-xl font-semibold uppercase">Struttura soluzione</p>
        <p>(Es. prima soluzione '[0]')</p>
        <pre class="border shadow-md bg-gray-900 text-white rounded-md p-6 w-full">
            <?= print_r($res->soluzioni[0]); ?></pre>
        <hr class="py-4 w-full">
        <p class="text-center text-xl font-semibold uppercase">Struttura tratta ('[vehicles]'')</p>
        <pre class="border shadow-md bg-gray-900 text-white rounded-md p-6 w-full">
            <?= print_r($res->soluzioni[0]->vehicles[0]); ?></pre>
        <?php endif; ?>
    </div>
</body>
</html>

<script>
</script>
