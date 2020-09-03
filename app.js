function LoadIn() {

    $.ajax({
        url: 'words.csv',
        dataType: 'text',
    }).done(successFunction);

    function deleteTable() {
        var table = document.getElementById("words");
        var rowCount = table.rows.length;
        for (var i = 0; i < rowCount; i++) {
            table.deleteRow(i);
        }
    }

    function successFunction(data) {

        var allRows = data.split(/\r?\n|\r/);
        var table = '<table id="words" class="table table-dark table-bordered table-hover table-striped">';

        for (var singleRow = 0; singleRow < allRows.length; singleRow++) {
            if (singleRow === 0) {
                table += '<thead>';
                table += '<tr>';
            } else {
                table += '<tr>';
            }
            var rowCells = allRows[singleRow].split(';');
            for (var rowCell = 0; rowCell < rowCells.length; rowCell++) {
                if (singleRow === 0) {
                    table += '<th>';
                    table += rowCells[rowCell];
                    table += '</th>';
                } else {
                    table += '<td>';

                    if (rowCell == 0) {
                        switch (rowCells[rowCell]) {
                            case "1":
                                table += "Family";
                                break;
                            case "2":
                                table += "Teszt";
                                break;
                        }
                    }
                    else {
                        table += rowCells[rowCell];
                    }

                    table += '</td>';
                }
            }
            if (singleRow === 0) {
                table += '</tr>';
                table += '</thead>';
                table += '<tbody>';
            } else {
                table += '</tr>';
            }
        }
        table += '</tbody>';
        table += '</table>';
        resetAdat("adatok");
        $('.adatok').append(table);
    }
}
function StartQuiz() {

    $.ajax({
        url: 'words.csv',
        dataType: 'text',
    }).done(feladatFeltoltes);


    function kerdesDataKivalasztas(data) {

        var quizKerdes = [, , , , ,];
        var allRows = data.split(/\r?\n|\r/);

        //  KÉRDÉS + VÁLASZ
        rndKerdes = Math.floor(Math.random() * allRows.length);
        quizKerdesData = allRows[rndKerdes].split(';');
        quizKerdes[0] = quizKerdesData[1];
        quizKerdes[1] = quizKerdesData[2];


        for (i = 2; i < 5; i++) {
            rndValaszok = Math.floor(Math.random() * allRows.length);
            quizValaszData = allRows[rndValaszok].split(';');
            quizKerdes[i] = quizValaszData[2];
        }
        return quizKerdes;

    };

    function randomTomb() {
        var as = [1, 2, 3, 4];
        var s = as.sort(func);

        function func(a, b) {
            return 0.5 - Math.random();
        }


        return as;

    }
    function kerdesToTable(quizKerdes) {

        var rnd = randomTomb();

        var table = "<table class='table table-dark table-bordered center'><thead class=''><tr><th class='bg-info' colspan='2'>";
        table += quizKerdes[0];
        table += "</th></tr></thead><tbody><tr><td>";
        table += quizKerdes[rnd[0]];
        table += "</td><td>";
        table += quizKerdes[rnd[1]];
        table += "</td></tr><tr><td>";
        table += quizKerdes[rnd[2]];
        table += "</td><td>";
        table += quizKerdes[rnd[3]];
        table += "</td></tr></tbody></table>";

        return table;

    }

    function kerdesToDiv(quizKerdes) {

        var rnd = randomTomb();
        var output = '';

        output += "<div class='card bg-dark col-8 border-0 text-center rounded-pill'>";

        output += "<div class='card-header active bg-info h3' stlye='width: 18rem;'>";
        output += quizKerdes[0];
        output += "</div>"

        output += "<ul class='bg-dark list-group'>";
        output += `<li id='valasz1' onclick="megoldas('${quizKerdes[1]}','valasz1')" class='btn list-group-item text-dark list-group-item-action'>`;
        output += quizKerdes[rnd[0]];
        output += `</li><li id='valasz2' onclick="megoldas('${quizKerdes[1]}','valasz2')" class='btn list-group-item list-group-item-action'>`
        output += quizKerdes[rnd[1]];
        output += `</li><li id='valasz3' onclick="megoldas('${quizKerdes[1]}','valasz3')" class='btn list-group-item list-group-item-action'>`
        output += quizKerdes[rnd[2]];
        output += `</li><li id='valasz4' onclick="megoldas('${quizKerdes[1]}','valasz4')" class='btn btn-light list-group-item list-group-item-action'>`
        output += quizKerdes[rnd[3]];
        output += "</li></ul>";

        nextButton = '<button type="button" onClick="StartQuiz()" class="btn btn-warning">Következő</button></div>';
        output += nextButton;
        return output;

    }
    function feladatFeltoltes(data) {

        resetAdat("adatok");
        quizKerdes = kerdesDataKivalasztas(data);
        $('.adatok').append(kerdesToDiv(quizKerdes));
    }
}

function resetAdat(adat) {
    var reset = document.getElementsByClassName(adat);
    reset[0].innerHTML = "";
    return;
}

function megoldas(megoldas, valasz) {

    var kivalasztott = document.getElementById(valasz).innerHTML;
    if (megoldas === kivalasztott) { 
        document.getElementById(valasz).classList.add("bg-success")
    }
    else { document.getElementById(valasz).classList.add("bg-danger") }

}

