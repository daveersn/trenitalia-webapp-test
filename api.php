<?php

$rawResponse = file_get_contents("http://www.viaggiatreno.it/viaggiatrenonew/resteasy/viaggiatreno/soluzioniViaggioNew/2446/1700/2021-05-27T00:00:00");
$res = json_decode($rawResponse);

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
<body class="bg-gray-800 flex justify-center items-center min-h-screen p-10" onclick="hideAutoCmp()">
    <div class="flex flex-col justify-center items-center p-8 border-2 border-blue-200 shadow-md bg-white rounded-md space-y-7">
        <div class="flex w-full justify-between items-end">
            <div>
                <p class="uppercase text-lg font-bold tracking-wider">Cerca tratte</p>
                <div class="flex space-x-2">
                    <div class="relative">
                        <input type="text" id="pInput" class="border border-blue-200 rounded-md shadow px-1 bg-gray-100" placeholder="Partenza" autocomplete="off" value="" oninput="showAutoCmp(this, 'autocmpPartenze');">
                        <div class="rounded-md shadow border absolute bg-white z-50 w-44" id="autocmpPartenze" hidden>
                            <p class="hover:bg-gray-200 p-1 px-2" onclick="autocompPartenze(this.innerHTML, 'pInput')">napoli</p>
                            <hr>
                            <p class="hover:bg-gray-200 p-1 px-2">napoli</p>
                            <hr>
                            <p class="hover:bg-gray-200 p-1 px-2">napoli</p>
                        </div>
                    </div>
                    <input type="text" class="border border-red-300 rounded-md shadow px-1 bg-gray-100" placeholder="Destinazione" autocomplete="off">
                </div>
            </div>
            <div><input class="border border-blue-200 rounded-md shadow px-1 bg-gray-100" type="date"></div>
        </div>

        <?php include 'printSolutions.php'; ?>

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
    </div>
</body>
</html>

<script>
    function autocompPartenze(value, input) {
        document.getElementById(input).value = value;
    }
    function showAutoCmp(el, autocmp) {
        if(el.value != "") {
            document.getElementById(autocmp).hidden = false;
        }
    }

    function hideAutoCmp() {
        document.getElementById('autocmpPartenze').hidden = true;
    }
</script>
