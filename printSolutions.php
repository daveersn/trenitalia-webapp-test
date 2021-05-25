<?php
foreach ($res->soluzioni as $key => $soluzione):?>
<div class="bg-gray-100 shadow border border-blue-200 rounded-md text-gray-800 p-3 mx-10 w-full">
    <p class="font-bold text-center uppercase tracking-wider" onclick="
     document.getElementById('solutionTab<?=$key?>').hidden = !
     document.getElementById('solutionTab<?=$key?>').hidden">Soluzione #
        <?=$key;?>
    </p>
    <div id='solutionTab<?=$key?>' hidden>
        <p class="flex justify-between items-center">
            <span><b>Durata viaggio:</b>
                <?= $soluzione->durata ?> <i class="far fa-clock"></i></span>

            <span><i class="far fa-calendar-alt"></i><b> Data:</b>
                <?=
            explode('T', $soluzione->vehicles[0]->orarioPartenza)[0];?></span>
        </p>
        <hr class="my-3 border">
        <div class="grid grid-cols-2">
            <?php
        foreach ($soluzione->vehicles as $key => $tratta):?>
            <div>
                <p class="font-semibold uppercase tracking-wider"><span class="font-bold">Scalo </span>#
                    <?= $key ?>
                </p>
                <p><b>Da:</b> <span class="text-blue-300 font-semibold">
                    <?= $tratta->origine?> | <?=
                        substr(explode('T', $tratta->orarioPartenza)[1], 0, 5);?>
                    </span><i class="far fa-clock text-xs"></i>
                </p>
                <p><b>A:</b> <span class="text-red-400 font-semibold">
                        <?= $tratta->destinazione ?> | <?=
                        substr(explode('T', $tratta->orarioPartenza)[1], 0, 5);?>
                    </span><i class="far fa-clock text-xs"></i>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
