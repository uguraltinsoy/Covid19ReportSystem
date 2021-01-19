var sorting = "DESC";
var totalCases = true;
var type = 0;

$(document).ready(function () {
    readData();    

    $.post("percent.php", {
        queryValues : "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC"
    }, function (sendData) {
        $('#graphDiv').html(sendData);
    });

    $("#table-tab").click(function () {
        $("#mGraphContainer").hide();
        $("#mTableContainer").show();
        $("#table-tab").removeClass("active");
        $("#graph-tab").addClass("active");
        $("#table-tab").addClass("inactice");
        $("#graph-tab").removeClass("inactice");
    });

    $("#graph-tab").click(function () {
        $("#mGraphContainer").show();
        $("#mTableContainer").hide();
        $("#table-tab").addClass("active");
        $("#graph-tab").removeClass("active");
        $("#table-tab").removeClass("inactice");
        $("#graph-tab").addClass("inactice");
    });

    $("#mCases").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 0;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 0;
            readData();
        }
    });

    $("#mDeaths").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 1;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 1;
            readData();
        }
    });

    $("#mRecovered").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 2;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 2;
            readData();
        }
    });

    $("#mActive").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 3;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 3;
            readData();
        }
    });

    $("#mCritical").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 4;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 4;
            readData();
        }
    });

    $("#mCasesPer").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 5;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 5;
            readData();
        }
    });

    $("#mDeathsPer").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 6;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 6;
            readData();
        }
    });

    $("#mTests").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 7;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 7;
            readData();
        }
    });

    $("#mTestsPop").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 8;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 8;
            readData();
        }
    });
    
    $("#mPopulation").click(function () {
        if (totalCases) {
            sorting = "ASC"
            totalCases = false;
            type = 9;
            readData();
        } else {
            sorting = "DESC"
            totalCases = true;
            type = 9;
            readData();
        }
    });

    $('#mPercentages').on('input', function (e) {
        var txt = $('#mPercentages').val();
        if (txt != "") {
            $.post("percent.php", {
                queryValues : "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase, flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country WHERE `cp`.`country` LIKE\'" + txt + "%\' ORDER BY `cp`.`country` ASC"
            }, function (sendData) {
                $('#graphDiv').html(sendData);
            });
        } else {
            $.post("percent.php", {
                queryValues : "SELECT cp.country, caseByPop, testByPop, caseByTest, deadByPop, deadByCase, recoverByPop, recoverbyCase,  flag FROM casesPercentage AS cp JOIN testsPercentage AS tp ON cp.country = tp.country JOIN deathsPercentage AS dp ON tp.country = dp.country JOIN recoveredPercentage AS rp ON dp.country = rp.country JOIN generaltable AS gt ON rp.country = gt.country ORDER BY `cp`.`country` ASC"
            }, function (sendData) {
                $('#graphDiv').html(sendData);
            });
        }
    });


    $('#mSumbit').on('input', function (e) {
        var txt = $('#mSumbit').val();
        if (txt != "") {
            $.post("table.php", {
                queryValues : "SELECT * FROM generaltable WHERE country LIKE \'" + txt + "%\' Order By country " + sorting
            }, function (gonderVeri) {
                $('#tableDiv').html(gonderVeri);
            });
        } else {
            $.post("table.php", {
                queryValues : "SELECT * FROM generaltable Order By cases " + sorting
            }, function (gonderVeri) {
                $('#tableDiv').html(gonderVeri);
            });
        }
    });

    function readData() {
        var queryValues = "SELECT * FROM generaltable Order By cases " + sorting;
        switch (type) {
            case 0:
                queryValues = "SELECT * FROM generaltable Order By cases " + sorting;
                break;
            case 1:
                queryValues = "SELECT * FROM generaltable Order By deaths " + sorting;
                break;
            case 2:
                queryValues = "SELECT * FROM generaltable Order By recovered " + sorting;
                break;
            case 3:
                queryValues = "SELECT * FROM generaltable Order By active " + sorting;
                break;
            case 4:
                queryValues = "SELECT * FROM generaltable Order By critical " + sorting;
                break;
            case 5:
                queryValues = "SELECT * FROM generaltable Order By casesPerOneMillion " + sorting;
                break;
            case 6:
                queryValues = "SELECT * FROM generaltable Order By deathsPerOneMillion " + sorting;
                break;
            case 7:
                queryValues = "SELECT * FROM generaltable Order By tests " + sorting;
                break;
            case 8:
                queryValues = "SELECT * FROM generaltable Order By testsPerOneMillion " + sorting;
                break;
            case 9:
                queryValues = "SELECT * FROM generaltable Order By population " + sorting;
                break;
            default:
        }
        $.post("table.php", {
            queryValues: queryValues
        }, function (gonderVeri) {
            $('#tableDiv').html(gonderVeri);
        });
    }
});
